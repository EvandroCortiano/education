@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Adicionar disciplina e professor na turma</h3>
            <!-- Criar um componente Vue.js -->
            <class-teaching class-information="{{$class_information->id}}"></class-teaching>
        </div>    
    </div>    
@endsection