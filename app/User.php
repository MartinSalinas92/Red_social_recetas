<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    //Evento que se ejecuta cuando un usuario es creado
    protected static function boot(){
        parent::boot();

        //asignar perfil una vez que haya creado un usuario nuevo
        static::created(function ($user) {
            $user->perfil()->create();
        });
    }

    /*Relacion de 1 a muchos es decir un usuario puede tener varias recetas */

    public function recetas(){

        return $this->hasMany(Receta::class);
    }

    public function perfil(){
        return $this->hasOne(Perfil::class);
    }

}


