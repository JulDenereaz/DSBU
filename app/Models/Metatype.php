<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metatype extends Model
{
    use HasFactory;
    protected $table = 'metatypes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];
    public function repositories() {
        return $this->belongsToMany(Repository::class);
    }
}
