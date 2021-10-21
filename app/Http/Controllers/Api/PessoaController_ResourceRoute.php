<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pessoa;

class PessoaController extends Controller
{

    private $pessoa;
        
    public function __construct(Pessoa $pessoa) {
        $this->pessoa = $pessoa;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pessoas = $this->pessoa->all();
        return response()->json($pessoas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $pessoa = $this->pessoa->create($data);
        return response()->json($pessoa);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pessoa = $this->pessoa->find($id);
        return response()->json($pessoa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $pessoa = $this->pessoa->find($data['id']);
        $pessoa->update($data);
        return response()->json($pessoa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        $pessoa = $this->pessoa->find($id);
        $pessoa->delete($pessoa);
        return response()->json(['data' => ['msg' => 'Pessoa removida com sucesso.']]);
    }
}
