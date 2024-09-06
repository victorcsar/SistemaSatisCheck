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

    function getAvaliacaoAplicacao($pdo) {
        $query = "SELECT 
                    SUM(CASE WHEN avaliacao_servico = 1 THEN 1 ELSE 0 END) AS muito_insatisfeito,
                    SUM(CASE WHEN avaliacao_servico = 2 THEN 1 ELSE 0 END) AS insatisfeito,
                    SUM(CASE WHEN avaliacao_servico = 3 THEN 1 ELSE 0 END) AS neutro,
                    SUM(CASE WHEN avaliacao_servico = 4 THEN 1 ELSE 0 END) AS satisfeito,
                    SUM(CASE WHEN avaliacao_servico = 5 THEN 1 ELSE 0 END) AS muito_satisfeito
                  FROM respostas_pesquisa";
    
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result;
    }

    function getAvaliacaoApresentacao($pdo) {
        $query = "SELECT 
                    SUM(CASE WHEN atendimento = 'excelente' THEN 1 ELSE 0 END) AS excelente,
                    SUM(CASE WHEN atendimento = 'bom' THEN 1 ELSE 0 END) AS bom,
                    SUM(CASE WHEN atendimento = 'razoavel' THEN 1 ELSE 0 END) AS razoavel,
                    SUM(CASE WHEN atendimento = 'ruim' THEN 1 ELSE 0 END) AS ruim,
                    SUM(CASE WHEN atendimento = 'muito_ruim' THEN 1 ELSE 0 END) AS muito_ruim
                  FROM respostas_pesquisa";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result;
    }

    function getTotalRespostas($pdo) {
        $query = 'SELECT COUNT(*) AS total_respostas FROM respostas_pesquisa';
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_respostas'];
    }
    

}catch(\Exception $e){
    // Capture a exceção e redirecione para a página de erro
    error_log($e->getMessage(), 3, '../logs/error.log'); // Exemplo de log em arquivo
    header('Location: ../public/errogeral.html');
    exit();
}
?>