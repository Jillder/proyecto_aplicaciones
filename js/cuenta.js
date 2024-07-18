document.addEventListener('DOMContentLoaded', function() {
    fetch('../php/obtener_datos.php')
        .then(response => response.json())
        .then(data => {
          //  const usuariosTable = document.getElementById('usuarios-table').getElementsByTagName('tbody')[0];
        //    data.usuarios.forEach(usuario => {
      //          const row = usuariosTable.insertRow();
    //            row.insertCell(0).textContent = usuario.usuario;
  //              row.insertCell(1).textContent = usuario.correo;
//            });

            const reservasTable = document.getElementById('reservas-table').getElementsByTagName('tbody')[0];
            data.reservas.forEach(reserva => {
                const row = reservasTable.insertRow();
                row.insertCell(0).textContent = reserva.fecha;
                row.insertCell(1).textContent = reserva.hora;
                row.insertCell(2).textContent = reserva.tamano_mesa;

                let restauranteNombre;
                switch (reserva.id_restaurante) {
                    case "1":
                        restauranteNombre = 'La esquina del gusto';
                        break;
                    case "2":
                        restauranteNombre = 'Mamma Rosa';
                        break;
                    case "3":
                        restauranteNombre = 'Dubai';
                        break;
                    case "4":
                        restauranteNombre = 'Finisterre';
                        break;    
                    case "5":
                        restauranteNombre = 'Martinica';
                        break;
                    default:
                        restauranteNombre = 'Desconocido';
                }
                row.insertCell(3).textContent = restauranteNombre;

                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Eliminar';
                deleteButton.addEventListener('click', function() {
                    eliminarReserva(reserva.id);
                });
                row.insertCell(4).appendChild(deleteButton);    
            });
        });
});

function eliminarReserva(idReserva) {
    // Enviar una solicitud HTTP POST al archivo PHP para eliminar la reserva
    fetch('../php/eliminar_reserva.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id: idReserva }), // Enviar el ID de la reserva como datos JSON
    })
    .then(response => {
        if (response.ok) {
            // Aquí podrías realizar alguna acción adicional si la eliminación fue exitosa
            console.log('Reserva eliminada correctamente');
        } else {
            console.error('Error al eliminar la reserva');
        }
    })
    .catch(error => {
        console.error('Error al eliminar la reserva:', error);
    });
}

