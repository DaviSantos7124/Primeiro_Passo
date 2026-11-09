

//mascara para os campos
$('#celular').mask('(00) 00000-0000');

const formulario = document.getElementById('formulario');
const mensagemSucesso = document.getElementById('mensagem-sucesso');


function validarCampo(input) {
    const valor = input.value.trim();
    let mensagem = '';
    //Regex
    //email
    let emailregex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
    //celular
    let celularregex = /^(\d)\1{10}$/;
    //Senha
    let senharegexM = /[A-Z]/;
    let senharegexm = /[a-z]/;
    let senharegexnum = /[0-9]/;
    let senharegexcaracter = /[^A-Za-z0-9]/;
    //nome
    let nomeregex = /^[A-Za-zÀ-ÿ]+(?:\s+[A-Za-zÀ-ÿ]+)+$/;
    switch (input.id) {

        case 'nome':
            if (!valor) {
                mensagem = 'Informe o nome.';
            } else if (!nomeregex.test(valor.trim())) {
                mensagem = 'Digite seu nome completo (nome e sobrenome).';
            }
            break;


        case 'email':
            if (!valor) {
                mensagem = 'Informe um endereço de e-mail válido.';
            } else if (!emailregex.test(valor)) {
                mensagem = 'Informe um endereço de e-mail válido.';
            } else if (erroEmail != '') {
                mensagem = erroEmail;
                 erroEmail = '';
            }
            break;

        case 'celular': {
            const numeros = valor.replace(/\D/g, '');

            if (!valor) {
                mensagem = 'Informe o telefone.';
            } else if (numeros.length != 11) {
                mensagem = 'Informe o telefone com DDD e 11 dígitos.';
            } else if (celularregex.test(numeros)) {
                mensagem = 'Informe um telefone válido.';
            }
            break;
        }

        case 'senha':
            if (!valor) {
                mensagem = 'Crie uma senha.';
            } else if (valor.length < 8) {
                mensagem = 'A senha deve ter pelo menos 8 caracteres.';
            } else if (!senharegexM.test(valor)) {
                mensagem = 'Inclua pelo menos uma letra maiúscula.';
            } else if (!senharegexm.test(valor)) {
                mensagem = 'Inclua pelo menos uma letra minúscula.';
            } else if (!senharegexnum.test(valor)) {
                mensagem = 'Inclua pelo menos um número.';
            } else if (!senharegexcaracter.test(valor)) {
                mensagem = 'Inclua pelo menos um caractere especial.';
            }
            break;

        case 'confirmar-senha':
            if (!valor) {
                mensagem = 'Confirme sua senha.';
            } else if (valor != document.getElementById('senha').value) {
                mensagem = 'As senhas não coincidem.';
            }
            break;
    }

    const caixa = input.closest('.campo');
    const erro = document.getElementById('erro-' + input.id);

    if (erro) {
        erro.textContent = mensagem;
    }

    if (caixa) {
        caixa.classList.toggle('campo-invalido', mensagem != '');
        caixa.classList.toggle('campo-valido', mensagem == '' && valor != '');
    }

    input.setAttribute('aria-invalid', mensagem ? 'true' : 'false');

    return mensagem == '';
}
if (erroEmail != '') {
    validarCampo(document.getElementById('email'));
}

formulario.querySelectorAll('input').forEach(function (input) {
    input.addEventListener('input', function () {
        validarCampo(input);
        mensagemSucesso.style.display = 'none';


        if (input.id == 'senha') {
            const confirmacao = document.getElementById('confirmar-senha');

            if (confirmacao.value != '') {
                validarCampo(confirmacao);
            }
        }
    });

    input.addEventListener('blur', function () {
        validarCampo(input);
    });
});

formulario.addEventListener('submit', function (evento) {
    evento.preventDefault();

    let formularioValido = true;
    let primeiroCampoInvalido = null;

    formulario.querySelectorAll('input').forEach(function (input) {
        const campoValido = validarCampo(input);

        if (input.id == 'email') {
            erroEmail = '';
        }
        if (!campoValido) {
            formularioValido = false;

            if (!primeiroCampoInvalido) {
                primeiroCampoInvalido = input;
            }
        }
    });

    if (formularioValido == false) {
        mensagemSucesso.style.display = 'none';
        primeiroCampoInvalido.focus();
        return;
    }


    formulario.submit();
});
