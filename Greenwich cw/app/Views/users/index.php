<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class = "container py-5">
    <div class = "card shadow-sm mb-4">
        <div class = "card-body d-flex justify-content-between align-items-center">
            <div>
                <h2 class = "mb-1">Users</h2>
                <p class = "text-muted mb-0">
                    Manage all registered users.
                </p>
            </div>
            <a href = "?controller=users&action=create"
                class = "btn btn-primary">
                Add user
            </a>
        </div>
    </div>
    <?php if (empty($users)): ?>
        <div class = "alert alert-info">
            No users found.
        </div>
    <?php else: ?>
        <div class = "card shadow-sm">
            <div class = "card-body">
                <table class = "table table-hover align-middle">
                    <thead class = "table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th width = "180">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars((string)$user['id']) ?></td>
                                <td>
                                    <?= htmlspecialchars($user['username']) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($user['email']) ?>
                                </td>
                                <td>
                                    <a href = "?controller=users&action=edit&id=<?= $user['id'] ?>"
                                        class = "btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    <form
                                        action = "?controller=users&action=delete&id=<?= htmlspecialchars((string)$user['id']) ?>"
                                        method = "POST"
                                        class = "d-inline">
                                        <button
                                            type = "submit"
                                            class = "btn btn-danger btn-sm"
                                            onclick = "return confirm('Delete this user?')">
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