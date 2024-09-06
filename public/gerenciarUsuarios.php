<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "master") {
    header('Location: ../public/login.php');
    exit();
}

require '../controller/gerenciarUsuarios.php';


$resultsPerPage = 10; // Número de resultados por página
$totalResults = getUsersCount($pdo); // Total de usuários
$totalPages = ceil($totalResults / $resultsPerPage); // Calcular o total de páginas
$currentPage = $_GET['page'] ?? 1;
$start = ($currentPage - 1) * $resultsPerPage;
$currentUsers = getUsers($pdo, $start, $resultsPerPage);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/rating-stars.png" type="image/x-icon">
    <title>Gerenciamento de Usuários</title>
    <link rel="stylesheet" href="../assets/css/gerenciarUsuarios.css">
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
        <h1>Gerenciamento de Usuários</h1>
        <div class="mb-3">
            <a href="register.php" class="btn btn-success">Adicionar Novo Usuário</a>
        </div>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome de Usuário</th>
                    <th>Role</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($currentUsers as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                        <td>
                            <a href="editarUsuario.php?id=<?php echo $user['id']; ?>" class="btn btn-primary btn-sm">Editar</a>
                            <?php if ($user['id'] != $_SESSION['user_id']): ?>
                                <a href="../controller/gerenciarUsuarios.php?metodo=delete&id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm">Excluir</a>
                            <?php else: ?>
                                <button class="btn btn-danger btn-sm" disabled>Excluir</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Verifica se existe uma mensagem de erro -->
        <?php if (isset($_GET['code'])) {
            if ($_GET['code'] == '200') {
        ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars("Dados do usuário atualizado com sucesso!"); ?>
                </div>
            <?php
            } elseif ($_GET['code'] == '201') {
            ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars("Usuário deletado com sucesso!"); ?>
                </div>
            <?php
            } elseif ($_GET['code'] == '202') {
            ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars("Usuário cadastrado com sucesso!"); ?>
                </div>
            <?php
            } elseif ($_GET['code'] == '500') {
            ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars("Erro ao atualizar os dados do usuário!"); ?>
                </div>
            <?php
            } elseif ($_GET['code'] == '501') {
            ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars("Erro ao deletar usuário!"); ?>
                </div>
        <?php }
        } ?>

        <!-- Paginação -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mt-4">
                <li class="page-item <?php if ($currentPage <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo max($currentPage - 1, 1); ?>">Anterior</a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php if ($currentPage >= $totalPages) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo min($currentPage + 1, $totalPages); ?>">Próximo</a>
                </li>
            </ul>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>