<?php

if (!function_exists('view')) {
    function view(string $viewName, array $data = [])
    {
        $cursos = $data;
        require __DIR__ . '/views/cursos/' . $viewName . '.php';
    }
}
