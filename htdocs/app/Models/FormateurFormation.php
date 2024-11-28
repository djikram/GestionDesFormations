<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormateurFormation extends Model
{
    use HasFactory;

    protected $table = "formateurformation";
    protected $fillable = ['idUser','idFormation'];

    // public function formateur()
    // {
    //     return $this->belongsTo(Courses::class, 'idFormation');
    // }

}
