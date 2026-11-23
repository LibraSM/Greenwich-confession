<?php
require __DIR__ . '/../layouts/header.php'; ?>
<div class = "container py-5">
    <div class = "row justify-content-center">
        <div class = "col-md-6">
            <div class = "card shadow">
                <div class = "card-header bg-primary text-white">
                    <h3>Create Account</h3>
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
                        action = "?controller=auth&action=store">

                        <div class = "mb-3">
                            <label class = "form-label">
                                Username
                            </label>
                            <input
                                type = "text"
                                name = "username"
                                class = "form-control"
                                required>
                        </div>

                        <div class = "mb-3">
                            <label class = "form-label">
                                Email
                            </label>
                            <input
                                type = "email"
                                name = "email"
                                class = "form-control"
                                required>
                        </div>

                        <div class = "mb-3">
                            <label class = "form-label">
                                Password
                            </label>

                            <input
                                type = "password"
                                name = "password"
                                class = "form-control"
                                required>
                        </div>
                        
                        <button
                            type = "submit"
                            class = "btn btn-primary">
                            Create account
                        </button>
                    </form>

                    <hr>
                    <p class = "text-center mb-0">
                        Already have an account?
                        <a href = "?controller=auth&action=login">
                            Login
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>