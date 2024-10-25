<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    use HasFactory;
    protected $table = 'repositories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];
    public function metatypes()
    {
        return $this->belongsToMany(Metatype::class);
    }
    public function dataCategories() {
        return $this->belongsToMany(DataCategory::class);
    }
}
