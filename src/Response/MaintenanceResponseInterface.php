<?php

/*
 * (c) Mykyta Melnyk <wawoxe@proton.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Wawoxe\MaintenanceBundle\Response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * MaintenanceResponseInterface interface.
 *
 * Interface defining the contract for maintenance response classes.
 * Classes implementing this interface must provide a method to generate
 * a maintenance response based on the given request.
 *
 * @author Mykyta Melnyk <wawoxe@proton.me>
 */
interface MaintenanceResponseInterface
{
    /**
     * Get maintenance response.
     *
     * Generates a maintenance response based on the given request.
     *
     * @param Request $request The request for which the response is generated
     *
     * @return Response The maintenance response
     */
    public function getResponse(Request $request): Response;
}
