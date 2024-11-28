<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Session;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
        public static function isConnected(){
        return Session :: get('email') !== null;
    }
    protected $fillable = [
        'username',
        'email',
        'phone',
        'cin',
        'age',
        'genre',
        'role',
        'departement'


    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function formations()
    {
        return $this->belongsToMany(Courses::class, 'formateurformation', 'idUser', 'idFormation');
    }
    public function formationsP()
    {
        return $this->belongsToMany(Courses::class, 'personelleformation', 'idUser', 'idFormation');
    }
    public function department()
    {
        return $this->belongsTo(DepartementUser::class, 'departement');
    }
    public function evaluation()
    {
        return $this->hasMany(Evaluation::class, 'idUser');
    }

}
