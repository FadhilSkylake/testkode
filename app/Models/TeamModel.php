<?php

namespace App\Models;

use CodeIgniter\Model;

class TeamModel extends Model
{
    protected $table = 'teams';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_klub', 'kota_klub', 'played', 'won', 'drawn', 'lost', 'goals_for', 'goals_against', 'point'];
}
