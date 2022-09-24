<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table      = 'mstr_customer';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'email', 'phone', 'password', 'is_active', 'point'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // protected $useSoftDeletes = true;

    public function countRegistrationDate($date)
    {
        $builder = $this->db->table('mstr_customer');
        $builder->where('created_at >=', $date . " 00:00:00.000");
        $builder->where('created_at <=', $date . " 23:59:59.999");
        return $builder->get();
    }
}
