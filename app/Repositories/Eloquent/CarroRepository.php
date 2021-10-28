<?php

namespace App\Repositories\Eloquent;

use App\Models\Carro;
use App\Repositories\Contracts\CarroRepositoryInterface;

class CarroRepository extends AbstractRepository implements CarroRepositoryInterface
{

    protected $model  = Carro::class;

    public function findFirstByPlaca($placa) {
        return Carro::where('placa', $placa)
        ->whereNull('deleted_at')
        ->first();
    }

    public function findFirstOrFailByPessoaIdPlaca($id, $placa) {
        return Carro::where('placa', $placa)
        ->where('pessoa_id', $id)
        ->firstOrFail();
    }

    public function getCarroComPessoaByPlaca($placa) {
        return Carro::where('placa', $placa)
        ->whereNull('deleted_at')
        ->with('pessoa')
        ->get();
    }
}
