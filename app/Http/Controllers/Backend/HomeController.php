<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends BackendController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('backend.home.index');
        /* Session::flush();*/
    }

    /*mostrar dados relativos ao perfil*/
    public function edit(Request $request)
    {
        $user = $request->user();

        return view('backend.home.edit', compact('user'));
    }

    /*metodo de actualizacaol*/
    public function update(UserUpdateRequest $request)
    {
        $user = $request->user();
        $user->update($request->all());

        return redirect()->back()->with("message", "Conta actualizada com sucesso!");
    }

    /*metodo para abrir o formulario da senha*/
    public function changePassword(Request $request)
    {
        $user = $request->user();

        return view('backend.home.change-password', compact('user'));

    }

    //update password
    public function updatePassword(ChangePasswordRequest $request)
    {
        $user = $request->user();

        $data = $request->all();

        //se a palavra passe antiga contiga com que esta na bd, faca:
        if (password_verify($data['password-antiga'], $user->password)) {

            $data['password'] = bcrypt($data['password']);

            /*dd("password-actual: " . $data['password']);*/
            $user->update($data);

            return redirect()->back()->with("message", "Password alterada com sucesso!");
        } else {
            return redirect()->back()->with("error-message", "A password antiga está incorrecta!");
        }

    }
}
