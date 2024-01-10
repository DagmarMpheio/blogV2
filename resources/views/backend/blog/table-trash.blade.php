<?php
/**
 * Created by PhpStorm.
 * User: Dagmar Mpheio
 * Date: 10/27/2020
 * Time: 11:57 PM
 */ ?>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <td width="80">Acção</td>
        <td>Título</td>
        <td width="120">Autor</td>
        <td width="150">Categoria</td>
        <td width="165">Data</td>
    </tr>
    </thead>
    <tbody>
    <?php $request = request();?>
    @foreach($posts as $post)
        <tr>
            <td>
                {!! Form::open(['style'=>'display:inline-block;','method' => 'PUT', 'route'=>['backend.blog.restore',$post->id]]) !!}

                @if(check_user_permissions($request,"Blog@restore",$post->id))
                    <button title="Restaurar" type="submit" class="btn btn-xs btn-primary">
                        <i class="fa fa-trash-restore"></i>
                    </button>
                @else
                    <button type="button" onclick="return false" class="btn btn-xs btn-primary disabled">
                        <i class="fa fa-trash-restore"></i>
                    </button>
                @endif
                {!! Form::close() !!}

                {!! Form::open(['style'=>'display:inline-block;','method' => 'DELETE', 'route'=>['backend.blog.force-destroy',$post->id]]) !!}

                @if(check_user_permissions($request,"Blog@forceDestroy",$post->id))
                    <button title="Eliminar Permanentemente"
                            onclick="return confirm('Você está prestes a excluír permanentemente o seu post. Tem a certeza?')"
                            type="submit" class="btn btn-xs btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                @else
                    <button onclick="return false" type="button" class="btn btn-xs btn-danger disabled">
                        <i class="fa fa-trash"></i>
                    </button>
                @endif
                {!! Form::close() !!}
            </td>
            <td>{{$post->title}}</td>
            <td>{{$post->author->name}}</td>
            <td>{{$post->category->title}}</td>
            <td>
                <abbr title="{{$post->dateFormatted(true)}}">{{$post->dateFormatted()}}</abbr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
