@extends('layoutt.dashboard')
@section('head')
    <title>{{ __('TextBoxes') }}</title>
@endsection
@section('body')
    @livewire('textbox.index')
@endsection
