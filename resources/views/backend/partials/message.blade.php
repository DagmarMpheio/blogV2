<?php
/**
 * Created by PhpStorm.
 * User: Dagmar Mpheio
 * Date: 10/27/2020
 * Time: 10:52 PM
 */
?>
@if(session('message'))
    <div class="alert alert-info">
        {{session('message')}}
    </div>
@elseif(session('error-message'))
    <div class="alert alert-danger">
        {{session('error-message')}}
    </div>
@elseif(session('trash-message'))
    <div class="alert alert-info">
        <?php list($message, $postId) = session('trash-message');?>
        {{ $message }}
        {!! Form::open(['method' => 'PUT','route'=>['backend.blog.restore',$postId]]) !!}
        <button type="submit" class="btn btn-sm btn-warning"><i class="fa fa-undo"></i> Desfazer</button>
        {!! Form::close() !!}
    </div>
@endif
