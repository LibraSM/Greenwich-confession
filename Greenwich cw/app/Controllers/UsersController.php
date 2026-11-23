<?php
declare(strict_types = 1);
require_once __DIR__ . '/../Models/Account.php';
class UsersController
{
    private Account $accountModel;
    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
        if (empty($_SESSION['is_admin'])) {
            header('Location: ?controller=home&action=index');
            exit;
        }
        $this->accountModel = new Account();
    }

    public function index(): void
    {
        $users = $this->accountModel->getAll();
        require __DIR__ . '/../Views/users/index.php';
    }

    public function create(): void
    {
        require __DIR__ . '/../Views/users/create.php';
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?controller=users&action=index');
            exit;
        }

        $this->accountModel->create(
            trim($_POST['username'] ?? ''),
            trim($_POST['email'] ?? ''),
            trim($_POST['password'] ?? '')
        );

        header('Location: ?controller=users&action=index');
        exit;
    }

    public function edit(int $id): void
    {
        $user = $this->accountModel->getById($id);
        if (!$user) {
            die("User not found.");
        }
        require __DIR__ . '/../Views/users/edit.php';
    }

    public function update(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?controller=users&action=index');
            exit;
        }

        $this->accountModel->update(
            $id, 
            trim($_POST['username']),
            trim($_POST['email']),
            $_POST['profile_image'] ?? null,
            $_POST['password'] ?? null
        ); 

        header('Location: ?controller=users&action=index');
        exit;
    }

    public function delete(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?controller=users&action=index');
            exit;
        }

        $this->accountModel->delete($id);
        header('Location: ?controller=users&action=index');
        exit;
    }
}
