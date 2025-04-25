<?php
session_start();
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $index = $_POST['index'] ?? null;
    $task = $_POST['task'] ?? '';

    switch ($action) {
        case 'add':
            if (!empty($task)) {
                $_SESSION['tasks'][] = ['name' => $task, 'done' => false];
            }
            break;
        case 'done':
            $_SESSION['tasks'][$index]['done'] = true;
            break;
        case 'delete':
            array_splice($_SESSION['tasks'], $index, 1);
            break;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>To Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

        <?php include 'header.php'; ?>

        <form method="post">
            <input type="text" name="task" placeholder="Teks to do">
            <button type="submit" name="action" value="add">Tambah</button>
        </form>

        <?php foreach ($_SESSION['tasks'] as $index => $t): ?>
            <div class="task">
                <span><?= htmlspecialchars($t['name']) ?></span>
                <span>
                    <?php if (!$t['done']): ?>
                        <form method="post" style="display:inline">
                            <input type="hidden" name="index" value="<?= $index ?>">
                            <button type="submit" name="action" value="done">Selesai</button>
                        </form>
                    <?php endif; ?>
                    <form method="post" style="display:inline">
                        <input type="hidden" name="index" value="<?= $index ?>">
                        <button type="submit" name="action" value="delete">Hapus</button>
                    </form>
                </span>
            </div>
        <?php endforeach; ?>

    </div>
</body>
</html>
