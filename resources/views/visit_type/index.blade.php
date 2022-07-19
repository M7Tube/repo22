@extends('layoutt.dashboard')
@section('head')
    <title>{{ __('Visit Type') }}</title>
@endsection
@section('body')
    @livewire('visit-type.index')
@endsection
