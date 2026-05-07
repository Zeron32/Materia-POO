<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agendamentos</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
    <header>
        <div class="container header-content">
            <div class="logo">
                <div class="logo-icon">A</div>
                <div class="logo-text">
                    <h1>Agendamentos</h1>
                    <p>Gerencie seus pedidos</p>
                </div>
            </div>
            <div class="header-actions">
                <button class="cart-button">
                    Carrinho <span id="cartBadge" class="cart-badge">0</span>
                </button>
            </div>
        </div>
    </header>

    <nav>
        <div class="container nav-tabs">
            <button class="nav-tab active" data-tab="catalog">Catálogo</button>
            <button class="nav-tab" data-tab="cart">Carrinho</button>
            <button class="nav-tab" data-tab="create">Agendar</button>
            <button class="nav-tab" data-tab="list">Meus Agendamentos</button>
        </div>
    </nav>

    <main class="container">
        <!-- Catálogo -->
        <section id="catalog" class="section active">
            <div class="section-header">
                <h2>Catálogo de Produtos</h2>
                <p>Escolha entre nossas opções</p>
            </div>
            <div id="productGrid" class="product-grid"></div>
        </section>

        <!-- Carrinho -->
        <section id="cart" class="section">
            <div class="section-header">
                <h2>Meu Carrinho</h2>
                <p id="cartDescription">Seu carrinho está vazio</p>
            </div>
            <div id="cartContent" class="cart-items"></div>
        </section>

        <!-- Formulário de Agendamento -->
        <section id="create" class="section">
            <div class="section-header">
                <h2>Novo Agendamento</h2>
                <p>Preencha os dados abaixo</p>
            </div>
            <div class="form-container">
                <div class="form-card">
                    <form id="scheduleForm">
                        @csrf
                        <div class="form-group">
                            <label for="productId" class="form-label">Produto</label>
                            <select id="productId" name="produto" class="form-select" required></select>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="size" class="form-label">Tamanho</label>
                                <select id="size" name="tamanho" class="form-select" disabled required></select>
                            </div>
                            <div class="form-group">
                                <label for="color" class="form-label">Cor</label>
                                <select id="color" name="cor" class="form-select" disabled required></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="quantity" class="form-label">Quantidade</label>
                            <input type="number" id="quantity" name="quantidade" class="form-input" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="customerName" class="form-label">Nome</label>
                                <input type="text" id="customerName" name="customerName" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label for="customerEmail" class="form-label">Email</label>
                                <input type="email" id="customerEmail" name="customerEmail" class="form-input" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="customerPhone" class="form-label">Telefone</label>
                                <input type="text" id="customerPhone" name="customerPhone" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label for="scheduledDate" class="form-label">Data</label>
                                <input type="date" id="scheduledDate" name="scheduledDate" class="form-input" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="notes" class="form-label">Observações</label>
                            <textarea id="notes" name="notes" class="form-textarea"></textarea>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Agendar</button>
                            <button type="reset" class="btn btn-secondary">Limpar</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Lista de Agendamentos -->
        <section id="list" class="section">
            <div class="section-header">
                <h2>Meus Agendamentos</h2>
                <p id="listDescription">Você ainda não tem agendamentos</p>
            </div>
            <div id="scheduleList" class="schedule-list"></div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} Agendamentos. Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        const SCHEDULES_URL = "{{ url('/schedules') }}";
    </script>
    <script src="{{ asset('app.js') }}"></script>
</body>
</html>
