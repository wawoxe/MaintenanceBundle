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
use Wawoxe\MaintenanceBundle\Response\MaintenanceResponseInterface;

/**
 * MaintenanceListener class.
 *
 * Event listener for managing maintenance mode.
 * Determines whether maintenance mode is enabled and applies the appropriate response.
 *
 * @author Mykyta Melnyk <wawoxe@proton.me>
 */
final readonly class MaintenanceListener
{
    /**
     * Constructor.
     *
     * @param MaintenanceResponseInterface $maintenanceResponse The maintenance response handler
     * @param bool $enabled Whether maintenance mode is enabled
     */
    public function __construct(
        private MaintenanceResponseInterface $maintenanceResponse,
        private bool $enabled,
    ) {
    }

    /**
     * Handle maintenance mode logic.
     *
     * Checks if maintenance mode is enabled and if the request is a main request.
     * If maintenance mode is enabled, and it is a main request, sets the maintenance response
     * and stops event propagation.
     *
     * @param RequestEvent $requestEvent The request event
     */
    public function __invoke(RequestEvent $requestEvent): void
    {
        if ($this->enabled && $requestEvent->isMainRequest()) {
            $requestEvent->setResponse($this->maintenanceResponse->getResponse($requestEvent->getRequest()));
            $requestEvent->stopPropagation();
        }
    }
}
