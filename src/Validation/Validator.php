<?php

namespace Clickbus\Validation;

use Symfony\Component\Validator\Validator\RecursiveValidator;
use Clickbus\Exception\ValidationException;

class Validator
{
    protected $validator;

    public function __construct(RecursiveValidator $validator)
    {
        $this->validator = $validator;
    }

    public function validate($data, $rules)
    {
        $errors = $this->validator->validateValue($data, $rules);

        if (count($errors) > 0) {
            $violations = [];

            foreach ($errors as $error) {
                $violations[] = [
                    "location" => $error->getPropertyPath(),
                    "message" => $error->getMessage(),
                    "invalid_value" => $error->getInvalidValue()
                ];
            }

            $exception = new ValidationException();
            $exception->setViolations($violations);

            throw $exception;
        }
    }
}


