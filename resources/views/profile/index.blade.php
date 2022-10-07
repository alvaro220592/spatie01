@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Perfis de acesso</div>
                
                <div class="card-body">
                    @foreach($roles as $role)
                        <ul>
                            <li><h5>{{ $role->name }}</h5></li>
                            <ul>
                                @foreach ($role->permissions as $permission)                                    
                                    <li><input type="checkbox" name="" id="">@lang("labels.$permission->name")</li>
                                @endforeach
                            </ul>
                        </ul>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
