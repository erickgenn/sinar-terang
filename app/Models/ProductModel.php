<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'mstr_product';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'quantity', 'price', 'picture', 'description', 'is_active', 'outlet_id', 'updated_at'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $useSoftDeletes = true;
    // protected $useSoftDeletes = true;
}
