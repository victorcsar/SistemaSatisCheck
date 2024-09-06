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
                'rgba(220, 53, 69, 0.8)', // Muito Insatisfeito: Vermelho Escuro
                'rgba(255, 99, 132, 0.8)', // Insatisfeito: Vermelho
                'rgba(255, 205, 86, 0.8)', // Neutro: Amarelo
                'rgba(40, 167, 69, 0.8)',  // Satisfeito: Verde Claro
                'rgba(0, 123, 255, 0.8)'   // Muito Satisfeito: Azul Claro (ajuste conforme necessário)
            ],
            borderColor: [
                'rgba(220, 53, 69, 1)',   // Vermelho Escuro para a borda
                'rgba(255, 99, 132, 1)',  // Vermelho para a borda
                'rgba(255, 205, 86, 1)',  // Amarelo para a borda
                'rgba(40, 167, 69, 1)',   // Verde Claro para a borda
                'rgba(0, 123, 255, 1)'    // Azul Claro para a borda (ajuste conforme necessário)
            ],
            borderWidth: 1
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false // Remove a legenda do gráfico
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 3 // Define o incremento do eixo Y como 1 para números inteiros
                }
            }
        }
    }
});

// Gráfico de Avaliação da Apresentação
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
                'rgba(0, 123, 255, 0.8)',  // Excelente: Azul Escuro
                'rgba(40, 167, 69, 0.8)',  // Bom: Verde Claro
                'rgba(255, 205, 86, 0.8)', // Razoável: Amarelo
                'rgba(255, 159, 64, 0.8)', // Ruim: Laranja
                'rgba(220, 53, 69, 0.8)'   // Muito Ruim: Vermelho Escuro
            ],
            borderColor: [
                'rgba(0, 123, 255, 1)',    // Azul Escuro para a borda
                'rgba(40, 167, 69, 1)',    // Verde Claro para a borda
                'rgba(255, 205, 86, 1)',    // Amarelo para a borda
                'rgba(255, 159, 64, 1)',    // Laranja para a borda
                'rgba(220, 53, 69, 1)'      // Vermelho Escuro para a borda
            ],
            borderWidth: 1
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false // Remove a legenda do gráfico
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 3 // Define o incremento do eixo Y como 1 para números inteiros
                }
            }
        }
    }
});

