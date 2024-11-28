<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $table = "courses";
    protected $fillable = [
        'name',
        'datedebut',
        'datefin',
        'modeformation',
        'groupecible',
        'nbrBenefi',
        'nbrJours',
        'nbrcours',
        'organisateur',

    ];
    public function coursFiles()
    {
        return $this->hasMany(CoursFormation::class, 'idformation'); // Adjust based on your actual model names and relationships
    }
    public function imageFiles()
    {
        return $this->hasMany(ImageFormation::class, 'idFormation'); // Adjust based on your actual model names and relationships
    }
    public function formateurs()
    {
        return $this->belongsToMany(User::class, 'formateurformation', 'idFormation', 'idUser');
    }
    public function personnels()
    {
        return $this->belongsToMany(User::class, 'personelleformation', 'idFormation', 'idUser')->where('role', 'Personnel');
    }
    public function personnelsCount()
    {
        return $this->personnels()->count();
    }
    // Relation avec Theme
    public function themes()
    {
        return $this->hasMany(Theme::class, 'idFormation'); // 'idformation' correspond à la clé étrangère dans la table themes
    }
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'idFormation'); // Assurez-vous que 'idFormation' correspond bien à votre base de données
    }
//     public function evaluations()
// {
//     return $this->hasMany(Evaluation::class);
// }


}
