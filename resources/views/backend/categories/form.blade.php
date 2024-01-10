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

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">{{$category->exists ? 'Actualizar' : 'Salvar'}}</button>
            <a href="{{route('backend.categories.index')}}" class="btn btn-default">Cancelar</a>
        </div>
    </div>
    <!-- /.box -->
</div>

