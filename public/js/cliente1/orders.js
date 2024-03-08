$('#tableOrder').DataTable().destroy(); // Revertir la inicialización anterior
$('.table-orders').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
    },
    drawCallback: function () {
        const pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
        pagination.find('.paginate_button.previous').html('<i class="fas fa-arrow-circle-left"></i>').addClass('pagination-icon');
        pagination.find('.paginate_button.next').html('<i class="fas fa-arrow-circle-right"></i>').addClass('pagination-icon');
    }
});

