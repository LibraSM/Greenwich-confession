<?php require __DIR__ . '/../layouts/header.php';?>
<div class = "container py-5">
    <div class = "mb-4">
        <h2>Create new user</h2>
        <p class = "text-muted">
            Add a new user to the system.
        </p>
    </div>
    <div class = "card shadow">
        <div class = "card-header bg-primary text-white">
            <h4 class = "mb-0">User information</h4>
        </div>
        <div class = "card-body">
            <form action = "?controller=users&action=store" method="POST">
                <div class = "mb-3">
                    <label for = "username" class = "form-label fw-bold">
                        Username
                    </label>
                    <input
                        id = "username"
                        type = "text"
                        name = "username"
                        class = "form-control"
                        placeholder = "Enter username"
                        required>
                </div>
                <div class = "mb-3">
                    <label for = "email" class = "form-label fw-bold">
                        Email address
                    </label>

                    <input
                        id = "email"
                        type = "email"
                        name = "email"
                        class = "form-control"
                        placeholder = "Enter email address"
                        required>
                </div>
                <div class = "mb-3">
                    <label for = "password" class = "form-label fw-bold">
                        Password
                    </label>
                    <input
                        type = "password"
                        name = "password"
                        id = "password"
                        class = "form-control"
                        minlength = "6"
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
                        class = "btn btn-success">
                        Create user
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>