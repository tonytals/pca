<?php

return [
    // The model which creates the comments aka the User model
    'commenter' => \ProntuarioEletronico\User::class,
    'commentable' => \ProntuarioEletronico\Prontuario::class
];
