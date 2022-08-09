<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Gerenciador de cursos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php if (isset($_SESSION['auth'])) : ?>
        <nav class="navbar navbar-dark bg-dark mb-2">
            <a href="/" class="navbar-brand">Home</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a href="/logout" class="nav-link">Sair</a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>
    <div class="container">