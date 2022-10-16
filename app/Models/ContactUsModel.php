<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactUsModel extends Model
{
    protected $table      = 'cust_contact';
    protected $primaryKey = 'id';

    protected $allowedFields = ['email', 'phone', 'updated_at'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // protected $useSoftDeletes = true;
}
