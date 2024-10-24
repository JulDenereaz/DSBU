<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMethod extends Model
{
    use HasFactory;
    protected $table = 'data_methods';

    public function dataCategory()
    {
        return $this->belongsTo(DataCategory::class);
    }
    
}
