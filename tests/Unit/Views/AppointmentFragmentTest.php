<?php

use PHPUnit\Framework\TestCase;

class AppointmentFragmentTest extends TestCase
{
    private $authUser;
    private $AuthUser;
    protected $view;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authUser = $this->createMock('User');
        $this->AuthUser = new class {
            private $data = [
                'id' => 1,
                'name' => 'Test User',
                'email' => 'test@example.com',
                'role' => 'admin'
            ];

            public function get($key)
            {
                return $this->data[$key] ?? null;
            }
        };
        $this->view = file_get_contents(BASE_PATH . '/app/views/fragments/appointment.fragment.php');
    }

    public function testInstructionsExist()
    {
        // Test if instructions exist
        $this->assertStringContainsString('Để tạo lượt khám cho bệnh nhân, có 2 phương thức như sau:', $this->view);
        $this->assertStringContainsString('Nếu bệnh nhân đến khám trực tiếp', $this->view);
        $this->assertStringContainsString('Nếu bệnh nhân đặt khám online', $this->view);
    }

    public function testFormElementsExist()
    {
        // Test if form elements exist
        $this->assertStringContainsString('id="service"', $this->view);
        $this->assertStringContainsString('id="speciality"', $this->view);
        $this->assertStringContainsString('id="doctor"', $this->view);
        $this->assertStringContainsString('id="datepicker"', $this->view);
        $this->assertStringContainsString('id="patient-id"', $this->view);
        $this->assertStringContainsString('id="patient-name"', $this->view);
        $this->assertStringContainsString('id="patient-phone"', $this->view);
        $this->assertStringContainsString('id="patient-birthday"', $this->view);
        $this->assertStringContainsString('id="patient-reason"', $this->view);
        $this->assertStringContainsString('id="appointment-time"', $this->view);
        $this->assertStringContainsString('id="status"', $this->view);
    }

    public function testButtonsExist()
    {
        // Test if buttons exist
        $this->assertStringContainsString('id="button-confirm"', $this->view);
        $this->assertStringContainsString('id="button-reset"', $this->view);
        $this->assertStringContainsString('id="button-cancel"', $this->view);
    }

    public function testStatusOptions()
    {
        ob_start();
        $AuthUser = $this->AuthUser;
        include(BASE_PATH . '/app/views/fragments/appointment.fragment.php');
        $output = ob_get_clean();

        $this->assertStringContainsString('value="processing"', $output);
        $this->assertStringContainsString('value="done"', $output);
        $this->assertStringContainsString('value="cancelled"', $output);
    }
}
