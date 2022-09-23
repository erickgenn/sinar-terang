<?php

namespace App\Models;

use CodeIgniter\Model;

class CashReportModel extends Model
{
    protected $table      = 'mstr_cash_report';
    protected $primaryKey = 'id';

    protected $allowedFields = ['description', 'debit', 'credit', 'balance', 'type'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $useSoftDeletes = true;

    public function cashReport($month)
    {
        $builder = $this->db->table('mstr_cash_report');

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
