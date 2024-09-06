# Projeto de Pesquisa de Satisfação

Este projeto é uma aplicação web para coletar feedback de usuários por meio de um formulário de pesquisa de satisfação. As respostas são armazenadas em um banco de dados MySQL.

## Requisitos

- PHP 7.4 ou superior
- MySQL
- Composer
- Extensão `pdo_mysql` habilitada no PHP

## Configuração do Ambiente

### 1. Instalar Dependências com Composer

Se o Composer ainda não estiver instalado, [siga as instruções de instalação do Composer](https://getcomposer.org/download/).

Após instalar o Composer, execute o comando abaixo para instalar as dependências do projeto:

composer install

### 2. Configurar o Arquivo .env

Crie um arquivo .env na raiz do projeto com as seguintes variáveis de ambiente:

DB_HOST=endereco_do_bd  
DB_NAME=pesquisa_db  
DB_USER=seu_usuario  
DB_PASS=sua_senha

### 3. Configurar o Banco de Dados

Certifique-se de que o banco de dados MySQL está configurado com o nome pesquisa_db. Você pode criar o banco de dados e as tabelas necessárias usando o script SQL fornecido na pasta sql.

### 4. Estrutura do Projeto

O projeto está organizado nas seguintes pastas, cada uma desempenhando um papel crucial na arquitetura da aplicação:

- **`assets`**: Contém os recursos estáticos do projeto, organizados em subpastas:
  - **`css`**: Arquivos de estilo (CSS) responsáveis pela aparência visual das páginas.
  - **`js`**: Scripts JavaScript utilizados para adicionar interatividade e funcionalidades dinâmicas às páginas.

- **`config`**: Nesta pasta, encontra-se o arquivo de configuração do banco de dados, responsável por estabelecer a conexão entre a aplicação e o banco de dados MySQL.

- **`logs`**: Armazena os arquivos de log do sistema, que são úteis para rastrear eventos e erros ocorridos durante a execução da aplicação.

- **`controller`**: Contém os arquivos PHP que atuam como controllers. Estes arquivos são responsáveis por toda a lógica de manipulação de dados, como o envio de formulários e a recuperação de registros do banco de dados. Esta camada de controle separa a lógica de negócio da apresentação.

- **`public`**: Contém as páginas que são acessíveis ao público. Estas páginas HTML são o ponto de entrada para os usuários e interagem com os controllers PHP para realizar operações como login, exibição dos resultados da pesquisa de satisfação, entre outras.