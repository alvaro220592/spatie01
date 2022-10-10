@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-3">
                    @can('user_create')
                        <div class="col-md-3">
                            <button class="btn btn-dark btn-sm form-control mb-3">Cadastrar</button>
                        </div>
                    @endcan

                    @can('user_read')
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Cadastro</th>
                                    @can(['user_read', 'user_edit', 'user_delete'])
                                        <th>Ações</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>

                                        @can(['user_read', 'user_edit', 'user_delete'])
                                            <td class="justify-content-between">
                                                @can('user_read')
                                                    <i class="bi bi-eye-fill mx-1"></i>
                                                @endcan
                                                @can('user_edit')
                                                    <i class="bi bi-pencil-fill mx-1"></i>
                                                @endcan
                                                @can('user_delete')
                                                    <i class="bi bi-trash-fill mx-1"></i>
                                                @endcan
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
