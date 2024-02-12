<?php

/*
 * (c) Mykyta Melnyk <wawoxe@proton.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Wawoxe\MaintenanceBundle\Test\Response;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;
use Wawoxe\MaintenanceBundle\Response\MaintenanceDefaultResponse;

/**
 * MaintenanceDefaultResponseTest class.
 *
 * Test case for the MaintenanceDefaultResponse class.
 * Verifies the behavior of the MaintenanceDefaultResponse when generating maintenance responses.
 *
 * @author Mykyta Melnyk <wawoxe@proton.me>
 */
class MaintenanceDefaultResponseTest extends TestCase
{
    /**
     * Test generating maintenance response for HTML format.
     *
     * @throws Exception
     */
    public function testGetResponseHtml(): void
    {
        // Create a mock request with HTML format
        $request = $this->createMock(Request::class);
        $request->expects($this->once())
            ->method('getRequestFormat')
            ->willReturn('html');

        // Generate maintenance response
        $response = (new MaintenanceDefaultResponse())->getResponse($request);
        // Assert that the response is an instance of Response class
        $this->assertInstanceOf(Response::class, $response);
        // Assert that the response status code is SERVICE_UNAVAILABLE (503)
        $this->assertSame(Response::HTTP_SERVICE_UNAVAILABLE, $response->getStatusCode());
    }

    /**
     * Test generating maintenance response for JSON format.
     *
     * @throws Exception
     */
    public function testGetResponseJson(): void
    {
        // Create a mock request with JSON format
        $request = $this->createMock(Request::class);
        $request->expects($this->once())
            ->method('getRequestFormat')
            ->willReturn('json');

        // Generate maintenance response
        $response = (new MaintenanceDefaultResponse())->getResponse($request);
        // Assert that the response is an instance of Response class
        $this->assertInstanceOf(Response::class, $response);
        // Assert that the response status code is SERVICE_UNAVAILABLE (503)
        $this->assertSame(Response::HTTP_SERVICE_UNAVAILABLE, $response->getStatusCode());
    }

    /**
     * Test generating maintenance response for unsupported format.
     *
     * @throws Exception
     */
    public function testGetResponseUnsupportedFormat(): void
    {
        // Expect UnsupportedMediaTypeHttpException to be thrown
        $this->expectException(UnsupportedMediaTypeHttpException::class);

        // Create a mock request with unsupported format
        $request = $this->createMock(Request::class);
        $request->expects($this->once())
            ->method('getRequestFormat')
            ->willReturn('unsupported');

        // Generate maintenance response
        (new MaintenanceDefaultResponse())->getResponse($request);
    }
}
