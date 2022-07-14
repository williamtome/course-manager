<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Gerenciador de cursos</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="jumbotron">
      <h1>Alterar curso <?= $curso->getDescricao(); ?></h1>
    </div>

    <form action="/salvar-curso" method="post">
		<div class="form-group">
			<label for="descricao">Descrição</label>
			<input type="text"
                   name="descricao"
                   class="form-control"
                   value="<?= isset($curso) ? $curso->getDescricao() : ''; ?>"
            >
		</div>
		<button class="btn btn-primary">Salvar</button>
        <a href="/" class="btn btn-default btn-sm">Voltar</a>
    </form>

    </ul>
  </div>
</body>

</html>