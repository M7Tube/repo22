@extends('layoutt.dashboard')
@section('head')
    <title>{{ __('Document') }}</title>
@endsection
@section('body')
    @livewire('document.index')
@endsection
