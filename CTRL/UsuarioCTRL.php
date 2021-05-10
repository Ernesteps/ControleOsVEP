<?php

//Require_once precisa ser validado tudo antes para prosseguir
//Include_once foda-se a validação, vai prosseguir de qualquer jeito
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/DAO/UsuarioDAO.php';
require_once 'UtilCTRL.php';

class UsuarioCTRL
{
    public function AlterarUserAdm(UsuarioVO $vo)
    {
        if ($vo->getNome() == '' || $vo->getCPF() == '') {
            return 0;
        }

        $dao = new UsuarioDAO();
        return $dao->AlterarUserAdm($vo);
    }

    public function AlterarUserFun(FuncionarioVO $vof)
    {
        if ($vof->getNome() == '' || $vof->getCPF() == '' || $vof->getEmail_fun() == '' || $vof->getTel_fun() == '' || $vof->getIdSetor() == '') {
            return 0;
        }

        $dao = new UsuarioDAO();
        return $dao->AlterarUserFun($vof);
    }

    public function AlterarUserTec(TecnicoVO $vot)
    {
        if ($vot->getNome() == '' || $vot->getCPF() == '' || $vot->getEmail_tec() == '' || $vot->getTel_tec() == '') {
            return 0;
        }
        $dao = new UsuarioDAO();
        return $dao->AlterarUserTec($vot);
    }

    public function InserirUsuarioCTRL(UsuarioVO $vo)
    {
        if ($vo->getTipo() == '' || $vo->getNome() == '' || $vo->getCPF() == '') {
            return 0;
        }

        $vo->setdtCad(UtilCTRL::DataAtual());
        $vo->setStatus(1);
        $vo->setSenha(UtilCTRL::RetonarCriptografado($vo->getCPF()));

        $dao = new UsuarioDAO();
        return $dao->InserirUsuarioDAO($vo, UtilCTRL::CodigoUserLogado());
    }
    public function InserirFuncionarioCTRL(FuncionarioVO $vof)
    {
        if ($vof->getTipo() == '' || $vof->getNome() == '' || $vof->getCPF() == '' || $vof->getEmail_fun() == '' || $vof->getTel_fun() == '' || $vof->getIdSetor() == '') {
            return 0;
        }

        $vof->setDtCad(UtilCTRL::DataAtual());
        $vof->setStatus(1);
        $vof->setSenha(UtilCTRL::RetonarCriptografado($vof->getCPF()));

        $dao = new UsuarioDAO();
        return $dao->InserirUserFunc($vof, UtilCTRL::CodigoUserLogado());
    }

    public function InserirTecnicoCTRL(TecnicoVO $vot)
    {
        //UtilCTRL::ExibirArray($vot); //Isso mostra todas as informações que está passando em um array, ou seja, no objeto.

        if ($vot->getTipo() == '' || $vot->getNome() == '' || $vot->getCPF() == '' || $vot->getEmail_tec() == '' || $vot->getTel_tec() == '') {
            return 0;
        }

        $vot->setDtCad(UtilCTRL::DataAtual());
        $vot->setStatus(1);
        $vot->setSenha(UtilCTRL::RetonarCriptografado($vot->getCPF()));

        $dao = new UsuarioDAO();
        return $dao->InserirUserTec($vot, UtilCTRL::CodigoUserLogado());
    }

    public function VerificarCPFCadastro($cpf, $id)
    {
        $dao = new UsuarioDAO();
        return $dao->VerificarCPFCadastro($cpf, $id);
    }

    public function VerificarEmailCadastro($email)
    {
        $dao = new UsuarioDAO();
        return $dao->VerificarEmailCadastro($email);
    }

    public function FiltrarUsuario($nome)
    {
        $dao = new UsuarioDAO();
        return $dao->FiltrarUsuario($nome);
    }

    public function ExcluirUsuarioCTRL($idUser, $idTipo){
        $dao = new UsuarioDAO();
        return $dao->ExcluirUsuarioDAO($idUser, $idTipo, UtilCTRL::CodigoUserLogado());
    }

    public function DetalharUsuarioCTRL($idUser)
    {
        $dao = new UsuarioDAO();
        return $dao->DetalharUsuario($idUser);
    }
}
