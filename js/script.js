document.addEventListener('DOMContentLoaded', function() {
    // Seleciona todos os controles de quantidade
    const quantityControls = document.querySelectorAll('.quantity-control');

    quantityControls.forEach(control => {
        const input = control.querySelector('.quantity-input');
        const decreaseButton = control.querySelector('.decrease');
        const increaseButton = control.querySelector('.increase');

        // Botão de diminuir
        decreaseButton.addEventListener('click', function() {
            let currentValue = parseInt(input.value, 10);
            if (currentValue > 0) {
                input.value = currentValue - 1;
            }
        });

        // Botão de aumentar
        increaseButton.addEventListener('click', function() {
            let currentValue = parseInt(input.value, 10);
            input.value = currentValue + 1;
        });
    });
});