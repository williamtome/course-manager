<?php
require __DIR__ . '/../header.php';
?>

<div class="jumbotron">
    <h1>Listar cursos</h1>
</div>

<a href="/novo-curso" class="btn btn-primary mb-2">Novo curso</a>

<ul class="list-group">
    <?php foreach ($cursos as $curso) : ?>
        <li class="list-group-item d-flex justify-content-between">
            <?= $curso->getDescricao(); ?>

            <span>
                <a href="/alterar-curso?id=<?= $curso->getId(); ?>" class="btn bn-sm btn-info">
                    Alterar
                </a>
                <a href="/excluir-curso?id=<?= $curso->getId(); ?>" class="btn btn-sm btn-danger">
                    Excluir
                </a>
            </span>
        </li>
    <?php endforeach; ?>
</ul>

<?php
require __DIR__ . '/../footer.php';
?>