<?php

//Require_once precisa ser validado tudo antes para prosseguir
//Include_once foda-se a validação, vai prosseguir de qualquer jeito
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/DAO/UsuarioDAO.php';
require_once 'UtilCTRL.php';

class UsuarioCTRL
{
    public function ValidarLogin($cpf, $senha)
    {
        if (trim($senha) == '' || trim($cpf) == '') {
            return 0;
        }

        $dao = new UsuarioDAO();
        $user = $dao->ValidarLogin($cpf);

        //Verifica se encontrou o user
        if (count($user) == 0) {
            return 2;
        }

        $senha_hash = $user[0]['senha_usuario'];

        //Verificar se a senha bate
        if (password_verify($senha, $senha_hash)) {
            $tipo = $user[0]['tipo_usuario'];
            UtilCTRL::CriarSessao($user[0]['id_usuario'], $user[0]['tipo_usuario'], $user[0]['id_setor']);

            switch ($tipo) {
                case 1:
                    header('location: http://localhost/ControleosVEP/acesso/adm/adm_inicial.php');
                    exit;
                    break;

                case 2:
                    header('location: http://localhost/ControleosVEP/acesso/funcionario/func_meusdados.php');
                    exit;
                    break;

                case 3:
                    header('location: http://localhost/ControleosVEP/acesso/tecnico/tec_meusdados.php');
                    exit;
                    break;
            }
        } else {

            return 2;
        }
    }

    public function ValidarSenhaFuncionario($cpf, $senha)
    {
        $dao = new UsuarioDAO();
        $user = $dao->ValidarLogin($cpf);

        //Verifica se encontrou o user
        if (count($user) == 0) {
            return 2;
        }

        $senha_hash = $user[0]['senha_usuario'];

        //Verificar se a senha bate
        if (password_verify($senha, $senha_hash)) {
            echo 'senha bate';
        } else {

            echo 'nope';
        }
    }

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
        if ($vof->getNome() == '' || $vof->getCPF() == '' || $vof->getEmail_fun() == '' || $vof->getEndereco_fun() == '' || $vof->getTel_fun() == '' || $vof->getIdSetor() == '') {
            return 0;
        }

        $dao = new UsuarioDAO();
        return $dao->AlterarUserFun($vof);
    }

    public function AlterarUserFunSolo(FuncionarioVO $vofS)
    {
        if ($vofS->getEndereco_fun() == '' || $vofS->getEmail_fun() == '' || $vofS->getTel_fun() == '') {
            return 0;
        }

        $vofS->setIdUser(UtilCTRL::CodigoUserLogado());

        $dao = new UsuarioDAO();
        return $dao->AlterarUserFunSolo($vofS);
    }

    public function AlterarUserTec(TecnicoVO $vot)
    {
        if ($vot->getNome() == '' || $vot->getCPF() == '' || $vot->getEmail_tec() == '' || $vot->getTel_tec() == '') {
            return 0;
        }
        $dao = new UsuarioDAO();
        return $dao->AlterarUserTec($vot);
    }

    public function AlterarUserTecSolo(TecnicoVO $votS)
    {
        if ($votS->getEndereco_tec() == '' || $votS->getEmail_tec() == '' || $votS->getTel_tec() == '') {
            return 0;
        }

        $votS->setIdUser(UtilCTRL::CodigoUserLogado());

        $dao = new UsuarioDAO();
        return $dao->AlterarUserTecSolo($votS);
    }

    public function InserirUsuarioCTRL(UsuarioVO $vo)
    {
        if ($vo->getTipo() == '' || $vo->getNome() == '' || $vo->getCPF() == '') {
            return 0;
        }
        $vo->setCPF(UtilCTRL::TirarCaracteresEspeciais($vo->getCPF()));

        $vo->setdtCad(UtilCTRL::DataAtual());
        $vo->setStatus(1);
        $vo->setSenha(UtilCTRL::RetornarCriptografado($vo->getCPF()));

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
        $vof->setSenha(UtilCTRL::RetornarCriptografado($vof->getCPF()));

        $dao = new UsuarioDAO();
        return $dao->InserirUserFunc($vof, UtilCTRL::CodigoUserLogado());
    }

    public function ValidarSenhaAtual($senha_atual)
    {
        $dao = new UsuarioDAO();

        $user_senha_hash = $dao->RecuperarSenhaAtual(UtilCTRL::CodigoUserLogado());
        $senha_hash = $user_senha_hash[0]['senha_usuario'];

        return password_verify($senha_atual, $senha_hash); //password_verify é booleano
    }

    public function InserirTecnicoCTRL(TecnicoVO $vot)
    {
        //UtilCTRL::ExibirArray($vot); //Isso mostra todas as informações que está passando em um array, ou seja, no objeto.

        if ($vot->getTipo() == '' || $vot->getNome() == '' || $vot->getCPF() == '' || $vot->getEmail_tec() == '' || $vot->getTel_tec() == '') {
            return 0;
        }

        $vot->setDtCad(UtilCTRL::DataAtual());
        $vot->setStatus(1);
        $vot->setSenha(UtilCTRL::RetornarCriptografado($vot->getCPF()));

        $dao = new UsuarioDAO();
        return $dao->InserirUserTec($vot, UtilCTRL::CodigoUserLogado());
    }

    public function VerificarCPFCadastro($cpf, $id)
    {
        $dao = new UsuarioDAO();
        $cpf = UtilCTRL::TirarCaracteresEspeciais($cpf);
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

    public function ExcluirUsuarioCTRL($idUser, $idTipo)
    {
        $dao = new UsuarioDAO();
        return $dao->ExcluirUsuarioDAO($idUser, $idTipo, UtilCTRL::CodigoUserLogado());
    }

    public function DetalharUsuarioCTRL($idUser)
    {
        $dao = new UsuarioDAO();
        return $dao->DetalharUsuario($idUser == '' ? UtilCTRL::CodigoUserLogado() : $idUser);
    }

    public function AlterarSenhaCTRL($senha, $rsenha)
    {
        if(trim($senha) == '' || trim($rsenha) == ''){
            return 0;
        }
        if(strlen(trim($senha)) < 6){
            return 6;
        }

        if(trim($senha) != trim($rsenha)){
            return 7;
        }

        $dao = new UsuarioDAO();
        return $dao->AlterarSenhaDAO(UtilCTRL::CodigoUserLogado(), UtilCTRL::RetornarCriptografado($senha));
    }
}
