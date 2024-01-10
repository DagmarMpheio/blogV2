<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermissionsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!check_user_permissions($request)) {
            abort(403, "Acesso Proíbido!");
        }

        return $next($request);
    }

    /*public function handle($request, Closure $next)
    {
        //pegar o usuario actual
        $currentUser = $request->user();

        //pegar a accao actual
        $currentActionName = ($request->route()->getActionName());
        list($controller, $method) = explode('@', $currentActionName);
        $controller = str_replace(["App\\Http\Controllers\\Backend\\", "Controller"], "", $controller);
//        dd("C: $controller M: $method");

        //mapa classe
        $classesMap = [
            'Blog' => 'post',
            'Categories' => 'category',
            'Users' => 'user'
        ];

        //mapa das permissoes
        $crudPermissionsMap = [
            'crud' => ['create', 'store', 'edit', 'update', 'destroy', 'restore', 'forceDestroy', 'index', 'view']
        ];

        foreach ($crudPermissionsMap as $permission => $methods) {
            //se o metodo actual existe na lista de metodos,
            //vamos verificar a permissao
            if (in_array($method, $methods) && isset($classesMap[$controller])) {
                $classeName = $classesMap[$controller];

                if ($classeName == 'post' && in_array($method, ['edit', 'update', 'destroy', 'restore', 'forceDestroy'])) {
                    //se o usuario actual nao tem update-others-post/delete-others-post permissso
                    //garantir que o usuario modifique o seu proprio post
                    if (($id = $request->route("blog")) && (!$currentUser->hasPermission('update-others-post') || !$currentUser->hasPermission('delete-others-post'))) {
                        $post = \App\Post::find($id);
                        if ($post->author_id !== $currentUser->id) {
                            abort(403, "Acesso Proíbido!");
                        }
                    }

                } //se o usuario actual nao tem permissao, nao permitir o proximo pedido
                elseif (!$currentUser->hasPermission("{$permission}-{$classeName}")) {
                    abort(403, "Acesso Proíbido!");
                }
                break;
            }

        }
        return $next($request);
    }*/
}
