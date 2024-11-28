<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageFormation extends Model
{
    use HasFactory;

    protected $table = "imageformation";
    protected $fillable = ['idFormation', 'name'];

    public function image()
    {
        return $this->belongsTo(Courses::class, 'idFormation');
    }

}
