document.addEventListener('DOMContentLoaded', function() {
    fetch('../php/obtener_datos.php')
        .then(response => response.json())
        .then(data => {
            const usuariosTable = document.getElementById('usuarios-table').getElementsByTagName('tbody')[0];
            data.usuarios.forEach(usuario => {
                const row = usuariosTable.insertRow();
                row.insertCell(0).textContent = usuario.usuario;
                row.insertCell(1).textContent = usuario.correo;
            });

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
                    default:
                        restauranteNombre = 'Desconocido';
                }
                row.insertCell(3).textContent = restauranteNombre;
            });
        });
});