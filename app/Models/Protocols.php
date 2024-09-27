<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Protocols extends Model
{
    use HasFactory;
    protected $table = 'protocols';  // Ensure this table name matches your database
}
