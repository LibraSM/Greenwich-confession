<?php
require __DIR__ . '/../layouts/header.php'; ?>

<div class = "container py-5">
    <div class = "row justify-content-center">
        <div class = "col md-6">
            <div class = "card shadow">
                <div class = "card-header bg-success text-white">
                    <h3>Login</h3>
                </div>

                <div class = "card-body">
                    <?php if (!empty($errors)): ?>
                        <div class = "alert alert-danger">
                            <ul class = "mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form
                        method = "POST"
                        action = "?controller=auth&action=authenticate">

                        <div class = "mb-3">
                            <label for = "email" class = "form-label">
                                Email
                            </label>
                            <input
                                id = "email"
                                type = "email"
                                name = "email"
                                class = "form-control"
                                value = "<?= htmlspecialchars($email ?? '') ?>"
                                required>
                        </div>

                        <div class = "mb-3">
                            <label for = "password" class = "form-label">
                                Password
                            </label>
                            <input
                                id = "password"
                                type = "password"
                                name = "password"
                                class = "form-control"
                                required>
                        </div>

                        <button
                            type = "submit"
                            class = "btn btn-success">
                            Login
                        </button>
                    </form>

                    <hr>
                    <p class = "text-center mb-0">
                        Don't have an account?
                        <a href = "?controller=auth&action=register">
                            Create one
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>