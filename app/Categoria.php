<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public function receta(){
        return $this->belongsTo(Receta::class);
    }
}