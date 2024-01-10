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
        <td>Nome da Categoria</td>
        <td width="150">Números de Posts</td>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
        <tr>
            <td>
                {!! Form::open(['method' => 'DELETE', 'route'=>['backend.categories.destroy',$category->id]]) !!}
                <a title="Editar" href="{{route('backend.categories.edit',$category->id)}}"
                   class="btn btn-xs btn-primary">
                    <i class="fa fa-edit"></i>
                </a>

                @if($category->id == config('cms.default_category_id'))
                    <button onclick="return false" title="Excluír" type="submit"
                            class="btn btn-xs btn-danger disabled">
                        <i class="fa fa-trash"></i>
                    </button>
                @else
                    <button onclick="confirm('Tem a certeza?')" title="Excluír" type="submit"
                            class="btn btn-xs btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                @endif
                {!! Form::close() !!}
            </td>
            <td>{{$category->title}}</td>
            <td>{{$category->posts->count()}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
