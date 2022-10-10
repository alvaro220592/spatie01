@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header fs-5">Perfis de acesso</div>

                    <div class="card-body p-3">
                        <div class="accordion" id="accordionExample">
                            @foreach ($roles as $role)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button id="botao_accordion_{{ $role->id }}" class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
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
                                                    @foreach ($permissions as $permission)
                                                        <!-- Se minha role tiver permissão para esta permission, vai ficar checkado -->
                                                        <li>
                                                            <input type="checkbox" name="{{ $permission->id }}" id="{{ $permission->id }}" class="role_{{ $role->id }}_permission" @if ($role->hasPermissionTo($permission->name)) checked @endif>&nbsp;<label for="{{ $permission->id }}">@lang("labels.$permission->name")</label>
                                                        </li>
                                                    @endforeach
                                                    <button class="btn btn-dark mt-2" type="submit" onclick="updateRole(event, {{ $role->id }})">Salvar</button>
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

