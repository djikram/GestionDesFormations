<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'competence';
    protected $fillable = ['nom', 'idTheme'];

    public function theme()
    {
        return $this->belongsTo(Theme::class, 'idTheme');
    }
    public function evaluation()
    {
        return $this->hasMany(Evaluation::class, 'idCompetence');
    }
}
