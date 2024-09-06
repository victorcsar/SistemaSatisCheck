<?php
session_start();

try {
    require '../config/bd.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (!empty($username) && !empty($password)) {
            $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE username = ?');
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                header('Location: ../public/dashboard.php');
                exit();
            } else {
                $error = 'Nome de usuário ou senha incorretos.';
            }
        } else {
            $error = 'Por favor, preencha todos os campos.';
        }

        // Redireciona de volta ao formulário de login com a mensagem de erro
        header('Location: ../public/login.php?error=' . urlencode($error));
        exit();
    } else {
        header('Location: ../public/login.php');
        exit();
    }
} catch (\Exception $e) {
    // Captura a exceção e redireciona para a página de erro
    error_log($e->getMessage(), 3, '../logs/error.log'); // Exemplo de log em arquivo
    header('Location: ../public/errogeral.html');
    exit();
}