<?php
// controller.php

try {
    require '../config/bd.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $avaliacao_servico = $_POST['question1'] ?? null;
        $atendimento = $_POST['question2'] ?? null;
        $comentarios_adicionais = $_POST['question3'] ?? null;

        if ($avaliacao_servico && $atendimento) {
            $stmt = $pdo->prepare('INSERT INTO respostas_pesquisa (avaliacao_servico, atendimento, comentarios_adicionais) VALUES (?, ?, ?)');
            if ($stmt->execute([$avaliacao_servico, $atendimento, $comentarios_adicionais])) {
                // Redireciona para a página de sucesso
                header('Location: ../public/sucesso.html');
                exit();
            } else {
                throw new \Exception('Erro ao enviar a pesquisa.');
            }
        } else {
            throw new \Exception('Por favor, preencha todas as perguntas obrigatórias.');
        }
    } else {
        throw new \Exception('Método de solicitação inválido.');
    }
} catch (\Exception $e) {
    // Capture a exceção e redirecione para a página de erro
    error_log($e->getMessage(), 3, '../logs/error.log'); // Exemplo de log em arquivo
    header('Location: ../public/errorgeral.html');
    exit();
}
?>
