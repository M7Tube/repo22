@extends('layoutt.dashboard')
@section('head')
    <title>{{ __('Template') }}</title>
@endsection
@section('body')
    @livewire('template.index')
@endsection
