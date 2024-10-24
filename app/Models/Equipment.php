<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Equipment extends Model
{
    use HasFactory;
    protected $table = 'equipment'; 

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'eq_id',
        'name',
        'shortname',
        'creator_id',
        'location',
        'platform_id',
        'software',
        'data_category_id',
        'description',
    ];

    
    
    public function creator()
    {
        return $this->belongsTo(User::class);
    }
    public function dataCategory()
    {
        return $this->belongsTo(DataCategory::class);
    }
    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
