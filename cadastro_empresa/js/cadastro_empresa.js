

        //mascara para os campos
        $('#celular').mask('(00) 00000-0000');
        $('#cnpj').mask('00.000.000/0000-00');

        const formulario = document.getElementById('formulario');
        const mensagemSucesso = document.getElementById('mensagem-sucesso');

        //valida o cnpj mas apenas pelo numero para saber se realmente existe devera ser consultado com alguma api
        function validarCNPJ(valor) {
            const cnpj = valor.replace(/\D/g, '');

            if (cnpj.length != 14 || /^(\d)\1{13}$/.test(cnpj)) {
                return false;
            }

            function calcularDigito(base, pesos) {
                let soma = 0;

                for (let i = 0; i < pesos.length; i++) {
                    soma += Number(base[i]) * pesos[i];
                }

                const resto = soma % 11;
                return resto < 2 ? 0 : 11 - resto;
            }

            const pesosPrimeiro = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
            const primeiroDigito = calcularDigito(cnpj, pesosPrimeiro);

            if (primeiroDigito != Number(cnpj[12])) {
                return false;
            }

            const pesosSegundo = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
            const segundoDigito = calcularDigito(cnpj, pesosSegundo);

            return segundoDigito == Number(cnpj[13]);
        }


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

            switch (input.id) {
                case 'razaosocial':
                    if (!valor) {
                        mensagem = 'Informe a razão social.';
                    } else if (valor.length < 3) {
                        mensagem = 'Digite pelo menos 3 caracteres.';
                    }
                    break;

                case 'nomeFantasia':
                    if (!valor) {
                        mensagem = 'Informe o nome fantasia.';
                    } else if (valor.length < 3) {
                        mensagem = 'Digite pelo menos 3 caracteres.';
                    }
                    break;

                case 'cnpj':
                    if (valor != '' && !validarCNPJ(valor)) {
                        mensagem = 'Informe um CNPJ válido.';
                    }
                    break;

                case 'email':
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
            //nao testei 
            //parei aquei

            const caixa = input.closest('.campo-cadastro, .campo-cadastro2');
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


        document.getElementById('voltar').addEventListener('click', function () {
            if (window.history.length > 1) {
                window.history.back();
            }
        });
    