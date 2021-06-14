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

    public function FiltrarChamadoSetorDAO($FiltrarSit)
    {
        $comando_sql = 'select cha.id_chamado,
                                    cha.data_chamado,
                                    usufun.nome_usuario as nome_funcionario,
                                    equip.ident_equip,
                                    equip.desc_equip,
                                    cha.desc_problema,
                                    cha.data_atendimento,
                                    usutec.nome_usuario as nome_tecnico,
                                    cha.data_encerramento,
                                    cha.laudo_chamado
                                from tb_chamado as cha
                            inner join tb_equipamento as equip
                                on cha.id_equipamento = equip.id_equipamento
                            inner join tb_usuario as usufun
                                on cha.id_usuario_fun = usufun.id_usuario
                            left join tb_usuario as usutec
                                on cha.id_usuario_tec = usutec.id_usuario';
            
        if ($FiltrarSit == 1) 
            $comando_sql .= ' where data_atendimento is null and data_encerramento is null';
                  
        else if ($FiltrarSit == 2) 
            $comando_sql .= ' where data_atendimento is not null and data_encerramento is null'; 
                            
        else if ($FiltrarSit == 3) 
            $comando_sql .= ' where data_encerramento is not null';
        
        $this->sql = $this->conexao->prepare($comando_sql);
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        $this->sql->execute();

        return $this->sql->fetchAll();
    }

    public function CarregarEquipamentosSetorDAO($idSetorLogado, $sit)
    {

        $comando_sql = 'select al.id_equipamento,
                               eq.ident_equip,
                               eq.desc_equip,
                               al.id_alocar_equip
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

    public function InserirChamadoDAOFunc(ChamadoVO $vo, $idUser, $idAlocar)
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

        $this->conexao->beginTransaction();
        try {
            $this->sql->execute();

            $comando_sql = 'update tb_alocar_equip
                                set sit_alocar = 3
                            where id_alocar_equip = ?';

            $this->sql = $this->conexao->prepare($comando_sql);
            $this->sql->bindValue(1, $idAlocar);
            $this->sql->execute();
            $this->conexao->commit();
            return 1;
        } catch (Exception $ex) {
            $this->conexao->rollBack();
            parent::GravarErro($ex->getMessage(), $idUser, InserirChamado);
            return -1;
        }
    }
}
