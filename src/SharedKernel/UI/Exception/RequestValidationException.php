<?php

namespace SharedKernel\UI\Exception;

use Exception;

class RequestValidationException extends Exception
{
    /** @var array */
    private $errors;

    public function __construct(array $errors)
    {
        $this->errors = $errors;
        parent::__construct($this->buildMessage());
    }

    private function buildMessage(): string
    {
        return print_r($this->errors, 1);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
