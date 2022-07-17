@extends('layoutt.dashboard')
@section('head')
    <title>{{ __('Category') }}</title>
@endsection
@section('body')
    @livewire('category.control')
@endsection
