<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_subcategory extends Model
{
    use HasFactory;
    protected $table = 'data_subcategories';

    public function dataCategory()
    {
        return $this->belongsTo(Data_category::class);
    }
    
}
