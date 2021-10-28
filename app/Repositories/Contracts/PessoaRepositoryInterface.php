<?php

namespace App\Repositories\Contracts;

interface PessoaRepositoryInterface {

    public function all();

    public function find($id);

    public function findOrFail($id);

    public function create(array $data);

    public function update($id, array $data);

    public function deleteById($id);

    public function findFirstByEmail($email);

    public function createCarro($pessoaModel, array $data);
}
