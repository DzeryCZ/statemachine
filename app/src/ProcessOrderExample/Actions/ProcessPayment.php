<?php

declare(strict_types=1);

namespace Statemachine\ProcessOrderExample\Actions;

use Statemachine\ProcessOrderExample\Entity\Order;
use Statemachine\Statemachine\Actions\AbstractAction;
use Statemachine\Statemachine\Entity\EntityInterface;

final class ProcessPayment extends AbstractAction
{
    // Todo - add DI

    /**
     * @param Order|EntityInterface $order
     */
    public function __invoke(EntityInterface $order): void
    {
        echo 'Processing Order' . PHP_EOL;
    }
}
