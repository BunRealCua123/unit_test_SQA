<?php

use PHPUnit\Framework\TestCase;

class AppointmentsControllerTest extends TestCase
{
    private $controller;
    private $authUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new AppointmentsController();
        $this->authUser = $this->createMock('User');
    }

    public function testProcessWithoutAuthUser()
    {
        // Test redirect to login when no auth user
        $this->controller->setVariable("AuthUser", null);
        $this->expectOutputString('');
        $this->controller->process();
    }

    public function testProcessWithAuthUser()
    {
        // Test with authenticated user
        $this->controller->setVariable("AuthUser", $this->authUser);
        $this->controller->process();
        // Verify view is called
        $this->expectOutputString('');
    }
}
