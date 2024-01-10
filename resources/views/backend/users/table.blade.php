<?php
/**
 * Created by PhpStorm.
 * User: Dagmar Mpheio
 * Date: 10/27/2020
 * Time: 11:58 PM
 */ ?>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <td width="80">Acção</td>
        <td>Nome</td>
        <td>Email</td>
        <td>Cargo</td>
    </tr>
    </thead>
    <tbody>
    <?php $currentUser = auth()->user();?>
    @foreach($users as $user)
        <tr>
            <td>
                <a title="Editar" href="{{route('backend.users.edit',$user->id)}}"
                   class="btn btn-xs btn-primary">
                    <i class="fa fa-edit"></i>
                </a>

                @if($user->id == config('cms.default_user_id') || $user->id == $currentUser->id)
                    <button onclick="return false" title="Excluír" type="submit"
                            class="btn btn-xs btn-danger disabled">
                        <i class="fa fa-trash"></i>
                    </button>
                @else
                    <a href="{{route('backend.users.confirm',$user->id)}}" title="Excluír" type="submit"
                       class="btn btn-xs btn-danger">
                        <i class="fa fa-trash"></i>
                    </a>
                @endif
            </td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->roles->first()->display_name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
