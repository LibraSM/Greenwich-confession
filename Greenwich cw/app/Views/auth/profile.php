<?php
/** @var array $account */
require __DIR__ . '/../layouts/header.php'; ?>

<div class = "container py-5">
    <div class = "row justify-content-center">
        <div class = "col-lg-6">
            <div class = "card shadow">
                <div class = "card-header bg-primary text-white">
                    <h3 class = "mb-0">
                        My Profile
                    </h3>
                </div>
                <div class = "card-body">
                    <div class = "text-center mb-4">
                    <?php if (!empty($account['profile_image'])): ?>
                        <img
                            src = "uploads/<?= htmlspecialchars($account['profile_image']) ?>"
                            alt = "Profile Picture"
                            class = "rounded-circle mb-3"
                            style = "width: 120px; height:120px; object-fit:cover;">
                    <?php else: ?>
                        <div class = "rounded-circle bg-primary text-white d-inline-flex justify-content-center align-items-center"
                            style = "width:120px; height:120px; font-size: 48px; font-weight:bold;">
                            <?= strtoupper(substr($account['username'], 0, 1)) ?>
                        </div>
                    <?php endif; ?>
                        <h4 class = "mt-3 mb-0">
                            <?= htmlspecialchars($account['username']) ?>
                        </h4>
                        <span class = "badge bg-success">
                            Registered User
                        </span>
                    </div>
                    <table class = "table table-striped table-bordered align-middle">
                        <tr>
                            <th width = "35%">
                                User ID
                            </th>
                            <td>
                                <?= htmlspecialchars((string)$account['id']) ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Username
                            </th>
                            <td>
                                <?= htmlspecialchars($account['username']) ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Email
                            </th>
                            <td>
                                <?= htmlspecialchars($account['email']) ?>
                            </td>
                        </tr>
                        <?php if (isset($account['created_at'])): ?>
                            <tr>
                                <th>
                                    Joined
                                </th>
                                <td>
                                    <?= date('d M Y', strtotime($account['created_at'])) ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </table>
                    <div class = "d-flex justify-content-between mt-4">
                        <a
                            href = "?controller=home&action=index"
                            class = "btn btn-secondary">
                            Back
                        </a>
                        <div>
                            <a
                                href = "?controller=auth&action=edit"
                                class = "btn btn-warning me-2">
                                Edit Profile
                            </a>
                            <a
                                href = "?controller=auth&action=logout"
                                class = "btn btn-danger">
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
