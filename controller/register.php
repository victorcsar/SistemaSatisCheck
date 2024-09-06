<?php

try {
    require '../config/bd.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        $role = $_POST['role'] ?? '';

        if (!empty($username) && !empty($password) && $password === $confirm_password && !empty($role)) {
            try {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $pdo->prepare('INSERT INTO usuarios (username, password, role) VALUES (?, ?, ?)');
                if ($stmt->execute([$username, $hashed_password, $role])) {
                    header('Location: ../public/gerenciarUsuarios.php?code=202');
                    exit();
                } else {
                    $error = 'Erro ao registrar o usuário.';
                }
            } catch (\Exception $e) {
                error_log($e->getMessage(), 3, '../logs/error.log');
                $error = 'Erro ao registrar o usuário.';
            }
        } else {
            $error = 'Por favor, preencha todos os campos e verifique as senhas.';
        }

        header('Location: ../public/register.php?error=' . urlencode($error));
        exit();
    } else {
        header('Location: ../public/register.php');
        exit();
    }
} catch (\Exception $e) {
    // Capture a exceção e redirecione para a página de erro
    error_log($e->getMessage(), 3, '../logs/error.log'); // Exemplo de log em arquivo
    header('Location: ../public/errorgeral.html');
    exit();
}
