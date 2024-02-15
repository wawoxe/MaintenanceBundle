<?php

/*
 * (c) Mykyta Melnyk <wawoxe@proton.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Wawoxe\MaintenanceBundle\Test;

use Exception;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Wawoxe\MaintenanceBundle\Response\MaintenanceResponseInterface;

/**
 * ConfigurationTest class.
 *
 * Test case for verifying the correct registration of services in the container
 * and ensuring that they adhere to expected interfaces.
 *
 * @author Mykyta Melnyk <wawoxe@proton.me>
 */
class ConfigurationTest extends TestCase
{
    /**
     * Test that services are registered correctly and implement expected interfaces.
     *
     * @throws Exception
     */
    public function testServicesAreRegistered(): void
    {
        // Load container with services
        $container = $this->loadContainer();

        // Assert that 'maintenance_response' service is registered
        $this->assertTrue($container->has('maintenance.response'));

        // Assert that 'maintenance_response' service implements MaintenanceResponseInterface
        $this->assertInstanceOf(
            MaintenanceResponseInterface::class,
            $container->get('maintenance.response')
        );

        // Assert that 'MaintenanceListener' service is registered
        $this->assertTrue($container->has('Wawoxe\MaintenanceBundle\EventListener\MaintenanceListener'));
    }

    /**
     * Load container with services from YAML configuration.
     *
     * @throws Exception
     */
    private function loadContainer(): ContainerBuilder
    {
        // Create a new container builder
        $container = new ContainerBuilder();

        // Load services from YAML file
        $loader = new YamlFileLoader($container, new FileLocator(dirname(__DIR__) . '/config'));
        $loader->load('services.yaml');

        return $container;
    }
}
