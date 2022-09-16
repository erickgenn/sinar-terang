<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table      = 'mstr_order';
    protected $primaryKey = 'id';

    protected $allowedFields = ['total_price'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $useSoftDeletes = true;
    // protected $useSoftDeletes = true;
}
