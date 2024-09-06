<?php

try {
    require '../config/bd.php';

    function getUsersCount($pdo){
        $stmt = $pdo->query('SELECT COUNT(*) FROM usuarios');
        return $stmt->fetchColumn();
    }

    function getUsers($pdo, $start, $limit){
        $stmt = $pdo->prepare('SELECT id, username, role FROM usuarios LIMIT :limit OFFSET :offset');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $start, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getUserById($pdo, $id){
        $stmt = $pdo->prepare('SELECT id, username, role FROM usuarios WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Função para atualizar um usuário
    function updateUser($pdo, $id, $username, $role, $flag, $pass){
        if($flag === true){
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare('UPDATE usuarios SET username = ?, role = ?, password = ? WHERE id = ?');
            return $stmt->execute([$username, $role, $hashed_password, $id]);
        }else{
            $stmt = $pdo->prepare('UPDATE usuarios SET username = ?, role = ? WHERE id = ?');
            return $stmt->execute([$username, $role, $id]);
        }

    }

    // Função para deletar um usuário
    function deleteUser($pdo, $id) {
        $stmt = $pdo->prepare('DELETE FROM usuarios WHERE id = ?');
        return $stmt->execute([$id]);
    }


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $username = $_POST['username'];
        $role = $_POST['role'];
        $id= $_GET['id'] ?? '';
        $metodo = $_GET['metodo'] ?? '';
        $newPass = $_POST['new-password'] ?? '';

        if($metodo == "update"){
            if(!empty($newPass)){
                $response = updateUser($pdo, $id, $username, $role, true, $newPass);                
            }else{
                $response = updateUser($pdo, $id, $username, $role, false, $newPass);
            }


            if($response === true){
                header('Location: ../public/gerenciarUsuarios.php?code=200');
                exit();
            }else{
                header('Location: ../public/gerenciarUsuarios.php?code=500');
                exit();
            }
        }
    }elseif(isset($_GET['metodo']) && $_GET['metodo'] === 'delete'){
        $id= $_GET['id'] ?? '';
        $response = deleteUser($pdo, $id);

        if($response === true){
            header('Location: ../public/gerenciarUsuarios.php?code=201');
            exit();
        }else{
            header('Location: ../public/gerenciarUsuarios.php?code=501');
            exit();
        }
    }
} catch (\Exception $e) {
    // Capture a exceção e redirecione para a página de erro
    error_log($e->getMessage(), 3, '../logs/error.log'); // Exemplo de log em arquivo
    header('Location: ../public/errogeral.html');
    exit();
}
