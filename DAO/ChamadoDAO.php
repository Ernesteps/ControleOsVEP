<?php
require_once 'Conexao.php';

define('InserirChamado', 'InserirChamadoDAO');

class ChamadoDAO extends Conexao
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

    public function CarregarEquipamentosSetorDAO($idSetorLogado, $sit)
    {

        $comando_sql = 'select al.id_equipamento,
                               eq.ident_equip,
                               eq.desc_equip
                            from tb_alocar_equip as al
                        inner join tb_equipamento as eq
                                on al.id_equipamento = eq.id_equipamento
                            where al.id_setor = ?
                                and al.sit_alocar = ?';

        $this->sql = $this->conexao->prepare($comando_sql);
        $this->sql->bindValue(1, $idSetorLogado);
        $this->sql->bindValue(2, $sit);

        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        $this->sql->execute();

        return $this->sql->fetchAll();
    }

    public function InserirChamadoDAOFunc(ChamadoVO $vo, $idUser)
    {
        $comando_sql = 'insert into tb_chamado
                        (
                            desc_problema,
                            data_chamado,
                            hora_chamado,
                            id_usuario_fun,
                            id_equipamento
                        )
                        value (?,?,?,?,?)';

        $this->sql = $this->conexao->prepare($comando_sql);

        $i = 1;
        $this->sql->bindValue($i++, $vo->getDesc_Problema());
        $this->sql->bindValue($i++, $vo->getData_Chamado());
        $this->sql->bindValue($i++, $vo->getHora_chamado());
        $this->sql->bindValue($i++, $idUser);
        $this->sql->bindValue($i++, $vo->getId_Equipamento());

        try {
            $this->sql->execute();
            return 1;
        } catch (Exception $ex) {
            parent::GravarErro($ex->getMessage(), $idUser, InserirChamado);
        }
    }
}
