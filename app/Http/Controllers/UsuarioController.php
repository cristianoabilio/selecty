<?php

namespace App\Http\Controllers;
use App;
use App\Experiencia;
use App\Formacao;
use App\Usuario;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\UsuarioStore;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
        $search  = $request->input('search');
        $order   = $request->input('order');
        $orderBy = $request->input('orderBy');
        $experiencia_id = $request->input('experiencia_id');
        $formacao_id = $request->input('formacao_id');
        
        $query = Usuario::searchFor($search);

        if (!empty($experiencia_id)) {
            $query->where('experiencia_id', $experiencia_id);
        }
        if (!empty($formacao_id)) {
            $query->where('formacao_id', $formacao_id);
        }

        if (!empty($orderBy)) {
            $query->orderBy($orderBy, $order === 'desc' ? $order : 'asc');
        }

        $usuarios = $query->paginate(10, ['*'], 'usuario_page')->appends($request->all());

        $data = [
            'status'    => true, 
            'usuarios'   => $usuarios, 
            'search'    => $search, 
            'ordery'    => $order, 
            'orderBy'   => $orderBy];
        
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioStore $request)
    {
        $telefone = $request->input('telefone');
        $email    = $request->input('email');

        if (empty($telefone) && empty($email)) {
            $data = ['status' => false, 'message' => 'Email ou telefone deve ser informado.'];
        } else {
            $data = DB::transaction(function() use ($request) {            
                $id = $request->input('id');                

                $request->merge([
                    'telefone' => preg_replace('/[^0-9]/', '', $request->input('telefone')),                
                ]);
                

                if ($id) {
                    $usuario = Usuario::where('id', $id)->first();

                    if ($usuario) {
                        $usuario->update($request->all());
                        $usuario->save();

                        return ['status' => true, 'data' => 'Usuário atualizado com sucesso.'];
                    }
                } else {
                    //dd($request->all());
                    // insere o usuario
                    Usuario::create($request->all());

                    return array('status' => true, 'data' => 'Usuário cadastrado com sucesso.');
                }
            });
        }
        return response()->json($data);        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
