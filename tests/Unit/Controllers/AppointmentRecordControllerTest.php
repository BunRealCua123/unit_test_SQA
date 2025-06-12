<?php

use PHPUnit\Framework\TestCase;

class AppointmentRecordControllerTest extends TestCase
{
    private $controller;
    private $authUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new AppointmentRecordController();
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
        $this->assertEquals(0, $this->controller->getVariable("id"));
        $this->assertEquals(0, $this->controller->getVariable("appointmentId"));
    }

    public function testProcessWithId()
    {
        // Test with record ID
        $this->controller->setVariable("AuthUser", $this->authUser);
        $_GET['id'] = 123;

        $this->controller->process();
        $this->assertEquals(123, $this->controller->getVariable("id"));
    }

    public function testProcessWithAppointmentId()
    {
        // Test with appointment ID
        $this->controller->setVariable("AuthUser", $this->authUser);
        $_GET['appointmentId'] = 456;

        $this->controller->process();
        $this->assertEquals(456, $this->controller->getVariable("appointmentId"));
    }
}
