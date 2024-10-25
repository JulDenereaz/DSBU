<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataCategory extends Model
{
    use HasFactory;
    protected $table = 'data_categories';

    public function repositories() {
        return $this->belongsToMany(Repository::class);
    }

}
