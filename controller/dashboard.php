<?php
//session_start();

try {

    require '../config/bd.php';
    
    function getSurveyResults($pdo, $start, $limit) {
        $stmt = $pdo->prepare('SELECT * FROM respostas_pesquisa ORDER BY data_envio DESC LIMIT :start, :limit');
        $stmt->bindValue(':start', $start, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    function getSurveyResultsCount($pdo) {
        $stmt = $pdo->query('SELECT COUNT(*) FROM respostas_pesquisa');
        return $stmt->fetchColumn();
    }

}catch(\Exception $e){
    // Capture a exceção e redirecione para a página de erro
    error_log($e->getMessage(), 3, '../logs/error.log'); // Exemplo de log em arquivo
    header('Location: ../public/errogeral.html');
    exit();
}
?>