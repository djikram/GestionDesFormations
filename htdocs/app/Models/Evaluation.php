<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    public $timestamps = false; // Désactive les timestamps

    protected $table = 'evaluation';
    protected $fillable = ['idCompetence', 'idUser', 'idFormation', 'note', 'commentaire'];

    public function competence()
    {
        return $this->belongsTo(Competence::class, 'idCompetence');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
    public function course()
    {
        return $this->belongsTo(Courses::class, 'idFormation');
    }
}
