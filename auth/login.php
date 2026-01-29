<?php
session_start();
require_once __DIR__ . '/../config/db.php';

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("
        SELECT u.user_id, u.password, r.role_name
        FROM users u
        JOIN user_roles r ON u.role_id = r.role_id
        WHERE u.username = ?
    ");
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user_id']  = $user['user_id'];
        $_SESSION['role']     = $user['role_name'];
        header("Location: /bhcis/index.php");
        exit;
    }

    $error = "Invalid credentials";
}
?>

<form method="POST">
    <h2>BHCIS Login</h2>
    <?= $error ? "<p style='color:red'>$error</p>" : "" ?>
    <input name="username" required placeholder="Username"><br><br>
    <input type="password" name="password" required placeholder="Password"><br><br>
    <button type="submit">Login</button>
</form>
