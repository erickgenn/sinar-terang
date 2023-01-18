<?php

namespace App\Models;

use CodeIgniter\Model;

class CashReportModel extends Model
{
    protected $table      = 'mstr_cash_report';
    protected $primaryKey = 'id';

    protected $allowedFields = ['description', 'debit', 'credit', 'balance', 'type', 'date', 'user_id'];

    protected $createdField  = 'created_at';

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

    public function monthSales($month)
    {
        $builder = $this->db->table('mstr_cash_report');

        $m = date('m', strtotime($month));
        $y = date('Y', strtotime($month));
        $d = cal_days_in_month(CAL_GREGORIAN, $m, $y);

        $builder->select('*');
        $builder->where("created_at >=", $y . '-' . $m . '-01');
        $builder->where("created_at <=", $y . '-' . $m . '-' . $d . ' ');
        $builder->where("type", "order");
        $builder->orderBy('created_at', 'ASC');
        return $builder->get();
    }

    public function salaryReport($month)
    {
        $builder = $this->db->table('mstr_cash_report');

        $m = date('m', strtotime($month));
        $y = date('Y', strtotime($month));
        $d = cal_days_in_month(CAL_GREGORIAN, $m, $y);

        $builder->select('*');
        $builder->where("created_at >=", $y . '-' . $m . '-01');
        $builder->where("created_at <=", $y . '-' . $m . '-' . $d . ' ');
        $builder->where("type", "salary");
        $builder->orderBy('created_at', 'ASC');
        return $builder->get();
    }

    public function electricalReport($month)
    {
        $builder = $this->db->table('mstr_cash_report');

        $m = date('m', strtotime($month));
        $y = date('Y', strtotime($month));
        $d = cal_days_in_month(CAL_GREGORIAN, $m, $y);

        $builder->select('*');
        $builder->where("created_at >=", $y . '-' . $m . '-01');
        $builder->where("created_at <=", $y . '-' . $m . '-' . $d . ' ');
        $builder->where("type", "electrical");
        $builder->orderBy('created_at', 'ASC');
        return $builder->get();
    }

    public function rentReport($month)
    {
        $builder = $this->db->table('mstr_cash_report');

        $m = date('m', strtotime($month));
        $y = date('Y', strtotime($month));
        $d = cal_days_in_month(CAL_GREGORIAN, $m, $y);

        $builder->select('*');
        $builder->where("created_at >=", $y . '-' . $m . '-01');
        $builder->where("created_at <=", $y . '-' . $m . '-' . $d . ' ');
        $builder->where("type", "rent");
        $builder->orderBy('created_at', 'ASC');
        return $builder->get();
    }

    public function maintenanceReport($month)
    {
        $builder = $this->db->table('mstr_cash_report');

        $m = date('m', strtotime($month));
        $y = date('Y', strtotime($month));
        $d = cal_days_in_month(CAL_GREGORIAN, $m, $y);

        $builder->select('*');
        $builder->where("created_at >=", $y . '-' . $m . '-01');
        $builder->where("created_at <=", $y . '-' . $m . '-' . $d . ' ');
        $builder->where("type", "maintenance");
        $builder->orderBy('created_at', 'ASC');
        return $builder->get();
    }

    public function otherReport($month)
    {
        $builder = $this->db->table('mstr_cash_report');

        $m = date('m', strtotime($month));
        $y = date('Y', strtotime($month));
        $d = cal_days_in_month(CAL_GREGORIAN, $m, $y);

        $builder->select('*');
        $builder->where("created_at >=", $y . '-' . $m . '-01');
        $builder->where("created_at <=", $y . '-' . $m . '-' . $d . ' ');
        $builder->where("type", "other");
        $builder->orderBy('created_at', 'ASC');
        return $builder->get();
    }
}
