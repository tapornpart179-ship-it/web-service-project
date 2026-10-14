@extends('template.backend.master')

@section('content')

  @livewire('editusertable', ['id' => $id])

@endsection