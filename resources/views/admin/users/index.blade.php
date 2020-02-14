@extends('layouts')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Usuários</h3>
            {!! Button::primary('Novo usuário') !!}
            {!!
                format($form->add('insert','submit',[
                    'attr' => ['class' => 'btn btn-primary btn-block'],
                    'label' => 'Inserir'
                ]))    
            !!}
        </div>
    </div>
@endsection