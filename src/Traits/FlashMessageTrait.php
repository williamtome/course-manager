<?php

namespace Alura\Cursos\Traits;

trait FlashMessageTrait
{
    public function defineMessage(string $type, string $message)
    {
        $_SESSION['message_type'] = $type;
        $_SESSION['message'] = $message;
    }
}
