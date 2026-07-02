# 🚀 Task Management API - Gestão de Projetos e Tarefas

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white" />
  <img src="https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
  <img src="https://img.shields.io/badge/PostgreSQL-15-336791?style=for-the-badge&logo=postgresql&logoColor=white" />
  <img src="https://img.shields.io/badge/Docker-Ready-2496ED?style=for-the-badge&logo=docker&logoColor=white" />
</p>

## 📌 Sobre o Projeto

Esta é uma API RESTful desenvolvida com base na metodologia **PBL (Aprendizagem Baseada em Problemas)**. O objetivo é solucionar um cenário real de agências de desenvolvimento: criar um sistema seguro e eficiente onde gerentes (Admins) podem gerenciar projetos e delegar tarefas, enquanto desenvolvedores (Devs) podem visualizar e atualizar o status de suas próprias atribuições.

O projeto foi construído com foco em **boas práticas de Engenharia de Software, Segurança e Infraestrutura (DevOps)**, operando em um ambiente 100% conteinerizado pronto para produção.

## 🛠️ Arquitetura e Stack Tecnológica

* **Backend:** PHP 8.4 com Laravel 11 (focado 100% em API, sem views).
* **Banco de Dados:** PostgreSQL 15.
* **Infraestrutura/DevOps:** Docker e Docker Compose. Arquitetura separando o servidor web (Nginx) da aplicação (PHP-FPM).
* **Segurança e Autenticação:** Laravel Sanctum (Tokens JWT/Bearer) e controle de acesso baseado em funções (RBAC).

## ✨ Funcionalidades (Até o momento)

- [x] **Ambiente Dockerizado:** Configuração customizada do `Dockerfile` e `docker-compose.yml` para Nginx, PHP e PostgreSQL.
- [x] **Modelagem de Banco de Dados:** Entidades `Users`, `Projects` e `Tasks` com chaves estrangeiras e exclusão em cascata (MER/DER estruturado).
- [x] **Seeders e Factories:** População automatizada do banco com dados fictícios e usuários de teste para validação de regras de negócio.
- [x] **Autenticação Segura:** Geração e revogação de tokens de acesso via rota `/api/login`.
- [x] **Proteção de Rotas:** Middleware bloqueando o acesso de usuários não autenticados.

## 🚀 Como executar o projeto localmente

Como o projeto é totalmente conteinerizado, você não precisa ter o PHP ou o PostgreSQL instalados na sua máquina. Basta ter o [Docker](https://www.docker.com/) instalado.

**1. Clone o repositório**
```bash
git clone [https://github.com/21v1u5/task-api-php.git](https://github.com/21v1u5/task-api-php.git)
cd task-api-php
```

2. Suba a infraestrutura
```bash
docker compose up -d --build
```

3. Configure o banco de dados e os dados de teste
```bash
docker compose exec app php artisan migrate:fresh --seed
```

O servidor estará rodando em: http://localhost:8000