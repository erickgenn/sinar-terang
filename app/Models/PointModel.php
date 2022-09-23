<?php

namespace App\Models;

use CodeIgniter\Model;

class PointModel extends Model
{
    protected $table      = 'mstr_point_history';
    protected $primaryKey = 'id';

    protected $allowedFields = ['operation', 'point', 'customer_id'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $useSoftDeletes = true;
}
