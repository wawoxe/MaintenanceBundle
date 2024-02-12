<?php

/*
 * (c) Mykyta Melnyk <wawoxe@proton.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Wawoxe\MaintenanceBundle\Test\EventListener;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Wawoxe\MaintenanceBundle\EventListener\MaintenanceListener;
use Wawoxe\MaintenanceBundle\Response\MaintenanceResponseInterface;

/**
 * MaintenanceListenerTest class.
 *
 * Test case for the MaintenanceListener class.
 * Verifies the behavior of the MaintenanceListener when handling requests.
 *
 * @author Mykyta Melnyk <wawoxe@proton.me>
 */
class MaintenanceListenerTest extends TestCase
{
    /**
     * Test invocation of the MaintenanceListener when maintenance mode is enabled, and it is a main request.
     *
     * @throws Exception
     */
    public function testInvokeWhenEnabledAndMainRequest(): void
    {
        // Create a mock maintenance response
        $maintenanceResponse = $this->createMock(MaintenanceResponseInterface::class);

        // Expect the getResponse method to be called once
        $maintenanceResponse->expects($this->once())
            ->method('getResponse')
            ->willReturn(new Response('Maintenance', Response::HTTP_SERVICE_UNAVAILABLE));

        // Create a mock RequestEvent
        $requestEvent = $this->createMock(RequestEvent::class);
        $requestEvent->expects($this->once())
            ->method('isMainRequest')
            ->willReturn(true);
        $requestEvent->expects($this->once())
            ->method('setResponse');
        $requestEvent->expects($this->once())
            ->method('stopPropagation');

        // Create the MaintenanceListener instance with maintenance mode enabled
        $listener = new MaintenanceListener($maintenanceResponse, true);
        // Invoke the listener with the mock RequestEvent
        $listener($requestEvent);
    }

    /**
     * Test invocation of the MaintenanceListener when maintenance mode is disabled
     *
     * @throws Exception
     */
    public function testInvokeWhenDisabled(): void
    {
        // Create a mock maintenance response
        $maintenanceResponse = $this->createMock(MaintenanceResponseInterface::class);
        // Create a mock RequestEvent
        $requestEvent = $this->createMock(RequestEvent::class);
        // Expect that setResponse and stopPropagation methods are not called
        $requestEvent->expects($this->never())
            ->method('setResponse');
        $requestEvent->expects($this->never())
            ->method('stopPropagation');

        // Create the MaintenanceListener instance with maintenance mode disabled
        $listener = new MaintenanceListener($maintenanceResponse, false);
        // Invoke the listener with the mock RequestEvent
        $listener($requestEvent);
    }
}
