<?php

use PHPUnit\Framework\TestCase;

// Đảm bảo TestAppointmentsController được load
require_once dirname(dirname(__DIR__)) . '/TestAppointmentsController.php';

class AppointmentsControllerTest extends TestCase
{
    private $controller;
    private $user;

    protected function setUp(): void
    {
        // Sử dụng TestAppointmentsController thay vì AppointmentsController
        $this->controller = $this->getMockBuilder('TestAppointmentsController')
            ->onlyMethods(['view'])
            ->getMock();

        // Mock method view để không làm gì
        $this->controller->method('view')
            ->willReturn(null);

        $this->user = new \UserModel();
        $this->user->set("id", 1);
        $this->user->set("name", "Test User");
        $this->user->set("email", "test@example.com");
        $this->user->set("role", "admin");
    }

    public function testProcessWithoutAuthUser()
    {
        $this->controller->setVariable("AuthUser", null);
        $result = $this->controller->process();
        $this->assertFalse($result, "Người dùng không đăng nhập phải chuyển hướng");
    }

    public function testProcessWithAuthUser()
    {
        $this->controller->setVariable("AuthUser", $this->user);

        // Đặt kỳ vọng rằng view sẽ được gọi với 'appointments'
        $this->controller->expects($this->once())
            ->method('view')
            ->with('appointments');

        $result = $this->controller->process();
        $this->assertTrue($result, "Controller phải trả về true với user đã đăng nhập");
    }
}
