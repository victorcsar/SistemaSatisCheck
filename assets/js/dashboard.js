// Dados de avaliações da aplicação
const avaliacoesAplicacao = {
    muito_insatisfeito: document.getElementById('data-aplicacao-muito-insatisfeito').value,
    insatisfeito: document.getElementById('data-aplicacao-insatisfeito').value,
    neutro: document.getElementById('data-aplicacao-neutro').value,
    satisfeito: document.getElementById('data-aplicacao-satisfeito').value,
    muito_satisfeito: document.getElementById('data-aplicacao-muito-satisfeito').value
};

// Dados de avaliações da apresentação com novas categorias
const avaliacoesApresentacao = {
    excelente: document.getElementById('data-apresentacao-excelente').value,
    bom: document.getElementById('data-apresentacao-bom').value,
    razoavel: document.getElementById('data-apresentacao-razoavel').value,
    ruim: document.getElementById('data-apresentacao-ruim').value,
    muito_ruim: document.getElementById('data-apresentacao-muito-ruim').value
};

// Gráfico de Avaliação da Aplicação
const ctxAplicacao = document.getElementById('barChartAplicacao').getContext('2d');
const barChartAplicacao = new Chart(ctxAplicacao, {
    type: 'bar',
    data: {
        labels: ['Muito Insatisfeito', 'Insatisfeito', 'Neutro', 'Satisfeito', 'Muito Satisfeito'],
        datasets: [{
            label: 'Avaliação da Aplicação',
            data: [
                avaliacoesAplicacao.muito_insatisfeito,
                avaliacoesAplicacao.insatisfeito,
                avaliacoesAplicacao.neutro,
                avaliacoesAplicacao.satisfeito,
                avaliacoesAplicacao.muito_satisfeito
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Gráfico de Avaliação da Apresentação com novas categorias
const ctxApresentacao = document.getElementById('barChartApresentacao').getContext('2d');
const barChartApresentacao = new Chart(ctxApresentacao, {
    type: 'bar',
    data: {
        labels: ['Excelente', 'Bom', 'Razoável', 'Ruim', 'Muito Ruim'],
        datasets: [{
            label: 'Avaliação da Apresentação',
            data: [
                avaliacoesApresentacao.excelente,
                avaliacoesApresentacao.bom,
                avaliacoesApresentacao.razoavel,
                avaliacoesApresentacao.ruim,
                avaliacoesApresentacao.muito_ruim
            ],
            backgroundColor: [
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
