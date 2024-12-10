function navigateTo(file) {
    window.location.href = file;
}

function validateBinaryInput(input) {
    const binaryPattern = /^[01]*$/; // Solo permite 0 y 1
    const errorElement = document.getElementById('ipError');
    
    // Validar si el valor contiene algo distinto de 0 y 1
    if (!binaryPattern.test(input.value)) {
        input.value = input.value.replace(/[^01]/g, ''); // Elimina caracteres no válidos
        errorElement.style.display = 'block';
    } else {
        errorElement.style.display = 'none';
    }
}
