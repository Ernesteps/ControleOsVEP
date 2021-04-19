<?php

require_once 'Conexao.php';

define('InserirTipo', 'InserirTipoDAO');
define('AlterarTipo', 'AlterarTipoDAO');
define('ExcluirTipo', 'ExcluirTipoDAO');

class TipoDAO extends Conexao{

    public function InserirTipoDAO(TipoVO $vo, $idUser){

        $conexao = parent::retornaConexao();
        $comando_sql = 'insert into tb_tipo (nome_tipo) value (?)';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $vo->getNome());
        
        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            parent::GravarErro($ex->getMessage(), $idUser, InserirTipo);
            return -1;
        }
    }

    public function AlterarTipoDAO(TipoVO $vo, $idUser){
        //1º Passo: Obter o objeto de conxexão. Para isso crie uma variável
        $conexao = parent::retornaConexao(); //Parent - Acesso de recursos da classe

        //2º Passo: Criar uma variavel que armazena o comando
        $comando_sql = 'update tb_tipo set nome_tipo = ? where id_tipo = ?'; //Informação dinamica usa-se ?;
    
        //3ºPasso: Criar o objeto que será levado para o banco de dados
        $sql = new PDOStatement();

        //4º Passo: O objeto $sql deverá receber a conexão preparada para o comando
        $sql = $conexao->prepare($comando_sql);

        //5º Passo: Observar se tem ? no comando_sql, se tiver, configurar os BindValues
        $i=1;
        $sql->bindValue($i++, $vo->getNome());
        $sql->bindValue($i++, $vo->getId_Tipo());
        
        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            parent::GravarErro($ex->getMessage(), $idUser, AlterarTipo);
            //echo $ex->getMessage(); //Retornar erro tecnico
            return -1;
        }
    }

    public function ExcluirTipoDAO($idTipo, $idUser){
        //1º Passo: Obter o objeto de conxexão. Para isso crie uma variável
        $conexao = parent::retornaConexao(); //Parent - Acesso de recursos da classe

        //2º Passo: Criar uma variavel que armazena o comando
        $comando_sql = 'delete from tb_tipo where id_tipo = ?'; //Informação dinamica usa-se ?;
    
        //3ºPasso: Criar o objeto que será levado para o banco de dados
        $sql = new PDOStatement();

        //4º Passo: O objeto $sql deverá receber a conexão preparada para o comando
        $sql = $conexao->prepare($comando_sql);

        //5º Passo: Observar se tem ? no comando_sql, se tiver, configurar os BindValues
        $i=1;
        $sql->bindValue($i++, $idTipo);
        
        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            parent::GravarErro($ex->getMessage(), $idUser, ExcluirTipo);
            //echo $ex->getMessage(); //Retornar erro tecnico
            return -2;
        }
    }

    public function ConsultarTipoDAO(){
        $conexao = parent::retornaConexao();

        $comando_sql = 'select id_tipo, nome_tipo from tb_tipo order by nome_tipo';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->setFetchMode(PDO::FETCH_ASSOC); //Enxuta as informações da consulta, mostrando apenas as informçoes importantes
        $sql->execute();

        return $sql->fetchAll(); //Varrer tudo, ou seja, retornar tudo, ou no caso, resultados.
    }
}