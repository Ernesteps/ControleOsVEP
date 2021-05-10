<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/controleosvep/CTRL/UsuarioCTRL.php';

if (isset($_POST['cpf_user'])) {
    $cpf = $_POST['cpf_user'];
    $id = $_POST['id'];
    $ctrl = new UsuarioCTRL();

    $tem_cpf = $ctrl->VerificarCPFCadastro($cpf, $id);
    echo $tem_cpf;
}
?>
