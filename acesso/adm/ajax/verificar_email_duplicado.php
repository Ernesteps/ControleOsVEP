<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/controleosvep/CTRL/UsuarioCTRL.php';

if(isset($_POST['email_user'])){
    $email = $_POST['email_user'];
    $ctrl = new UsuarioCTRL();

    $tem_email = $ctrl->VerificarEmailCadastro($email);
    echo $tem_email;
}
?>