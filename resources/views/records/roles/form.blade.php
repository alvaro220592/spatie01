<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro de perfil de acesso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <form action="" method="post">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" name="name" id="role_name" class="form-control" placeholder="Nome do perfil de acesso" onkeypress="return event.charCode != 32">
                        </div>
                    </div>

                    <h5>Permissões do perfil:</h5>
                    <ul class="permissions-list">
                        @csrf
                        @foreach ($funcionalities as $funcionality)
                            <div class="mb-3">
                                <strong>@lang("labels.profile.$funcionality->name")</strong>

                                @foreach ($funcionality->permissions as $permission)
                                    <li>
                                        <input type="checkbox" name="{{ $permission->id }}" id="{{ $permission->name }}" class="permissions">&nbsp;<label                                                for="{{ $permission->id }}">@lang("labels.$permission->name")</label>
                                    </li>
                                @endforeach
                            </div>
                        @endforeach
                    </form>
                </ul>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" id="btn_close_modal">Cancelar</button>
                <button type="button" class="btn btn-dark btn-sm" onclick="createRole(event)">Salvar</button>
            </div>
        </div>
    </div>
</div>