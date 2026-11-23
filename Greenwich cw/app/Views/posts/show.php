<?php require __DIR__ . '/../layouts/header.php';
/** @var array $post */
/** @var array $users */
/** @var array $modules */
?>
<div class = "container py-5">
    <div class = "card shadow">
        <div class = "card-header bg-primary text-white">
            <h2><?= htmlspecialchars($post['title']) ?></h2>
        </div>
        <div class = "card-body">
            <?php if (!empty($post['image'])): ?>
                <div class = "text-center mb-4">
                    <img
                        src = "uploads/<?= htmlspecialchars($post['image']) ?>"
                        alt = "Image attached to post: <?= htmlspecialchars($post['title']) ?>"
                        class = "img-fluid rounded shadow"
                        style = "max-height:400px;">
                </div>
            <?php endif; ?>
            <h5>Content</h5>
            <p class = "mt-3 post-content">
                <?=  nl2br(htmlspecialchars($post['content'])) ?>
            </p>
            <hr>
            <div class = "row text-center mt-4">
                <div class = "col-md-4">
                    <div class = "border rounded p-3">
                        <h6 class = "text-muted">Author</h6>
                        <h5><?= htmlspecialchars($post['username']) ?></h5>
                    </div>
                </div>
                <div class = "col-md-4">
                    <div class = "border rounded p-3">
                        <h6 class = "text-muted">Module</h6>
                        <h5><?= htmlspecialchars($post['module_name']) ?></h5>
                    </div>
                </div>
                <div class = "col-md-4">
                    <div class = "border rounded p-3">
                        <h6 class = "text-muted">Created</h6>
                        <h5><?= date('d M Y', strtotime($post['created_at'])) ?></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class = "card-footer d-flex justify-content-between align-items-center">
            <a
                href = "?controller=home&action=index"
                class = "btn btn-secondary">
                Back
            </a>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
