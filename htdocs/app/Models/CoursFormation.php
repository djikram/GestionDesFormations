<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursFormation extends Model
{
    use HasFactory;

    protected $table = "coursformation";
    protected $fillable = ['idformation', 'name'];

    public function course()
    {
        return $this->belongsTo(Courses::class, 'idformation');
    }

}
