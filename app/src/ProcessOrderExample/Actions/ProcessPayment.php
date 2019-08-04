<?php

declare(strict_types=1);

namespace Statemachine\Statemachine\Actions;

use Statemachine\ProcessOrderExample\Entity\Order;
use Statemachine\Statemachine\Entity\EntityInterface;

final class ProcessPayment extends AbstractAction
{
    // Todo  - add DI

    /**
     * @param Order|EntityInterface $order
     */
    public function invoke(EntityInterface $order): void
    {
        echo 'Processing Order';
    }
}
