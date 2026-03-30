<?php
session_start();
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: index.php");
    exit;
}

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'Admin' && $password === 'Admin@123') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid Username or Password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Eduex Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>
        body { background: #f4f7fe; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); width: 100%; max-width: 400px; }
        .btn-primary { background: #1a73e8; border: none; padding: 12px; border-radius: 8px; font-weight: 600; width: 100%; }
        .form-control { padding: 12px; border-radius: 8px; border: 1px solid #e0e0e0; margin-bottom: 20px; }
        .logo { text-align: center; margin-bottom: 30px; }
        .logo img { max-width: 150px; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo">
            <img src="../assets/img/logo/logo.png" alt="logo">
        </div>
        <h4 class="text-center mb-4">Admin Login</h4>
        <?php if($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="Admin" required>
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            <button type="submit" class="btn btn-primary">Login Now</button>
        </form>
    </div>
</body>
</html>
