@extends('layoutt.dashboard')
@section('head')
    <title>{{ __('Selector') }}</title>
@endsection
@section('body')
    @livewire('selector.index')
@endsection
