function togglePasswordFields() {
    var passwordFields = document.getElementById('password-fields');
    if (document.getElementById('change-password-check').checked) {
        passwordFields.style.display = 'block';
    } else {
        passwordFields.style.display = 'none';
    }
}

document.getElementById('edit-user-form').addEventListener('submit', function(event) {
    var newPassword = document.getElementById('new-password').value;
    var confirmPassword = document.getElementById('confirm-password').value;
    var errorMessage = document.getElementById('password-error');

    if (document.getElementById('change-password-check').checked) {
        if (newPassword === '' || confirmPassword === '') {
            errorMessage.textContent = 'Os campos de senha não podem estar vazios.';
            errorMessage.style.display = 'block';
            event.preventDefault(); // Impede o envio do formulário
        } else if (newPassword !== confirmPassword) {
            errorMessage.textContent = 'As senhas não coincidem.';
            errorMessage.style.display = 'block';
            event.preventDefault(); // Impede o envio do formulário
        } else {
            errorMessage.style.display = 'none';
        }
    }
});