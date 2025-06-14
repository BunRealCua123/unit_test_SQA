<?php

use PHPUnit\Framework\TestCase;

class AppointmentFragmentTest extends TestCase
{
    private $AuthUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Sử dụng UserModel thay vì User
        $this->AuthUser = new UserModel();
        $this->AuthUser->set("id", 1);
        $this->AuthUser->set("name", "Test User");
        $this->AuthUser->set("email", "test@example.com");
        $this->AuthUser->set("role", "admin");

        // Thiết lập biến global cho fragment
        $GLOBALS['AuthUser'] = $this->AuthUser;
    }

    public function testInstructionsExist()
    {
        ob_start();
        include(BASE_PATH . '/app/views/fragments/appointment.fragment.php');
        $output = ob_get_clean();

        // Test if instructions exist
        $this->assertStringContainsString('Để tạo lượt khám cho bệnh nhân', $output);
    }

    public function testFormElementsExist()
    {
        ob_start();
        include(BASE_PATH . '/app/views/fragments/appointment.fragment.php');
        $output = ob_get_clean();

        // Test if form elements exist
        $this->assertStringContainsString('id="service"', $output);
        $this->assertStringContainsString('id="speciality"', $output);
        $this->assertStringContainsString('id="doctor"', $output);
        $this->assertStringContainsString('id="datepicker"', $output);
    }

    public function testButtonsExist()
    {
        ob_start();
        include(BASE_PATH . '/app/views/fragments/appointment.fragment.php');
        $output = ob_get_clean();

        // Test if buttons exist
        $this->assertStringContainsString('id="button-confirm"', $output);
        $this->assertStringContainsString('id="button-reset"', $output);
        $this->assertStringContainsString('id="button-cancel"', $output);
    }

    public function testStatusOptions()
    {
        ob_start();
        include(BASE_PATH . '/app/views/fragments/appointment.fragment.php');
        $output = ob_get_clean();

        $this->assertStringContainsString('value="processing"', $output);
        $this->assertStringContainsString('value="done"', $output);
        $this->assertStringContainsString('value="cancelled"', $output);
    }

    protected function tearDown(): void
    {
        unset($GLOBALS['AuthUser']);
        parent::tearDown();
    }
}
