<?php

namespace App\Http\Controllers;

use App\Models\Funcionality;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $funcionalities = Funcionality::all();
        return view('records.roles.index', compact('roles', 'funcionalities'));
    }

    public function getRoles(){
        return response()->json([
            'roles' => Role::all(),
            'funcionalities' => Funcionality::with('permissions')->get()
        ]);
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
    public function store(Request $request)
    {
        try {
            $role = new Role;
            $role->create($request->all())->givePermissionTo($request->permissions_list);
            
            return response()->json(['success' => true, 'response' => 'Cadastrado com sucesso']);
        }catch(\Exception $e) {
            return response()->json(['success' => false, 'response' => "Erro: " . $e->getMessage()]);
        }
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
        $role = Role::find($id);

        try{
            // Retirando as permissões para serem substituídas pelas que vieram marcadas
            foreach($role->permissions as $permission){
                $role->revokePermissionTo($permission->name);
            }

            // Dando as permissões que vieram marcadas
            $role->syncPermissions($request->permissions);

            return response()->json(['success' => true, 'response' => 'Permissões atualizadas com sucesso']);
        }catch(\Exception $e){
            return response()->json(['success' => false, 'response' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $role = Role::findById($id);
            if(!$role){
                return response()->json(['success' => false, 'response' => "Não encontrado"]);
            }
            $role->delete();

            return response()->json(['success' => true, 'response' => "Excluído com sucesso"]);

        }catch(\Exception $e){
            $mensagem = $e->getMessage();
            return response()->json(['success' => false, 'response' => "Erro ao deletar: $mensagem"]);
        }
    }
}
