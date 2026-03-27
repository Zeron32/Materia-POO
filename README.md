Sistema de Compra de Camisas

Sobre o Projeto
Este projeto consiste no desenvolvimento de um sistema de e-commerce para venda de camisas personalizadas, com foco em usabilidade, desempenho e escalabilidade. A aplicação permite que os usuários naveguem por um catálogo de produtos, personalizem camisas conforme suas preferências e realizem compras de forma simples e segura.

A proposta do sistema é oferecer uma experiência moderna, combinando design intuitivo com funcionalidades robustas, permitindo que tanto clientes finais quanto administradores tenham facilidade no uso da plataforma.

Objetivo
Desenvolver uma aplicação completa de comércio eletrônico com foco em:
Experiência do usuário intuitiva e responsiva
Personalização avançada de produtos
Eficiência no processo de compra
Organização e gerenciamento de pedidos
Escalabilidade para futuras melhorias

Público-Alvo
Clientes que desejam adquirir camisas personalizadas
Pequenos empreendedores que queiram utilizar a plataforma para vendas
Usuários que buscam praticidade e customização em produtos

Funcionalidades

Catálogo de Produtos
Organização por categorias: masculina, feminina e infantil
Sistema de busca por nome ou palavra-chave
Filtros avançados por tamanho, cor, preço e marca
Exibição de produtos com imagens, descrições detalhadas e avaliações

Personalização de Camisas
Seleção de cor e tamanho
Inserção de textos personalizados com escolha de fonte e cor
Upload de imagens ou logotipos
Ajuste de posicionamento da estampa
Pré-visualização dinâmica da camisa personalizada

Carrinho de Compras
Adição e remoção de produtos
Atualização de quantidade em tempo real
Aplicação de cupons de desconto
Cálculo automático do total da compra

Checkout
Preenchimento de dados do cliente
Cálculo de frete com base no CEP
Seleção de endereço de entrega
Escolha da forma de pagamento: cartão, boleto e Pix
Exibição de resumo completo antes da confirmação

Gestão de Pedidos
Visualização do histórico de compras
Acompanhamento do status do pedido
Detalhamento de cada pedido realizado

Funcionalidades Futuras
Sistema de autenticação (login e cadastro)
Recuperação de senha
Perfil do usuário com edição de dados
Gerenciamento de múltiplos endereços
Painel administrativo
Controle de estoque automatizado
Relatórios de vendas
Sistema de avaliações e comentários
Integração com APIs de pagamento e serviços de entrega
Notificações por e-mail ou SMS

Requisitos Funcionais
O sistema deve permitir cadastro e visualização de produtos
O sistema deve permitir personalização de camisas
O sistema deve gerenciar carrinho de compras
O sistema deve processar pedidos
O sistema deve calcular frete automaticamente

Requisitos Não Funcionais
Interface responsiva e amigável
Tempo de resposta rápido
Segurança nas transações
Escalabilidade do sistema
Compatibilidade com diferentes navegadores

Fluxo da Aplicação
O usuário acessa o sistema
Navega pelo catálogo de produtos
Seleciona uma camisa
Personaliza o produto (opcional)
Adiciona ao carrinho
Finaliza a compra no checkout
Recebe confirmação do pedido
Acompanha o status da entrega

Tecnologias Sugeridas
Frontend: HTML, CSS, JavaScript ou frameworks como React
Backend: Java, Python ou Node.js
Banco de Dados: MySQL ou PostgreSQL
Controle de Versão: Git e GitHub
APIs: Integração com sistemas de pagamento e cálculo de frete

Arquitetura do Sistema
Arquitetura baseada no padrão cliente-servidor
Separação entre frontend e backend
Uso de APIs REST para comunicação entre os serviços
Possibilidade de adoção de arquitetura MVC

Responsividade
O sistema será totalmente responsivo, adaptando-se a diferentes tamanhos de tela, garantindo uma experiência consistente em desktops, tablets e smartphones.

Segurança
Criptografia de dados sensíveis
Validação de entradas do usuário
Proteção contra ataques comuns (SQL Injection, XSS)
Autenticação e autorização de usuários

Possíveis Melhorias
Implementação de inteligência artificial para sugestões de estampas
Sistema de recomendação de produtos
Integração com redes sociais
Programa de fidelidade para clientes

camisas-ecommerce/
│
├── frontend/
├── backend/
├── docs/
├── database/
├── .gitignore
├── README.md

frontend/
│
├── public/
│   └── index.html
│
├── src/
│   ├── assets/            imagens, ícones, fontes
│   ├── components/        componentes reutilizáveis
│   │   ├── Button/
│   │   ├── CardProduto/
│   │   ├── Navbar/
│   │   └── Footer/
│   │
│   ├── pages/             páginas principais
│   │   ├── Home/
│   │   ├── Catalogo/
│   │   ├── Produto/
│   │   ├── Carrinho/
│   │   ├── Checkout/
│   │   └── Perfil/
│   │
│   ├── services/          comunicação com API
│   │   ├── api.js
│   │   ├── produtosService.js
│   │   └── pedidosService.js
│   │
│   ├── hooks/             hooks customizados
│   ├── context/           estado global (carrinho, usuário)
│   ├── utils/             funções auxiliares
│   ├── styles/            CSS global / temas
│   ├── routes/            configuração de rotas
│   ├── App.js
│   └── main.js
│
├── package.json
└── vite.config.js

backend/
│
├── src/
│   ├── config/           # configs (db, env)
│   │   └── database.js
│   │
│   ├── controllers/      # lógica das rotas
│   │   ├── produtoController.js
│   │   ├── pedidoController.js
│   │   └── usuarioController.js
│   │
│   ├── models/           # modelos do banco
│   │   ├── Produto.js
│   │   ├── Pedido.js
│   │   └── Usuario.js
│   │
│   ├── routes/           # definição das rotas
│   │   ├── produtoRoutes.js
│   │   ├── pedidoRoutes.js
│   │   └── usuarioRoutes.js
│   │
│   ├── services/         # regras de negócio
│   │   ├── pagamentoService.js
│   │   ├── freteService.js
│   │   └── personalizacaoService.js
│   │
│   ├── middlewares/      # autenticação, validações
│   │   ├── authMiddleware.js
│   │   └── errorMiddleware.js
│   │
│   ├── utils/            # funções auxiliares
│   ├── app.js
│   └── server.js
│
├── package.json
└── .env

database/
│
├── migrations/           # criação de tabelas
├── seeds/                # dados iniciais
└── schema.sql

docs/
│
├── requisitos.md
├── arquitetura.md
├── api.md
└── wireframes/

Autor
Kleber José da Silva
RA: 202510220