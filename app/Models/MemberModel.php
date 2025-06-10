<?php
namespace  App\Models;
use CodeIgniter\Model;

class MemberModel extends Model {
    protected $table = 'members';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'membership_number',
        'first_name',
        'surname',
        'email',
        'phone',
        'idta_pin',
        'role',
        'class_attended',
        'notes'
    ];

    protected $useTimestamps = true;
}

