<?php
declare(strict_types=1);
require_once __DIR__ . '/../Models/Post.php';

class HomeController
{
    private Post $postModel;

    public function __construct()
    {
        $this->postModel = new Post();
    }

    public function index(): void
    {
        $posts = $this->postModel->getAll();

        require __DIR__ . '/../Views/home/index.php';
    }
}
