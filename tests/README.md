# Unit Tests for Umbrella Corporation Appointment System

This directory contains unit tests for the Umbrella Corporation Appointment System.

## Test Structure

- `tests/Unit/Controllers/` - Tests for controllers
- `tests/Unit/Views/` - Tests for views

## Running Tests

1. Install dependencies:

```bash
composer install
```

2. Run all tests:

```bash
composer test
```

3. Run specific test file:

```bash
./vendor/bin/phpunit tests/Unit/Controllers/AppointmentControllerTest.php
```

4. Run tests with coverage report:

```bash
./vendor/bin/phpunit --coverage-html coverage
```

## Test Coverage

The tests cover the following functionality:

### Controllers

- Authentication checks
- Route parameter handling
- Query parameter handling
- View rendering
- Variable setting/getting

### Views

- Template rendering
- Form validation
- Data display
- User interaction

## Writing New Tests

1. Create a new test class in the appropriate directory
2. Extend PHPUnit\Framework\TestCase
3. Write test methods prefixed with "test"
4. Use PHPUnit assertions to verify behavior
5. Run tests to verify they pass

## Best Practices

1. Each test should test one specific behavior
2. Use descriptive test names
3. Set up test data in setUp() method
4. Clean up test data in tearDown() method
5. Mock external dependencies
6. Keep tests independent of each other
7. Follow AAA pattern (Arrange, Act, Assert)
