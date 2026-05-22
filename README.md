# Scannan

## Sobre o Projeto

O Scannan é uma API REST desenvolvida para permitir que usuários descubram, avaliem e organizem obras de entretenimento, incluindo livros e filmes. A plataforma centraliza informações sobre obras e autores, permitindo que cada usuário registre suas avaliações, acompanhe suas obras favoritas e consulte opiniões de outros usuários.

O objetivo do projeto é oferecer um ambiente simples e organizado para compartilhamento de avaliações e recomendações, facilitando a descoberta de novos conteúdos com base nas experiências da comunidade.

## Funcionalidades

- Cadastro e autenticação de usuários
- Gerenciamento de perfil
- Cadastro e consulta de obras (livros e filmes)
- Cadastro e consulta de autores
- Avaliação de obras pelos usuários
- Cálculo da nota média das obras
- Favoritar obras
- Associação de obras a temas/categorias
- Consulta de avaliações realizadas por usuários

## Tecnologias Utilizadas

- PHP 8
- Laravel
- PostgreSQL
- JWT Authentication
- Composer
- Insomnia (testes da API)

## Estrutura Principal

### Usuário
Responsável pelo gerenciamento de contas, autenticação e interações com o sistema.

### Obra
Representa um livro ou filme disponível para avaliação.

### Autor
Armazena informações dos autores das obras cadastradas.

### Avaliação
Permite que usuários atribuam notas e comentários às obras.

### Favorito
Permite que usuários salvem obras de interesse para consulta futura.

### Tema
Classifica as obras por categorias ou assuntos.

## Objetivo Acadêmico

Este projeto foi desenvolvido com o propósito de aplicar conceitos de desenvolvimento de APIs REST, modelagem de banco de dados, autenticação baseada em tokens JWT, validações de dados e boas práticas de desenvolvimento utilizando o framework Laravel.

## Instalação e Configuração

### 1. Configure o arquivo `.env`

Crie um arquivo `.env` com base no arquivo `.env.example` presente no projeto.

Altere as configurações de conexão com o banco de dados:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=scannan
DB_USERNAME={coloque seu usuário}
DB_PASSWORD={coloque sua senha}
```

### 2. Instale as dependências

```bash
composer install
```

### 3. Gere a chave da aplicação

```bash
php artisan key:generate
```

### 4. Gere o segredo JWT

```bash
php artisan jwt:secret
```

### 5. Crie o banco de dados

Crie no PostgreSQL um banco de dados com o mesmo nome definido em `DB_DATABASE` no arquivo `.env`.

Exemplo:

```sql
CREATE DATABASE scannan;
```

### 6. Execute as migrations

```bash
php artisan migrate
```

### 7. Inicie o servidor

```bash
php artisan serve
```

A aplicação estará disponível em:

```text
http://127.0.0.1:8000
```

## Autenticação

A API utiliza autenticação baseada em JWT.

Após realizar o login, um token será retornado na resposta. Para acessar rotas protegidas, envie esse token no cabeçalho `Authorization` utilizando o esquema Bearer:

```http
Authorization: Bearer seu_token_aqui
```

### Exemplo no Insomnia

```http
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
```