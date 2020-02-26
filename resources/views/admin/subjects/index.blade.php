@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Disciplinas</h3>
            {!! Button::primary('Nova disciplina')->asLinkTo(route('admin.subjects.create')) !!}
            <br><br>
        </div>
        <div class="row">
            {!! Table::withContents($subjects->items())->striped()
                    ->hover()
                    ->callback('Ações', function($field, $model){
                        $linkEdit = route('admin.subjects.edit',['subject' => $model->id]);
                        $linkShow = route('admin.subjects.show',['subject' => $model->id]);
                        return Button::link(Icon::create('pencil').' Editar')->asLinkTo($linkEdit).'|'.
                            Button::link(Icon::create('folder-open').'&nbsp;&nbsp;Ver')->asLinkTo($linkShow);
                    })
            !!}
        </div>

        {!! $subjects->links() !!}
    </div>
@endsection