<?php
namespace App\Models;

use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table = 'attendance';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'event_id',
        'member_id',
        'attended',
        'notes',
        'class_attended',
        'amount_paid',
        'payment_method'
    ];

    protected $useTimestamps = true;

    /**
     * Get attendance reports with filtering options.
     *
     * @param array $filters ['min_attendance' => int, 'start_date' => date, 'end_date' => date,
     *                       'class_attended' => string, 'leader_follower' => string,
     *                       'lapsed_since' => date]
     * @return array
     */
    public function getAttendanceReport(array $filters = []): array
    {
        $builder = $this->db->table('attendance a');
        $builder->select('m.id, m.first_name, m.surname, m.email, m.role as leader_follower, a.class_attended, COUNT(a.id) as attendance_count, MAX(e.event_date) as last_attended');
        $builder->join('members m', 'a.member_id = m.id');
        $builder->join('events e', 'a.event_id = e.id');
        $builder->where('a.attended', 1);
        $builder->groupBy('m.id, a.class_attended, m.role');

        // Filter minimum attendance count
        if (!empty($filters['min_attendance'])) {
            $builder->having('attendance_count >=', $filters['min_attendance']);
        }

        // Filter date range of events attended
        if (!empty($filters['start_date'])) {
            $builder->where('e.event_date >=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $builder->where('e.event_date <=', $filters['end_date']);
        }

        // Filter by class attended
        if (!empty($filters['class_attended'])) {
            $builder->where('a.class_attended', $filters['class_attended']);
        }

        // Filter by role (leader/follower/both)
        if (!empty($filters['leader_follower'])) {
            $builder->where('m.role', $filters['leader_follower']);
        }

        // Filter lapsed members: last attended before given date
        if (!empty($filters['lapsed_since'])) {
            $builder->having('MAX(e.event_date) <=', $filters['lapsed_since']);
        }

        $query = $builder->get();
        return $query->getResultArray();
    }
}
