<?php

namespace  Application\Source\Interfaces;

interface IPasswordValidate 
{
    public function validatePass($senha): string;
}