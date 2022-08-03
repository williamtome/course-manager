<?php

if (!function_exists('view')) {
    function view(string $viewName, array $data = [])
    {
        $totalCourses = count($data);

        if ($totalCourses == 0 || $totalCourses > 1) {
            $cursos = $data;
        } else {
            $curso = $data[0];
        }

        require __DIR__ . '/views/' . str_replace('.', '/', $viewName) . '.php';
    }
}
