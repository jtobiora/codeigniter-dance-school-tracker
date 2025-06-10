<?php
namespace App\Controllers;

use App\Models\AttendanceModel;
use App\Models\EventModel;
use App\Models\MemberModel;

class AttendanceController extends BaseController {
    protected AttendanceModel $attendanceModel;
    protected EventModel $eventsModel;
    protected MemberModel $memberModel;

    public function __construct()
    {
        $this->attendanceModel = new AttendanceModel();
        $this->memberModel = new MemberModel();
        $this->eventsModel = new EventModel();
    }

    public function index($eventId = null) {
        if (!$eventId) {
            $data['events'] = $this->eventsModel->orderBy('event_date', 'DESC')->findAll();
            return view('attendance/select_event', $data);
        }

        $data['event'] = $this->eventsModel->find($eventId);
        if (!$data['event']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Event not found.');
        }

        // Fetch all members
        $members = $this->memberModel->findAll();

        // Fetch attendances for this event
        $attendances = $this->attendanceModel->where('event_id', $eventId)->findAll();

        $attendanceByMember = [];
        $classAttendedByMember = [];
        foreach ($attendances as $att) {
            $attendanceByMember[$att['member_id']] = $att;
            $classAttendedByMember[$att['member_id']] = $att['class_attended'] ?? '';
        }

        // Define your class options - could also come from DB or config
        $classOptions = [
            'Beginner',
            'Intermediate',
            'Advanced',
            'Advanced Latin',
            'Salsa',
            'Bachata',
            'Other'
        ];


        $data['members'] = $members;
        $data['attendanceByMember'] = $attendanceByMember;
        $data['classAttendedByMember'] = $classAttendedByMember;
        $data['classOptions'] = $classOptions;

        return view('attendance/index', $data);
    }

    /**
     * @throws \ReflectionException
     */
    public function saveAttendance($eventId): \CodeIgniter\HTTP\RedirectResponse
    {
        $post = $this->request->getPost();

        $allMembers = $post['members'] ?? [];


        foreach ($allMembers as $memberId) {
            $attended = isset($post['attendance'][$memberId]) ? 1 : 0;
            $notes = $post['notes'][$memberId] ?? null;
            $classAttended  = $post['class_attended'][$memberId] ?? null;
            $amountPaid     = $post['amount_paid'][$memberId] ?? null;
            $paymentMethod  = $post['payment_method'][$memberId] ?? null;

            $existing = $this->attendanceModel
                ->where('event_id', $eventId)
                ->where('member_id', $memberId)
                ->first();


            $data = [
                'event_id'        => $eventId,
                'member_id'       => $memberId,
                'attended'        => $attended,
                'notes'           => $notes,
                'class_attended'  => $classAttended,
                'amount_paid'     => $amountPaid,
                'payment_method'  => $paymentMethod,
            ];


            if ($existing) {
                $this->attendanceModel->update($existing['id'], $data);
            } else {
                $this->attendanceModel->insert($data);
            }
        }

        return redirect()->to("/attendance/$eventId")->with('success', 'Attendance updated successfully.');
    }

    public function report(): string
    {
        $attendances = $this->attendanceModel
            ->select('attendance.*, events.event_name, events.event_date, members.first_name, members.surname')
            ->join('events', 'events.id = attendance.event_id')
            ->join('members', 'members.id = attendance.member_id')
            ->orderBy('attendance.id', 'DESC')
            ->findAll();

        return view('attendance/report', ['attendances' => $attendances]);
    }

    public function edit($attendanceId)
    {
        $attendance = $this->attendanceModel
            ->select('attendance.*, events.event_name, events.event_date, members.first_name, members.surname')
            ->join('events', 'events.id = attendance.event_id')
            ->join('members', 'members.id = attendance.member_id')
            ->where('attendance.id', $attendanceId)
            ->first();

        if (!$attendance) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Attendance record not found.');
        }

        return view('attendance/edit', ['attendance' => $attendance]);
    }

    /**
     * @throws \ReflectionException
     */
    public function update($attendanceId): \CodeIgniter\HTTP\RedirectResponse
    {
        $post = $this->request->getPost();

        $data = [
            'attended' => isset($post['attended']) ? 1 : 0,
            'notes'    => $post['notes']
        ];

        $this->attendanceModel->update($attendanceId, $data);

        return redirect()->to('/attendance/report')->with('success', 'Attendance record updated.');
    }

    public function delete($attendanceId): \CodeIgniter\HTTP\RedirectResponse
    {
        $attendance = $this->attendanceModel->find($attendanceId);

        if (!$attendance) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Attendance record not found.');
        }

        $this->attendanceModel->delete($attendanceId);

        return redirect()->to('/attendance/report')->with('success', 'Attendance record deleted.');
    }
}
