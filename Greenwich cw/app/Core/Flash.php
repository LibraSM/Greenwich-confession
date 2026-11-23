<?php
declare(strict_types=1);

class Flash
{
    public static function set(string $type, string $message): void
    {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }

        public static function display(): void
        {
            if (!isset($_SESSION['flash'])) {
                return;
            }

            $flash = $_SESSION['flash'];
            echo '
            <div class = "alert alert- '. htmlspecialchars($flash['type']) . ' alert-dismissible fade show" role = "alert">
                ' . htmlspecialchars($flash['message']) . '
                <button type = "button" class = "btn-close" data-bs-dismiss = "alert"></button>
            </div>';

            unset($_SESSION['flash']);
        }
}
