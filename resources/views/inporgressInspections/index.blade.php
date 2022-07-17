@extends('layoutt.dashboard')
@section('head')
    <title>{{ __('in Porgress Inspections') }}</title>
@endsection
@section('body')
    @livewire('inporgress-inspections.index')
@endsection
