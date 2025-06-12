<?php

namespace Tests\Unit\Views;

use PHPUnit\Framework\TestCase;
use UserModel;

class AppointmentRecordsFragmentTest extends TestCase
{
    private $user;
    private $AuthUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = new UserModel();
        $this->user->set("id", 1);
        $this->user->set("name", "Test User");
        $this->user->set("email", "test@example.com");
        $this->user->set("role", "admin");

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
    }

    public function testSearchElementsExist()
    {
        ob_start();
        $AuthUser = $this->AuthUser;
        include(BASE_PATH . '/app/views/fragments/appointmentRecords.fragment.php');
        $output = ob_get_clean();

        $this->assertStringContainsString('id="search"', $output);
        $this->assertStringContainsString('id="button-search"', $output);
        $this->assertStringContainsString('id="button-reset"', $output);
    }

    public function testOrderElementsExist()
    {
        ob_start();
        $AuthUser = $this->AuthUser;
        include(BASE_PATH . '/app/views/fragments/appointmentRecords.fragment.php');
        $output = ob_get_clean();

        $this->assertStringContainsString('id="order-dir"', $output);
        $this->assertStringContainsString('id="order-column"', $output);
        $this->assertStringContainsString('id="datepicker"', $output);
    }

    public function testFilterElementsExist()
    {
        ob_start();
        $AuthUser = $this->AuthUser;
        include(BASE_PATH . '/app/views/fragments/appointmentRecords.fragment.php');
        $output = ob_get_clean();

        $this->assertStringContainsString('id="speciality"', $output);
        $this->assertStringContainsString('id="doctor"', $output);
        $this->assertStringContainsString('id="length"', $output);
    }

    public function testTableHeadersExist()
    {
        ob_start();
        $AuthUser = $this->AuthUser;
        include(BASE_PATH . '/app/views/fragments/appointmentRecords.fragment.php');
        $output = ob_get_clean();

        $this->assertStringContainsString('Ngày khám', $output);
        $this->assertStringContainsString('Họ tên', $output);
        $this->assertStringContainsString('Chuyên khoa', $output);
        $this->assertStringContainsString('Nguyên nhân', $output);
        $this->assertStringContainsString('Bác sĩ', $output);
        $this->assertStringContainsString('Hành động', $output);
    }

    public function testPaginationExists()
    {
        ob_start();
        $AuthUser = $this->AuthUser;
        include(BASE_PATH . '/app/views/fragments/appointmentRecords.fragment.php');
        $output = ob_get_clean();

        $this->assertStringContainsString('id="pagination"', $output);
        $this->assertStringContainsString('id="button-previous"', $output);
        $this->assertStringContainsString('id="current-page"', $output);
        $this->assertStringContainsString('id="button-next"', $output);
    }

    public function testModalExists()
    {
        ob_start();
        $AuthUser = $this->AuthUser;
        include(BASE_PATH . '/app/views/fragments/appointmentRecords.fragment.php');
        $output = ob_get_clean();

        $this->assertStringContainsString('id="record"', $output);
        $this->assertStringContainsString('id="title"', $output);
        $this->assertStringContainsString('id="body"', $output);
    }
}
