<?php
declare(strict_types=1);
require_once __DIR__ . '/../Models/Account.php';
require_once __DIR__ . '/../Models/Module.php';
require_once __DIR__ . '/../Models/Post.php';

class PostsController
{
    private Post $postModel;
    private Account $accountModel;
    private Module $moduleModel;

    public function __construct()
    {
        $this->postModel = new Post();
        $this->accountModel = new Account();
        $this->moduleModel = new Module();
    }

    private function requireLogin(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
    }

    public function index(): void
    {
        header('Location: ?controller=home&action=index');
        exit;
    }

    public function show(int $id): void
    {
        $post = $this->postModel->getById($id);

        if (!$post) {
            die('Post not found.');
        }

        require __DIR__ . '/../Views/posts/show.php';
    }

    public function create(): void
    {
        $this->requireLogin();
        $modules = $this->moduleModel->getAll();

        require __DIR__ . '/../Views/posts/create.php';
    }

    public function store(): void
    {
        $this->requireLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?controller=home&action=index');
            exit;
        }

        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        $userId = (int)$_SESSION['user_id'];
        $moduleId = (int)$_POST['module_id'];
        $image = null;

        if ($title === '') {
            die('Post title is required.');
        }

        if ($content === '') {
            die('Post content is required.');
        }

        if (!$this->accountModel->getById($userId)) {
            die('Please select a valid author.');
        }

        if (!$this->moduleModel->getById($moduleId)) {
            die('Please select a valid module.');
        }

        if (
            isset($_FILES['image']) &&
            $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE
        ) {
            if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                die('Image upload failed.');
            }

            $allowedTypes = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/gif' => 'gif',
                'image/webp' => 'webp'
            ];

            $fileInfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $fileInfo->file($_FILES['image']['tmp_name']);

            if (!isset($allowedTypes[$mimeType])) {
                die('Only JPG, PNG, GIF and WEBP images are allowed.');
            }

            $image = time() . '_' . basename($_FILES['image']['name']);
            $uploadPath = __DIR__ . '/../../public/uploads/' . $image;

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                die('Unable to save the uploaded image.');
            }
        }

        $this->postModel->create(
            $title,
            $content,
            $image,
            $userId,
            $moduleId
        );

        header('Location: ?controller=home&action=index');
        exit;
    }
}
