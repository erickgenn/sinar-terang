<?php

namespace App\Models;

use CodeIgniter\Model;

class OutletModel extends Model
{
    protected $table      = 'mstr_outlet';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'is_active', 'location', 'picture', 'updated_at'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $useSoftDeletes = true;

    // protected $useSoftDeletes = true;
}
