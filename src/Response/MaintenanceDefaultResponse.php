<?php

/*
 * (c) Mykyta Melnyk <wawoxe@proton.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Wawoxe\MaintenanceBundle\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;

/**
 * MaintenanceDefaultResponse class.
 *
 * Concrete implementation of the MaintenanceResponseInterface interface.
 * Generates maintenance responses based on the request format.
 *
 * @author Mykyta Melnyk <wawoxe@proton.me>
 */
final class MaintenanceDefaultResponse implements MaintenanceResponseInterface
{
    /**
     * Get maintenance response.
     *
     * Generates a maintenance response based on the given request format.
     * Supports HTML and JSON formats.
     *
     * @param Request $request The request for which the response is generated
     *
     * @return Response The maintenance response
     *
     * @throws UnsupportedMediaTypeHttpException When an unsupported content type is encountered
     */
    public function getResponse(Request $request): Response
    {
        return match ($request->getRequestFormat()) {
            'html' => (new Response('Maintenance'))->setStatusCode(Response::HTTP_SERVICE_UNAVAILABLE),
            'json' => (new JsonResponse([
                'message' => 'Maintenance',
            ]))->setStatusCode(Response::HTTP_SERVICE_UNAVAILABLE),
            default => throw new UnsupportedMediaTypeHttpException('Unsupported Content-Type')
        };
    }
}
