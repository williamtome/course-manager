<?php
require __DIR__ . '/../header.php';
?>

<div class="jumbotron">
  <h1>Alterar curso <?= $curso->getDescricao(); ?></h1>
</div>

<form action="/atualizar-curso?id=<?= $curso->getId(); ?>" method="post">
  <div class="form-group">
    <label for="descricao">Descrição</label>
    <input type="text" name="descricao" class="form-control" value="<?= isset($curso) ? $curso->getDescricao() : ''; ?>">
  </div>
  <button class="btn btn-primary">Salvar</button>
  <a href="/" class="btn btn-default btn-sm">Voltar</a>
</form>

<?php
require __DIR__ . '/../footer.php';
?>