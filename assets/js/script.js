document.getElementById('survey-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);
    
    // Verifica se a primeira pergunta (question1) foi respondida
    if (!data.question1) {
        showMessage('Por favor, selecione um emoji.', 'danger');
        return;
    }

    // Verifica se a segunda pergunta (question2) foi respondida
    if (!data.question2) {
        showMessage('Por favor, selecione uma opção para avaliar nossa apresentação.', 'danger');
        return;
    }

    // Se as validações passarem, submete o formulário
    this.submit(); // Envia o formulário

    // // Enviar os dados para o servidor (simulação)
    // fetch('/submit-survey', {
    //     method: 'POST',
    //     headers: {
    //         'Content-Type': 'application/json',
    //     },
    //     body: JSON.stringify(data),
    // })
    // .then(response => response.json())
    // .then(result => {
    //     showMessage('Pesquisa enviada com sucesso!', 'success');
    //     console.log('Success:', result);
    // })
    // .catch(error => {
    //     showMessage('Erro ao enviar a pesquisa. Tente novamente mais tarde.', 'danger');
    //     console.error('Error:', error);
    // });
});

// Função para exibir mensagens de feedback
function showMessage(message, type) {
    const feedbackDiv = document.getElementById('feedback-message');
    feedbackDiv.innerHTML = `<div class="alert alert-${type}" role="alert">${message}</div>`;
    feedbackDiv.classList.remove('d-none');
    
    // Remover a mensagem após 5 segundos
    setTimeout(() => {
        feedbackDiv.classList.add('d-none');
    }, 5000);
}
