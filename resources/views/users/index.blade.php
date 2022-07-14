@extends('layoutt.dashboard')
@section('head')
    <title>{{ __('User') }}</title>
@endsection
@section('body')
    @livewire('users.index')
@endsection
