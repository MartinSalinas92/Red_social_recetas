<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Receta extends Model
{

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }
    
}
