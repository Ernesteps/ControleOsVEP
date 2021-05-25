<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/controleosvep/DAO/UsuarioDAO.php';

if(isset($_POST['senha_atual_user'])){

    $senha = $_POST['senha_atual_user'];
    $cpf = $_POST['cpf_user'];

    $dao = new UsuarioDAO();
    $user = $dao->ValidarLogin($cpf);
    $senha_hash = $user[0]['senha_usuario'];

    if (password_verify($senha, $senha_hash)) {
        echo 1;
    } else {
        echo -1;
    }    
}
?>