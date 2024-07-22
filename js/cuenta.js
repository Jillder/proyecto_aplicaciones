document.addEventListener('DOMContentLoaded', function() {
    fetch('../php/obtener_datos.php')
        .then(response => response.json())
        .then(data => {
            const reservasTable = document.getElementById('reservas-table').getElementsByTagName('tbody')[0];
            data.reservas.forEach(reserva => {
                const row = reservasTable.insertRow();
                row.insertCell(0).textContent = reserva.fecha;
                row.insertCell(1).textContent = reserva.hora;
                row.insertCell(2).textContent = reserva.tamano_mesa;
                row.insertCell(3).textContent = reserva.restaurante_nombre;

                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Eliminar';
                deleteButton.setAttribute('data-id', reserva.id);
                deleteButton.addEventListener('click', function() {
                    eliminarReserva(reserva.id);
                });
                row.insertCell(4).appendChild(deleteButton);    
            });
        });
});

function eliminarReserva(idReserva) {
    const formData = new FormData();
    formData.append('id', idReserva);

    fetch('../php/eliminar_reserva.php', {
        method: 'POST',
        body: formData 
    })
    .then(response => {
        if (response.ok) {
            console.log('Reserva eliminada correctamente');
            const row = document.querySelector(`button[data-id='${idReserva}']`).closest('tr');
            if (row) {
                row.remove();
            }
        } else {
            console.error('Error al eliminar la reserva');
        }
    })
    .catch(error => {
        console.error('Error al eliminar la reserva:', error);
    });
}
