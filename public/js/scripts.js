let token = document.querySelector("meta[name='csrf-token']").content;

var tempo = 3000

async function updateRole(event, role_id) {
    event.preventDefault();

    let checks = document.querySelectorAll(`input[class='role_${role_id}_permission']`)
    ids_permissoes = []

    checks.forEach(check => {
        if (check.checked == true) {
            ids_permissoes.push(check.name);
        }
    })

    fetch(`/perfis/editar/${role_id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            "X-CSRF-TOKEN": token
        },
        body: JSON.stringify({
            permissions: ids_permissoes
        })
    }).then(response => {
        return response.json()

    }).then(data => {
        Toast.fire({
            icon: 'success',
            title: data.response
        })

        setTimeout(() => {
            document.getElementById(`botao_accordion_${role_id}`).click()
        }, tempo);

    }).catch(error => console.error(error));

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
}