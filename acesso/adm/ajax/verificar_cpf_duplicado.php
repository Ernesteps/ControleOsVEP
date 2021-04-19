<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/controleosvep/CTRL/UsuarioCTRL.php';

if (isset($_POST['cpf_user'])) {
    $cpf = $_POST['cpf_user'];
    $ctrl = new UsuarioCTRL();

    $tem_cpf = $ctrl->VerificarCPFCadastro($cpf);
    echo $tem_cpf;
}
?>
