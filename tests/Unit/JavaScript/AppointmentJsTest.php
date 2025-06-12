<?php

namespace Tests\Unit\JavaScript;

use PHPUnit\Framework\TestCase;

class AppointmentJsTest extends TestCase
{
    protected $jsFile;

    protected function setUp(): void
    {
        $this->jsFile = file_get_contents(BASE_PATH . '/assets/js/customized/appointment.js');
    }

    public function testSetupDropdownService()
    {
        // Test setupDropdownService function
        $this->assertTrue(function_exists('setupDropdownService'));
    }

    public function testSetupDropdownSpeciality()
    {
        // Test setupDropdownSpeciality function
        $this->assertTrue(function_exists('setupDropdownSpeciality'));
    }

    public function testSetupDropdownDoctor()
    {
        // Test setupDropdownDoctor function
        $this->assertTrue(function_exists('setupDropdownDoctor'));
    }

    public function testSetupChooseSpeciality()
    {
        // Test setupChooseSpeciality function
        $this->assertTrue(function_exists('setupChooseSpeciality'));
    }

    public function testSetupDatePicker()
    {
        $this->assertTrue(strpos($this->jsFile, 'function setupDatePicker()') !== false, 'Không tìm thấy hàm setupDatePicker trong JS');
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
        $this->assertStringContainsString('function setupButton(id)', $this->jsFile);
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

    public function testCreateDropdownDoctor2()
    {
        $this->assertStringContainsString('function createDropdownDoctor2(resp)', $this->jsFile);
    }

    public function testIsDoctorBusy()
    {
        $this->assertStringContainsString('function isDoctorBusy(method, url, info)', $this->jsFile);
    }

    public function testGlobalVariables()
    {
        $this->assertStringContainsString('let bookingId = 0', $this->jsFile);
        $this->assertStringContainsString('let serviceId = 0', $this->jsFile);
        $this->assertStringContainsString('let doctorId = 0', $this->jsFile);
    }
}
