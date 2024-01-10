@extends('errors::illustrated-layout')

@section('title', __('Acesso Proibido'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Acesso Proibido'))
