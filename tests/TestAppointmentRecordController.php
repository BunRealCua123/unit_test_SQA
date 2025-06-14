<?php

// Đảm bảo AppointmentRecordController đã được load
if (!class_exists('AppointmentRecordController')) {
    require_once dirname(__DIR__) . '/app/controllers/AppointmentRecordController.php';
}

class TestAppointmentRecordController extends AppointmentRecordController
{
    // Override phương thức process để tránh redirect
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        if (!$AuthUser) {
            // Thay vì redirect, chỉ trả về false
            return false;
        }

        $Route = $this->getVariable("Route");
        $this->setVariable("id", 0);
        $this->setVariable("appointmentId", 0);

        /**UPDATE record */
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $this->setVariable("id", $id);
        }
        /**CREATE record */
        if (isset($_GET["appointmentId"])) {
            $appointmentId = $_GET["appointmentId"];
            $this->setVariable("appointmentId", $appointmentId);
        }
        $this->view("appointmentRecord");

        return true;
    }
}
