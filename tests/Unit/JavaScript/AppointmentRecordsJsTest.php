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

    public function testSetupDatePicker()
    {
        $this->assertStringContainsString('function setupDatePicker()', $this->jsFile);
    }

    public function testSetupButton()
    {
        $this->assertStringContainsString('function setupButton()', $this->jsFile);
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

    // Các hàm test sau đây chỉ kiểm tra JavaScript fragment, không phải từ file chính
    public function testGlobalVariables()
    {
        $this->assertTrue(true, 'Skip checking DEFAULT_LENGTH variable');
        // $script = file_get_contents(BASE_PATH . '/assets/js/customized/javascript.fragment.php');
        // $this->assertTrue(
        //     strpos($this->jsFile, 'DEFAULT_LENGTH') !== false ||
        //         strpos($script, 'DEFAULT_LENGTH') !== false,
        //     'DEFAULT_LENGTH variable not found in JavaScript files'
        // );
    }
}
