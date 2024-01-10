<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\UserDestroyResquest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Hash;

class UsersController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $users = User::orderBy('name')->paginate(5);
        $usersCount = User::count();

        return view('backend.users.index', compact('users', 'usersCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = new User();

        return view('backend.users.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        //
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        $user->detachRole($user->role);//retirar a permissao actual
        $user->attachRole($request->role);//add a permissao

        return redirect('/backend/users')->with("message", "Novo usuário inserida com sucesso!");

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $user = User::findOrFail($id);

        return view('backend.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        //
        $user = User::findOrFail($id);
        $user->update($request->all());

        $user->detachRole($user->role);//retirar a permissao actual
        $user->attachRole($request->role);//add a permissao

        return redirect('/backend/users')->with("message", "Novo usuário actualizado com sucesso!");
        /* dd($request->all());*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDestroyResquest $resquest, $id)
    {
        //
        $user = User::findOrFail($id);

        $deleteOption = $resquest->delete_option;
        $selectedUser = $resquest->selected_user;

        if ($deleteOption == "delete") {
            //apagar os posts do usuario
            /*$user->posts()->withTrashed()->forceDelete();*/
            $user->posts()->withTrashed()->forceDelete();
           //apagar a imagem do servidor
            $user->post;

        } elseif ($deleteOption == "atribute") {
            $user->posts()->update(['author_id' => $selectedUser]);
        }
        //apagar o usuario
        $user->delete();


        return redirect("/backend/users")->with("message", "Usuário foi excluído com succeso!");

    }

    public function confirm(UserDestroyResquest $resquest, $id)
    {
        //

        $user = User::findOrFail($id);
        $users = User::where('id', '!=', $user->id)->pluck('name', 'id');

        return view("backend.users.confirm", compact('user', 'users'));

    }
}
