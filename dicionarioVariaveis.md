# 📋 Dicionário de Variáveis - TCC Aluguel de Ferramentas

## ⚠️ LEIA ANTES DE CODAR: ESTE ARQUIVO É O CONTRATO DA EQUIPE ⚠️

O maior risco do nosso projeto é um membro da equipe criar um código que não se encaixa no código de outro. Isso acontece quando as variáveis (ex: `name=""` no HTML) não batem com as do `Controller` (ex: `$_POST['...']`).

Este arquivo é a **fonte única da verdade** para impedir isso.

### REGRA OFICIAL DO PROJETO:

**É PROIBIDO criar variáveis "da cabeça".** Siga este processo:

1.  **VERIFIQUE:** Antes de escrever um `name=""` ou `$_POST['...']`, abra este arquivo e veja se a variável já existe. Se sim, **use-a exatamente** como está escrita.
2.  **PRECISA DE UMA NOVA?** Se a variável não existe (ex: para a Sprint 3, `acao_cadastrar_reserva`), você deve:
    * **Passo 1:** Adicioná-la às tabelas abaixo.
    * **Passo 2:** Fazer `git add dicionarioVariaveis.md` e `git commit -m "Adiciona novas variáveis X, Y ao dicionário"`.
    * **Passo 3:** Fazer `git push origin main`.
    * **Passo 4:** Avisar a equipe no WhatsApp: **"Pessoal, atualizei o dicionário. Deem `git pull` antes de continuar."**
3.  **SÓ ENTÃO** você pode usar a nova variável no seu código.

**Seguir esta regra garante que o projeto funcionará quando juntarmos as partes.**

---

## 🔑 Chaves de Formulário (`$_POST`)

Valores do atributo `name=""` nos formulários HTML.

### Sprint 1: Cadastro e Login de Usuário
* `acao_cadastrar`: Botão de envio do formulário `cadastroUsuario.php`.
* `acao_login`: Botão de envio do formulário `login.php`.
* `nome_usuario`: Campo de nome completo.
* `email_usuario`: Campo de e-mail (usado no login e cadastro).
* `senha_usuario`: Campo de senha (usado no login e cadastro).
* `confirmar_senha`: Campo de confirmação de senha.
* `telefone_usuario`: Campo de telefone.
* `endereco_usuario`: Campo de endereço.
* `categoria_cliente`: Campo de rádio (PF ou PJ).
* `cpf_cnpj`: Campo de CPF/CNPJ (corrigido de `cpf_cnpj` para `cpf_cnpj_usuario`).

### Sprint 2: CRUD de Ferramentas (Admin)
* `acao_cadastrar_ferramenta`: Botão de envio do `cadastrar_ferramentas.php`.
* `acao_editar_ferramenta`: Botão de envio do `editar_ferramentas.php`.
* `acao_excluir_ferramenta`: Botão de envio do `excluir_ferramentas.php`.
* `id_ferramenta`: Campo `hidden` para identificar a ferramenta na edição/exclusão.
* `nome_ferramenta`: Campo "Nome" da ferramenta.
* `modelo_ferramenta`: Campo "Modelo" da ferramenta.
* `categoria_ferramenta`: Campo "Categoria" da ferramenta.
* `preco_ferramenta`: Campo "Preço" da ferramenta.
* `disponibilidade_ferramenta`: Campo `<select>` de disponibilidade.

### Sprint 3: Fluxo de Reserva (Cliente)
* `acao_simular_reserva`: Botão de envio do `reserva_formulario.php`.
* `data_reserva`: Campo "Data de Retirada".
* `data_devolucao`: Campo "Data de Devolução".
* `acao_cadastrar_reserva`: Botão de envio do `confirmarReserva.php`.

### Sprint 4: Gerenciamento (Admin & Perfil)
* `acao_editar_reserva`: Botão de envio do `editar_reserva.php`.
* `id_reserva`: Campo `hidden` para identificar a reserva na edição/exclusão.
* `id_usuario`: Campo `hidden` (usado na edição de reserva).
* `status_reserva`: Campo `<select>` de status da reserva.
* `status_pagamento`: Campo `<select>` de status do pagamento.
* `acao_excluir_reserva`: Botão de envio do `excluir_reserva.php`.
* `acao_editar_perfil`: Botão de envio do `meu_perfil.php`.
* `(nome_usuario, telefone_usuario, endereco_usuario)`: Reutilizados do Sprint 1 para o formulário `meu_perfil.php`.

---

## 📤 Upload de Arquivos (`$_FILES`)

### Sprint 2: CRUD de Ferramentas (Admin)
* `foto_ferramenta`: Campo `input type="file"` para a foto da ferramenta.

---

## 🔗 Parâmetros de URL (`$_GET`)

Chaves usadas na URL para navegação e feedback.

* `pagina`: Chave principal do `Navegacao.php` para incluir páginas (ex: `index.php?pagina=cadastro` ou `index.php?pagina=listar_ferramentas`).
* `status`: Chave para mensagens de feedback (ex: `status=login_invalido` ou `status=sucesso_cadastro`).
* `id`: Chave para identificar um item específico (ex: `index.php?pagina=editar_ferramenta&id=5`).

---

## 👤 Variáveis de Sessão (`$_SESSION`)

Chaves criadas no `UsuarioController.php` após o login para identificar o usuário.

* `id_usuario`: O ID numérico do usuário, vindo do banco de dados.
* `nome_usuario`: O nome do usuário logado (para saudação).
* `tipo_usuario`: O tipo de acesso ('cliente' ou 'administrador'), usado para permissões.
* `reserva_simulacao`: Array (temporário) que armazena os dados da reserva entre a simulação (`acao_simular_reserva`) e a confirmação (`acao_cadastrar_reserva`).