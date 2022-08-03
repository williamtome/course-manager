<?php

namespace Alura\Cursos\Controllers;

abstract class BaseController
{
    protected function validate(string $field, string $method, string $filterType)
    {
        return filter_input($method, $field, $filterType);
    }
}
