<?php

// Configurações do site
//Define - Variável torna-se constante.
define('HOST', 'localhost'); //IP
define('USER', 'root'); //usuario
define('PASS', null); //Senha
define('DB', 'db_os_vep'); //Banco
/**
 * Conexao.class TIPO [Conexão]
 * Descricao: Estabelece conexões com o banco usando SingleTon
 * @copyright (c) year, Wladimir M. Barros
 */

class Conexao {

    /** @var PDO */
    private static $Connect; //static - cria na memoria, nao precisa ser instanciada

    private static function Conectar() {
        try {

            //Verifica se a conexão não existe
            if (self::$Connect == null):

                $dsn = 'mysql:host=' . HOST . ';dbname=' . DB;
                self::$Connect = new PDO($dsn, USER, PASS, null);
            endif;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
       
        //Seta os atributos para que seja retornado as excessões do banco
        self::$Connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
       
        return  self::$Connect;
    }

    public static function retornaConexao() {
        return  self::Conectar();
    }

    public static function GravarErro($msg, $idUser, $funcao)
    {
        $quebra = chr(13) . chr(10);
        $arquivo = $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/DAO/Erro/Erro.txt';

        //verifica se o arquivo nao existe
        if (!file_exists($arquivo)) {
            $arquivo = fopen($arquivo, 'w'); //'W' Write
        } else {
            //Abrir o arquivo existente, deixando o curso no final do arquivo
            $arquivo = fopen($arquivo, 'a+'); 
        }

        date_default_timezone_set('America/Sao_Paulo');

        $texto_final = '****************************************************************' . $quebra;
        $texto_final .= 'Erro: ' . $msg . $quebra; //.= Pega o mesmo valor, ou seja, como se fosse $texto_final = $texto_final .
        $texto_final .= 'Data: ' . date('d/m/Y') . ' Hora: ' . date('H:i') . $quebra;
        $texto_final .= 'Função Chamado: ' . $funcao . $quebra;
        $texto_final .= 'Id Usuario Logado: ' . $idUser . $quebra;

        //Escrever no arquivo o conteudo do texto
        fwrite($arquivo, $texto_final);
        fclose($arquivo);
    }    
}