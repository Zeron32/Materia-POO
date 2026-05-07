// =======================
// Catálogo de Produtos
// =======================
const products = [
    { id: 1, name: 'Camiseta Básica Branca', price: 49.90, image: 'https://images.unsplash.com/photo-1648483098902-7af8f711498f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHx3aGl0ZSUyMHQtc2hpcnQlMjBwcm9kdWN0fGVufDF8fHx8MTc3NDAyMjQ4M3ww&ixlib=rb-4.1.0&q=80&w=1080', sizes: ['P','M','G','GG'], colors: ['Branco','Off-White'] },
    { id: 2, name: 'Camiseta Básica Preta', price: 49.90, image: 'https://images.unsplash.com/photo-1610502778270-c5c6f4c7d575?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxibGFjayUyMHQtc2hpcnQlMjBwcm9kdWN0fGVufDF8fHx8MTc3NDA0NjkzNHww&ixlib=rb-4.1.0&q=80&w=1080', sizes: ['P','M','G','GG'], colors: ['Preto','Carvão'] },
    { id: 3, name: 'Camiseta Azul', price: 54.90, image: 'https://images.unsplash.com/photo-1760864407190-5351a18d2a26?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxibHVlJTIwdC1zaGlydCUyMHByb2R1Y3R8ZW58MXx8fHwxNzczOTczNDA4fDA&ixlib=rb-4.1.0&q=80&w=1080', sizes: ['P','M','G','GG','XG'], colors: ['Azul Marinho','Azul Royal'] },
    { id: 4, name: 'Camiseta Vermelha', price: 54.90, image: 'https://images.unsplash.com/photo-1773936846384-c143d3969fa0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxyZWQlMjB0LXNoaXJ0JTIwcHJvZHVjdHxlbnwxfHx8fDE3NzQwNDY5MzR8MA&ixlib=rb-4.1.0&q=80&w=1080', sizes: ['P','M','G','GG'], colors: ['Vermelho','Bordô'] },
    { id: 5, name: 'Camiseta Cinza', price: 49.90, image: 'https://images.unsplash.com/photo-1737094540214-261561588b89?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxncmV5JTIwdC1zaGlydCUyMHByb2R1Y3R8ZW58MXx8fHwxNzc0MDQ2OTM1fDA&ixlib=rb-4.1.0&q=80&w=1080', sizes: ['P','M','G','GG'], colors: ['Cinza Mescla','Cinza Escuro'] },
    { id: 6, name: 'Camiseta Verde', price: 54.90, image: 'https://images.unsplash.com/photo-1706550633982-6388c69002a0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxncmVlbiUyMHQtc2hpcnQlMjBwcm9kdWN0fGVufDF8fHx8MTc3NDA0NjkzNXww&ixlib=rb-4.1.0&q=80&w=1080', sizes: ['P','M','G','GG'], colors: ['Verde Musgo','Verde Militar'] }
];

// Preenche o select de produtos
function populateProductSelect() {
    const productSelect = document.getElementById('productId');
    productSelect.innerHTML = '<option value="">Selecione um produto</option>';
    products.forEach(p => {
        const option = document.createElement('option');
        option.value = p.id;
        option.textContent = p.name;
        productSelect.appendChild(option);
    });

    productSelect.addEventListener('change', function() {
        const selected = products.find(p => p.id == this.value);
        populateSizeAndColor(selected);
    });
}

// Preenche tamanho e cor conforme produto escolhido
function populateSizeAndColor(product) {
    const sizeSelect = document.getElementById('size');
    const colorSelect = document.getElementById('color');

    sizeSelect.innerHTML = '';
    colorSelect.innerHTML = '';

    if (product) {
        sizeSelect.disabled = false;
        colorSelect.disabled = false;

        product.sizes.forEach(s => {
            const opt = document.createElement('option');
            opt.value = s;
            opt.textContent = s;
            sizeSelect.appendChild(opt);
        });

        product.colors.forEach(c => {
            const opt = document.createElement('option');
            opt.value = c;
            opt.textContent = c;
            colorSelect.appendChild(opt);
        });
    } else {
        sizeSelect.disabled = true;
        colorSelect.disabled = true;
    }
}

// =======================
// Estado do Carrinho
// =======================
let cart = [];

// =======================
// Alterna entre abas
// =======================
function switchTab(tabName) {
    document.querySelectorAll('.nav-tab').forEach(tab => {
        tab.classList.remove('active');
        if (tab.dataset.tab === tabName) {
            tab.classList.add('active');
        }
    });

    document.querySelectorAll('.section').forEach(section => {
        section.classList.remove('active');
    });
    const section = document.getElementById(tabName);
    if (section) {
        section.classList.add('active');
    }
}

// =======================
// Renderiza catálogo
// =======================
function renderProducts() {
    const grid = document.getElementById('productGrid');
    grid.innerHTML = '';
    products.forEach(p => {
        const card = document.createElement('div');
        card.className = 'product-card';
        card.innerHTML = `
            <img src="${p.image}" alt="${p.name}" class="product-image">
            <div class="product-info">
                <h3 class="product-name">${p.name}</h3>
                <p class="product-price">R$ ${p.price.toFixed(2)}</p>
                <button class="btn btn-primary" onclick="addToCart(${p.id})">Adicionar ao Carrinho</button>
            </div>
        `;
        grid.appendChild(card);
    });
}

// =======================
// Carrinho
// =======================
function addToCart(productId) {
    const product = products.find(p => p.id === productId);
    cart.push(product);
    renderCart();
}

function renderCart() {
    const cartContent = document.getElementById('cartContent');
    const cartDescription = document.getElementById('cartDescription');
    cartContent.innerHTML = '';

    if (cart.length === 0) {
        cartDescription.textContent = 'Seu carrinho está vazio';
    } else {
        cartDescription.textContent = '';
        cart.forEach((item, index) => {
            const div = document.createElement('div');
            div.className = 'cart-item';
            div.innerHTML = `
                <img src="${item.image}" class="cart-item-image">
                <div class="cart-item-info">
                    <h4 class="cart-item-name">${item.name}</h4>
                    <p class="cart-item-price">R$ ${item.price.toFixed(2)}</p>
                </div>
                <button class="remove-btn" onclick="removeFromCart(${index})">Remover</button>
            `;
            cartContent.appendChild(div);
        });
    }

    document.getElementById('cartBadge').textContent = cart.length;
}

function removeFromCart(index) {
    cart.splice(index, 1);
    renderCart();
}

// =======================
// Agendamentos
// =======================
async function carregarAgendamentos() {
    try {
        const response = await fetch(SCHEDULES_URL);
        if (!response.ok) throw new Error('Erro na requisição: ' + response.status);

        const schedules = await response.json();
        const list = document.getElementById('scheduleList');
        const description = document.getElementById('listDescription');

        list.innerHTML = '';
        if (schedules.length === 0) {
            description.textContent = 'Você ainda não tem agendamentos';
        } else {
            description.textContent = '';
            schedules.forEach(s => {
                const card = document.createElement('div');
                card.className = 'schedule-card';
                card.innerHTML = `
                    <div class="schedule-content">
                        <div class="schedule-info">
                            <div class="schedule-header">
                                <h3 class="schedule-title">${s.produto}</h3>
                                <span class="schedule-date">${s.scheduledDate}</span>
                            </div>
                            <div class="info-grid">
                                <div class="info-box purple">
                                    <div class="info-box-title">Cliente</div>
                                    <div class="info-box-content">${s.customerName}</div>
                                </div>
                                <div class="info-box blue">
                                    <div class="info-box-title">Email</div>
                                    <div class="info-box-content">${s.customerEmail}</div>
                                </div>
                                <div class="info-box green">
                                    <div class="info-box-title">Telefone</div>
                                    <div class="info-box-content">${s.customerPhone}</div>
                                </div>
                            </div>
                            <div class="notes-box">
                                <div class="notes-title">Observações</div>
                                <div class="notes-text">${s.notes || ''}</div>
                            </div>
                        </div>
                    </div>
                `;
                list.appendChild(card);
            });
        }

        document.getElementById('scheduleCount').textContent = schedules.length + ' Agendamentos';
    } catch (error) {
        console.error('Erro ao carregar agendamentos:', error);
    }
}

// =======================
// Envia formulário
// =======================
async function handleSubmit(event) {
    event.preventDefault();

    const data = {
        produto: document.getElementById('productId').value,
        tamanho: document.getElementById('size').value,
        cor: document.getElementById('color').value,
        quantidade: document.getElementById('quantity').value,
        customerName: document.getElementById('customerName').value,
        customerEmail: document.getElementById('customerEmail').value,
        customerPhone: document.getElementById('customerPhone').value,
        scheduledDate: document.getElementById('scheduledDate').value,
        notes: document.getElementById('notes') ? document.getElementById('notes').value : ''
    };

    try {
        const response = await fetch(SCHEDULES_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(data)
        });

        if (!response.ok) {
            throw new Error('Erro na requisição');
        }

        const result = await response.json();
        alert('Agendamento salvo com sucesso!');
        carregarAgendamentos();
        switchTab('list');
        event.target.reset();
    } catch (error) {
        console.error('Erro ao enviar agendamento:', error);
        alert('Não foi possível salvar o agendamento.');
    }
}

// =======================
// Deletar
// =======================

async function deleteSchedule(id) {
    if (!confirm('Deseja realmente excluir este agendamento?')) return;

    try {
        const response = await fetch(`${SCHEDULES_URL}/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        });

        if (!response.ok) {
            throw new Error('Erro ao excluir agendamento');
        }

        const result = await response.json();
        if (result.success) {
            alert('Agendamento excluído com sucesso!');
            carregarAgendamentos(); // atualiza lista
        }
    } catch (error) {
        console.error('Erro ao excluir:', error);
        alert('Não foi possível excluir o agendamento.');
    }
}


// =======================
// Inicialização
// =======================
function setupEventListeners() {
    document.querySelectorAll('.nav-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            switchTab(this.dataset.tab);
        });
    });

    const form = document.getElementById('scheduleForm');
    if (form) {
        form.addEventListener('submit', handleSubmit);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    setupEventListeners();
    renderProducts();
    renderCart();
    carregarAgendamentos();
    carregarAgendamentos();
    populateProductSelect();
});
