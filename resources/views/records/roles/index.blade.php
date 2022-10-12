@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header fs-5">Perfis de acesso</div>

                    <div class="card-body p-3">

                        {{-- Botão de cadastro --}}
                        <button type="button" class="btn btn-dark btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Cadastrar
                        </button>

                        {{-- Accordion com as roles e dentro de cada uma, as permissions --}}
                        <div class="accordion" id="accordionExample">
                            @foreach ($roles as $role)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button id="botao_accordion_{{ $role->id }}" class="accordion-button collapsed"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne{{ $role->name }}" aria-expanded="true"
                                            aria-controls="collapseOne{{ $role->name }}">
                                            <strong>{{ $role->name }}</strong>
                                        </button>
                                    </h2>
                                    <div id="collapseOne{{ $role->name }}" class="accordion-collapse collapse"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul class="permissions-list">
                                                <form action="" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        @foreach ($funcionalities as $funcionality)
                                                            <div class="mb-3 col-md-6">
                                                                <strong>@lang("labels.profile.$funcionality->name")</strong>

                                                                @foreach ($funcionality->permissions as $permission)
                                                                    <li>
                                                                        <input type="checkbox" name="{{ $permission->id }}"
                                                                            id="{{ $permission->id }}"
                                                                            class="role_{{ $role->id }}_permission"
                                                                            @if ($role->hasPermissionTo($permission->name)) checked @endif>&nbsp;<label
                                                                            for="{{ $permission->id }}">@lang("labels.$permission->name")</label>
                                                                    </li>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="row">
                                                            <div class="col-md-2 mb-2">
                                                                <button class="btn btn-dark btn-sm form-control" type="submit" onclick="updateRole(event, {{ $role->id }})">Salvar</button>
                                                            </div>
                                                            <div class="col-md-2 mb-2">
                                                                <button class="btn btn-danger btn-sm form-control">Excluir</button>
                                                            </div>
                                                    </div>
                                                </form>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('records.roles.form')
