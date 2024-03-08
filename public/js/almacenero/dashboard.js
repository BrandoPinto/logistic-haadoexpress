//DATATABLES PARA LAS TABLAS DEL DASHBOARD
$('.table-dashboard').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
    },
    drawCallback: function () {
        const pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
        pagination.find('.paginate_button.previous').html('<i class="fas fa-arrow-circle-left"></i>').addClass('pagination-icon');
        pagination.find('.paginate_button.next').html('<i class="fas fa-arrow-circle-right"></i>').addClass('pagination-icon');
    }
});
//ACTUALIZANDO EL ESTADO DEL REABASTECIMIENTO y ASIGNANDO DELIVERY
document.addEventListener('DOMContentLoaded', function () {
    const resupply = document.querySelectorAll('.btn-resupply-state')
    const delivery = document.querySelectorAll('.btn-assign-delivery')
    const fulfillment = document.querySelectorAll('.btn-assign-fulfillment')
    resupply.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const idInput = document.getElementById('idInput');

            idInput.value = id;

        });
    });

    delivery.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const idInputOrders = document.getElementById('idOrders');

            idInputOrders.value = id;

        });
    });

    fulfillment.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const idInputArticle = document.getElementById('idArticle');

            idInputArticle.value = id;

        });
    });


});
