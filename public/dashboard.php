<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../public/login.php');
    exit();
}

require '../controller/dashboard.php';

$resultsPerPage = 10; // Número de resultados por página
$totalResults = getSurveyResultsCount($pdo); // Total de resultados
$totalPages = ceil($totalResults / $resultsPerPage); // Calcular o total de páginas
$currentPage = $_GET['page'] ?? 1;
$start = ($currentPage - 1) * $resultsPerPage;
$currentResults = getSurveyResults($pdo, $start, $resultsPerPage);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/rating-stars.png" type="image/x-icon">
    <title>Dashboard - Resultados da Pesquisa</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- Incluido navbar -->
    <?php
    require '../partials/navbar.php'
    ?>

    <div class="container-fluid mt-4">
        <h1>Resultados da Pesquisa de Satisfação</h1>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Avaliação do Serviço</th>
                    <th>Atendimento</th>
                    <th>Comentários Adicionais</th>
                    <th>Data de Envio</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($currentResults as $result): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($result['id']); ?></td>
                        <td><?php
                            if ($result['avaliacao_servico'] == 1) {
                                echo nl2br(htmlspecialchars("😡\nMuito Insatisfeito"));
                            } elseif ($result['avaliacao_servico'] == 2) {
                                echo nl2br(htmlspecialchars("😠\nInsatisfeito"));
                            } elseif ($result['avaliacao_servico'] == 3) {
                                echo nl2br(htmlspecialchars("😐\nNeutro"));
                            } elseif ($result['avaliacao_servico'] == 4) {
                                echo nl2br(htmlspecialchars("😊\nSatisfeito"));
                            } elseif ($result['avaliacao_servico'] == 5) {
                                echo nl2br(htmlspecialchars("😍\nMuito Satisfeito"));
                            } else {
                                echo htmlspecialchars("Não foi possivel recuperar essa avaliação");
                            }
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($result['atendimento']); ?></td>
                        <td><?php echo htmlspecialchars($result['comentarios_adicionais']); ?></td>
                        <td><?php
                            //$dataEnvio = $result['data_envio'];
                            $date = new DateTime($result['data_envio']);
                            $formattedDate = $date->format('d/m/Y \à\s H:i');
                            echo htmlspecialchars($formattedDate);
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

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