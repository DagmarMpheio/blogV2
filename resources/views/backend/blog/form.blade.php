<?php
/**
 * Created by PhpStorm.
 * User: Dagmar Mpheio
 * Date: 10/27/2020
 * Time: 2:57 PM
 */
?>

<div class="col-xs-9">
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body ">

            @csrf

            <div class="form-group {{$errors->has('title') ? ' has-error' : ''}} has-feedback">
                {!! Form::label('title','Título') !!}
                {!! Form::text('title',null,['class'=>'form-control']) !!}

                @if ($errors->has('title'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('title')}}</strong>
                                </span>
                @endif
            </div>

            <div class="form-group {{$errors->has('slug') ? ' has-error' : ''}} has-feedback">
                {!! Form::label('slug') !!}
                {!! Form::text('slug',null,['class'=>'form-control']) !!}

                @if ($errors->has('slug'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('slug')}}</strong>
                                </span>
                @endif
            </div>

            <div class="form-group {{$errors->has('excerpt') ? ' has-error' : ''}} has-feedback excerpt">
                {!! Form::label('excerpt') !!}
                {!! Form::textarea('excerpt',null,['class'=>'form-control']) !!}

                @if ($errors->has('excerpt'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('excerpt')}}</strong>
                                </span>
                @endif
            </div>

            <div class="form-group {{$errors->has('body') ? ' has-error' : ''}} has-feedback">
                {!! Form::label('body','Corpo') !!}
                {!! Form::textarea('body',null,['class'=>'form-control']) !!}

                @if ($errors->has('body'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('body')}}</strong>
                                </span>
                @endif
            </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer clearfix">
            <div class="pull-left">
                {{-- {{$posts->links()}}--}}
            </div>

            <div class="pull-right">
                <small>{{--{{$postCount}} {{Str::Plural('Item',$postCount)}}--}}</small>
            </div>
        </div>
    </div>
    <!-- /.box -->
</div>

<div class="col-xs-3">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Publicar</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('published_at','Data de Publicação') !!}
                {!! Form::text('published_at', null, ['class'=>'form-control','placeholder'=>'Y-m-d H:i:s']) !!}

                {{--@if ($errors->has('published_at'))
                    <span class="help-block">
                    <strong>{{ $errors->first('published_at')}}</strong>
                </span>
                @endif--}}
            </div>
        </div>

        <div class="box-footer">
            <div class="pull-left">
                <a href="#" class="btn btn-default" id="draft-btn">Guardar o rascunho</a>
            </div>
            <div class="pull-right">
                {!! Form::submit('Publicar',['class'=>'btn btn-primary']) !!}
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Categoria</h3>
        </div>
        <div class="box-body">
            <div class="form-group {{$errors->has('category_id') ? ' has-error' : ''}} has-feedback">
                {!! Form::select('category_id',App\Category::pluck('title','id'),null,['class'=>'form-control','placeholder'=>'Escolha a categoria']) !!}

                @if ($errors->has('category_id'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('category_id')}}</strong>
                                </span>
                @endif
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Tags</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {!! Form::text('post_tags', null, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Imagem do Post</h3>
        </div>
        <div class="box-body text-center">
            <div class="form-group {{$errors->has('image') ? ' has-error' : ''}} has-feedback">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                        <img src="{{ ($post->image_thumb_url) ? $post->image_thumb_url : '/backend/img/no-image.png'}}"
                             alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail"
                         style="max-width: 200px; max-height: 150px;"></div>
                    <div>
                                            <span class="btn btn-default btn-file"><span class="fileinput-new">Seleccione a imagem</span><span
                                                        class="fileinput-exists">Mudar</span>{!! Form::file('image') !!}</span>
                        <a href="#" class="btn btn-default fileinput-exists"
                           data-dismiss="fileinput">Remover</a>
                    </div>
                </div>

                @if ($errors->has('image'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('image')}}</strong>
                                </span>
                @endif
            </div>

        </div>
    </div>
</div>
