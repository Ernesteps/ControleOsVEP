<!-- http://localhost/controleosvep/ -->
<!DOCTYPE html>
<html>

<head>
  <?php
  // Comando para incluir uma vez o código .php para a pagina selecionada.
  include_once '../../template/_head.php';
  ?>
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">

    <!-- Navbar -->
    <?php
    include_once '../../template/_topo.php';
    include_once '../../template/_menu.php';
    ?>
    <!-- Navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Filtre seus chamados</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Funcionário</a></li>
                <li class="breadcrumb-item active">Meus Chamados</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Aqui você visualiza todos os seus chamados realizados</h3>

          </div>
          <div class="card-body">

            <div class="form-group">
              <label>Escolha a situação do chamado</label>
              <select name="" id="" class="form-control">
                <option value="">Todos</option>
              </select>
            </div>

            <button class="btn btn-warning"> Pesquisar </button>

            <hr>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Chamados Encontrados</h3>

                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Data da abertura</th>
                          <th>Funcionário</th>
                          <th>Equipamento</th>
                          <th>Problema</th>
                          <th>Data Atendimento</th>
                          <th>Técnico</th>
                          <th>Data Encerramento</th>
                          <th>Laudo</th>
                          <th>Ação</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>(nome)</td>
                          <td>(funcionario)</td>
                          <td>(equipamento)</td>
                          <td>(problema)</td>
                          <td>(data atendimento)</td>
                          <td>(tecnico)</td>
                          <td>(data encerramento)</td>
                          <td>(laudo)</td>
                          <td>
                            <a href="#" class="btn btn-warning btn-xs">Ver mais...</a>
                          </td>

                        </tr>

                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>

          </div>
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php

    include_once '../../template/_footer.php';

    ?>


    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
</body>

</html>