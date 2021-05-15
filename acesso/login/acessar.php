<?php

?>

<!DOCTYPE html>
<html>

<head>
    <?php include_once '../../template/_head.php'; ?>
</head>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    Controle de OS
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Acesse o sistema</p>

      <form action="acessar.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="CPF" name="cpf" id="cpf">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" id="pass" name="pass" placeholder="Digita sua senha">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="btn_acessar"  onclick="return ValidarTela(15)" class="btn btn-primary btn-block">Acessar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<?php include_once '../../template/_scripts.php'; ?>

</body>
</html>
