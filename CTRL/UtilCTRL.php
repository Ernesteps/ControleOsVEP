<?php

class UtilCTRL
{
    private static function IniciarSessao()
    {
        if (!isset($_SESSION)) {
            //Sessão dura em torno de 3 minutos.
            session_start();
        }
    }

    public static function CriarSessao($id_user, $tipo, $idSetor)
    {
        self::IniciarSessao(); //Self somente statico
        $_SESSION['cod'] = $id_user;
        $_SESSION['tipo'] = $tipo;
        $_SESSION['setor'] = $idSetor;
    }

    public static function Deslogar()
    {
        self::IniciarSessao();
        unset($_SESSION['cod']);
        unset($_SESSION['tipo']);
        unset($_SESSION['setor']);

        self::VoltarPaginaLogin();
    }

    public static function VerTipoAcesso($tipo)
    {
        self::IniciarSessao();
        if($tipo != $_SESSION['tipo']){
            self::Deslogar();
        }
    }

    public static function VerificarLogado()
    {
        if (!isset($_SESSION['cod']) || $_SESSION['cod'] == '') {
            self::VoltarPaginaLogin();
        }
    }

    public static function VoltarPaginaLogin()
    {
        header('location: http://localhost/ControleosVEP/acesso/login/acessar.php');
        exit;
    }

    public static function MostraTipoUser($tipo)
    {
        $nome = '';

        switch ($tipo) {
            case 1:
                $nome = 'Administrador';
                break;
            case 2:
                $nome = 'Funcionário';
                break;
            case 3:
                $nome = 'Técnico';
                break;
        }
        return $nome;
    }

    public static function CodigoUserLogado()
    {
        self::IniciarSessao();
        return $_SESSION['cod'];
    }

    public static function TipoUserLogado()
    {
        self::IniciarSessao();
        return $_SESSION['tipo'];
    }

    public static function SetorUserLogado()
    {
        self::IniciarSessao();
        return $_SESSION['setor'];
    }

    public static function RetornarCriptografado($palavra)
    {
        return password_hash($palavra, PASSWORD_DEFAULT);
    }

    public static function ExibirArray($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    private static function SetarFusoHorario()
    {
        date_default_timezone_set('America/Sao_Paulo');
    }

    public static function HoraAtual()
    {
        self::SetarFusoHorario();
        return date('H:i');
    }
    public static function DataAtual()
    {
        self::setarFusoHorario();
        return date('Y-m-d');
    }
    public static function DataExibir($data)
    {
        return explode('-', $data)[2] . '/' . explode('-', $data)[1] . '/' . explode('-', $data)[0];
    }

    public static function TirarCaracteresEspeciais($str){
        $especial = array('_', '(', '.', '-', '!', ' ', '/', '\\', ')', '*');
        $str_limpa = str_replace($especial, '', $str);

        return $str_limpa;
    }

    public static function StuacaoChamado($dataAtendimento, $dataEncerramento)
    {

        $sit = '';
        if ($dataAtendimento != '' && $dataEncerramento != '') {
            $sit = '<i>Encerrado</i>';
        } else if ($dataAtendimento == '') {
            $sit = '<i>Aguardando Atendimento</i>';
        } else if ($dataAtendimento != '' && $dataEncerramento == ''){
            $sit = '<i>Em Atendimento</i>';
        }
        return $sit;
    }
}
