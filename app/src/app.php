<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$containerBuilder = new ContainerBuilder();
$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
$loader->load('../config/services.yaml');


// Todo - change this entrypoint
$order = new \Statemachine\ProcessOrderExample\Entity\Order();
/** @var \Statemachine\Statemachine\Command\RunEvent $runEventService */
$runEventService = $containerBuilder->get('Statemachine\Statemachine\Command\RunEvent');
$runEventService->run($order, 'PaymentReceived');
