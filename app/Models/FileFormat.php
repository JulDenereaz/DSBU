<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileFormat extends Model
{
    use HasFactory;
    protected $table = 'file_formats'; 

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'value',
        'description',
    ];


    public function equipment() {
        return $this->belongsToMany(Equipment::class);
    }

}
