const urlParams = new URLSearchParams(window.location.search);
        const restaurantId = urlParams.get('id');

        const restaurantNameElement = document.getElementById('restaurant-name');
        const restaurantIdInput = document.getElementById('restaurant-id');

        if (restaurantId == 1) {
            restaurantNameElement.textContent = 'La esquina del guso';
            restaurantIdInput.value = 1;
        } else if (restaurantId == 2) {
            restaurantNameElement.textContent = 'Mamma rosa';
            restaurantIdInput.value = 2;
        } else if (restaurantId == 3) {
        restaurantNameElement.textContent = 'Dubai';
        restaurantIdInput.value = 3;
        } else if (restaurantId == 4) {
        restaurantNameElement.textContent = 'Finisterre';
        restaurantIdInput.value = 4;
        } else if (restaurantId == 5) {
            restaurantNameElement.textContent = 'Martinica';
            restaurantIdInput.value = 5;
        }
        else {
            restaurantNameElement.textContent = 'Restaurante Desconocido';
        }