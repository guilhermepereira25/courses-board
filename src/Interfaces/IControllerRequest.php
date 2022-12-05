<?php

namespace  Application\Source\Interfaces;

interface IControllerRequest 
{
    public function processRequest(): void;
}