# Sistema de Gestão Empresarial

Um sistema web completo para gerenciamento de usuários, produtos, desenvolvido com **Laravel**, **Bootstrap** e **MySQL**.
## Funcionalidades

- Cadastro, edição e exclusão de usuários
- CRUD de produtos com upload de imagens
- Dashboard administrativo com estatísticas
- Sistema de login, logout e autenticação de usuários
- Controle de permissões por nível de acesso (admin e usuário)
- Notificações de sucesso e erro

## Tecnologias Utilizadas

- **Backend:** Laravel 11, PHP 8
- **Banco de dados:** MySQL
- **Frontend:** Bootstrap 5, Blade Templates
- **Gerenciamento de dependências:** Composer
- **Controle de versão:** Git

## Instalação

1. Clone o repositório:
   ```bash
   git clone https://github.com/cezar-m/Case-teste-Vox-Tecnologia
   
## Estrutura do Projeto

app/
├── Http/
│ ├── Controllers/
│ │ ├── AuthController.php
│ │ ├── DashboardController.php
│ │ ├── ProdutoController.php
│ │ ├── UserController.php
│ │ └── Controller.php <- Controller base
│ │
│ ├── Middleware/
│ │ ├── AdminMiddleware.php
│ │ └── Authenticate.php
│ │
│ └── Kernel.php <- Registrando middlewares
│
resources/
├── views/
│ ├── layouts/
│ │ └── app.blade.php <- Layout principal (header/footer)
│ │
│ ├── dashboard/
│ │ └── index.blade.php <- Dashboard Admin
│ │
│ ├── produtos/
│ │ ├── index.blade.php <- Listagem produtos
│ │ ├── create.blade.php <- Form criar produto
│ │ └── edit.blade.php <- Form editar produto
│ │
│ └── auth/
│ ├── login.blade.php
│ ├── register.blade.php
│ └── components/ <- Componentes Blade (inputs, buttons)
│
routes/
└── web.php <- Rotas web
