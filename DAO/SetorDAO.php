<?php

require_once 'Conexao.php';

define('InserirSetor', 'InserirSetorDAO');
define('AlterarSetor', 'AlterarSetorDAO');
define('ExcluirSetor', 'ExcluirSetorDAO');

class SetorDAO extends Conexao{

    public function InserirSetorDAO(SetorVO $vo, $idUser){
        //1º Passo: Obter o objeto de conxexão. Para isso crie uma variável
        $conexao = parent::retornaConexao(); //Parent - Acesso de recursos da classe

        //2º Passo: Criar uma variavel que armazena o comando
        $comando_sql = 'insert into tb_setor (nome_setor) value (?)'; //Informação dinamica usa-se ?;
    
        //3ºPasso: Criar o objeto que será levado para o banco de dados
        $sql = new PDOStatement();

        //4º Passo: O objeto $sql deverá receber a conexão preparada para o comando
        $sql = $conexao->prepare($comando_sql);

        //5º Passo: Observar se tem ? no comando_sql, se tiver, configurar os BindValues
        $i=1;
        $sql->bindValue($i++, $vo->getNome());
        
        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            parent::GravarErro($ex->getMessage(), $idUser, InserirSetor);
            //echo $ex->getMessage(); //Retornar erro tecnico
            return -1;
        }
    }

    public function AlterarSetorDAO(SetorVO $vo, $idUser){
        //1º Passo: Obter o objeto de conxexão. Para isso crie uma variável
        $conexao = parent::retornaConexao(); //Parent - Acesso de recursos da classe

        //2º Passo: Criar uma variavel que armazena o comando
        $comando_sql = 'update tb_setor set nome_setor = ? where id_setor = ?'; //Informação dinamica usa-se ?;
    
        //3ºPasso: Criar o objeto que será levado para o banco de dados
        $sql = new PDOStatement();

        //4º Passo: O objeto $sql deverá receber a conexão preparada para o comando
        $sql = $conexao->prepare($comando_sql);

        //5º Passo: Observar se tem ? no comando_sql, se tiver, configurar os BindValues
        $i=1;
        $sql->bindValue($i++, $vo->getNome());
        $sql->bindValue($i++, $vo->getIdSetor());
        
        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            parent::GravarErro($ex->getMessage(), $idUser, AlterarSetor);
            //echo $ex->getMessage(); //Retornar erro tecnico
            return -1;
        }
    }

    public function ExcluirSetorDAO($idSetor, $idUser){
        //1º Passo: Obter o objeto de conxexão. Para isso crie uma variável
        $conexao = parent::retornaConexao(); //Parent - Acesso de recursos da classe

        //2º Passo: Criar uma variavel que armazena o comando
        $comando_sql = 'delete from tb_setor where id_setor = ?'; //Informação dinamica usa-se ?;
    
        //3ºPasso: Criar o objeto que será levado para o banco de dados
        $sql = new PDOStatement();

        //4º Passo: O objeto $sql deverá receber a conexão preparada para o comando
        $sql = $conexao->prepare($comando_sql);

        //5º Passo: Observar se tem ? no comando_sql, se tiver, configurar os BindValues
        $sql->bindValue(1, $idSetor);
        
        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            parent::GravarErro($ex->getMessage(), $idUser, ExcluirSetor);
            //echo $ex->getMessage(); //Retornar erro tecnico
            return -2;
        }
    }

    public function ConsultarSetorDAO(){
        $conexao = parent::retornaConexao();

        $comando_sql = 'select id_setor, nome_setor from tb_setor order by nome_setor';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->setFetchMode(PDO::FETCH_ASSOC); //Enxuta as informações da consulta, mostrando apenas as informçoes importantes
        $sql->execute();

        return $sql->fetchAll(); //Varrer tudo, ou seja, retornar tudo, ou no caso, resultados.
    }
}