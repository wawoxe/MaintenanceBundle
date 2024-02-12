# MaintenanceBundle

MaintenanceBundle is a Symfony bundle that provides functionality for managing maintenance mode in Symfony applications. It allows you to easily enable maintenance mode and customize the maintenance response based on the request format.

## Installation

You can install MaintenanceBundle via Composer. Run the following command:

```bash
composer require wawoxe/maintenance-bundle
```

## Configuration

After installation, you need to configure MaintenanceBundle in your Symfony application. Here's an example configuration:

```yaml
# config/services.yaml

parameters:
  # Set to true to enable maintenance mode, false otherwise.
  app.maintenance.enabled: true
  # Determines the order in which event listeners are executed.
  app.maintenance.priority: 1000

# [optional]
services:
  maintenance_response:
    # Set your own class responsible for generating maintenance responses.
    class: Wawoxe\MaintenanceBundle\Response\MaintenanceDefaultResponse
```

This configuration enables maintenance mode and specifies the priority of the maintenance event listener. You can customize the maintenance response by modifying the `maintenance_response` service definition.

## Usage

Once configured, MaintenanceBundle will automatically handle maintenance mode for your Symfony application. When maintenance mode is enabled and a request is received, the maintenance listener will intercept the request and apply the maintenance response based on the request format.

You can customize the maintenance response by creating a custom class that implements the `MaintenanceResponseInterface`. Then, update the service definition for `maintenance_response` to use your custom class.

## Testing

MaintenanceBundle includes PHPUnit tests to ensure the functionality is working as expected. You can run the tests using the following command:

```bash
composer test
```

## Contributing

Contributions are welcome! If you have any suggestions, bug fixes, or feature requests, please open an issue or submit a pull request on GitHub.

## License

MaintenanceBundle is open-source software licensed under the MIT license. See the [LICENSE](LICENSE) file for more information.