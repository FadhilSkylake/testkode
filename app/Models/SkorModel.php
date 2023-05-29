<?php

namespace App\Models;

use CodeIgniter\Model;

class SkorModel extends Model
{

    protected $table            = 'skor';
    protected $primaryKey       = 'id_skor';
    protected $allowedFields    = ['id_klub1', 'id_klub2', 'skor1', 'skor2'];
}
