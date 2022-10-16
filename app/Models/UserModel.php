<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'mstr_user';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'role', 'email', 'password', 'is_active', 'updated_at'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $useSoftDeletes = true;
    // protected $useSoftDeletes = true;
}
