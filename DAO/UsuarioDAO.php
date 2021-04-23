<?php

require_once 'Conexao.php';

define('Inserir', 'InserirUsuarioDAO');
define('Alterar', 'AlterarUsuarioDAO');
define('Excluir', 'ExcluirUsuarioDAO');

define('InserirTec', 'InserirUserTecDAO');
define('AlterarTec', 'AlterarUserTecDAO');
define('ExcluirTec', 'ExcluirUserTecDAO');

define('InserirFunc', 'InserirUserFuncDAO');
define('AlterarFunc', 'AlterarUserFuncDAO');
define('ExcluirFunc', 'ExcluirUserFuncDAO');

class UsuarioDAO extends Conexao
{
    public function InserirUsuarioDAO(UsuarioVO $vo, $idUser)
    {
        $conexao = parent::retornaConexao();
        $comando_sql = 'insert into tb_usuario
                        (tipo_usuario, 
                        nome_usuario, 
                        cpf_usuario, 
                        senha_usuario, 
                        status_usuario, 
                        data_cadastro) 
                        value (?,?,?,?,?,?)';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $i = 1;
        $sql->bindValue($i++, $vo->getTipo());
        $sql->bindValue($i++, $vo->getNome());
        $sql->bindValue($i++, $vo->getCPF());
        $sql->bindValue($i++, $vo->getSenha());
        $sql->bindValue($i++, $vo->getStatus());
        $sql->bindValue($i++, $vo->getDtCad());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            parent::GravarErro($ex->getMessage(), $idUser, Inserir);
            return -1;
        }
    }

    public function InserirUserTec(TecnicoVO $vo, $idUser)
    {
        $conexao = parent::retornaConexao();
        $comando_sql = 'insert into tb_usuario
                        (tipo_usuario,
                        nome_usuario,
                        cpf_usuario,
                        senha_usuario,
                        status_usuario,
                        data_cadastro)
                        value (?,?,?,?,?,?)';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $i = 1;
        $sql->bindValue($i++, $vo->getTipo());
        $sql->bindValue($i++, $vo->getNome());
        $sql->bindValue($i++, $vo->getCPF());
        $sql->bindValue($i++, $vo->getSenha());
        $sql->bindValue($i++, $vo->getStatus());
        $sql->bindValue($i++, $vo->getDtCad());

        $conexao->beginTransaction();

        try {
            //Inserção na tb_usuario
            $sql->execute();

            //Recuperar o ID do usuario cadastrado
            $id_user = $conexao->lastInsertId();

            $comando_sql = 'insert into tb_tecnico
                            (id_usuario_tec,
                            email_tec,
                            tel_tec,
                            endereco_tec)
                            value (?,?,?,?)';

            $sql = $conexao->prepare($comando_sql);

            $i = 1;
            $sql->bindValue($i++, $id_user);
            $sql->bindValue($i++, $vo->getEmail_tec());
            $sql->bindValue($i++, $vo->getTel_tec());
            $sql->bindValue($i++, $vo->getEndereco_tec());

            //Inserção na tb_tecnico
            $sql->execute();

            //Confirmar a Transação
            $conexao->commit();

            return 1;
        } catch (Exception $ex) {

            //echo $ex;
            $conexao->rollBack();
            parent::GravarErro($ex->getMessage(), $idUser, InserirTec);
            return -1;
        }
    }

    public function InserirUserFunc(FuncionarioVO $vo, $idUser)
    {
        $conexao = parent::retornaConexao();
        $comando_sql = 'insert into tb_usuario
                        (tipo_usuario,
                        nome_usuario,
                        cpf_usuario,
                        senha_usuario,
                        status_usuario,
                        data_cadastro)
                        value (?,?,?,?,?,?)';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $i = 1;
        $sql->bindValue($i++, $vo->getTipo());
        $sql->bindValue($i++, $vo->getNome());
        $sql->bindValue($i++, $vo->getCPF());
        $sql->bindValue($i++, $vo->getSenha());
        $sql->bindValue($i++, $vo->getStatus());
        $sql->bindValue($i++, $vo->getDtCad());

        $conexao->beginTransaction();

        try {

            $sql->execute();
            $id_user = $conexao->lastInsertId();

            $comando_sql = 'insert into tb_funcionario
                            (id_usuario_fun,
                            email_fun,
                            tel_fun,
                            endereco_fun,
                            id_setor)
                            value (?,?,?,?,?)';

            $sql = $conexao->prepare($comando_sql);

            $i = 1;
            $sql->bindValue($i++, $id_user);
            $sql->bindValue($i++, $vo->getEmail_fun());
            $sql->bindValue($i++, $vo->getTel_fun());
            $sql->bindValue($i++, $vo->getEndereco_fun());
            $sql->bindValue($i++, $vo->getIdSetor());

            $sql->execute();
            $conexao->commit();
            return 1;
        } catch (Exception $ex) {

            //echo $ex;
            $conexao->rollBack();
            parent::GravarErro($ex->getMessage(), $idUser, InserirFunc);
            return -1;
        }
    }

    public function VerificarCPFCadastro($cpf)
    {
        $conexao = parent::retornaConexao();
        $comando_sql = 'select count(cpf_usuario) as contar
                        from tb_usuario where cpf_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $cpf);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        $result = $sql->fetchAll();
        return $result[0]['contar'];
    }

    public function VerificarEmailCadastro($email)
    {
        $conexao = parent::retornaConexao();
        $comando_sql = 'select (SELECT COUNT(email_tec) FROM tb_tecnico WHERE email_tec = ?) +
                        (SELECT COUNT(email_fun) FROM tb_funcionario WHERE email_fun = ?) as contar';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $i = 1;
        $sql->bindValue($i++, $email);
        $sql->bindValue($i++, $email);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        $result = $sql->fetchAll();
        return $result[0]['contar'];
    }

    public function FiltrarUsuario($nome)
    {

        $conexao = parent::retornaConexao();

        $comando_sql = 'select id_usuario, nome_usuario, tipo_usuario
		                from tb_usuario
                        where nome_usuario like ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, '%' . $nome . '%');
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function ExcluirUsuarioDAO($idUser, $idTipo, $UtilIdUser)
    {
        $conexao = parent::retornaConexao();

        if ($idTipo == 1){
            $comando_sql = 'delete from tb_usuario where id_usuario = ?';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $idUser);

            try{
                $sql->execute();
                return 1;
            }catch(Exception $ex){
                parent::GravarErro($ex->getMessage(), $idUser, Excluir);
                return -2;
            }
        }

        if ($idTipo != 1) {
            if ($idTipo == 2) {
                $comando_sql = 'delete from tb_funcionario where id_usuario_fun = ?';
            } else if ($idTipo == 3) {
                $comando_sql = 'delete from tb_tecnico where id_usuario_tec = ?';
            }
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $idUser);
            $conexao->beginTransaction();

            try {
                $sql->execute();

                $comando_sql = 'delete from tb_usuario where id_usuario = ?';
                $sql = $conexao->prepare($comando_sql);

                $sql->bindValue(1, $idUser);
                $sql->execute();
                $conexao->commit();
                return 1;
            } catch (Exception $ex) {
                $conexao->rollBack();
                parent::GravarErro($ex->getMessage(), $UtilIdUser, Excluir);
                return -2;
            }
        }
    }
}
