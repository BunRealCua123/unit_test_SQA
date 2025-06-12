<?php

namespace Tests\Unit\JavaScript;

use PHPUnit\Framework\TestCase;

class AppointmentArrangeJsTest extends TestCase
{
    protected $jsFile;

    protected function setUp(): void
    {
        $this->jsFile = file_get_contents(BASE_PATH . '/assets/js/customized/appointmentArrange.js');
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
        // Test setupDatePicker function
        $this->assertTrue(function_exists('setupDatePicker'));
    }

    public function testSetupButton()
    {
        $this->assertStringContainsString('function setupButton()', $this->jsFile);
    }

    public function testSetupAppointmentList()
    {
        // Test setupAppointmentList function
        $this->assertTrue(function_exists('setupAppointmentList'));
    }

    public function testSetupAppointmentListWithParameter()
    {
        // Test setupAppointmentListWithParameter function
        $this->assertTrue(function_exists('setupAppointmentListWithParameter'));
    }

    public function testSetupAppointmentListWithParameterAndCallback()
    {
        // Test setupAppointmentListWithParameterAndCallback function
        $this->assertTrue(function_exists('setupAppointmentListWithParameterAndCallback'));
    }

    public function testSetupAppointmentListWithParameterAndCallbackAndError()
    {
        // Test setupAppointmentListWithParameterAndCallbackAndError function
        $this->assertTrue(function_exists('setupAppointmentListWithParameterAndCallbackAndError'));
    }

    public function testSetupAppointmentListWithParameterAndCallbackAndErrorAndSuccess()
    {
        // Test setupAppointmentListWithParameterAndCallbackAndErrorAndSuccess function
        $this->assertTrue(function_exists('setupAppointmentListWithParameterAndCallbackAndErrorAndSuccess'));
    }

    public function testCreateSortableTable()
    {
        $this->assertStringContainsString('function createSortableTable(resp)', $this->jsFile);
    }

    public function testGlobalVariables()
    {
        $this->assertTrue(strpos($this->jsFile, 'let firstElement') !== false, 'Không tìm thấy biến firstElement trong JS');
        $this->assertTrue(strpos($this->jsFile, 'let secondElement') !== false, 'Không tìm thấy biến secondElement trong JS');
        $this->assertTrue(strpos($this->jsFile, 'let doctor_id') !== false, 'Không tìm thấy biến doctor_id trong JS');
    }
}
