<?php

namespace Tests\Unit\Views;

use PHPUnit\Framework\TestCase;

class AppointmentRecordFragmentTest extends TestCase
{
    protected $view;
    protected $AuthUser;

    protected function setUp(): void
    {
        $this->view = file_get_contents(BASE_PATH . '/app/views/fragments/appointmentRecord.fragment.php');
        $this->AuthUser = (object)[
            'id' => 1,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'admin'
        ];
    }

    public function testLabelsExist()
    {
        $this->assertStringContainsString('Trạng thái trước khám', $this->view);
        $this->assertStringContainsString('Trạng thái sau khám', $this->view);
        $this->assertStringContainsString('Nguyên nhân', $this->view);
        $this->assertStringContainsString('Mô tả', $this->view);
    }

    public function testFormElementsExist()
    {
        $this->assertStringContainsString('<textarea class="form-control" id="status-before"', $this->view);
        $this->assertStringContainsString('<textarea class="form-control" id="status-after"', $this->view);
        $this->assertStringContainsString('<textarea class="form-control" id="reason"', $this->view);
        $this->assertStringContainsString('<textarea class="form-control" id="description"', $this->view);
    }

    public function testButtonsExist()
    {
        $this->assertStringContainsString('<button id="button-save" class="btn btn-primary"', $this->view);
    }
}
