<?php

use PHPUnit\Framework\TestCase;

class AppointmentArrangeFragmentTest extends TestCase
{
    private $AuthUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Sử dụng UserModel thay vì User vì User không tồn tại
        $this->AuthUser = new UserModel();
        $this->AuthUser->set("id", 1);
        $this->AuthUser->set("name", "Test User");
        $this->AuthUser->set("email", "test@example.com");
        $this->AuthUser->set("role", "admin");

        // Thiết lập biến global cho fragment
        $GLOBALS['AuthUser'] = $this->AuthUser;
    }

    public function testFilterElementsExist()
    {
        ob_start();
        include(BASE_PATH . '/app/views/fragments/appointmentArrange.fragment.php');
        $output = ob_get_clean();

        // Test filter elements
        $this->assertStringContainsString('id="speciality"', $output);
        $this->assertStringContainsString('id="doctor"', $output);
    }

    public function testButtonsExist()
    {
        ob_start();
        include(BASE_PATH . '/app/views/fragments/appointmentArrange.fragment.php');
        $output = ob_get_clean();

        // Test buttons
        $this->assertStringContainsString('id="button-search"', $output);
        $this->assertStringContainsString('id="button-reset"', $output);
        $this->assertStringContainsString('id="button-save"', $output);
    }

    public function testAppointmentListExists()
    {
        ob_start();
        include(BASE_PATH . '/app/views/fragments/appointmentArrange.fragment.php');
        $output = ob_get_clean();

        // Test appointment list
        $this->assertStringContainsString('id="appointmentSortable"', $output);
    }

    public function testColumnHeadersExist()
    {
        ob_start();
        include(BASE_PATH . '/app/views/fragments/appointmentArrange.fragment.php');
        $output = ob_get_clean();

        // Test column headers
        $this->assertStringContainsString('STT', $output);
        $this->assertStringContainsString('Họ tên', $output);
        $this->assertStringContainsString('Mô tả', $output);
        $this->assertStringContainsString('Ngày sinh', $output);
    }

    public function testNotesExist()
    {
        ob_start();
        include(BASE_PATH . '/app/views/fragments/appointmentArrange.fragment.php');
        $output = ob_get_clean();

        // Test notes
        $this->assertStringContainsString('Lưu ý: danh sách này được tính từ bệnh nhân thứ 3', $output);
    }

    protected function tearDown(): void
    {
        unset($GLOBALS['AuthUser']);
        parent::tearDown();
    }
}
