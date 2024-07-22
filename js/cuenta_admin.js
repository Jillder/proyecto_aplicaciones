document.addEventListener('DOMContentLoaded', function() {
    fetch('../php/obtener_datos.php')
        .then(response => response.json())
        .then(data => {
           const usuariosTable = document.getElementById('usuarios-table').getElementsByTagName('tbody')[0];
           data.usuarios.forEach(usuario => {
               const row = usuariosTable.insertRow();
               row.insertCell(0).textContent = usuario.usuario;
               row.insertCell(1).textContent = usuario.correo;
               const deleteCell = row.insertCell(2);
               const deleteButton = document.createElement('button');
               deleteButton.textContent = 'Eliminar';
               deleteButton.classList.add('delete-button');
               deleteButton.addEventListener('click', function() {
                   eliminarCuenta(usuario.id, row);
               });
               deleteCell.appendChild(deleteButton);
           });
        });
});

function eliminarCuenta(usuarioId, row) {
    fetch(`../php/eliminar_usuario.php?id=${usuarioId}`, {
        method: 'DELETE'
    })
    .then(response => {
        if (response.ok) {
            row.remove();
        } else {
            alert('No se pudo eliminar la cuenta.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ocurrió un error al intentar eliminar la cuenta.');
    });
}
