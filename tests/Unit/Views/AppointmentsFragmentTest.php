<?php

namespace Tests\Unit\Views;

use PHPUnit\Framework\TestCase;
use UserModel;

class AppointmentsFragmentTest extends TestCase
{
    private $user;
    private $AuthUser;
    protected $view;

    protected function setUp(): void
    {
        parent::setUp();
        if (!defined('APPURL')) {
            define('APPURL', 'http://localhost');
        }
        if (!defined('API_URL')) {
            define('API_URL', 'http://localhost/api');
        }
        if (!defined('ROLE')) {
            define('ROLE', 'admin');
        }
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
        $this->view = file_get_contents(BASE_PATH . '/app/views/fragments/appointments.fragment.php');
    }

    public function testSearchElementsExist()
    {
        ob_start();
        $AuthUser = $this->AuthUser;
        include(BASE_PATH . '/app/views/fragments/appointments.fragment.php');
        $output = ob_get_clean();

        $this->assertStringContainsString('id="search"', $output);
        $this->assertStringContainsString('id="button-search"', $output);
        $this->assertStringContainsString('id="button-reset"', $output);
    }

    public function testOrderElementsExist()
    {
        ob_start();
        $AuthUser = $this->AuthUser;
        include(BASE_PATH . '/app/views/fragments/appointments.fragment.php');
        $output = ob_get_clean();

        $this->assertStringContainsString('id="order-dir"', $output);
        $this->assertStringContainsString('id="order-column"', $output);
        $this->assertStringContainsString('id="status"', $output);
    }

    public function testFilterElementsExist()
    {
        ob_start();
        $AuthUser = $this->AuthUser;
        include(BASE_PATH . '/app/views/fragments/appointments.fragment.php');
        $output = ob_get_clean();

        $this->assertStringContainsString('id="speciality"', $output);
        $this->assertStringContainsString('id="doctor"', $output);
        $this->assertStringContainsString('id="length"', $output);
        $this->assertStringContainsString('id="datepicker"', $output);
    }

    public function testTableHeadersExist()
    {
        ob_start();
        $AuthUser = $this->AuthUser;
        include(BASE_PATH . '/app/views/fragments/appointments.fragment.php');
        $output = ob_get_clean();

        // Kiểm tra các tiêu đề cột thực tế trong HTML
        $this->assertStringContainsString('<th>Ngày khám</th>', $output);
        $this->assertStringContainsString('<th>Họ tên</th>', $output);
        $this->assertStringContainsString('<th class="text-center">Chuyên khoa</th>', $output);
        $this->assertStringContainsString('<th>Nguyên nhân</th>', $output);
        $this->assertStringContainsString('<th class="text-center">Phòng khám</th>', $output);
        $this->assertStringContainsString('<th>Tình trạng</th>', $output);
    }

    public function testPaginationExists()
    {
        ob_start();
        $AuthUser = $this->AuthUser;
        include(BASE_PATH . '/app/views/fragments/appointments.fragment.php');
        $output = ob_get_clean();

        $this->assertStringContainsString('id="pagination"', $output);
        $this->assertStringContainsString('id="button-previous"', $output);
        $this->assertStringContainsString('id="current-page"', $output);
        $this->assertStringContainsString('id="button-next"', $output);
    }

    public function testAdminButtonsExist()
    {
        ob_start();
        $AuthUser = $this->AuthUser;
        include(BASE_PATH . '/app/views/fragments/appointments.fragment.php');
        $output = ob_get_clean();

        // Các nút trong file JavaScript thay vì trong HTML fragment
        // Vì button-done được thêm vào bằng JavaScript trong file appointments.js
        $jsFile = file_get_contents(BASE_PATH . '/assets/js/customized/appointments.js');
        $this->assertStringContainsString('#button-done', $jsFile, 'Không tìm thấy nút "button-done" trong JavaScript');
    }
}
