<?php

require_once "./vendor/autoload.php";

use Symfony\Component\Validator\ConstraintValidatorFactory;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\RecursiveValidator;
use Clickbus\Validation\Validator;
use Clickbus\Exception\ValidationException;

$constraintFactory = new ConstraintValidatorFactory();
$builder = Validation::createValidatorBuilder();
$builder->setConstraintValidatorFactory($constraintFactory);
$validator = new Validator($builder->getValidator());

$places = [
    [
        'uuid' => '1235678909876543234678984334567',
        'terminal' => [
            'name' => 'Nome do Terminal',
            'address'  => 'Rua Pindamonhangaba, 123 - São Paulo - SP - 012345-678',
        ]
    ],
    [
        'uuid' => '7929e684-4665-11e5-a151-feff819cdc9f',
        'terminal' => [
            'name' => 'Nome',
            'address'  => '',
        ]
    ],
    [
        'uuid' => '97f09b9e-4665-11e5-a151-feff819cdc9f',
        'terminal' => [
            'name' => '',
            'address'  => 'Rua Pindamonhangaba, 123 - São Paulo - SP - 012345-678',
        ]
    ],
    [
        'uuid' => 'dcce5602-4665-11e5-a151-feff819cdc9f',
        'terminal' => [
            'name' => 'Nome do Terminal',
            'address'  => 'Rua',
        ]
    ],
    [
    ]

];

$rules = new Assert\All(['constraints' => [
    new Assert\Collection([
        'uuid' => new Assert\Uuid([
            'payload' => [
                'code' => 'SOME_AWESOME_CODE'
            ]
        ]),
        'terminal' => new Assert\Collection([
            'name' => [new Assert\NotBlank(), new Assert\Length(['min' => 10])],
            'address'  => new Assert\Length(['min' => 10]),
        ]),
    ])
]]);

try {
    $validator->validate($places, $rules);
} catch (ValidationException $e) {
    var_dump($e->getViolations());
}

/*

//TODO: SINTAXE ALTERNATIVA

$rules = v::all(['constraints' => [
    v::collection[
        'uuid' => v::uuid([
            'payload' => [
                'code' => 'SOME_AWESOME_CODE'
            ]
        ]),
        'terminal' => v::collection([
            'name' => v::notBlank()->length(['min' => 10])],
            'address'  => v::length(['min' => 10]),
        ]),
    ])
]]);

*/




