<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class = "container py-5">
    <div class = "d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class = "fw-bold mb-1">Posts</h1>
            <p class = "text-muted mb-0">
                Read the latest confessions from Greenwich students.
            </p>
        </div>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a
                href = "?controller=posts&action=create"
                class = "btn btn-primary">
                + Create Post
            </a>
        <?php endif; ?>
    </div>

    <?php if (empty($posts)): ?>
        <div class = "alert alert-info">
            No posts have been created yet.
        </div>
    <?php else: ?>
        <div class = "row g-4">
            <?php foreach ($posts as $post): ?>
                <div class = "col-md-6 col-lg-4">
                    <div class = "card post-card h-100 shadow-sm">
                        <?php if (!empty($post['image'])): ?>
                            <img
                                src = "uploads/<?= htmlspecialchars($post['image']) ?>"
                                alt = "<?= htmlspecialchars($post['title']) ?>"
                                class = "card-img-top post-card-image">
                        <?php endif; ?>

                        <div class = "card-body">
                            <h5 class = "card-title fw-bold">
                                <?= htmlspecialchars($post['title']) ?>
                            </h5>
                            <p class = "card-text text-muted post-card-text">
                                <?= htmlspecialchars($post['content']) ?>
                            </p>
                        </div>

                        <div class = "card-footer bg-white border-0 pt-0">
                            <a
                                href = "?controller=posts&action=show&id=<?= $post['id'] ?>"
                                class = "btn btn-primary w-100">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
