<?php

namespace  Application\Source\Infra;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;

class EntityManagerCreator
{
    public function getEntityManager(): EntityManagerInterface
    {
        $paths = [__DIR__ . '/../Entity'];
        $isDevMode = false;

        $dbParams = array(
            'host' => 'localhost',
            'user' => 'root',
            'password' => '',
            'dbname' => 'courses',
            'charset' => 'UTF8',
            'driver' => 'pdo_mysql'
        );

        $cacheDir = dirname(__FILE__) . '/cache';

        $config = Setup::createAnnotationMetadataConfiguration(
            $paths,
            $isDevMode
        );

        $config->setAutoGenerateProxyClasses(true);

        return EntityManager::create($dbParams, $config);
    }
}
