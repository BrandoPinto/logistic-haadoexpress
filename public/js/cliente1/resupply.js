document.addEventListener("DOMContentLoaded", function () {
    // Obtener referencia a los elementos del formulario
    const heightInput = document.getElementById("heightInput");
    const widthInput = document.getElementById("widthInput");
    const depthInput = document.getElementById("depthInput");
    const quantityBoxInput = document.getElementById("quantityBoxInput");
    const articleSelect = document.getElementById("articleSelect");
    const quantityArticleInput = document.getElementById("quantityArticleInput");
    const tablaProductos = document.getElementById("tablaProductos");

    // Agregar un controlador de eventos al botón "Agregar producto"
    document.getElementById("addButton").addEventListener("click", function () {
        // Obtener los valores de los campos del formulario
        const height = heightInput.value;
        const width = widthInput.value;
        const depth = depthInput.value;
        const quantityBox = quantityBoxInput.value;
        const id_article = articleSelect.value;
        const article = articleSelect.options[articleSelect.selectedIndex].text;
        const quantityArticle = quantityArticleInput.value;

        // Crear una nueva fila en la tabla con los valores ingresados
        const newRow = tablaProductos.insertRow();

        // Agregar celdas a la fila
        const idCell = newRow.insertCell();
        const articleCell = newRow.insertCell();
        const heightCell = newRow.insertCell();
        const widthCell = newRow.insertCell();
        const depthCell = newRow.insertCell();
        const quantityBoxCell = newRow.insertCell();
        const quantityArticleCell = newRow.insertCell();
        const actionsCell = newRow.insertCell();

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

        const heightInputCell = document.createElement("input");
        heightInputCell.type = "number";
        heightInputCell.value = height;
        heightInputCell.name = "height[]";
        heightInputCell.classList.add("form-control");
        heightCell.appendChild(heightInputCell);

        const widthInputCell = document.createElement("input");
        widthInputCell.type = "number";
        widthInputCell.value = width;
        widthInputCell.name = "width[]";
        widthInputCell.classList.add("form-control");
        widthCell.appendChild(widthInputCell);

        const depthInputCell = document.createElement("input");
        depthInputCell.type = "number";
        depthInputCell.value = depth;
        depthInputCell.name = "depth[]";
        depthInputCell.classList.add("form-control");
        depthCell.appendChild(depthInputCell);

        const quantityBoxInputCell = document.createElement("input");
        quantityBoxInputCell.type = "number";
        quantityBoxInputCell.value = quantityBox;
        quantityBoxInputCell.name = "quantityBox[]";
        quantityBoxInputCell.readOnly = true;
        quantityBoxInputCell.classList.add("form-control");
        quantityBoxCell.appendChild(quantityBoxInputCell);

        const quantityArticleInputCell = document.createElement("input");
        quantityArticleInputCell.type = "number";
        quantityArticleInputCell.value = quantityArticle;
        quantityArticleInputCell.name = "quantityArticle[]";
        quantityArticleInputCell.readOnly = true;
        quantityArticleInputCell.classList.add("form-control");
        quantityArticleCell.appendChild(quantityArticleInputCell);


        // Ocultar celdas
        idCell.style.display = "none";
        heightCell.style.display = "none";
        widthCell.style.display = "none";
        depthCell.style.display = "none";

        // Agregar botón de eliminar a la celda de acciones
        const deleteButton = document.createElement("button");
        deleteButton.classList.add("btn", "btn-danger");
        deleteButton.innerHTML = '<i class="fas fa-trash"></i>';
        deleteButton.type = "button"; // Tipo de botón
        deleteButton.addEventListener("click", function () {
            tablaProductos.deleteRow(-1); // Eliminar la última fila
        });
        actionsCell.appendChild(deleteButton);

        // Limpiar los campos del formulario
        heightInput.value = "";
        widthInput.value = "";
        depthInput.value = "";
        quantityBoxInput.value = "";
        articleSelect.value = "";
        quantityArticleInput.value = "";
        checkboxFulfillment.checked = false;
    });
});
