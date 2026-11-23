<?php
declare(strict_types=1);
require_once __DIR__ . '/../Models/Module.php';
require_once __DIR__ . '/../../config/config.php';
class ModulesControllers
{
    private Module $moduleModel;
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
        $this->moduleModel = new Module();
    }
    
    public function index(): void
    {
        $modules = $this->moduleModel->getAll();
        require __DIR__ . '/../Views/modules/index.php';
    }

    public function create(): void
    {
        require __DIR__ . '/../Views/modules/create.php';
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?controller=modules&action=index');
            exit;
        }

        $this->moduleModel->create(
            trim($_POST['module_name'])
        );

        header('Location: ?controller=modules&action=index');
        exit;
    }

    public function edit(int $id): void
    {
        $module = $this->moduleModel->getById($id);
        if (!$module) {
            die("Module not found.");
        }

        require __DIR__ . '/../Views/modules/edit.php';
    }

    public function update(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?controller=modules&action=index');
            exit;
        }

        $this->moduleModel->update(
            $id,
            trim($_POST['module_name'])
        );

        header('Location: ?controller=modules&action=index');
        exit;
    }

    public function delete(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?controller=modules&action=index');
            exit;
        }

        $this->moduleModel->delete($id);
        header('Location: ?controller=modules&action=index');
        exit;
    }
}
