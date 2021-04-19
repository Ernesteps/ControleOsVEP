<?php

require_once 'Conexao.php';

define('InserirModelo', 'InserirModeloDAO');
define('AlterarModelo', 'AlterarModeloDAO');
define('ExcluirModelo', 'ExcluirModeloDAO');

class ModeloDAO extends Conexao{

    public function InserirModeloDAO(ModeloVO $vo, $idUser){

        $conexao = parent::retornaConexao();
        $comando_sql = 'insert into tb_modelo (nome_modelo) value (?)';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $i=1;
        $sql->bindValue($i++, $vo->getNome());
        
        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            parent::GravarErro($ex->getMessage(), $idUser, InserirModelo);
            return -1;
        }
    }

    public function AlterarModeloDAO(ModeloVO $vo, $idUser){
        //1º Passo: Obter o objeto de conxexão. Para isso crie uma variável
        $conexao = parent::retornaConexao(); //Parent - Acesso de recursos da classe

        //2º Passo: Criar uma variavel que armazena o comando
        $comando_sql = 'update tb_modelo set nome_modelo = ? where id_modelo = ?'; //Informação dinamica usa-se ?;
    
        //3ºPasso: Criar o objeto que será levado para o banco de dados
        $sql = new PDOStatement();

        //4º Passo: O objeto $sql deverá receber a conexão preparada para o comando
        $sql = $conexao->prepare($comando_sql);

        //5º Passo: Observar se tem ? no comando_sql, se tiver, configurar os BindValues
        $i=1;
        $sql->bindValue($i++, $vo->getNome());
        $sql->bindValue($i++, $vo->getIdModelo());
        
        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            parent::GravarErro($ex->getMessage(), $idUser, AlterarModelo);
            //echo $ex->getMessage(); //Retornar erro tecnico
            return -1;
        }
    }

    public function ExcluirModeloDAO($idModelo, $idUser){
        //1º Passo: Obter o objeto de conxexão. Para isso crie uma variável
        $conexao = parent::retornaConexao(); //Parent - Acesso de recursos da classe

        //2º Passo: Criar uma variavel que armazena o comando
        $comando_sql = 'delete from tb_modelo where id_modelo = ?'; //Informação dinamica usa-se ?;
    
        //3ºPasso: Criar o objeto que será levado para o banco de dados
        $sql = new PDOStatement();

        //4º Passo: O objeto $sql deverá receber a conexão preparada para o comando
        $sql = $conexao->prepare($comando_sql);

        //5º Passo: Observar se tem ? no comando_sql, se tiver, configurar os BindValues
        $sql->bindValue(1, $idModelo);
        
        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            parent::GravarErro($ex->getMessage(), $idUser, ExcluirModelo);
            //echo $ex->getMessage(); //Retornar erro tecnico
            return -2;
        }
    }

    public function ConsultarModeloDAO(){
        $conexao = parent::retornaConexao();

        $comando_sql = 'select id_modelo, nome_modelo from tb_modelo order by nome_modelo';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->setFetchMode(PDO::FETCH_ASSOC); //Enxuta as informações da consulta, mostrando apenas as informçoes importantes
        $sql->execute();

        return $sql->fetchAll(); //Varrer tudo, ou seja, retornar tudo, ou no caso, resultados.
    }
}