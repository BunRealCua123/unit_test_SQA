<?php

namespace Tests\Unit\JavaScript;

use PHPUnit\Framework\TestCase;

class AppointmentJsTest extends TestCase
{
    protected $jsFile;

    protected function setUp(): void
    {
        parent::setUp();
        $this->jsFile = file_get_contents(BASE_PATH . '/assets/js/customized/appointment.js');
    }

    public function testSetupDatePicker()
    {
        $this->assertStringContainsString('function setupDatePicker()', $this->jsFile);
    }

    public function testSetupDatePickerForPatientBirthday()
    {
        $this->assertStringContainsString('function setupDatePickerForPatientBirthday()', $this->jsFile);
    }

    public function testSetupTimePicker()
    {
        $this->assertStringContainsString('function setupTimePicker()', $this->jsFile);
    }

    public function testReset()
    {
        $this->assertStringContainsString('function reset()', $this->jsFile);
    }

    public function testSetupButton()
    {
        $this->assertStringContainsString('function setupButton(', $this->jsFile);
    }

    public function testGetNecessaryInfo()
    {
        $this->assertStringContainsString('function getNecessaryInfo()', $this->jsFile);
    }

    public function testSendAppointmentRequest()
    {
        $this->assertStringContainsString('function sendAppointmentRequest(method, url, data)', $this->jsFile);
    }

    public function testSetupAppointmentInfo()
    {
        $this->assertStringContainsString('function setupAppointmentInfo(id)', $this->jsFile);
    }

    public function testSetupAppointmentInfoWithParameter()
    {
        $this->assertStringContainsString('function setupAppointmentInfoWithParameter(resp)', $this->jsFile);
    }

    public function testSetupPatientInformation()
    {
        $this->assertStringContainsString('function setupPatientInformation(patient_id)', $this->jsFile);
    }

    public function testSetupDropdownService2()
    {
        $this->assertStringContainsString('function setupDropdownService2()', $this->jsFile);
    }

    public function testCreateDropdownService2()
    {
        $this->assertStringContainsString('function createDropdownService2(resp)', $this->jsFile);
    }

    public function testSetupDropdownDoctor2()
    {
        $this->assertStringContainsString('function setupDropdownDoctor2()', $this->jsFile);
    }

    public function testBookingIdVariable()
    {
        $this->assertStringContainsString('let bookingId = 0', $this->jsFile);
    }

    public function testServiceIdVariable()
    {
        $this->assertStringContainsString('let serviceId = 0', $this->jsFile);
    }

    public function testDoctorIdVariable()
    {
        $this->assertStringContainsString('let doctorId = 0', $this->jsFile);
    }
}
