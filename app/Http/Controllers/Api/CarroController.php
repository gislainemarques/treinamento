<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarroRequest;
use App\Http\Resources\CarroCollection;
use App\Http\Resources\CarroResource;
use App\Http\Resources\PessoaResource;
use App\Models\Carro;
use App\Repositories\Contracts\PessoaRepositoryInterface;
use App\Repositories\Contracts\CarroRepositoryInterface;

class CarroController extends Controller
{
    private $pessoaRepository;
    private $carroRepository;

    public function __construct(PessoaRepositoryInterface $pessoaRepository,
                                CarroRepositoryInterface $carroRepository) {
        $this->pessoaRepository = $pessoaRepository;
        $this->carroRepository = $carroRepository;

    }

    public function index() {
        $carros = $this->carroRepository->all();
        return new CarroCollection($carros);
    }

    public function showCarroComPessoa($placa) {
        try {

            $carro = $this->carroRepository->getCarroComPessoaByPlaca($placa);

            if (!$carro) {
                throw new \Exception("Placa não encontrada.");
            }

            return response()->json($carro);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function save(CarroRequest $request) {
        $data = $request->all();

        try {

            $pessoa = $this->pessoaRepository->find($data['pessoa_id']);
            if (!$pessoa) {
                throw new \Exception("Pessoa não encontrada.");
            }

            $carro = $this->carroRepository->findFirstByPlaca($data['placa']);
            if ($carro) {
                throw new \Exception("Carro já possui proprietário.");
            }

            $carro = $this->carroRepository->create($data);

            return new CarroResource($carro);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function delete($id) {
        try {
            $carro = $this->carroRepository->deleteById($id);
            return response()->json(['data' => ['msg' => 'Carro removido com sucesso.']]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }
}
