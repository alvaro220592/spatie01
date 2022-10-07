@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Perfis de acesso</div>
                
                <div class="card-body p-3">
                    @foreach($roles as $role)
                        <div class="card mb-3 p-3">
                            <ul class="roles-list">
                                <li><h5><strong>{{ $role->name }}</strong></h5></li>
                                <h6>Permissões</h6>
                                <ul class="permissions-list">
                                    @foreach ($permissions as $permission)
                                        {{-- Se minha role tiver permissão para esta permission, vai ficar checkado --}}
                                        <li><input type="checkbox" name="" id="" @if($role->hasPermissionTo($permission->name)) checked @endif >&nbsp;@lang("labels.$permission->name")</li>
                                    @endforeach
                                </ul>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
