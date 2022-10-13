let token = document.querySelector("meta[name='csrf-token']").content;

var tempo = 3000

// Toast
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: tempo,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

// Confirmação
const Confirm = Swal.mixin({
    confirmButtonText: 'Sim',
    cancelButtonText: 'Não',
    showCancelButton: true,
    showCloseButton: true
})

getRoles()

function getRoles() {


    fetch(`perfis/getRoles`)
        .then(res => res.json())
        .then(data => {
            console.log(data);

            data.funcionalities.forEach(funcionality => {
                console.log(funcionality);

                document.getElementById('teste').innerHTML += `
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th colspan="2">${funcionality.name}</th>
                        </tr>
                        </thead>
                        <tbody>`

                        funcionality.permissions.forEach(permission => {
                            document.querySelector('tbody').innerHTML +=`
                                <tr>
                                    <td><input type="checkbox"></th>
                                    <td>${permission.name}</td>
                                </tr>`
                        })
                        document.getElementById('teste').innerHTML +=`
                        </tbody>
                    </table>
                </div>
                `
            })
        })
        .catch(error => console.log(error))
}

function createRole(event) {
    event.preventDefault();

    let role_name = document.getElementById('role_name').value

    let permissions = document.querySelectorAll('.permissions');

    let permissions_list = []

    permissions.forEach(permission => {
        if (permission.checked) {
            permissions_list.push(permission.id)
        }
    })

    console.log(permissions_list);

    fetch(`/perfis`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            "X-CSRF-TOKEN": token
        },
        body: JSON.stringify({
            name: role_name,
            permissions_list: permissions_list
        })
    }).then(response => response.json())

        .then(data => {
            Toast.fire({
                icon: 'success',
                title: data.response
            })

            setTimeout(() => {
                document.getElementById(`btn_close_modal`).click()
            }, tempo);
        })

        .then(error => console.log(error))

}

function updateRole(event, role_id) {
    event.preventDefault();

    let checks = document.querySelectorAll(`input[class='role_${role_id}_permission']`)
    ids_permissoes = []

    checks.forEach(check => {
        if (check.checked == true) {
            ids_permissoes.push(check.name);
        }
    })

    fetch(`/perfis/${role_id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            "X-CSRF-TOKEN": token
        },
        body: JSON.stringify({
            permissions: ids_permissoes
        })
    })
        .then(response => response.json())

        .then(data => {
            if (data.success) {
                Toast.fire({
                    icon: 'success',
                    title: data.response
                })
            }

            setTimeout(() => {
                document.getElementById(`botao_accordion_${role_id}`).click()
            }, tempo);

        }).catch(error => console.error(error));
}

function deleteRole(role_id) {

    Confirm.fire({
        title: 'Tem certeza?'
    })
        .then((result) => {
            if (result.isConfirmed) {

                fetch(`/perfis/${role_id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Toast.fire({
                                icon: 'success',
                                title: data.response
                            })
                        }
                        setTimeout(() => {
                            document.getElementById(`botao_accordion_${role_id}`).click()
                        }, tempo);
                    })
                    .catch(error => console.log(error))
            }
        })
}