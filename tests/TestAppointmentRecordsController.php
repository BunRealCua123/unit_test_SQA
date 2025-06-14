\htdocs\PTIT-Do-An-Tot-Nghiep\umbrella-corporation\tests\TestAppointmentRecordsController.php
<?php

// Đảm bảo AppointmentRecordsController đã được load
if (!class_exists('AppointmentRecordsController')) {
    require_once dirname(__DIR__) . '/app/controllers/AppointmentRecordsController.php';
}

class TestAppointmentRecordsController extends AppointmentRecordsController
{
    // Override phương thức process để tránh redirect
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        if (!$AuthUser) {
            // Thay vì redirect, chỉ trả về false
            return false;
        }

        $this->view("appointmentRecords");
        return true;
    }
}
