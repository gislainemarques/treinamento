<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PessoaResource;
use App\Http\Resources\CarroCollection;
use App\Http\Resources\PessoaCollection;
use App\Http\Requests\PessoaRequest;
use App\Http\Requests\CarroRequest;
use App\Repositories\Contracts\PessoaRepositoryInterface;
use App\Repositories\Contracts\CarroRepositoryInterface;

class PessoaController extends Controller
{
    private $pessoaRepository;
    private $carroRepository;

    public function __construct(PessoaRepositoryInterface $pessoaRepository,
                                CarroRepositoryInterface $carroRepository) {
        $this->pessoaRepository = $pessoaRepository;
        $this->carroRepository = $carroRepository;

    }

    public function index() {
        $pessoas = $this->pessoaRepository->all();
        return new PessoaCollection($pessoas);
    }

    public function show($id) {
        $pessoa = $this->pessoaRepository->find($id);
        return new PessoaResource($pessoa);
    }

    public function save(PessoaRequest $request) {
        $data = $request->all();

        try {
            $pessoa = $this->pessoaRepository->findFirstByEmail($data['email']);

            if ($pessoa) {
                throw new \Exception("Email já cadastrado.");
            }

            $pessoa = $this->pessoaRepository->create($data);
            return new PessoaResource($pessoa);

            
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function update(Request $request) {
        $data = $request->only('id','nome','telefone');
        try {
            $pessoa = $this->pessoaRepository->update($data['id'], $data);
            return new PessoaResource($pessoa);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }


    public function delete($id) {
        try {
            $pessoa = $this->pessoaRepository->findOrFail($id);
            $this->pessoaRepository->deleteById($id);
            return response()->json(['data' => ['msg' => 'Pessoa removida com sucesso.']]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function carro($id) {
        try {
            $pessoa = $this->pessoaRepository->findOrFail($id);
            return new CarroCollection($pessoa->carros);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function saveCarro(CarroRequest $request, $pessoa_id) {
        $data = $request->all();

        try {
            $pessoa = $this->pessoaRepository->find($pessoa_id);

            $carro = $this->carroRepository->findFirstByPlaca($data['placa']);

            if ($carro) {
                throw new \Exception("Carro já possui proprietário.");
            }

            $this->pessoaRepository->createCarro($pessoa, $data);

            return new CarroCollection($pessoa->carros);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }

    }

    public function deleteCarro($id, $placa) {
        try {

            $carro = $this->carroRepository->findFirstOrFailByPessoaIdPlaca($id, $placa);

            $this->carroRepository->delete($carro);

            return response()->json(['data' => ['msg' => 'Carro removido com sucesso.']]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }
}
