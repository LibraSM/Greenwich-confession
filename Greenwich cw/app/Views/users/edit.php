<?php 
require __DIR__ . '/../layouts/header.php';
/** @var array $user */
?>
<div class = "container py-5">
    <div class = "mb-4">
        <h2>Edit user</h2>
        <p class = "text-muted">
            Update the user's information.
        </p>
    </div>
    <div class = "card shadow">
        <div class = "card-header bg-warning">
            <h4 class = "mb-0">User Information</h4>
        </div>
        <div class = "card-body">
            <form action = "?controller=users&action=update&id=<?= htmlspecialchars((string)$user['id']) ?>" method = "POST">
                <div class = "mb-3">
                    <label class = "form-label fw-bold">
                        Username
                    </label>

                    <input
                        type = "text"
                        name = "username"
                        class = "form-control"
                        value = "<?= htmlspecialchars($user['username']) ?>"
                        required>
                </div>
                <div class = "mb-3">
                    <label class = "form-label fw-bold">
                        Email Address
                    </label>
                    <input
                        type = "email"
                        name = "email"
                        class = "form-control"
                        value = "<?= htmlspecialchars($user['email']) ?>"
                        required>
                </div>
                <hr>
                <div class = "d-flex justify-content-between">
                    <a
                        href = "?controller=users&action=index"
                        class = "btn btn-secondary">
                        Cancel
                    </a>
                    <button
                        type = "submit"
                        class = "btn btn-warning">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>