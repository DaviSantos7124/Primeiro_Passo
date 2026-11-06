

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
         
            //nome
            let nomeregex = /^[A-Za-zÀ-ÿ]+(?:\s+[A-Za-zÀ-ÿ]+)+$/;
            let cargoregex =/^[\p{L}\p{M}\d\s.,()\/-]+$/u ;
            
            switch (input.id) {

                case 'nome':
                    if (!valor) {
                        mensagem = 'Informe o nome.';
                    } else if (!nomeregex.test(valor.trim())) {
                        mensagem = 'Digite seu nome completo (nome e sobrenome).';
                    }
                    break;

                        case 'cargo':
                    if (!valor) {
                        mensagem = 'Informe o cargo.';
                    } else if (!cargoregex.test(valor.trim())) {
                        mensagem = 'Digite seu cargo.';
                    }
                    break;


                case 'email-contato':
                    if (!valor) {
                        mensagem = 'Informe um endereço de e-mail válido.';
                    } else if (!emailregex.test(valor)) {
                        mensagem = 'Informe um endereço de e-mail válido.';
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

         

                case 'cargo':
                    if (!valor) {
                        mensagem = 'Confirme sua senha.';
                    } else if (valor != document.getElementById('senha').value) {
                        mensagem = 'As senhas não coincidem.';
                    }
                    break;
            }

            const caixa = input.closest('.campo-cadastro');
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


        formulario.querySelectorAll('input').forEach(function (input) {
            input.addEventListener('input', function () {
                validarCampo(input);
                mensagemSucesso.style.display = 'none';


          
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


     
