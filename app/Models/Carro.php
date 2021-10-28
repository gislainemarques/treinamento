<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carro extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'pessoa_id',
        'placa',
        'cor',
        'nome',
    ];

    public function pessoa() {
        return $this->belongsTo(Pessoa::class);
    }

}
