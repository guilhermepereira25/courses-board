<?php

use  Application\Source\Infra\EntityManagerCreator;

require_once __DIR__ . '/vendor/autoload.php';

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet(
    (new EntitymanagerCreator())->getEntityManager()
);
