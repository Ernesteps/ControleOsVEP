<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ControleOsVEP/CTRL/UtilCTRL.php';

$tipo = UtilCTRL::TipoUserLogado();

if (isset($_GET['close']) && $_GET['close'] == '1') {
  UtilCTRL::Deslogar();
}
?>

<!-- Main Sidebar Container Line 147 blank.html -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

      <div class="info">
        <a href="#" class="d-block"><?= UtilCTRL::MostraTipoUser($tipo) ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <?php if ($tipo == 1) { ?>
          <li class="nav-item">
            <a href="adm_setor.php" class="nav-link">
              <i class="nav-icon far fa-edit"></i>
              <p>
                Gerenciar Setor
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="adm_modelo.php" class="nav-link">
              <i class="nav-icon far fa-edit"></i>
              <p>
                Gerenciar Modelo
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="adm_tipoequip.php" class="nav-link">
              <i class="nav-icon far fa-edit"></i>
              <p>
                Gerenciar Tipo
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon far fa-file-alt"></i>
              <p>
                Equipamento
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="adm_equipamento.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Novo Equipamento</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="adm_alocarequip.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Alocar Equipamento</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="adm_consultarequip.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consultar Equipamento</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="adm_removerequip.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Remover Equipamento</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
                Usuario
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="adm_usuario.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Novo Usuario</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="adm_consultarusuario.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consultar Usuario</p>
                </a>
              </li>
            </ul>
          </li>

        <?php } else if ($tipo == 2) { ?>

          <li class="nav-item">
            <a href="func_novochamado.php" class="nav-link">
              <i class="nav-icon far fa-edit"></i>
              <p>
                Novo Chamado
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="func_meuschamados.php" class="nav-link">
              <i class="nav-icon far fa-edit"></i>
              <p>
                Consultar Chamados
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="func_meusdados.php" class="nav-link">
              <i class="nav-icon far fa-edit"></i>
              <p>
                Meus Dados
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="func_mudarsenha.php" class="nav-link">
              <i class="nav-icon far fa-edit"></i>
              <p>
                Mudar Senha
              </p>
            </a>
          </li>

        <?php } else if ($tipo == 3) { ?>

          <!--<li class="nav-item">
            <a href="tec_atenderchamado.php" class="nav-link">
              <i class="nav-icon far fa-edit"></i>
              <p>
                Atender Chamado
              </p>
            </a>
          </li>
          -->
          <li class="nav-item">
            <a href="tec_chamados.php" class="nav-link">
              <i class="nav-icon far fa-edit"></i>
              <p>
                Chamados
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="tec_meusdados.php" class="nav-link">
              <i class="nav-icon far fa-edit"></i>
              <p>
                Meus Dados
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="tec_mudarsenha.php" class="nav-link">
              <i class="nav-icon far fa-edit"></i>
              <p>
                Mudar Senha
              </p>
            </a>
          </li>
        <?php } ?>

        <li class="nav-item">
          <a href="../../template/_menu.php?close=1" class="nav-link">
            <i class="nav-icon far"></i>
            <p>
              Sair
            </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>