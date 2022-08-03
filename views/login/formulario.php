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
      <h1>Login</h1>
    </div>

    <form action="/logar" method="post">
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

    </ul>
  </div>
</body>

</html>