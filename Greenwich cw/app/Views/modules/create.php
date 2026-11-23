<?php
require __DIR__ . '/../layouts/header.php';
?>

<div class = "container py-5">
    <div class = "mb-4">
        <h2>Create new module</h2>
        <p class = "text-muted">
            Add a new module to the system.
        </p>
    </div>
    <div class = "card shadow">
        <div class = "card-header bg-primary text-white">
            <h4 class = "mb-0">Module information</h4>
        </div>
        <div class = "card-body">
            <form action="?controller=modules&action=store" method = "POST">
                <div class = "mb-3">
                    <label for = "module_name" class = "form-label fw-bold">
                        Module name
                    </label>
                    <input
                        id = "module_name"
                        type = "text"
                        name = "module_name"
                        class = "form-control"
                        placeholder = "Enter module name"
                        required>
                </div>
                <hr>
                <div class = "d-flex justify-content-between">
                    <a
                        href = "?controller=modules&action=index"
                        class = "btn btn-secondary">
                        Cancel
                    </a>
                    <button
                        type = "submit"
                        class = "btn btn-success">
                        Create module
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>