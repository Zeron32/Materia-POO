const products = [
    {
        id: 1,
        name: 'Camiseta Básica Branca',
        price: 49.90,
        image: 'https://images.unsplash.com/photo-1648483098902-7af8f711498f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHx3aGl0ZSUyMHQtc2hpcnQlMjBwcm9kdWN0fGVufDF8fHx8MTc3NDAyMjQ4M3ww&ixlib=rb-4.1.0&q=80&w=1080',
        sizes: ['P', 'M', 'G', 'GG'],
        colors: ['Branco', 'Off-White']
    },
    {
        id: 2,
        name: 'Camiseta Básica Preta',
        price: 49.90,
        image: 'https://images.unsplash.com/photo-1610502778270-c5c6f4c7d575?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxibGFjayUyMHQtc2hpcnQlMjBwcm9kdWN0fGVufDF8fHx8MTc3NDA0NjkzNHww&ixlib=rb-4.1.0&q=80&w=1080',
        sizes: ['P', 'M', 'G', 'GG'],
        colors: ['Preto', 'Carvão']
    },
    {
        id: 3,
        name: 'Camiseta Azul',
        price: 54.90,
        image: 'https://images.unsplash.com/photo-1760864407190-5351a18d2a26?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxibHVlJTIwdC1zaGlydCUyMHByb2R1Y3R8ZW58MXx8fHwxNzczOTczNDA4fDA&ixlib=rb-4.1.0&q=80&w=1080',
        sizes: ['P', 'M', 'G', 'GG', 'XG'],
        colors: ['Azul Marinho', 'Azul Royal']
    },
    {
        id: 4,
        name: 'Camiseta Vermelha',
        price: 54.90,
        image: 'https://images.unsplash.com/photo-1773936846384-c143d3969fa0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxyZWQlMjB0LXNoaXJ0JTIwcHJvZHVjdHxlbnwxfHx8fDE3NzQwNDY5MzR8MA&ixlib=rb-4.1.0&q=80&w=1080',
        sizes: ['P', 'M', 'G', 'GG'],
        colors: ['Vermelho', 'Bordô']
    },
    {
        id: 5,
        name: 'Camiseta Cinza',
        price: 49.90,
        image: 'https://images.unsplash.com/photo-1737094540214-261561588b89?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxncmV5JTIwdC1zaGlydCUyMHByb2R1Y3R8ZW58MXx8fHwxNzc0MDQ2OTM1fDA&ixlib=rb-4.1.0&q=80&w=1080',
        sizes: ['P', 'M', 'G', 'GG'],
        colors: ['Cinza Mescla', 'Cinza Escuro']
    },
    {
        id: 6,
        name: 'Camiseta Verde',
        price: 54.90,
        image: 'https://images.unsplash.com/photo-1706550633982-6388c69002a0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxncmVlbiUyMHQtc2hpcnQlMjBwcm9kdWN0fGVufDF8fHx8MTc3NDA0NjkzNXww&ixlib=rb-4.1.0&q=80&w=1080',
        sizes: ['P', 'M', 'G', 'GG'],
        colors: ['Verde Musgo', 'Verde Militar']
    }
];

// Estado da aplicação
let schedules = [];
let selectedProductId = null;
let cart = [];

// Inicialização
document.addEventListener('DOMContentLoaded', function() {
    loadSchedules();
    loadCart();
    renderProducts();
    renderScheduleList();
    renderCart();
    setupEventListeners();
    updateScheduleCount();
    updateCartCount();
    setMinDate();
});

// Configurar data mínima (hoje)
function setMinDate() {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('scheduledDate').min = today;
}

// Configurar event listeners
function setupEventListeners() {
    // Navegação entre abas
    document.querySelectorAll('.nav-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            switchTab(this.dataset.tab);
        });
    });

    // Formulário de agendamento
    document.getElementById('scheduleForm').addEventListener('submit', handleSubmit);
    
    // Mudanças no formulário
    document.getElementById('productId').addEventListener('change', handleProductChange);
    document.getElementById('quantity').addEventListener('input', updateTotal);
}

// Trocar aba
function switchTab(tabName) {
    // Atualizar abas ativas
    document.querySelectorAll('.nav-tab').forEach(tab => {
        tab.classList.remove('active');
        if (tab.dataset.tab === tabName) {
            tab.classList.add('active');
        }
    });

    // Atualizar seções ativas
    document.querySelectorAll('.section').forEach(section => {
        section.classList.remove('active');
    });
    document.getElementById(tabName).classList.add('active');
}

// Renderizar produtos
function renderProducts() {
    const grid = document.getElementById('productGrid');
    grid.innerHTML = '';

    products.forEach(product => {
        const card = document.createElement('div');
        card.className = 'product-card';
        card.innerHTML = `
            <img src="${product.image}" alt="${product.name}" class="product-image">
            <div class="product-info">
                <h3 class="product-name">${product.name}</h3>
                <div class="product-price">R$ ${product.price.toFixed(2)}</div>
                
                <div class="product-details">
                    <div class="detail-label">Tamanhos disponíveis:</div>
                    <div class="tags">
                        ${product.sizes.map(size => `<span class="tag">${size}</span>`).join('')}
                    </div>
                </div>

                <div class="product-details">
                    <div class="detail-label">Cores disponíveis:</div>
                    <div class="tags">
                        ${product.colors.map(color => `<span class="tag color">${color}</span>`).join('')}
                    </div>
                </div>

                <button class="btn btn-primary" onclick="selectProduct(${product.id})">
                    🛒 Agendar Compra
                </button>
            </div>
        `;
        grid.appendChild(card);
    });

    // Popular select do formulário
    const productSelect = document.getElementById('productId');
    productSelect.innerHTML = '<option value="">Selecione um produto</option>';
    products.forEach(product => {
        const option = document.createElement('option');
        option.value = product.id;
        option.textContent = `${product.name} - R$ ${product.price.toFixed(2)}`;
        productSelect.appendChild(option);
    });
}

// Selecionar produto
function selectProduct(productId) {
    selectedProductId = productId;
    document.getElementById('productId').value = productId;
    handleProductChange();
    switchTab('schedule');
}

// Quando o produto muda no formulário
function handleProductChange() {
    const productId = parseInt(document.getElementById('productId').value);
    const product = products.find(p => p.id === productId);
    
    const sizeSelect = document.getElementById('size');
    const colorSelect = document.getElementById('color');
    const preview = document.getElementById('productPreview');

    if (product) {
        // Atualizar preview
        preview.innerHTML = `
            <div class="product-preview">
                <img src="${product.image}" alt="${product.name}" class="preview-image">
                <div class="preview-info">
                    <h3>${product.name}</h3>
                    <div class="preview-price">R$ ${product.price.toFixed(2)}</div>
                </div>
            </div>
        `;

        // Atualizar tamanhos
        sizeSelect.innerHTML = '<option value="">Selecione</option>';
        product.sizes.forEach(size => {
            const option = document.createElement('option');
            option.value = size;
            option.textContent = size;
            sizeSelect.appendChild(option);
        });
        sizeSelect.disabled = false;

        // Atualizar cores
        colorSelect.innerHTML = '<option value="">Selecione</option>';
        product.colors.forEach(color => {
            const option = document.createElement('option');
            option.value = color;
            option.textContent = color;
            colorSelect.appendChild(option);
        });
        colorSelect.disabled = false;

        updateTotal();
    } else {
        preview.innerHTML = '';
        sizeSelect.innerHTML = '<option value="">Selecione</option>';
        sizeSelect.disabled = true;
        colorSelect.innerHTML = '<option value="">Selecione</option>';
        colorSelect.disabled = true;
        document.getElementById('totalBox').style.display = 'none';
    }
}

// Atualizar total
function updateTotal() {
    const productId = parseInt(document.getElementById('productId').value);
    const quantity = parseInt(document.getElementById('quantity').value) || 0;
    const product = products.find(p => p.id === productId);
    
    const totalBox = document.getElementById('totalBox');
    const totalValue = document.getElementById('totalValue');

    if (product && quantity > 0) {
        const total = product.price * quantity;
        totalValue.textContent = `R$ ${total.toFixed(2)}`;
        totalBox.style.display = 'flex';
    } else {
        totalBox.style.display = 'none';
    }
}

// Validar formulário
function validateForm() {
    const errors = {};
    
    const productId = document.getElementById('productId').value;
    const size = document.getElementById('size').value;
    const color = document.getElementById('color').value;
    const quantity = parseInt(document.getElementById('quantity').value);
    const customerName = document.getElementById('customerName').value.trim();
    const customerEmail = document.getElementById('customerEmail').value.trim();
    const customerPhone = document.getElementById('customerPhone').value.trim();
    const scheduledDate = document.getElementById('scheduledDate').value;

    if (!productId) errors.productId = 'Selecione um produto';
    if (!size) errors.size = 'Selecione um tamanho';
    if (!color) errors.color = 'Selecione uma cor';
    if (!quantity || quantity < 1) errors.quantity = 'Quantidade mínima é 1';
    if (!customerName) errors.customerName = 'Nome é obrigatório';
    if (!customerEmail) errors.customerEmail = 'Email é obrigatório';
    else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(customerEmail)) {
        errors.customerEmail = 'Email inválido';
    }
    if (!customerPhone) errors.customerPhone = 'Telefone é obrigatório';
    if (!scheduledDate) errors.scheduledDate = 'Data é obrigatória';

    // Limpar erros anteriores
    document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
    document.querySelectorAll('.form-input, .form-select').forEach(el => {
        el.classList.remove('error');
    });

    // Mostrar novos erros
    Object.keys(errors).forEach(field => {
        const errorEl = document.getElementById(field + 'Error');
        const inputEl = document.getElementById(field);
        if (errorEl) errorEl.textContent = errors[field];
        if (inputEl) inputEl.classList.add('error');
    });

    return Object.keys(errors).length === 0;
}

// Enviar formulário
function handleSubmit(e) {
    e.preventDefault();
    
    if (!validateForm()) return;

    const productId = parseInt(document.getElementById('productId').value);
    const product = products.find(p => p.id === productId);

    const schedule = {
        id: Date.now().toString(),
        product: product,
        size: document.getElementById('size').value,
        color: document.getElementById('color').value,
        quantity: parseInt(document.getElementById('quantity').value),
        customerName: document.getElementById('customerName').value.trim(),
        customerEmail: document.getElementById('customerEmail').value.trim(),
        customerPhone: document.getElementById('customerPhone').value.trim(),
        scheduledDate: document.getElementById('scheduledDate').value,
        notes: document.getElementById('notes').value.trim(),
        createdAt: new Date().toISOString()
    };

    schedules.push(schedule);
    saveSchedules();
    renderScheduleList();
    updateScheduleCount();
    
    // Limpar formulário
    document.getElementById('scheduleForm').reset();
    document.getElementById('productPreview').innerHTML = '';
    document.getElementById('totalBox').style.display = 'none';
    document.getElementById('size').disabled = true;
    document.getElementById('color').disabled = true;
    
    // Ir para lista
    switchTab('list');
    
    alert('✅ Agendamento realizado com sucesso!');
}

// Cancelar agendamento
function cancelSchedule() {
    if (confirm('Deseja cancelar este agendamento?')) {
        document.getElementById('scheduleForm').reset();
        document.getElementById('productPreview').innerHTML = '';
        document.getElementById('totalBox').style.display = 'none';
        switchTab('catalog');
    }
}

//=== FUNÇÕES DO CARRINHO ===//

// Renderizar carrinho
function renderCart() {
    const cartContent = document.getElementById('cartContent');
    const description = document.getElementById('cartDescription');
    
    if (cart.length === 0) {
        description.textContent = 'Seu carrinho está vazio';
        cartContent.innerHTML = `
            <div class="empty-state">
                <div class="empty-icon">🛒</div>
                <h3 class="empty-title">Seu carrinho está vazio</h3>
                <p class="empty-text">Adicione produtos ao carrinho para começar!</p>
            </div>
        `;
        return;
    }

    const itemCount = cart.reduce((sum, item) => sum + item.quantity, 0);
    const total = cart.reduce((sum, item) => sum + (item.product.price * item.quantity), 0);

    description.textContent = `${itemCount} ${itemCount === 1 ? 'item' : 'itens'} no carrinho`;
    
    cartContent.innerHTML = `
        <div class="cart-items">
            ${cart.map((item, index) => `
                <div class="cart-item">
                    <img src="${item.product.image}" alt="${item.product.name}" class="cart-item-image">
                    <div class="cart-item-info">
                        <div class="cart-item-name">${item.product.name}</div>
                        <div class="cart-item-details">Tamanho: ${item.size} | Cor: ${item.color}</div>
                        <div class="cart-item-price">R$ ${(item.product.price * item.quantity).toFixed(2)}</div>
                    </div>
                    <div class="cart-item-actions">
                        <div class="quantity-controls">
                            <button class="quantity-btn" onclick="updateCartQuantity(${index}, ${item.quantity - 1})">−</button>
                            <span class="quantity-display">${item.quantity}</span>
                            <button class="quantity-btn" onclick="updateCartQuantity(${index}, ${item.quantity + 1})">+</button>
                        </div>
                        <button class="remove-btn" onclick="removeFromCart(${index})">🗑️ Remover</button>
                    </div>
                </div>
            `).join('')}
        </div>

        <div class="cart-summary">
            <div class="cart-summary-row">
                <span class="cart-summary-label">Subtotal (${itemCount} ${itemCount === 1 ? 'item' : 'itens'})</span>
                <span class="cart-summary-value">R$ ${total.toFixed(2)}</span>
            </div>
            <div class="cart-summary-row">
                <span class="cart-total-label">Total</span>
                <span class="cart-total-value">R$ ${total.toFixed(2)}</span>
            </div>
            <div class="cart-actions">
                <button class="btn btn-primary" onclick="checkoutCart()">✅ Finalizar Pedido</button>
                <button class="btn btn-secondary" onclick="clearCart()">🗑️ Limpar Carrinho</button>
            </div>
        </div>
    `;
}

// Adicionar ao carrinho
function addToCart(productId, size, color, quantity) {
    const product = products.find(p => p.id === productId);
    if (!product) return;

    // Verificar se o item já existe no carrinho
    const existingIndex = cart.findIndex(item => 
        item.product.id === productId && 
        item.size === size && 
        item.color === color
    );

    if (existingIndex >= 0) {
        // Atualizar quantidade
        cart[existingIndex].quantity += quantity;
    } else {
        // Adicionar novo item
        cart.push({
            product: product,
            size: size,
            color: color,
            quantity: quantity
        });
    }

    saveCart();
    renderCart();
    updateCartCount();
    alert('✅ Produto adicionado ao carrinho!');
}

// Atualizar quantidade no carrinho
function updateCartQuantity(index, newQuantity) {
    if (newQuantity < 1) {
        removeFromCart(index);
        return;
    }

    cart[index].quantity = newQuantity;
    saveCart();
    renderCart();
    updateCartCount();
}

// Remover do carrinho
function removeFromCart(index) {
    if (confirm('Deseja remover este item do carrinho?')) {
        cart.splice(index, 1);
        saveCart();
        renderCart();
        updateCartCount();
    }
}

// Limpar carrinho
function clearCart() {
    if (confirm('Deseja limpar todo o carrinho?')) {
        cart = [];
        saveCart();
        renderCart();
        updateCartCount();
    }
}

// Finalizar pedido
function checkoutCart() {
    if (cart.length === 0) {
        alert('❌ Seu carrinho está vazio!');
        return;
    }

    const customerName = prompt('Digite seu nome:');
    if (!customerName) return;

    const customerEmail = prompt('Digite seu email:');
    if (!customerEmail || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(customerEmail)) {
        alert('❌ Email inválido!');
        return;
    }

    const customerPhone = prompt('Digite seu telefone:');
    if (!customerPhone) return;

    const scheduledDate = prompt('Digite a data de retirada (dd/mm/aaaa):');
    if (!scheduledDate) return;

    // Converter cada item do carrinho em um agendamento
    cart.forEach(item => {
        const schedule = {
            id: Date.now().toString() + Math.random(),
            product: item.product,
            size: item.size,
            color: item.color,
            quantity: item.quantity,
            customerName: customerName,
            customerEmail: customerEmail,
            customerPhone: customerPhone,
            scheduledDate: scheduledDate,
            notes: 'Pedido via carrinho',
            createdAt: new Date().toISOString()
        };

        schedules.push(schedule);
    });

    saveSchedules();
    renderScheduleList();
    updateScheduleCount();

    // Limpar carrinho
    cart = [];
    saveCart();
    renderCart();
    updateCartCount();

    alert('✅ Pedido finalizado com sucesso!');
    switchTab('list');
}

// Atualizar contador do carrinho
function updateCartCount() {
    const count = cart.reduce((sum, item) => sum + item.quantity, 0);
    document.getElementById('cartBadge').textContent = count;
}

// Salvar carrinho
function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Carregar carrinho
function loadCart() {
    const saved = localStorage.getItem('cart');
    if (saved) {
        try {
            cart = JSON.parse(saved);
        } catch (e) {
            cart = [];
        }
    }
}

//=== FUNÇÕES DE AGENDAMENTOS ===//

// Renderizar lista de agendamentos
function renderScheduleList() {
    const list = document.getElementById('scheduleList');
    const description = document.getElementById('listDescription');
    
    if (schedules.length === 0) {
        description.textContent = 'Você ainda não tem agendamentos';
        list.innerHTML = `
            <div class="empty-state">
                <div class="empty-icon">📅</div>
                <h3 class="empty-title">Nenhum agendamento ainda</h3>
                <p class="empty-text">Comece navegando pelo catálogo e agendando sua primeira compra!</p>
            </div>
        `;
        return;
    }

    description.textContent = `Você tem ${schedules.length} ${schedules.length === 1 ? 'agendamento' : 'agendamentos'}`;
    
    // Ordenar por data de criação (mais recentes primeiro)
    const sorted = [...schedules].sort((a, b) => 
        new Date(b.createdAt).getTime() - new Date(a.createdAt).getTime()
    );

    list.innerHTML = sorted.map(schedule => {
        const total = schedule.product.price * schedule.quantity;
        return `
            <div class="schedule-card">
                <div class="schedule-content">
                    <img src="${schedule.product.image}" alt="${schedule.product.name}" class="schedule-image">
                    <div class="schedule-info">
                        <div class="schedule-header">
                            <div>
                                <h3 class="schedule-title">${schedule.product.name}</h3>
                                <p class="schedule-date">Agendado em: ${formatDateTime(schedule.createdAt)}</p>
                            </div>
                            <button class="btn btn-danger" onclick="deleteSchedule('${schedule.id}')" style="width: auto; padding: 8px 16px;">
                                🗑️ Cancelar
                            </button>
                        </div>

                        <div class="info-grid">
                            <div class="info-box purple">
                                <div class="info-box-title">📦 Produto</div>
                                <div class="info-box-content">
                                    <strong>Tamanho:</strong> ${schedule.size}<br>
                                    <strong>Cor:</strong> ${schedule.color}<br>
                                    <strong>Qtd:</strong> ${schedule.quantity}
                                </div>
                            </div>

                            <div class="info-box blue">
                                <div class="info-box-title">👤 Cliente</div>
                                <div class="info-box-content">
                                    <strong>${schedule.customerName}</strong><br>
                                    📧 ${schedule.customerEmail}<br>
                                    📞 ${schedule.customerPhone}
                                </div>
                            </div>

                            <div class="info-box green">
                                <div class="info-box-title">📅 Agendamento</div>
                                <div class="info-box-content">
                                    <strong>Data:</strong> ${formatDate(schedule.scheduledDate)}<br>
                                    <strong style="font-size: 18px; color: #059669;">R$ ${total.toFixed(2)}</strong>
                                </div>
                            </div>
                        </div>

                        ${schedule.notes ? `
                            <div class="notes-box">
                                <div class="notes-title">💬 Observações</div>
                                <div class="notes-text">${schedule.notes}</div>
                            </div>
                        ` : ''}
                    </div>
                </div>
            </div>
        `;
    }).join('');
}

// Deletar agendamento
function deleteSchedule(id) {
    if (confirm('Tem certeza que deseja cancelar este agendamento?')) {
        schedules = schedules.filter(s => s.id !== id);
        saveSchedules();
        renderScheduleList();
        updateScheduleCount();
    }
}

// Atualizar contador
function updateScheduleCount() {
    const count = schedules.length;
    document.getElementById('scheduleCount').textContent = 
        `${count} ${count === 1 ? 'Agendamento' : 'Agendamentos'}`;
}

// Formatar data
function formatDate(dateString) {
    // Tentar diferentes formatos de data
    let date;
    if (dateString.includes('/')) {
        // Formato dd/mm/aaaa
        const parts = dateString.split('/');
        date = new Date(parts[2], parts[1] - 1, parts[0]);
    } else if (dateString.includes('-')) {
        // Formato yyyy-mm-dd
        date = new Date(dateString + 'T00:00:00');
    } else {
        date = new Date(dateString);
    }
    
    return date.toLocaleDateString('pt-BR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    });
}

// Formatar data e hora
function formatDateTime(dateString) {
    const date = new Date(dateString);
    return date.toLocaleString('pt-BR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Salvar no localStorage
function saveSchedules() {
    localStorage.setItem('schedules', JSON.stringify(schedules));
}

// Carregar do localStorage
function loadSchedules() {
    const saved = localStorage.getItem('schedules');
    if (saved) {
        try {
            schedules = JSON.parse(saved);
        } catch (e) {
            schedules = [];
        }
    }
}
