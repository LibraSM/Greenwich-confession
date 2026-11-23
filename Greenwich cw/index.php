<?php
declare(strict_types=1);

$query = (string) ($_SERVER['QUERY_STRING'] ?? '');
$location = 'public/index.php' . ($query !== '' ? '?' . $query : '');

header('Location: ' . $location);
exit;
