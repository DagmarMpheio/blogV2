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
                {!! Form::open(['method' => 'DELETE', 'route'=>['backend.blog.destroy',$post->id]]) !!}

                @if(check_user_permissions($request,"Blog@edit",$post->id))
                    <a title="Editar" href="{{route('backend.blog.edit',$post->id)}}"
                       class="btn btn-xs btn-primary">
                        <i class="fa fa-edit"></i>
                    </a>
                @else
                    <a href="#" class="btn btn-xs btn-primary disabled">
                        <i class="fa fa-edit"></i>
                    </a>
                @endif

                @if(check_user_permissions($request,"Blog@destroy",$post->id))
                    <button title="Mover para Reciclagem" type="submit" class="btn btn-xs btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                @else
                    <button type="button" onclick="return false" class="btn btn-xs btn-danger disabled">
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
                |
                {!!$post->publicationLabel()!!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
