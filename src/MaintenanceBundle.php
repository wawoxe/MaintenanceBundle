<?php

/*
 * (c) Mykyta Melnyk <wawoxe@proton.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Wawoxe\MaintenanceBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

/**
 * MaintenanceBundle class.
 *
 * Symfony bundle for managing maintenance mode.
 *
 * Symfony bundle for managing maintenance mode.
 * Loads service configuration from YAML file.
 *
 * @author Mykyta Melnyk <wawoxe@proton.me>
 */
final class MaintenanceBundle extends AbstractBundle
{
    /**
     * Load extension configuration.
     *
     * Imports service configuration from a YAML file.
     * The configuration is applied to the Symfony service container.
     *
     * @param array $config An array of configuration settings
     * @param ContainerConfigurator $container The container configurator
     * @param ContainerBuilder $builder The container builder
     */
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import(dirname(__DIR__).'/config/services.yaml');

        parent::loadExtension($config, $container, $builder);
    }
}
