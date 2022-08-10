<?php

namespace Alura\Cursos\Traits;

trait ViewRenderTrait
{
    public function view(string $name, array $data = []): void
    {
        $totalCourses = count($data);

        if ($totalCourses == 0 || $totalCourses > 1) {
            $cursos = $data;
        } else {
            $curso = $data[0];
        }

        require __DIR__ . '/../../views/' . str_replace('.', '/', $name) . '.php';
    }
}
