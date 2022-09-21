<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table      = 'mstr_order';
    protected $primaryKey = 'id';

    protected $allowedFields = ['total_price', 'request_cancel', 'customer_id'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $useSoftDeletes = true;
    // protected $useSoftDeletes = true;

    public function monthSales($month)
    {
        $builder = $this->db->table('mstr_order');

        $m = date('m', strtotime($month));
        $y = date('Y', strtotime($month));
        $d = cal_days_in_month(CAL_GREGORIAN, $m, $y);

        $builder->select('*');
        $builder->where("created_at >=", $y . '-' . $m . '-01');
        $builder->where("created_at <=", $y . '-' . $m . '-' . $d . ' ');
        $builder->orderBy('created_at', 'ASC');
        return $builder->get();
    }
}
