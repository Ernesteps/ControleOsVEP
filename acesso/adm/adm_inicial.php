<?php
require_once '_vertipo_adm.php';
require_once '../../CTRL/ChamadoCTRL.php';

$ctrl = new ChamadoCTRL();

$dados = $ctrl->CarregarGraficoInicial();



?>

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
              <h1>Inicial</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                <li class="breadcrumb-item active">Inicial</li>
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
            <h3 class="card-title">Acompanhe os números dos atendimentos atualizados</h3>

          </div>
          <div class="card-body">

            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
              google.charts.load("current", {
                packages: ['corechart']
              });
              google.charts.setOnLoadCallback(drawChart);

              function drawChart() {
                var data = google.visualization.arrayToDataTable([
                  ["Element", "QTDE", {
                    role: "style"
                  }],
                  ["Aguardando", <?= $dados[0]['aguardando'] ?>, "red"],
                  ["Atendimento", <?= $dados[0]['atendimento'] ?>, "blue"],
                  ["Finalizado", <?= $dados[0]['finalizado'] ?>, "green"],
                ]);

                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1,
                  {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                  },
                  2
                ]);

                var options = {
                  title: "Números atuais das situações dos chamados",
                  width: 800,
                  height: 400,
                  bar: {
                    groupWidth: "50%"
                  },
                  legend: {
                    position: "none"
                  },
                };
                var chart = new google.visualization.ColumnChart(document.getElementById("grafico_chamados"));
                chart.draw(view, options);
              }
            </script>
            <div id="grafico_chamados" style="width: 900px; height: 300px;"></div>


          </div>
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php

    include_once '../../template/_footer.php';
    include_once '../../template/_msg.php';

    ?>

    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
</body>

</html>