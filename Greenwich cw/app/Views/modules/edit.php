<?php
require __DIR__ . '/../layouts/header.php';
/** @var array $module */
?>

<div class = "container py-5">
    <div class = "mb-4">
        <h2>Edit module</h2>
        <p class = "text-muted">
            Update the module information.
        </p>
    </div>
    <div class = "card shadow">
        <div class = "card-header bg-warning">
            <h4 class = "mb-0">Module information</h4>
        </div>
        <div class = "card-body">
            <form action = "?controller=modules&action=update&id=<?= htmlspecialchars((string)$module['id']) ?>" method = "POST">
                <div class = "mb-3">
                    <label class = "form-label fw-bold">
                        Module name
                    </label>
                    <input
                        type = "text"
                        name = "module_name"
                        class = "form-control"
                        value = "<?= htmlspecialchars($module['module_name']) ?>"
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
                        class = "btn btn-warning">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>