<?php

use PHPUnit\Framework\TestCase;

// Đảm bảo TestAppointmentRecordsController được load
require_once dirname(dirname(__DIR__)) . '/TestAppointmentRecordsController.php';

class AppointmentRecordsControllerTest extends TestCase
{
    private $controller;
    private $user;

    protected function setUp(): void
    {
        // Sử dụng TestAppointmentRecordsController thay vì AppointmentRecordsController
        $this->controller = $this->getMockBuilder('TestAppointmentRecordsController')
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

        // Đặt kỳ vọng rằng view sẽ được gọi với 'appointmentRecords'
        $this->controller->expects($this->once())
            ->method('view')
            ->with('appointmentRecords');

        $result = $this->controller->process();
        $this->assertTrue($result, "Controller phải trả về true với user đã đăng nhập");
    }
}
