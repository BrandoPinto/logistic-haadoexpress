//Inicializando SELECT2
$(document).ready(function () {
    $('.select2').select2({
        width: '100%'
    });
});


//HABILITAR INPUTS DE ACUERDO AL TIPO DE PEDIDO
$(document).ready(function () {
    const typeOrderInput = document.getElementById("input-type-order");
    // Escucha cambios en el select
    $("#select-type").change(function () {
        // Obtiene el valor seleccionado
        const selectedValue = $(this).val();

        // Oculta ambos divs por defecto
        $("#div-email").addClass("d-none");
        $("#div-dni").addClass("d-none");
        $("#div-method").addClass("d-none");
        $("#div-amount").addClass("d-none");
        $("#div-agency").addClass("d-none");
        $("#div-location").addClass("d-none");

        if (selectedValue == 1) {
            typeOrderInput.value = 1;
            $("#div-dni").removeClass("d-none");
            $("#div-agency").removeClass("d-none");
        } else if (selectedValue == 2) {
            typeOrderInput.value = 2;
            $("#div-email").removeClass("d-none");
            $("#div-method").removeClass("d-none");
            $("#div-amount").removeClass("d-none");
            $("#div-location").removeClass("d-none");
        }
    });
});

//PASANDO DATOS DE INPUT A LA TABLA
document.addEventListener("DOMContentLoaded", function () {
    // Obtener referencia a los elementos del formulario
    const articleSelect = document.getElementById("articleSelect");
    const quantityArticleInput = document.getElementById("quantity_article");
    const tablaArticulos = document.getElementById("tablaArticulos");

    // Agregar un controlador de eventos al botón "Agregar producto"
    document.getElementById("addButton").addEventListener("click", function () {
        // Obtener los valores de los campos del formulario
        const id_article = articleSelect.value;
        const article = articleSelect.options[articleSelect.selectedIndex].text;
        const quantityArticle = quantityArticleInput.value;

        // Crear una nueva fila en la tabla con los valores ingresados
        const newRow = tablaArticulos.insertRow();

        // Agregar celdas a la fila
        const idCell = newRow.insertCell();
        const articleCell = newRow.insertCell();
        const quantityCell = newRow.insertCell();
        const actionsCell = newRow.insertCell(); // Agregar celda para acciones

        // Crear elementos de input
        const idInput = document.createElement("input");
        idInput.type = "number";
        idInput.value = id_article;
        idInput.name = "id[]";
        idInput.classList.add("form-control");
        idCell.appendChild(idInput);

        const articleInput = document.createElement("input");
        articleInput.type = "text";
        articleInput.value = article;
        articleInput.name = "article[]";
        articleInput.readOnly = true;
        articleInput.classList.add("form-control");
        articleCell.appendChild(articleInput);

        const quantityArticleInputCell = document.createElement("input");
        quantityArticleInputCell.type = "number";
        quantityArticleInputCell.value = quantityArticle;
        quantityArticleInputCell.name = "quantityArticle[]";
        quantityArticleInputCell.readOnly = true;
        quantityArticleInputCell.classList.add("form-control");
        quantityCell.appendChild(quantityArticleInputCell);

        idCell.style.display = "none";

        // Agregar botón de eliminar a la celda de acciones
        const deleteButton = document.createElement("button");
        deleteButton.classList.add("btn", "btn-danger");
        deleteButton.innerHTML = '<i class="fas fa-trash"></i>';
        deleteButton.type = "button"; // Tipo de botón
        deleteButton.addEventListener("click", function () {
            tablaArticulos.deleteRow(-1); // Eliminar la última fila
        });
        actionsCell.appendChild(deleteButton);

        // Limpiar los campos del formulario
        quantityArticleInput.value = "";
        $("#articleSelect").val(null).trigger('change'); // Limpiar y desencadenar el evento de cambio en el select2


    });


    //Obteniendo sub agencias de acuerdo a la agencia seleccionada.
    const citySelect = document.getElementById("city-select");
    const addressLabel = document.getElementById("address-label");
    citySelect.addEventListener("change", function () {
        const selectedCity = citySelect.value;
        updateDistrictOptions(selectedCity);
    });

    function updateDistrictOptions(selectedCity) {
        const requestOptions = {
            method: 'POST',
            body: JSON.stringify({
                selectedCity,
                _token: csrfToken
            }),
            headers: {
                'Content-Type': 'application/json'
            }
        };

        fetch('/select/value/city', requestOptions)
            .then(response => response.json())
            .then(data => {
                const districtSelect = document.getElementById("district-select");
                const districtDiv = document.getElementById('div-district');
                districtSelect.innerHTML = "";

                data.forEach(option => {
                    const optionElement = document.createElement("option");
                    optionElement.value = option.idDistrict;
                    optionElement.textContent = option.district;
                    districtSelect.appendChild(optionElement);
                });

                if (data.some(option => option.type === 2)) {
                    districtSelect.readOnly = true;
                    districtDiv.style.display = 'none';
                    addressLabel.innerHTML = "DIRECCION y DISTRITO <span class='text-danger'>*</span>"
                } else {
                    districtDiv.style.display = 'block';
                    districtSelect.readOnly = false;
                    addressLabel.innerHTML = "DIRECCION <span class='text-danger'>*</span>"
                }

                districtSelect.style.display = data.length > 0 ? "block" : "none";
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }



});
