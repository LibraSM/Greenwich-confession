<?php
declare(strict_types=1);
require_once __DIR__ . '/../Models/Account.php';

class AuthController
{
    private Account $accountModel;

    public function __construct()
    {
        $this->accountModel = new Account();
    }

    public function register(): void
    {
        require __DIR__ . '/../Views/auth/register.php';
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?controller=auth&action=register');
            exit;
        }

        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $errors = [];

        if ($username === '') {
            $errors[] = 'Username is required.';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'A valid email is required.';
        }

        if (strlen($password) < 6) {
            $errors[] = 'Password must be at least 6 characters.';
        }

        if ($this->accountModel->emailExists($email)) {
            $errors[] = 'Email already exists.';
        }

        if (!empty($errors)) {
            require __DIR__ . '/../Views/auth/register.php';
            return;
        }
        $this->accountModel->create(
            $username,
            $email,
            $password
        );

        Flash::set(
            'success',
            'Account created successfully, use your credentials to log in.'
        );

        header('Location: ?controller=auth&action=login');
        exit;

    }

    public function login(): void
    {
        require __DIR__ . '/../Views/auth/login.php';
    }

    public function authenticate(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?controller=auth&action=login');
            exit;
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $errors = [];

        $account = $this->accountModel->getByEmail($email);

        if (!$account || !password_verify($password, $account['password'])) {
            $errors[] = 'Invalid email or password.';
            require __DIR__ . '/../Views/auth/login.php';
            return;
        }

        session_regenerate_id(true);

        $_SESSION['user_id'] = $account['id'];
        $_SESSION['username'] = $account['username'];
        $_SESSION['profile_image'] = $account['profile_image'];
        $_SESSION['is_admin'] = $account['is_admin'];

        Flash::set(
            'success',
            'Welcome back, '. $account['username'] . '!'
        );

        header('Location: ?controller=home&action=index');
        exit;
    }
    
    public function logout(): void
    {
        session_unset();
        session_destroy();

        session_start();

        Flash::set(
            'info',
            'You have been logged out.'
        );

        header('Location: ?controller=auth&action=login');
        exit;
    }

    public function profile(): void 
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }

        $account = $this->accountModel->getById(
            (int)$_SESSION['user_id']
        );

        if (!$account) {
            header('Location: ?controller=auth&action=login');
            exit;
        }

        $_SESSION['username'] = $account['username'];
        $_SESSION['profile_image'] = $account['profile_image'];
        $_SESSION['is_admin'] = $account['is_admin'];

        require __DIR__ . '/../Views/auth/profile.php';
    }

    public function edit(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }

        $account = $this->accountModel->getById(
            (int)$_SESSION['user_id']
        );

        if (!$account) {
            die('Account not found.');
        }

        require __DIR__ . '/../Views/auth/edit.php';
    }

    public function update(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?controller=auth&action=edit');
            exit;
        }

        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        $account = $this->accountModel->getById(
            (int)$_SESSION['user_id']
        );

        $profileImage = $account['profile_image'];

        $errors = [];
        if ($password !== '') {
            if (strlen($password) < 6) {
                $errors[] = 'Password must be at least 6 characters.';
            }
            if ($password !== $confirmPassword) {
                $errors[] = 'Passwords do not match.';
            }
        }

        if ($username === '') {
            $errors[] = 'Username is required';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email.';
        }

        if (
            $this->accountModel->emailExistsForOtherUser(
                $email,
                (int)$_SESSION['user_id']
            )
        ) {
            $errors[] = 'Email is already in use.';
        }

        if (!empty($errors)) {
            $account = [
                'id' => $_SESSION['user_id'],
                'username' => $username,
                'email' => $email
            ];

            require __DIR__ . '/../Views/auth/edit.php';
            return;
        }

        if (
            isset($_FILES['profile_image']) &&
            $_FILES['profile_image']['error'] !== UPLOAD_ERR_NO_FILE
        ) {
            if ($_FILES['profile_image']['error'] !== UPLOAD_ERR_OK) {
                die('Profile image upload failed.');
            }

            if ($_FILES['profile_image']['size'] > 5 * 1024 * 1024) {
                die('The profile image must be smaller than 5MB.');
            }

            $allowedTypes = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/gif' => 'gif',
                'image/webp' => 'webp',
            ];

            $fileInfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $fileInfo->file($_FILES['profile_image']['tmp_name']);

            if (!isset($allowedTypes[$mimeType])) {
                die('Only JPG, PNG, GIF and WEBP images are allowed.');
            }

            $uploadDirectory = __DIR__ . '/../../public/uploads/';

            if (!is_dir($uploadDirectory)) {
                mkdir($uploadDirectory, 0755, true);
            }

            $profileImage = bin2hex(random_bytes(16))
                . '.'
                . $allowedTypes[$mimeType];
            $uploadPath = $uploadDirectory . $profileImage;

            if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadPath)) {
                die('Unable to save the uploaded image.');
            }

            if (
                !empty($account['profile_image']) &&
                file_exists($uploadDirectory . $account['profile_image'])
            ) {
                unlink($uploadDirectory . $account['profile_image']);
            }
        }

        $this->accountModel->update(
            (int)$_SESSION['user_id'],
            $username,
            $email,
            $profileImage,
            $password
        );

        $_SESSION['username'] = $username;
        $_SESSION['profile_image'] =  $profileImage;

        Flash::set(
            'success',
            'Profile update successfully.'
        );

        header('Location: ?controller=auth&action=profile');
        exit;
    }
}
