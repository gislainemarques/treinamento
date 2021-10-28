<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nome',
        'telefone',
        'email',
    ];


    public function carros() {
        return $this->hasMany(Carro::class);
    }

}
