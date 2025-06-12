<?php

use PHPUnit\Framework\TestCase;

class AppointmentArrangeFragmentTest extends TestCase
{
    private $authUser;
    private $AuthUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authUser = $this->createMock('User');
        $this->AuthUser = new \stdClass();
        $this->AuthUser->id = 1;
        $this->AuthUser->name = 'Test User';
        $this->AuthUser->email = 'test@example.com';
        $this->AuthUser->role = 'admin';
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
        $this->assertStringContainsString('Danh sách khám bệnh', $output);
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
        $this->assertStringContainsString('Thời gian hẹn khám', $output);
    }

    public function testNotesExist()
    {
        ob_start();
        include(BASE_PATH . '/app/views/fragments/appointmentArrange.fragment.php');
        $output = ob_get_clean();

        // Test notes
        $this->assertStringContainsString('Lưu ý: danh sách này được tính từ bệnh nhân thứ 3', $output);
        $this->assertStringContainsString('Ví dụ: số 1 đang khám và số 2 là người kế tiếp', $output);
    }
}
