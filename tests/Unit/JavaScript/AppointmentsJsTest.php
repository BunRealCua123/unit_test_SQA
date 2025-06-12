<?php

namespace Tests\Unit\JavaScript;

use PHPUnit\Framework\TestCase;

class AppointmentsJsTest extends TestCase
{
    protected $jsFile;

    protected function setUp(): void
    {
        parent::setUp();
        $this->jsFile = file_get_contents(BASE_PATH . '/assets/js/customized/appointments.js');
    }

    public function testGetFilteringCondition()
    {
        $this->assertStringContainsString('function getFilteringCondition()', $this->jsFile);
    }

    public function testSetupAppointmentTable()
    {
        $this->assertStringContainsString('function setupAppointmentTable(url, params)', $this->jsFile);
    }

    public function testPagination()
    {
        $this->assertStringContainsString('function pagination(url, totalRecord, currentRecord)', $this->jsFile);
    }

    public function testCreateAppointmentTable()
    {
        $this->assertStringContainsString('function createAppointmentTable(resp)', $this->jsFile);
    }

    public function testSetupDatePicker()
    {
        $this->assertStringContainsString('function setupDatePicker()', $this->jsFile);
    }

    public function testSetupButton()
    {
        $this->assertStringContainsString('function setupButton()', $this->jsFile);
    }

    public function testSetupAppointmentActions()
    {
        $this->assertStringContainsString('function setupAppointmentActions()', $this->jsFile);
    }

    public function testMakeAppointmentAction()
    {
        $this->assertStringContainsString('function makeAppointmentAction(method, url, id, params = [])', $this->jsFile);
    }
}
