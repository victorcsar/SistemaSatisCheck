<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: ../public/dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/rating-stars.png" type="image/x-icon">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
<div class="container mt-5">
    <form id="login-form" action="../controller/login.php" method="POST" class="bg-light p-4 rounded shadow">
        <h1 class="text-center">Login</h1>
        
        <div class="mb-3">
            <label for="username" class="form-label">Nome de Usuário</label>
            <input type="text" id="username" name="username" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        
        <!-- Verifica se existe uma mensagem de erro -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary w-100">Entrar</button>
        <!-- <div id="feedback-message" class="mt-3"></div> -->
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
