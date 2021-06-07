<?php
require_once 'Conexao.php';

class Func_ChamadoDAO extends Conexao
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
}