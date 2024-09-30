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
        'eq_name',
        'creator_id',
        'location',
        'platform',
        'platform_name',
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
        return $this->belongsTo(Data_category::class);
    }
}
