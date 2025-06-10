<?php

namespace App\Controllers;

use App\Models\AttendanceModel;
use CodeIgniter\Controller;

class ReportController extends Controller{
    protected $attendanceModel;

    public function __construct()
    {
        $this->attendanceModel = new AttendanceModel();
    }

// Show report with filters
    public function index(): void
    {
        $filters = $this->request->getGet();
        $reportData = $this->attendanceModel->getAttendanceReport($filters);

        $data = [
            'filters' => $filters,
            'reportData' => $reportData,
            'classOptions' => ['Beginner', 'Intermediate', 'Advanced', 'Advanced Latin', 'Salsa', 'Bachata', 'Other'],
            'leaderFollowerOptions' => ['Leader', 'Follower', 'Both'],
        ];

        echo view('attendance/att_report', $data);
    }

// Export CSV of filtered results
    public function exportCsv()
    {
        $filters = $this->request->getGet();
        $data = $this->attendanceModel->getAttendanceReport($filters);

        $filename = "attendance_report_" . date('Ymd_His') . ".csv";

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=' . $filename);

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Name', 'Email', 'Leader/Follower', 'Class', 'Attendance Count', 'Last Attended']);

        foreach ($data as $row) {
            fputcsv($output, [
                $row['first_name'] . ' ' . $row['surname'],
                $row['email'],
                $row['leader_follower'],
                $row['class_attended'],
                $row['attendance_count'],
                $row['last_attended'],
            ]);
        }
        fclose($output);
        exit;
    }

// Send emails to selected members from filtered list
    public function sendEmails()
    {
        $emails = $this->request->getPost('member_emails');
        $subject = $this->request->getPost('subject');
        $message = $this->request->getPost('message');

        if (empty($emails)) {
            return redirect()->back()->with('error', 'No members selected.');
        }

        $emailService = \Config\Services::email();
        $successCount = 0;
        $errorMessages = [];

        foreach ($emails as $to) {
            $emailService->clear();
            $emailService->setTo($to);
            $emailService->setSubject($subject);
            $emailService->setMessage($message);

            if ($emailService->send()) {
                $successCount++;
            } else {
                $errorMessages[] = "Failed to send to $to: " . $emailService->printDebugger(['headers']);
            }
        }

        if (!empty($errorMessages)) {
            // You could log this instead of redirecting with it, if it's too long
            return redirect()->back()->with('error', implode('<br>', $errorMessages));
        }

        return redirect()->back()->with('success', "$successCount emails sent successfully.");
    }

}
