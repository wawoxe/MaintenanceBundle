<?php

/*
 * (c) Mykyta Melnyk <wawoxe@proton.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Wawoxe\MaintenanceBundle\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Wawoxe\MaintenanceBundle\Response\ResponseInterface;

/**
 * @author Mykyta Melnyk <wawoxe@proton.me>
 */
final readonly class MaintenanceListener
{
    public function __construct(
        private ResponseInterface $maintenanceResponse,
        private bool $enabled,
    ) {
    }

    public function __invoke(RequestEvent $requestEvent): void
    {
        if ($this->enabled && $requestEvent->isMainRequest()) {
            $requestEvent->setResponse($this->maintenanceResponse->getResponse($requestEvent->getRequest()));
            $requestEvent->stopPropagation();
        }
    }
}
