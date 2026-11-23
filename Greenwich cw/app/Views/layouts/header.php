<?php
$currentController = $_GET['controller'] ?? 'home';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greenwich Confession</title>
    <link href = "css/bootstrap.min.css" rel = "stylesheet">
    <link
        href = "css/style.css"
        rel = "stylesheet">
</head>
<body>
    <nav class = "navbar navbar-expand-lg navbar-dark">
    <div class = "container">
        <a class = "navbar-brand" href = "?controller=home&action=index">
            Greenwich Confession
        </a>
        <button
            class = "navbar-toggler"
            type = "button"
            data-bs-toggle = "collapse"
            data-bs-target = "#navbarNav"
            aria-controls = "navbarNav"
            aria-expanded = "false"
            aria-label = "Toggle navigation">

            <span class = "navbar-toggler-icon"></span>
        </button>
        <div class = "collapse navbar-collapse" id = "navbarNav">
            <ul class = "navbar-nav ms-auto align-items-lg-center gap-lg-1">
                <li class = "nav-item">
                    <a
                        class = "nav-link" href = "?controller=home&action=index">
                        Posts
                    </a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if (!empty($_SESSION['is_admin'])): ?>
                    <li class = "nav-item">
                        <a class = "nav-link" href = "?controller=users&action=index">
                            Users
                        </a>
                    </li>
                    <li class = "nav-item">
                        <a class = "nav-link" href = "?controller=modules&action=index">
                            Modules
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class = "nav-item">
                        <a class = "nav-link" href = "?controller=posts&action=create">
                            Create Post
                        </a>
                    </li>
                    <li class = "nav-item dropdown">
                        <a
                            class = "nav-link dropdown-toggle"
                            href = "#"
                            id = "profileDropdown"
                            role = "button"
                            data-bs-toggle = "dropdown"
                            aria-expanded = "false">
                            <?= htmlspecialchars($_SESSION['username'] ?? ($account['username'] ?? 'Account')) ?>
                        </a>
                        <ul class = "dropdown-menu dropdown-menu-end">
                            <li>
                                <a class = "dropdown-item"
                                    href = "?controller=auth&action=profile">
                                    My Profile
                                </a>
                            </li>
                            <li>
                                <a class = "dropdown-item"
                                    href = "?controller=auth&action=edit">
                                    Edit Profile
                                </a>
                            </li>
                            <li><hr class = "dropdown-divider"></li>
                            <li>
                                <a class = "dropdown-item text-danger"
                                    href = "?controller=auth&action=logout">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class = "nav-item">
                        <a class = "nav-link"
                            href = "?controller=auth&action=login">
                            Login
                        </a>
                    </li>
                    <li class = "nav-item">
                        <a class = "nav-link"
                            href = "?controller=auth&action=register">
                            Create account
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class = "container mt-3">
    <?php Flash::display(); ?>
</div>
