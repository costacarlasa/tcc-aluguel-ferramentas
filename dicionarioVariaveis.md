# 📋 Dicionário de Variáveis - TCC Aluguel de Ferramentas

## ⚠️ LEIA ANTES DE CODAR: ESTE ARQUIVO É O CONTRATO DA EQUIPE ⚠️

O maior risco do nosso projeto é um membro da equipe criar um código que não se encaixa no código de outro. Isso acontece quando as variáveis (ex: `name=""` no HTML) não batem com as do `Controller` (ex: `$_POST['...']`).

Este arquivo é a **fonte única da verdade** para impedir isso.

### REGRA OFICIAL DO PROJETO:

**É PROIBIDO criar variáveis "da cabeça".** Siga este processo:

1.  **VERIFIQUE:** Antes de escrever um `name=""` ou `$_POST['...']`, abra este arquivo e veja se a variável já existe. Se sim, **use-a exatamente** como está escrita.
2.  **PRECISA DE UMA NOVA?** Se a variável não existe (ex: para a Sprint 2, `nome_ferramenta`), você deve:
    * **Passo 1:** Adicioná-la às tabelas abaixo.
    * **Passo 2:** Fazer `git add dicionario.md` e `git commit -m "Adiciona novas variáveis X, Y ao dicionário"`.
    * **Passo 3:** Fazer `git push origin main`.
    * **Passo 4:** Avisar a equipe no WhatsApp: **"Pessoal, atualizei o dicionário. Deem `git pull` antes de continuar."**
3.  **SÓ ENTÃO** você pode usar a nova variável no seu código.

**Seguir esta regra garante que o projeto funcionará quando juntarmos as partes.**

---

## 🔑 Chaves de Formulário (`$_POST`)

Valores do atributo `name=""` nos formulários HTML.

* `acao_cadastrar`: Botão de envio do formulário `cadastroUsuario.php`.
* `acao_login`: Botão de envio do formulário `login.php`.
* `nome_usuario`: Campo de nome completo.
* `email_usuario`: Campo de e-mail (usado no login e cadastro).
* `senha_usuario`: Campo de senha (usado no login e cadastro).
* `confirmar_senha`: Campo de confirmação de senha.
* `telefone_usuario`: Campo de telefone.
* `endereco_usuario`: Campo de endereço.
* `categoria_cliente`: Campo de rádio (PF ou PJ).
* `cpf_cnpj_usuario`: Campo de CPF/CNPJ.

## 🔗 Parâmetros de URL (`$_GET`)

Chaves usadas na URL para navegação e feedback.

* `pagina`: Chave principal do `Navegacao.php` para incluir páginas (ex: `index.php?pagina=cadastro`).
* `status`: Chave para mensagens de feedback (ex: `status=login_invalido` ou `status=cadastro_sucesso`).

## 👤 Variáveis de Sessão (`$_SESSION`)

Chaves criadas no `UsuarioController.php` após o login para identificar o usuário.

* `id_usuario`: O ID numérico do usuário, vindo do banco de dados.
* `nome_usuario`: O nome do usuário logado (para saudação).
* `tipo_usuario`: O tipo de acesso ('cliente' ou 'administrador'), usado para direcionar o painel.