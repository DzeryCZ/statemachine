<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$containerBuilder = new ContainerBuilder();
$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
$loader->load('../config/services.yaml');
$containerBuilder->compile();

// Todo - change this entrypoint
$order = new Statemachine\ProcessOrderExample\Entity\Order();
$order->setState('new');
/** @var Statemachine\Statemachine\Command\RunEvent $runEventService */
$runEventService = $containerBuilder->get(Statemachine\Statemachine\Command\RunEvent::class);
$runEventService->run($order, 'PaymentReceived');
