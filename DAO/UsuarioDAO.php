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

    /** @var PDO */
    private $conexao;

    /** @var PDOStatement */
    private $sql;

    public function __construct()
    {
        $this->conexao = parent::retornaConexao();
        $this->sql = new PDOStatement();
    }

    public function ValidarLogin($cpf)
    {
        $comando_sql = 'select 
                            usu.id_usuario, 
                            usu.tipo_usuario, 
                            usu.senha_usuario
                            fun.id_setor
                        from tb_usuario as usu
                    left join tb_funcionario as fun
                        on usu.id_usuario = fun.id_usuario_fun
                    where usu.cpf_usuario = ? and usu.status_usuario = ?';
        $this->sql = $this->conexao->prepare($comando_sql);

        $i=1;
        $this->sql->bindValue($i++, $cpf);
        $this->sql->bindValue($i++, 1);
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        $this->sql->execute();

        return $this->sql->fetchAll();
    }

    public function AlterarUserAdm(UsuarioVO $vo)
    {

        $comando_sql = 'update tb_usuario
                        set nome_usuario = ?, 
                            cpf_usuario = ?
                        where id_usuario = ?';

        $this->sql = $this->conexao->prepare($comando_sql);
        $i = 1;
        $this->sql->bindValue($i++, $vo->getNome());
        $this->sql->bindValue($i++, $vo->getCPF());
        $this->sql->bindValue($i++, $vo->getIdUser());

        try {
            $this->sql->execute();
            return 1;
        } catch (Exception $ex) {
            parent::GravarErro($ex->getMessage(), $vo->getIdUser(), Alterar);
            return -1;
        }
    }

    public function AlterarUserFun(FuncionarioVO $vo)
    {

        $comando_sql = 'update tb_usuario
                        set nome_usuario = ?, 
                            cpf_usuario = ?
                        where id_usuario = ?';

        $this->sql = $this->conexao->prepare($comando_sql);
        $i = 1;
        $this->sql->bindValue($i++, $vo->getNome());
        $this->sql->bindValue($i++, $vo->getCPF());
        $this->sql->bindValue($i++, $vo->getIdUser());

        $this->conexao->beginTransaction();

        try {
            $this->sql->execute();

            $comando_sql = 'update tb_funcionario
                                set email_fun = ?,
                                    tel_fun = ?,
                                    endereco_fun = ?,
                                    id_setor = ?
                                where id_usuario_fun = ?';

            $this->sql = $this->conexao->prepare($comando_sql);

            $i = 1;
            $this->sql->bindValue($i++, $vo->getEmail_fun());
            $this->sql->bindValue($i++, $vo->getTel_fun());
            $this->sql->bindValue($i++, $vo->getEndereco_fun());
            $this->sql->bindValue($i++, $vo->getIdSetor());
            $this->sql->bindValue($i++, $vo->getIdUser());

            $this->sql->execute();
            $this->conexao->commit();

            return 1;
        } catch (Exception $ex) {
            $this->conexao->rollBack();
            parent::GravarErro($ex->getMessage(), $vo->getIdUser(), AlterarFunc);
            return -1;
        }
    }

    public function AlterarUserTec(TecnicoVO $vo)
    {

        $comando_sql = 'update tb_usuario
                        set nome_usuario = ?, 
                            cpf_usuario = ?
                        where id_usuario = ?';

        $this->sql = $this->conexao->prepare($comando_sql);
        $i = 1;
        $this->sql->bindValue($i++, $vo->getNome());
        $this->sql->bindValue($i++, $vo->getCPF());
        $this->sql->bindValue($i++, $vo->getIdUser());

        $this->conexao->beginTransaction();

        try {
            $this->sql->execute();

            $comando_sql = 'update tb_tecnico
                                set email_tec = ?,
                                    tel_tec = ?,
                                    endereco_tec = ?
                                where id_usuario_tec = ?';

            $this->sql = $this->conexao->prepare($comando_sql);

            $i = 1;
            $this->sql->bindValue($i++, $vo->getEmail_tec());
            $this->sql->bindValue($i++, $vo->getTel_tec());
            $this->sql->bindValue($i++, $vo->getEndereco_tec());
            $this->sql->bindValue($i++, $vo->getIdUser());

            $this->sql->execute();
            $this->conexao->commit();

            return 1;
        } catch (Exception $ex) {
            $this->conexao->rollBack();
            parent::GravarErro($ex->getMessage(), $vo->getIdUser(), AlterarTec);
            return -1;
        }
    }

    public function InserirUsuarioDAO(UsuarioVO $vo, $idUser)
    {
        $comando_sql = 'insert into tb_usuario
                        (tipo_usuario, 
                        nome_usuario, 
                        cpf_usuario, 
                        senha_usuario, 
                        status_usuario, 
                        data_cadastro) 
                        value (?,?,?,?,?,?)';

        $this->sql = $this->conexao->prepare($comando_sql);

        $i = 1;
        $this->sql->bindValue($i++, $vo->getTipo());
        $this->sql->bindValue($i++, $vo->getNome());
        $this->sql->bindValue($i++, $vo->getCPF());
        $this->sql->bindValue($i++, $vo->getSenha());
        $this->sql->bindValue($i++, $vo->getStatus());
        $this->sql->bindValue($i++, $vo->getDtCad());

        try {
            $this->sql->execute();
            return 1;
        } catch (Exception $ex) {
            parent::GravarErro($ex->getMessage(), $idUser, Inserir);
            return -1;
        }
    }

    public function InserirUserTec(TecnicoVO $vo, $idUser)
    {
        $comando_sql = 'insert into tb_usuario
                        (tipo_usuario,
                        nome_usuario,
                        cpf_usuario,
                        senha_usuario,
                        status_usuario,
                        data_cadastro)
                        value (?,?,?,?,?,?)';

        $this->sql = $this->conexao->prepare($comando_sql);

        $i = 1;
        $this->sql->bindValue($i++, $vo->getTipo());
        $this->sql->bindValue($i++, $vo->getNome());
        $this->sql->bindValue($i++, $vo->getCPF());
        $this->sql->bindValue($i++, $vo->getSenha());
        $this->sql->bindValue($i++, $vo->getStatus());
        $this->sql->bindValue($i++, $vo->getDtCad());

        $this->conexao->beginTransaction();

        try {
            //Inserção na tb_usuario
            $this->sql->execute();

            //Recuperar o ID do usuario cadastrado
            $id_user = $this->conexao->lastInsertId();

            $comando_sql = 'insert into tb_tecnico
                            (id_usuario_tec,
                            email_tec,
                            tel_tec,
                            endereco_tec)
                            value (?,?,?,?)';

            $this->sql = $this->conexao->prepare($comando_sql);

            $i = 1;
            $this->sql->bindValue($i++, $id_user);
            $this->sql->bindValue($i++, $vo->getEmail_tec());
            $this->sql->bindValue($i++, $vo->getTel_tec());
            $this->sql->bindValue($i++, $vo->getEndereco_tec());

            //Inserção na tb_tecnico
            $this->sql->execute();

            //Confirmar a Transação
            $this->conexao->commit();

            return 1;
        } catch (Exception $ex) {

            //echo $ex;
            $this->conexao->rollBack();
            parent::GravarErro($ex->getMessage(), $idUser, InserirTec);
            return -1;
        }
    }

    public function InserirUserFunc(FuncionarioVO $vo, $idUser)
    {
        $comando_sql = 'insert into tb_usuario
                        (tipo_usuario,
                        nome_usuario,
                        cpf_usuario,
                        senha_usuario,
                        status_usuario,
                        data_cadastro)
                        value (?,?,?,?,?,?)';

        $this->sql = $this->conexao->prepare($comando_sql);

        $i = 1;
        $this->sql->bindValue($i++, $vo->getTipo());
        $this->sql->bindValue($i++, $vo->getNome());
        $this->sql->bindValue($i++, $vo->getCPF());
        $this->sql->bindValue($i++, $vo->getSenha());
        $this->sql->bindValue($i++, $vo->getStatus());
        $this->sql->bindValue($i++, $vo->getDtCad());

        $this->conexao->beginTransaction();

        try {

            $this->sql->execute();
            $id_user = $this->conexao->lastInsertId();

            $comando_sql = 'insert into tb_funcionario
                            (id_usuario_fun,
                            email_fun,
                            tel_fun,
                            endereco_fun,
                            id_setor)
                            value (?,?,?,?,?)';

            $this->sql = $this->conexao->prepare($comando_sql);

            $i = 1;
            $this->sql->bindValue($i++, $id_user);
            $this->sql->bindValue($i++, $vo->getEmail_fun());
            $this->sql->bindValue($i++, $vo->getTel_fun());
            $this->sql->bindValue($i++, $vo->getEndereco_fun());
            $this->sql->bindValue($i++, $vo->getIdSetor());

            $this->sql->execute();
            $this->conexao->commit();
            return 1;
        } catch (Exception $ex) {

            //echo $ex;
            $this->conexao->rollBack();
            parent::GravarErro($ex->getMessage(), $idUser, InserirFunc);
            return -1;
        }
    }

    public function VerificarCPFCadastro($cpf, $id)
    {
        $comando_sql = 'select count(cpf_usuario) as contar
                        from tb_usuario where cpf_usuario = ?';

        if ($id != null) {
            $comando_sql .= ' and id_usuario != ?';
        }

        $this->sql = $this->conexao->prepare($comando_sql);
        $this->sql->bindValue(1, $cpf);

        if ($id != null) {
            $this->sql->bindValue(2, $id);
        }

        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        $this->sql->execute();

        $result = $this->sql->fetchAll();
        return $result[0]['contar'];
    }

    public function VerificarEmailCadastro($email)
    {
        $comando_sql = 'select (SELECT COUNT(email_tec) FROM tb_tecnico WHERE email_tec = ?) +
                        (SELECT COUNT(email_fun) FROM tb_funcionario WHERE email_fun = ?) as contar';

        $this->sql = $this->conexao->prepare($comando_sql);
        $i = 1;
        $this->sql->bindValue($i++, $email);
        $this->sql->bindValue($i++, $email);
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        $this->sql->execute();

        $result = $this->sql->fetchAll();
        return $result[0]['contar'];
    }

    public function FiltrarUsuario($nome)
    {

        $comando_sql = 'select id_usuario, nome_usuario, tipo_usuario
		                from tb_usuario
                        where nome_usuario like ?';

        $this->sql = $this->conexao->prepare($comando_sql);
        $this->sql->bindValue(1, '%' . $nome . '%');
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        $this->sql->execute();

        return $this->sql->fetchAll();
    }

    public function DetalharUsuario($idUser)
    {
        $comando_sql = 'select usu.id_usuario,
                               usu.nome_usuario,
                               usu.tipo_usuario,
                               usu.cpf_usuario,
                               tec.tel_tec,
                               tec.email_tec,
                               tec.endereco_tec,
                               fun.id_setor,
                               fun.tel_fun,
                               fun.endereco_fun,
                               fun.email_fun  
                            from tb_usuario as usu
                            left join tb_funcionario as fun
                                on usu.id_usuario = fun.id_usuario_fun
                            left join tb_tecnico as tec
                                on usu.id_usuario = tec.id_usuario_tec
                             where usu.id_usuario = ?';

        $this->sql = $this->conexao->prepare($comando_sql);
        $i = 1;
        $this->sql->bindValue($i++, $idUser);
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        $this->sql->execute();

        return $this->sql->fetchAll();
    }

    public function ExcluirUsuarioDAO($idUser, $idTipo, $UtilIdUser)
    {

        if ($idTipo == 1) {
            $comando_sql = 'delete from tb_usuario where id_usuario = ?';
            $this->sql = $this->conexao->prepare($comando_sql);
            $this->sql->bindValue(1, $idUser);

            try {
                $this->sql->execute();
                return 1;
            } catch (Exception $ex) {
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
            $this->sql = $this->conexao->prepare($comando_sql);
            $this->sql->bindValue(1, $idUser);
            $this->conexao->beginTransaction();

            try {
                $this->sql->execute();

                $comando_sql = 'delete from tb_usuario where id_usuario = ?';
                $this->sql = $this->conexao->prepare($comando_sql);

                $this->sql->bindValue(1, $idUser);
                $this->sql->execute();
                $this->conexao->commit();
                return 1;
            } catch (Exception $ex) {
                $this->conexao->rollBack();
                parent::GravarErro($ex->getMessage(), $UtilIdUser, Excluir);
                return -2;
            }
        }
    }
}
