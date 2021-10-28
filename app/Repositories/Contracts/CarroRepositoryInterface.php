<?php

namespace App\Repositories\Contracts;

interface CarroRepositoryInterface {

    public function all();

    public function create(array $data);

    public function delete($model);

    public function deleteById($id);

    public function findFirstByPlaca($placa);

    public function findFirstOrFailByPessoaIdPlaca($id, $placa);

    public function getCarroComPessoaByPlaca($placa);

}
