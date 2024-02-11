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
 * This is maintenance Response example. You can return Symfony responses conditionally with checking Request variables.
 *
 * @author Mykyta Melnyk <wawoxe@proton.me>
 */
final class DefaultResponse implements ResponseInterface
{
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
