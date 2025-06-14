<?php

namespace Tests\Unit\JavaScript;

use PHPUnit\Framework\TestCase;

class AppointmentArrangeJsTest extends TestCase
{
    protected $jsFile;

    protected function setUp(): void
    {
        parent::setUp();
        $this->jsFile = file_get_contents(BASE_PATH . '/assets/js/customized/appointmentArrange.js');
    }

    public function testSetupButton()
    {
        $this->assertStringContainsString('function setupButton()', $this->jsFile);
    }

    public function testCreateSortableTable()
    {
        $this->assertStringContainsString('function createSortableTable(resp)', $this->jsFile);
    }

    public function testGlobalVariables()
    {
        $this->assertStringContainsString('let firstElement', $this->jsFile);
        $this->assertStringContainsString('let secondElement', $this->jsFile);
        $this->assertStringContainsString('let doctor_id', $this->jsFile);
    }

    public function testDocumentReady()
    {
        $this->assertStringContainsString('$(document).ready(function(){', $this->jsFile);
    }
}
