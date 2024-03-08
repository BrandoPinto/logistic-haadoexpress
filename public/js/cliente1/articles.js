//PASANDO DATOS DE TABLA AL MODAL PARA EDITAR
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-article-button');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const description = this.getAttribute('data-description');
            const idInput = document.getElementById('id_input');
            const descriptionInput = document.getElementById('description_input');

            idInput.value = id;
            descriptionInput.value = description;

            // Abre el modal utilizando Bootstrap 5
            const modal = new bootstrap.Modal(document.getElementById('modal-edit-articles'));
            modal.show();
        });
    });
});