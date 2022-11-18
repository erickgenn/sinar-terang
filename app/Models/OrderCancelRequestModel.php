<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderCancelRequestModel extends Model
{
    protected $table      = 'mstr_order_cancel_req';
    protected $primaryKey = 'id';

    protected $allowedFields = ['reason', 'request_by', 'order_id'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $useSoftDeletes = true;
}
