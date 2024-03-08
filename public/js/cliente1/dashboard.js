 // MES ACTUAL
 function getMonthName(month) {
    var months = [
        'Enero', 'Febrero', 'Marzo', 'Abril',
        'Mayo', 'Junio', 'Julio', 'Agosto',
        'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];
    return months[month];
}

// Obtén el nombre del mes en español
var startOfMonth = new Date();
startOfMonth.setDate(1); // Establece el día en 1 para obtener el primer día del mes
var formattedMonth = getMonthName(startOfMonth.getMonth());

// Asigna el nombre del mes al elemento HTML
document.getElementById('month').innerText = formattedMonth;