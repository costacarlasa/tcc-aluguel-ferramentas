# 🔧 Plataforma Web de Aluguel de Ferramentas

![Status](https://img.shields.io/badge/Status-Em%20Desenvolvimento-yellow)
![Linguagem](https://img.shields.io/badge/PHP-8.2-777BB4?logo=php)
![Banco](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql)
![Servidor](https://img.shields.io/badge/Apache-2.4-D22128?logo=apache)

Este projeto é o Trabalho de Conclusão de Curso (TCC) para o curso Técnico em Desenvolvimento de Sistemas. O objetivo é desenvolver uma plataforma web completa que atue como um *marketplace* para o aluguel de ferramentas, conectando proprietários (locadores) a usuários (locatários).

A plataforma utiliza uma arquitetura **MVC (Model-View-Controller)** pura, escrita em **PHP orientado a objetos**, garantindo a separação de responsabilidades (Regras de Negócio, Conexão com o Banco e Interface do Usuário) e facilitando a manutenção.

---

## 🚀 Funcionalidades Implementadas (Sprints 1-4)

O sistema é dividido em duas grandes áreas: o Painel Administrativo (para gerenciamento) e a Área do Cliente (para consumo).

### 👨&zwj;💼 Painel Administrativo
* **Autenticação Segura:** Login de administrador com verificação de sessão (`$_SESSION`).
* **CRUD de Ferramentas:** (Sprint 2) Gerenciamento completo de ferramentas, incluindo cadastro, edição (com upload de fotos), listagem e exclusão.
* **Gerenciamento de Reservas:** (Sprint 4.1) Visualização de todas as reservas do sistema, com funcionalidade para editar o status (ex: "Aprovada", "Finalizada") e excluir reservas.
* **Gerenciamento de Usuários:** (Sprint 4.3 - *Em andamento*) Visualização de todos os clientes e administradores cadastrados.

### 👤 Área do Cliente
* **Autenticação de Cliente:** (Sprint 1) Fluxo completo de cadastro e login de novos usuários (clientes).
* **Vitrine de Ferramentas:** (Sprint 3) O cliente pode visualizar todas as ferramentas disponíveis em formato de "cards".
* **Fluxo de Reserva com Simulação:** (Sprint 3)
    1.  O cliente visualiza os **detalhes** da ferramenta (foto, preço, etc.).
    2.  Ele pode **simular** a reserva, selecionando datas para ver o **cálculo do valor total** (preço/dia vs. total de dias).
    3.  Ele pode **confirmar** a reserva, que é então enviada ao banco de dados com status "pendente".
* **Minhas Reservas:** (Sprint 3) O cliente possui uma página que lista seu histórico de reservas.
* **Meu Perfil:** (Sprint 4.2) O cliente pode visualizar e atualizar seus dados pessoais (nome, telefone, endereço).

---

## 🛠️ Tecnologias Utilizadas

Este projeto foi construído utilizando as seguintes tecnologias:

* **Backend:**
    * **PHP 8.2** (Linguagem principal, 100% Orientada a Objetos).
    * **Arquitetura MVC:** `Model` (para lógica de banco), `View` (para HTML) e `Controller` (para orquestração).
    * **Roteador Central:** Um `Navegacao.php` centralizado que processa todas as requisições `GET` e `POST`.
* **Banco de Dados:**
    * **MySQL 8.0** (Gerenciado via XAMPP/phpMyAdmin).
    * **PDO (PHP Data Objects):** Para conexão segura e prevenção de SQL Injection.
* **Frontend:**
    * HTML5
    * CSS3
* **Ambiente e Versão:**
    * **XAMPP** (Servidor Apache + MySQL).
    * **Git & GitHub:** Para controle de versão e trabalho em equipe.

---

## 🏁 Como Executar o Projeto (Para Avaliação)

Para executar este projeto localmente, siga os passos abaixo:

1.  **Clone o Repositório:**
    ```bash
    git clone [https://github.com/costacarlasa/tcc-aluguel-ferramentas.git](https://github.com/costacarlasa/tcc-aluguel-ferramentas.git)
    ```

2.  **Mova para o XAMPP:**
    * Mova a pasta `tcc-aluguel-ferramentas` para dentro do diretório `htdocs` da sua instalação do XAMPP.

3.  **Inicie os Serviços:**
    * Abra o painel de controle do **XAMPP** e inicie os módulos **Apache** e **MySQL**.

4.  **Crie o Banco de Dados:**
    * Acesse o `phpMyAdmin` (geralmente `http://localhost/phpmyadmin`).
    * Crie uma nova base de dados chamada exatamente `aluguel_ferramentas`.

5.  **Importe o Schema:**
    * Com o banco `aluguel_ferramentas` selecionado, clique na aba **"Importar"**.
    * Importe o arquivo `database/schema.sql` que está neste projeto.

6.  **Execute:**
    * Acesse o projeto no seu navegador:
    * `http://localhost/tcc-aluguel-ferramentas/`