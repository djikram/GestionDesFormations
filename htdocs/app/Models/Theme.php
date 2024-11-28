<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "theme";
    protected $fillable = ['idFormation', 'nom'];

    public function course()
    {
        return $this->belongsTo(Courses::class, 'idFormation');
    }
    public function competence()
    {
        return $this->hasMany(Competence::class, 'idTheme');
    }

}
