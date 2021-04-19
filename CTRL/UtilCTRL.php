<?php

class UtilCTRL
{
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
        return 1; //Fixo por enquanto...
    }

    public static function RetonarCriptografado($palavra)
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
}
