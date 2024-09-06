<?php
session_start();

if (!isset($_SESSION['user_id']) && $_SESSION['role'] !== 'master') {
    header('Location: ../public/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/rating-stars.png" type="image/x-icon">
    <title>Registro</title>
    <link rel="stylesheet" href="../assets/css/register.css">
</head>

<body>
    <div class="container">
        <h2>Registro</h2>
        <form id="register-form" action="../controller/register.php" method="post">
            <div class="form-group">
                <label for="username">Nome de Usuário:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmar Senha:</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="role">Tipo de Usuario:</label>
                <select id="role" name="role" class="form-control" required>
                    <option value="">Selecione um papel</option>
                    <option value="master">Master</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <!-- Verifica se existe uma mensagem de erro -->
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary">Registrar</button>
            <div id="feedback-message" class="mt-3"></div>
        </form>
    </div>
    <script src="../assets/js/register.js"></script>
</body>

</html>
