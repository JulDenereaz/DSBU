<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experiment extends Model
{
    use HasFactory;
    protected $table = 'experiments'; 
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function protocol()
    {
        return $this->belongsTo(Protocol::class);
    }
    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function dataSubcategory()
    {
        return $this->belongsTo(Data_subcategory::class);
    }


}
