<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class Experiment extends Model
{
    use HasFactory;
    protected $table = 'experiments'; 

    // Accessor to return status in a formatted way (optional)
    public function getStatusAttribute($value)
    {
        return ucfirst(strtolower($value)); // This will return status as 'Ready', 'Created', etc.
    }

    protected $fillable = [
        'name', 
        'group_id', 
        'user_id', 
        'protocol_id', 
        'equipment_id', 
        'project_id', 
        'data_subcategory_id', 
        'status',
        'collection_date',
        'samples',
        'samples',
        'description',
        'file_structure',
        'supp_table',
        'is_personal',
        'is_sensitive',
        'is_encrypted',
        'is_archived',
        'is_deposited',
        'storage_period',
        'License',
    ];


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
