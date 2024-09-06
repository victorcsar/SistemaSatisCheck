<nav class="navbar navbar-expand-lg navbar-dark d-flex">
    <a href="../public/dashboard.php" class="navbar-brand">Dashboard</a>
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'master'): ?>
        <div class="ms-auto">
            <a class="nav-link" href="../public/gerenciarUsuarios.php">Gerenciar Usuários</a>
        </div>
    <?php endif; ?>
    <div class="ms-auto">
        <a href="../controller/logout.php" class="btn btn-danger">
        <i class="bi bi-box-arrow-right"></i>
            Sair
        </a>
    </div>
</nav>