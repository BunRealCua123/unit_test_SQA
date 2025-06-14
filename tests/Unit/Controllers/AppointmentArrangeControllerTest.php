<?php

use PHPUnit\Framework\TestCase;

// Đường dẫn chính xác đến TestAppointmentArrangeController.php
require_once dirname(dirname(__DIR__)) . '/TestAppointmentArrangeController.php';

class AppointmentArrangeControllerTest extends TestCase
{
    private $controller;
    private $authUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Sử dụng TestAppointmentArrangeController thay vì AppointmentArrangeController
        $this->controller = $this->getMockBuilder('TestAppointmentArrangeController')
            ->onlyMethods(['view'])
            ->getMock();

        $this->controller->method('view')
            ->willReturn(null);

        if (class_exists('App\Models\User')) {
            $this->authUser = new \App\Models\User(1, 'Test User', 'test@example.com', 'admin');
        } else if (class_exists('UserModel')) {
            $this->authUser = new UserModel();
        } else {
            // Fallback nếu không có class User nào
            $this->authUser = new stdClass();
            $this->authUser->id = 1;
            $this->authUser->name = 'Test User';
        }
    }

    public function testProcessWithoutAuthUser()
    {
        $this->controller->setVariable("AuthUser", null);

        // Kiểm tra kết quả process() thay vì bắt exception
        $result = $this->controller->process();
        $this->assertFalse($result, "Controller đã không chuyển hướng khi không có người dùng đăng nhập");
    }

    public function testProcessWithAuthUser()
    {
        // Thiết lập kỳ vọng rằng view sẽ được gọi với tham số 'appointmentArrange'
        $this->controller->expects($this->once())
            ->method('view')
            ->with('appointmentArrange');

        $this->controller->setVariable("AuthUser", $this->authUser);

        $result = $this->controller->process();
        $this->assertTrue($result, "Controller đã không hiển thị view khi có người dùng đăng nhập");
    }
}
