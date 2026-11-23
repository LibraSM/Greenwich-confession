<?php require __DIR__ . '/../layouts/header.php';
/** @var array $post */
/** @var array $users */
/** @var array $modules */
?>
    <div class = "container py-5 mt-3">
        <div class = "mb-4">
        <h2>Create New Post</h2>
        <p class = "text-muted">
            Fill in the information below to publish a new post.
        </p>
    </div>
    <div class = "card shadow">
        <div class = "card-header bg-dark text-white">
            <h4 class = "mb-0">Post Information</h4>
        </div>
        <div class = "card-body">
            <form action = "?controller=posts&action=store" method = "POST" enctype = "multipart/form-data">
                <div class = "mb-3">
                    <label for = "post-title" class = "form-label fw-bold">
                        Title
                    </label>
                    <input
                        id = "post-title"
                        type = "text"
                        name = "title"
                        class = "form-control"
                        placeholder = "Enter post title"
                        required>
                </div>
                <div class = "mb-3">
                    <label for = "post-content" class = "form-label fw-bold">
                        Content
                    </label>
                    <textarea
                        id = "post-content"
                        name = "content"
                        class = "form-control"
                        rows = "5"
                        placeholder = "Write your post here..."
                        required></textarea>
                </div>
                <div class = "mb-3">
                    <label for = "post-image" class = "form-label fw-bold">
                        Upload image
                    </label>
                    <input
                        id = "post-image"
                        type = "file"
                        name = "image"
                        class = "form-control"
                        accept = "image/*">
                    <div class = "form-text">
                        Optional. Upload an image related to your post.
                    </div>
                </div>
                <div class = "mb-3">
                    <label for = "post-module" class = "form-label fw-bold">
                        Module
                    </label>
                    <select
                        id = "post-module"
                        name = "module_id"
                        class = "form-select"
                        required>

                        <option value = "">
                            Select module
                        </option>
                        <?php foreach ($modules as $module): ?>
                            <option value = "<?= htmlspecialchars((string)$module['id']) ?>">
                                <?= htmlspecialchars($module['module_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <hr class = mt-4>
                <div class = "d-flex justify-content-between">
                    <a
                        href = "?controller=home&action=index"
                        class = "btn btn-outline-secondary">
                        Cancel
                    </a>
                    <button
                        type = "submit"
                        class = "btn btn-primary">
                        Publish Post
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
<?php require __DIR__ . '/../layouts/footer.php';?>
