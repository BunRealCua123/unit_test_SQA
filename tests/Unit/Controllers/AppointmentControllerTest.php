<?php

namespace Tests\Unit\Controllers;

use PHPUnit\Framework\TestCase;

// Đảm bảo TestAppointmentController được load
require_once dirname(dirname(__DIR__)) . '/TestAppointmentController.php';

class AppointmentControllerTest extends TestCase
{
    private $controller;
    private $user;

    protected function setUp(): void
    {
        // Sử dụng TestAppointmentController thay vì AppointmentController
        $this->controller = $this->getMockBuilder('TestAppointmentController')
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
        $this->controller->setVariable("Route", (object)['params' => (object)[]]);

        // Đặt kỳ vọng rằng view sẽ được gọi với 'appointment'
        $this->controller->expects($this->once())
            ->method('view')
            ->with('appointment');

        $result = $this->controller->process();
        $this->assertTrue($result, "Controller phải trả về true với user đã đăng nhập");
    }

    public function testProcessWithId()
    {
        $this->controller->setVariable("AuthUser", $this->user);
        $this->controller->setVariable("Route", (object)['params' => (object)['id' => 1]]);

        // Đặt kỳ vọng rằng view sẽ được gọi với 'appointment'
        $this->controller->expects($this->once())
            ->method('view')
            ->with('appointment');

        $result = $this->controller->process();
        $this->assertTrue($result);
        $this->assertEquals(1, $this->controller->getVariable("id"), "ID phải được thiết lập chính xác");
    }

    public function testProcessWithQueryParams()
    {
        $this->controller->setVariable("AuthUser", $this->user);
        $this->controller->setVariable("Route", (object)['params' => (object)[]]);

        $_GET['speciality'] = 'test';
        $_GET['doctor'] = 'test';
        $_GET['patientName'] = 'John Doe';

        // Đặt kỳ vọng rằng view sẽ được gọi với 'appointment'
        $this->controller->expects($this->once())
            ->method('view')
            ->with('appointment');

        $result = $this->controller->process();
        $this->assertTrue($result);
    }

    protected function tearDown(): void
    {
        // Xóa các giá trị $_GET sau mỗi test
        $_GET = [];
    }
}
