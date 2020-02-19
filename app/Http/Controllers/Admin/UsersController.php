<?php

namespace EDU\Http\Controllers\Admin;

use EDU\Forms\UserForm;
use EDU\Models\User;
use Illuminate\Http\Request;
use EDU\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\Facades\FormBuilder;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = FormBuilder::create(UserForm::class, [
            'url' => route('admin.users.store'),
            'method' => 'POST'
        ]);
        return view('admin.users.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** @var Form $form */
        $form = FormBuilder::create(UserForm::class);

        // verifica se eh valido
        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        // pega somente os valores relativo aos campos, 
        // 'seguranca' não vai nada que não seja os valores dos campos do formulario
        $data = $form->getFieldValues();
        $result = User::createFully($data);

        //retorna a mensagem de sucesso
        $request->session()->flash('message', "Usuário ".$data['name']." criado com sucesso!");
        $request->session()->flash('user_created',[
            'id' => $result['user']->id,
            'password' => $result['password']
        ]);

        return redirect()->route('admin.users.show_details');
    }

    public function showDetails()
    {
        $userData = session('user_created');
        $user = User::findOrFail($userData['id']);
        $user->password = $userData['password'];
        return view('admin.users.show_details', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \EDU\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \EDU\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $form = FormBuilder::create(UserForm::class, [
            'url' => route('admin.users.update', ['user'=>$user->id]),
            'method' => 'PUT',
            'model' => $user
        ]);
        return view('admin.users.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \EDU\Models\User  $user
     */
    public function update(Request $request, User $user)
    {
        /** @var Form $form */
        $form = FormBuilder::create(UserForm::class, [
            'data' => ['id' => $user->id]
        ]);

        // verifica se eh valido
        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $user->update($data);
        session()->flash('message', "Usuário editado com sucesso!");

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \EDU\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('message', "Usuário excluido com sucesso!");
        return redirect()->route('admin.users.index');
    }
}
