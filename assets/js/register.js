document.getElementById('register-form').addEventListener('submit', function(event) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const role = document.getElementById('role').value;

    if (password !== confirmPassword) {
        event.preventDefault();
        alert('As senhas não coincidem.');
    } else if (!role) {
        event.preventDefault();
        alert('Por favor, selecione o tipo do Usuario.');
    }
});
