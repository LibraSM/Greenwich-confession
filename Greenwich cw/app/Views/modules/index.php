<?php
require __DIR__ . '/../layouts/header.php';
?>
<div class = "container py-5">
    <div class = "card shadow-sm mb-4">
        <div class = "card-body d-flex justify-content-between align-items-center">
            <div>
                <h2 class = "mb-1">Modules</h2>
                <p class = "text-muted mb-0">
                    Manage all modules.
                </p>
            </div>
            <a href = "?controller=modules&action=create"
                class = "btn btn-primary">
                Add module
            </a>
        </div>
    </div>
    <?php if (empty($modules)): ?>
        <div class = "alert alert-info">
            No modules found.
        </div>
    <?php else: ?>
        <div class = "card shadow-sm">
            <div class = "card-body">
                <table class = "table table-hover align-middle">
                    <thead class = "table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Module Name</th>
                            <th width = "180">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($modules as $module): ?>
                            <tr>
                                <td>
                                    <?= htmlspecialchars((string)$module['id'])  ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($module['module_name']) ?>
                                </td>
                                <td>
                                    <a
                                        href = "?controller=modules&action=edit&id=<?= $module['id'] ?>"
                                        class = "btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    <form
                                        action = "?controller=modules&action=delete&id=<?= htmlspecialchars((string)$module['id']) ?>"
                                        method = "POST"
                                        class = "d-inline">
                                        <button
                                            type = "submit"
                                            class = "btn btn-danger btn-sm"
                                            onclick = "return confirm('Delete this module?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>