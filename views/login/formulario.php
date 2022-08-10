<?php
require __DIR__ . '/../header.php';
?>

<div class="jumbotron">
  <h1>Login</h1>
</div>

<?php if (isset($_SESSION['message'])) : ?>
  <div class="alert alert-<?= $_SESSION['message_type']; ?>">
    <?= $_SESSION['message']; ?>
  </div>
<?php
  unset($_SESSION['message_type']);
  unset($_SESSION['message']);
endif;
?>

<form action="/realiza-login" method="post">
  <div class="form-group">
    <label for="email">E-mail</label>
    <input type="email" name="email" class="form-control">
  </div>
  <div class="form-group">
    <label for="password">Senha</label>
    <input type="password" name="password" class="form-control">
  </div>
  <button class="btn btn-primary">Entrar</button>
  <a href="/novo-usuario" class="btn btn-secondary btn-sm">
    Não tem conta? Cadastre-se
  </a>
</form>

<?php
require __DIR__ . '/../footer.php';
?>