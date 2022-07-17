@extends('layoutt.dashboard')
@section('head')
    <title>{{ __('Questions') }}</title>
@endsection
@section('body')
    @livewire('attrubite.index')
@endsection
