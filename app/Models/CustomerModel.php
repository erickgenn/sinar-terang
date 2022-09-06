<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table      = 'mstr_customer';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'email', 'phone', 'password', 'is_active'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // protected $useSoftDeletes = true;
}
