<?php

namespace Tests\Unit\Controllers;

use PHPUnit\Framework\TestCase;
use AppointmentController;
use UserModel;

class AppointmentControllerTest extends TestCase
{
    private $controller;
    private $user;

    protected function setUp(): void
    {
        $this->controller = new AppointmentController();
        $this->user = new UserModel();
        $this->user->set("id", 1);
        $this->user->set("name", "Test User");
        $this->user->set("email", "test@example.com");
        $this->user->set("role", "admin");
    }

    public function testProcessWithoutAuthUser()
    {
        $this->assertTrue($this->controller->process());
    }

    public function testProcessWithAuthUser()
    {
        $_SESSION['user'] = $this->user;
        $this->assertTrue($this->controller->process());
    }

    public function testProcessWithId()
    {
        $_GET['id'] = 1;
        $this->assertTrue($this->controller->process());
    }

    public function testProcessWithQueryParams()
    {
        $_GET['speciality'] = 'test';
        $_GET['doctor'] = 'test';
        $this->assertTrue($this->controller->process());
    }
}
