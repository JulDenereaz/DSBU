<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experiments extends Model
{
    use HasFactory;
    protected $table = 'experiments';  // Ensure this table name matches your database
}
