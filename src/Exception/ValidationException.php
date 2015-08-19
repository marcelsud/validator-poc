<?php

namespace Clickbus\Exception;

class ValidationException extends \Exception
{
    protected $violations;

    public function setViolations(array $violations) {
        $this->violations = $violations;
    }

    public function getViolations()
    {
        return $this->violations;
    }
}

