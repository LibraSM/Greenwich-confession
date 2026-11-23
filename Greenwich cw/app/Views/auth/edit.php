<?php
/** @var array $account */
require __DIR__ . '/../layouts/header.php';
?>

<div class = "container py-5">
    <div class = "row justify-content-center">
        <div class = "col-lg-6">
            <div class = "card shadow">
                <div class = "card-header bg-warning">
                    <h3 class = "mb-0">
                        Edit Profile
                    </h3>
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
                        action = "?controller=auth&action=update"
                        enctype = "multipart/form-data">

                        <div class = "mb-3">
                            <label for = "username" class = "form-label">
                                Username
                            </label>
                            <input
                                id = "username"
                                type = "text"
                                name = "username"
                                class = "form-control"
                                value = "<?= htmlspecialchars($account['username']) ?>"
                                required>
                        </div>
                        <div class = "mb-3">
                            <label for = "email" class = "form-label">
                                Email
                            </label>
                            <input
                                type = "email"
                                name = "email"
                                class = "form-control"
                                value = "<?= htmlspecialchars($account['email']) ?>"
                                required>
                        </div>
                        <div class = "mb-3">
                            <label for = "password" class = "form-label fw-bold">
                                New Password
                            </label>
                            <input
                                id = "password"
                                type = "password"
                                name = "password"
                                class = "form-control"
                                placeholder = "Leave blank to keep current password">
                        </div>
                        <div class = "mb-3">
                            <label for = "password" class = "form-label fw-bold">
                                Confirm Password
                            </label>
                            <input
                                id = "password"
                                type = "password"
                                name = "confirm_password"
                                class = "form-control"
                                placeholder = "Confirm new password">
                        </div>
                        <div class = "mb-4 text-center">
                            <?php if (!empty($account['profile_image'])): ?>
                                <img
                                    src = "uploads/<?= htmlspecialchars($account['profile_image']) ?>"
                                    class = "rounded-circle border shadow"
                                    style = "width:120px; height: 120px; object-fit:cover;">
                            <?php else: ?>
                                <div
                                    class = "rounded-circle bg-primary text-white d-inline-flex justify-content-center align-items-center shadow"
                                    style = "width:120px; height:120px; font-size:48px; font-weight:bold;">
                                    <?= strtoupper(substr($account['username'], 0, 1)) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class = "mb-3">
                            <label class = "form-label fw-bold">
                                Change Profile Picture
                            </label>
                            <input
                                type = "file"
                                name = "profile_image"
                                class = "form-control"
                                accept = "image/*">
                            <div class = "form-text">
                                Leave empty to keep your current picture.
                            </div>
                        </div>

                        <div class = "d-flex justify-content-between">
                            <a
                                href = "?controller=auth&action=profile"
                                class = "btn btn-secondary">
                                Cancel
                            </a>
                            <button
                                type = "submit"
                                class = "btn btn-success">
                                Save changes
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>