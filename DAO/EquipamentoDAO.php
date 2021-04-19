<?php

require_once 'Conexao.php';

define('AlocarEquipamento', 'AlocarEquipamentoDAO');
define('InserirEquipamento', 'InserirEquipamentoDAO');
define('AlterarEquipamento', 'AlterarEquipamentoDAO');
define('RemoverEquipamento', 'RemoverEquipamentoDAO');

class EquipamentoDAO extends Conexao
{
    public function AlocarEquipamento(AlocarEquipVO $vo, $idUser)
    {
        $conexao = parent::retornaConexao();
        $comando_sql = 'insert into tb_alocar_equip
                        (id_equipamento, id_setor, sit_alocar, data_alocar, hora_alocar)
                        values (?,?,?,?,?)';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $i = 1;
        $sql->bindValue($i++, $vo->getId_Equipamento());
        $sql->bindValue($i++, $vo->getId_Setor());
        $sql->bindValue($i++, $vo->getSit_alocar());
        $sql->bindValue($i++, $vo->getData_alocar());
        $sql->bindValue($i++, $vo->getHora_alocar());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            //echo $ex->getMessage();
            parent::GravarErro($ex->getMessage(), $idUser, AlocarEquipamento);
            return -1;
        }
    }

    public function FiltrarEquipamentosNaoAlocado()
    {
        $conexao = parent::retornaConexao();
        $comando_sql = 'select eq.id_equipamento, 
                        eq.ident_equip,
                        eq.desc_equip
                        from tb_equipamento as eq
                        left join tb_alocar_equip as al
                        on eq.id_equipamento = al.id_equipamento
                        where eq.id_equipamento 
                        not in (select al1.id_equipamento
                                from tb_alocar_equip as al1
                                where al1.data_remover is null)';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function InserirEquipamentoDAO(EquipamentoVO $vo, $idUser)
    {
        //1º Passo: Obter o objeto de conxexão. Para isso crie uma variável
        $conexao = parent::retornaConexao(); //Parent - Acesso de recursos da classe

        //2º Passo: Criar uma variavel que armazena o comando
        $comando_sql = 'insert into tb_equipamento (ident_equip,desc_equip,id_modelo,id_tipo,id_usuario) value (?,?,?,?,?)'; //Informação dinamica usa-se ?;

        //3ºPasso: Criar o objeto que será levado para o banco de dados
        $sql = new PDOStatement();

        //4º Passo: O objeto $sql deverá receber a conexão preparada para o comando
        $sql = $conexao->prepare($comando_sql);

        //5º Passo: Observar se tem ? no comando_sql, se tiver, configurar os BindValues

        $i = 1;
        $sql->bindValue($i++, $vo->getIdent_Equip());
        $sql->bindValue($i++, $vo->getDesc_Equip());
        $sql->bindValue($i++, $vo->getId_Modelo());
        $sql->bindValue($i++, $vo->getId_Tipo());
        $sql->bindValue($i++, $vo->getId_Usuario());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            //echo $ex->getMessage(); //Retornar erro tecnico
            parent::GravarErro($ex->getMessage(), $idUser, InserirEquipamento);
            return -1;
        }
    }

    public function AlterarEquipamento(EquipamentoVO $vo, $idUser)
    {
        $conexao = parent::retornaConexao();

        $comando_sql = 'update tb_equipamento 
                        set ident_equip = ?,
                        desc_equip = ?,
                        id_modelo =?,
                        id_tipo = ?
                        where id_equipamento = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $i = 1;
        $sql->bindvalue($i++, $vo->getIdent_Equip());
        $sql->bindValue($i++, $vo->getDesc_Equip());
        $sql->bindValue($i++, $vo->getId_Modelo());
        $sql->bindValue($i++, $vo->getId_Tipo());
        $sql->bindValue($i++, $vo->getId_Equipamento());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            //cho $ex->getMessage();
            parent::GravarErro($ex->getMessage(), $idUser, AlterarEquipamento);
            return -1;
        }
    }

    public function ConsultarEquipamentoDAO()
    {
        $conexao = parent::retornaConexao();

        $comando_sql = 'select id_equipamento, ident_equip, desc_equip, id_modelo, id_tipo, id_usuario from tb_equipamento order by ident_equip';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->setFetchMode(PDO::FETCH_ASSOC); //Enxuta as informações da consulta, mostrando apenas as informçoes importantes
        $sql->execute();

        return $sql->fetchAll(); //Varrer tudo, ou seja, retornar tudo, ou no caso, resultados.
    }

    public function PesquisarEquipamentoTipo($idTipo)
    {

        $conexao = parent::retornaConexao();
        $comando_sql = 'select
                        eq.id_equipamento,
                        eq.ident_equip,
                        eq.desc_equip,
                        mo.nome_modelo,
                        ti.nome_tipo
                        from tb_equipamento as eq
                        inner join tb_modelo as mo
                            on eq.id_modelo = mo.id_modelo
                        inner join tb_tipo as ti
                            on eq.id_tipo = ti.id_tipo
                        where eq.id_tipo = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $i = 1;
        $sql->bindValue($i++, $idTipo);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function DetalharEquipamento($idEquipamento)
    {
        $conexao = parent::retornaConexao();
        $comando_sql = 'select
                            eq.id_equipamento,
                            eq.ident_equip,
                            eq.desc_equip,
                            eq.id_modelo,
                            eq.id_tipo
                            from tb_equipamento as eq
                            where eq.id_equipamento = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $i = 1;
        $sql->bindValue($i++, $idEquipamento);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function ExcluirEquipamentoDAO($idEquipamento)
    {

        $conexao = parent::retornaConexao();
        $comando_sql = 'delete from tb_equipamento where id_equipamento = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idEquipamento);

        try {
            $sql->execute();
            return 1;
        } catch (exception $ex) {
            return -2;
        }
    }

    public function RemoverEquipamento(AlocarEquipVO $vo, $idUser)
    {
        $conexao = parent::retornaConexao();

        $comando_sql = 'update tb_alocar_equip
                            set data_remover = ?, 
                            hora_remover = ?, 
                            sit_alocar = ?
                        where id_alocar_equip = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $i = 1;
        $sql->bindValue($i++, $vo->getData_remover());
        $sql->bindValue($i++, $vo->getHora_remover());
        $sql->bindValue($i++, $vo->getSit_alocar());
        $sql->bindValue($i++, $vo->getIdalocar_equip());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            //$ex->getMessage();
            parent::GravarErro($ex->getMessage(), $idUser, RemoverEquipamento);
            return -1;
        }
    }

    public function FiltrarAlocado($idSetor)
    {
        $conexao = parent::retornaConexao();
        $comando_sql = 'select al.id_alocar_equip,
                               eq.ident_equip,
                               eq.desc_equip,
                               al.sit_alocar
                            from tb_alocar_equip as al
                        inner join tb_equipamento as eq 
                            on al.id_equipamento = eq.id_equipamento
                        where al.id_setor =?
                            and al.data_remover is null';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $idSetor);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }
}
