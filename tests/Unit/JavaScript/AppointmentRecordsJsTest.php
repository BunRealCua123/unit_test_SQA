<?php

namespace Tests\Unit\JavaScript;

use PHPUnit\Framework\TestCase;

class AppointmentRecordsJsTest extends TestCase
{
    protected $jsFile;

    protected function setUp(): void
    {
        $this->jsFile = file_get_contents(BASE_PATH . '/assets/js/customized/appointmentRecords.js');
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

    public function testSetupDropdownLength()
    {
        // Test setupDropdownLength function
        $this->assertTrue(function_exists('setupDropdownLength'));
    }

    public function testSetupChooseSpeciality()
    {
        // Test setupChooseSpeciality function
        $this->assertTrue(function_exists('setupChooseSpeciality'));
    }

    public function testSetupDatePicker()
    {
        $this->assertStringContainsString('function setupDatePicker()', $this->jsFile);
    }

    public function testSetupButton()
    {
        $this->assertStringContainsString('function setupButton()', $this->jsFile);
    }

    public function testSetupAppointmentRecords()
    {
        // Test setupAppointmentRecords function
        $this->assertTrue(function_exists('setupAppointmentRecords'));
    }

    public function testSetupAppointmentRecordsWithParameter()
    {
        // Test setupAppointmentRecordsWithParameter function
        $this->assertTrue(function_exists('setupAppointmentRecordsWithParameter'));
    }

    public function testSetupAppointmentRecordsWithParameterAndCallback()
    {
        // Test setupAppointmentRecordsWithParameterAndCallback function
        $this->assertTrue(function_exists('setupAppointmentRecordsWithParameterAndCallback'));
    }

    public function testSetupAppointmentRecordsWithParameterAndCallbackAndError()
    {
        // Test setupAppointmentRecordsWithParameterAndCallbackAndError function
        $this->assertTrue(function_exists('setupAppointmentRecordsWithParameterAndCallbackAndError'));
    }

    public function testSetupAppointmentRecordsWithParameterAndCallbackAndErrorAndSuccess()
    {
        // Test setupAppointmentRecordsWithParameterAndCallbackAndErrorAndSuccess function
        $this->assertTrue(function_exists('setupAppointmentRecordsWithParameterAndCallbackAndErrorAndSuccess'));
    }

    public function testSetupRecordTable()
    {
        $this->assertStringContainsString('function setupRecordTable(url, params)', $this->jsFile);
    }

    public function testCreateRecordTable()
    {
        $this->assertStringContainsString('function createRecordTable(resp)', $this->jsFile);
    }

    public function testPagination()
    {
        $this->assertStringContainsString('function pagination(url, totalRecord, currentRecord)', $this->jsFile);
    }

    public function testPrintAppointmentRecord()
    {
        $this->assertStringContainsString('function printAppointmentRecord(resp)', $this->jsFile);
    }

    public function testGetFilteringCondition()
    {
        $this->assertStringContainsString('function getFilteringCondition()', $this->jsFile);
    }

    public function testGlobalVariables()
    {
        $this->assertTrue(strpos($this->jsFile, 'let DEFAULT_LENGTH') !== false, 'Không tìm thấy biến DEFAULT_LENGTH trong JS');
    }
}
