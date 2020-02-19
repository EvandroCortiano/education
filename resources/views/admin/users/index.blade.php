@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Usuários</h3>
            {!! Button::primary(Icon::user().' Novo usuário')->asLinkTo(route('admin.users.create')) !!}
            <br><br>
        </div>
        <div class="row">
            {!! Table::withContents($users->items())->striped()->bordered()
                    ->hover()
                    ->callback('Ações', function($field, $model){
                        $linkEdit = route('admin.users.edit', ['user' => $model->id]);
                        $linkShow = route('admin.users.show', ['user' => $model->id]);
                        return Button::link(Icon::create('pencil').' Editar')->asLinkTo($linkEdit)." | ".
                            Button::link(Icon::create('folder-open').'&nbsp;&nbsp;Ver')->asLinkTo($linkShow);
                    })
            !!}

            {!! $users->links() !!}
        </div>
    </div>
@endsection