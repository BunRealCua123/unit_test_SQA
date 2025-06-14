<?php

use PHPUnit\Framework\TestCase;

// Đảm bảo TestAppointmentRecordController được load
require_once dirname(dirname(__DIR__)) . '/TestAppointmentRecordController.php';

class AppointmentRecordControllerTest extends TestCase
{
    private $controller;
    private $user;

    protected function setUp(): void
    {
        // Sử dụng TestAppointmentRecordController thay vì AppointmentRecordController
        $this->controller = $this->getMockBuilder('TestAppointmentRecordController')
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

        // Đặt kỳ vọng rằng view sẽ được gọi với 'appointmentRecord'
        $this->controller->expects($this->once())
            ->method('view')
            ->with('appointmentRecord');

        $result = $this->controller->process();
        $this->assertTrue($result, "Controller phải trả về true với user đã đăng nhập");
    }

    protected function tearDown(): void
    {
        // Xóa các giá trị $_GET sau mỗi test
        $_GET = [];
    }
}
