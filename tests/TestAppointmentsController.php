<?php

// Đảm bảo AppointmentsController đã được load
if (!class_exists('AppointmentsController')) {
    require_once dirname(__DIR__) . '/app/controllers/AppointmentsController.php';
}

class TestAppointmentsController extends AppointmentsController
{
    // Override phương thức process để tránh redirect
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        if (!$AuthUser) {
            // Thay vì redirect, chỉ trả về false
            return false;
        }

        $this->view("appointments");
        return true;
    }
}
