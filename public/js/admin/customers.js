document.addEventListener('DOMContentLoaded', function () {
    //INICIALIZANDO DATATABLE
    $(document).ready(function () {
        $('.table-users').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
            },
            drawCallback: function () {
                const pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
                pagination.find('.paginate_button.previous').html('<i class="fas fa-arrow-circle-left"></i>').addClass('pagination-icon');
                pagination.find('.paginate_button.next').html('<i class="fas fa-arrow-circle-right"></i>').addClass('pagination-icon');
            }
        });
    });

    //MOSTRANDO CONTRASEÑA EN FORMULARIO
    $(document).ready(function () {
        $('#togglePassword').on('click', function () {
            const passwordInput = $('#passwordInput');
            const passwordFieldType = passwordInput.attr('type');

            if (passwordFieldType === 'password') {
                passwordInput.attr('type', 'text');
            } else {
                passwordInput.attr('type', 'password');
            }
        });
    });


    $(document).ready(function () {
        $('#rolSelect').change(function () {
            var selectedValue = $(this).val();
            if (selectedValue == '4') {
                $('#infoEmpresaRow').show();
            } else {
                $('#infoEmpresaRow').hide();
            }
        });
    });
});


//Eliminar btn sub email
document.addEventListener('DOMContentLoaded', function () {
    const deleteBtns = document.querySelectorAll('.deleteEmail');

    deleteBtns.forEach((btn) => {
        btn.addEventListener('click', function () {
            const emailId = this.getAttribute('data-id');
            console.log('ID a eliminar:', emailId);

            Swal.fire({
                title: '¿Estás seguro?',
                text: '¡No podrás revertir esto!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminarlo'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar la solicitud Fetch con el token CSRF y el id del correo electrónico

                    fetch('/eliminar/subemail', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            body: JSON.stringify({
                                emailId: emailId
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Manejar la respuesta del servidor
                            Swal.fire('Eliminado', 'Tu registro ha sido eliminado.', 'success');
                            // Puedes realizar acciones adicionales después de eliminar
                            // por ejemplo, recargar la página o actualizar la lista de correos electrónicos
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error', 'Hubo un error al eliminar el registro.', 'error');
                        });
                }
            });
        });
    });
});
