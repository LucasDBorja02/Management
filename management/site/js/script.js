document.addEventListener('DOMContentLoaded', () => {
    // Função para validar o formulário de login
    const loginForm = document.querySelector('form[action="login.php"]');
    if (loginForm) {
        loginForm.addEventListener('submit', (event) => {
            const email = document.getElementById('email').value;
            const senha = document.getElementById('senha').value;
            if (email.trim() === '' || senha.trim() === '') {
                event.preventDefault();
                alert('Por favor, preencha todos os campos.');
            }
        });
    }

    // Função para validar o formulário de registro
    const registerForm = document.querySelector('form[action="register.php"]');
    if (registerForm) {
        registerForm.addEventListener('submit', (event) => {
            const nome = document.getElementById('nome').value;
            const cpf = document.getElementById('cpf').value;
            const endereco = document.getElementById('endereco').value;
            const telefone = document.getElementById('telefone').value;
            const email = document.getElementById('email').value;
            const senha = document.getElementById('senha').value;

            if (nome.trim() === '' || cpf.trim() === '' || endereco.trim() === '' || telefone.trim() === '' || email.trim() === '' || senha.trim() === '') {
                event.preventDefault();
                alert('Todos os campos devem ser preenchidos.');
            }
        });
    }

    // Função para manipular a adição de produtos ao carrinho
    const cartLinks = document.querySelectorAll('a[href*="carrinho.php"]');
    if (cartLinks) {
        cartLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                const productId = link.href.split('produto_id=')[1];

                fetch(`/pages/carrinho.php?produto_id=${productId}`)
                    .then(response => response.text())
                    .then(result => {
                        alert('Produto adicionado ao carrinho com sucesso!');
                        // Aqui você pode atualizar o carrinho, exibir a quantidade no canto da página, etc.
                    })
                    .catch(error => {
                        console.error('Erro ao adicionar ao carrinho:', error);
                    });
            });
        });
    }

    // Manipular o botão de finalizar compra (só para garantir a validação de pagamento)
    const checkoutForm = document.querySelector('form[action="checkout.php"]');
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', (event) => {
            const formaPagamento = document.getElementById('forma_pagamento').value;
            if (formaPagamento === '') {
                event.preventDefault();
                alert('Por favor, selecione uma forma de pagamento.');
            }
        });
    }
});
