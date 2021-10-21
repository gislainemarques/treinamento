<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Http\Resources\PessoaResource;
use App\Http\Resources\PessoaCollection;
use App\Http\Requests\PessoaRequest;

class PessoaController extends Controller
{
    private $pessoa;
        
    public function __construct(Pessoa $pessoa) {
        $this->pessoa = $pessoa;
    }

    public function index() {
        $pessoas = $this->pessoa->paginate(2);
        //return response()->json($pessoas);
        return new PessoaCollection($pessoas);
    }

    public function show($id) {
        $pessoa = $this->pessoa->find($id);
        
        //return response()->json($pessoa);
        return new PessoaResource($pessoa);
    }

    public function save(PessoaRequest $request) {
        $data = $request->all();

        $pessoa = Pessoa::where('email', $data['email'])->first();
 
        if ($pessoa) {
            return response()->json(['data' => ['msg' => 'Email já cadastrado.']]);
        } else {
            $pessoa = $this->pessoa->create($data);
            return response()->json($pessoa);
        }
    }

    public function update(Request $request) {
        $data = $request->only('id','nome','telefone');
        $pessoa = $this->pessoa->find($data['id']);
        $pessoa->update($data);
        return response()->json($pessoa);
    }


    public function delete($id) {
        $pessoa = $this->pessoa->find($id);
        $pessoa->delete($pessoa);
        return response()->json(['data' => ['msg' => 'Pessoa removida com sucesso.']]);
    }

}
