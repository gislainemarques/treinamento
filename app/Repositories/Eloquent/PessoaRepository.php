<?php

namespace App\Repositories\Eloquent;

use App\Models\Pessoa;
use App\Repositories\Contracts\PessoaRepositoryInterface;

class PessoaRepository extends AbstractRepository implements PessoaRepositoryInterface
{

    protected $model = Pessoa::class;

    public function findFirstByEmail($email) {
        return Pessoa::where('email', $email)->whereNull('deleted_at')->first();
    }

    public function createCarro($pessoaModel, array $data) {
        return $pessoaModel->carros()->create($data);
    }
}
