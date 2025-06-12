<?php

namespace Tests\Unit\JavaScript;

use PHPUnit\Framework\TestCase;

class AppointmentRecordJsTest extends TestCase
{
    protected $jsFile;

    protected function setUp(): void
    {
        parent::setUp();
        $this->jsFile = file_get_contents(BASE_PATH . '/assets/js/customized/appointmentRecord.js');
    }

    public function testSetupAppointmentRecordInfo()
    {
        // Test setupAppointmentRecordInfo function
        $this->assertStringContainsString('function setupAppointmentRecordInfo', $this->jsFile);
    }

    public function testPrintAppointmentRecord()
    {
        // Test printAppointmentRecord function
        $this->assertStringContainsString('function printAppointmentRecord', $this->jsFile);
    }

    public function testGetNecessaryInfo()
    {
        // Test getNecessaryInfo function
        $this->assertStringContainsString('function getNecessaryInfo', $this->jsFile);
    }

    public function testSetupButton()
    {
        // Test setupButton function
        $this->assertStringContainsString('function setupButton', $this->jsFile);
    }
}
