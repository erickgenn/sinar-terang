<?php

namespace App\Models;

use CodeIgniter\Model;

class PointConfigurationModel extends Model
{
    protected $table      = 'mstr_point_configuration';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'description', 'point', 'value', 'updated_at'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $useSoftDeletes = true;
}
