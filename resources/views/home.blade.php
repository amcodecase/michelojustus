@extends('layouts.app')

@section('content')
    @include('components.hero', ['data' => $data])
    @include('components.offerings')
    @include('components.services', ['data' => $data])
    @include('components.projects', ['data' => $data])
    @include('components.experience', ['data' => $data])
    @include('components.contact', ['data' => $data])
@endsection
