<?php

namespace Alura\Cursos\Interfaces;

interface IPasswordValidate 
{
    public function validatePass($senha): string;
}