<?php
session_start();

if (!isset($_SESSION['user_id']) || (!isset($_GET['id']) || $_SESSION['role'] !== 'master')) {
    header('Location: ../public/login.php');
    exit();
}

require '../controller/gerenciarUsuarios.php';

$user_id = $_GET['id'];
$user = getUserById($pdo, $user_id);

if (!$user) {
    header('Location: ../public/gerenciarUsuarios.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/rating-stars.png" type="image/x-icon">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="../assets/css/editarUsuario.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- Incluido navbar -->
    <?php
    require '../partials/navbar.php'
    ?>

    <div class="container mt-4">
        <h1>Editar Usuário</h1>
        <form id="edit-user-form" action="../controller/gerenciarUsuarios.php?id=<?php echo $user_id; ?>&metodo=update" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
            <div class="form-group">
                <label for="username">Nome de Usuário:</label>
                <input type="text" id="username" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>

            <div class="form-group">
                <label for="role">Função:</label>
                <select id="role" name="role" class="form-select" required>
                    <option value="" disabled>Selecione a função</option>
                    <option value="master" <?php if ($user['role'] === 'master') echo 'selected'; ?>>Master</option>
                    <option value="admin" <?php if ($user['role'] === 'admin') echo 'selected'; ?>>Admin</option>
                </select>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="change-password-check" onclick="togglePasswordFields()">
                <label class="form-check-label" for="change-password-check">Trocar senha</label>
            </div>

            <div id="password-fields" style="display: none;">
                <div class="form-group">
                    <label for="new-password">Nova Senha:</label>
                    <input type="password" id="new-password" name="new-password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirmar Nova Senha:</label>
                    <input type="password" id="confirm-password" name="confirm-password" class="form-control">
                </div>
                <div id="password-error" class="text-danger" style="display: none;"></div>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>

        </form>
    </div>

    <script src="../assets/js/editarUsuario.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>