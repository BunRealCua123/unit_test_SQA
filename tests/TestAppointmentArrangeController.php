<?php
// filepath: d:\xampp1\htdocs\PTIT-Do-An-Tot-Nghiep\umbrella-corporation\tests\TestAppointmentArrangeController.php

// Đảm bảo AppointmentArrangeController đã được load
if (!class_exists('AppointmentArrangeController')) {
    require_once dirname(__DIR__) . '/app/controllers/AppointmentArrangeController.php';
}

class TestAppointmentArrangeController extends AppointmentArrangeController
{
    // Override phương thức process để tránh redirect
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        if (!$AuthUser) {
            // Thay vì redirect, chỉ trả về false
            return false;
        }

        $this->view("appointmentArrange");
        return true;
    }
}
