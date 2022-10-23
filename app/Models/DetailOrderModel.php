<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailOrderModel extends Model
{
    protected $table      = 'mstr_detail_order';
    protected $primaryKey = 'id';

    protected $allowedFields = ['product_id', 'product_name', 'product_price', 'order_id', 'quantity'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $useSoftDeletes = true;
    // protected $useSoftDeletes = true;
}
