
        //mascara para os campos

        $('#cep').mask('00000-000');

        const formulario = document.getElementById('formulario');

        const formulariocep = document.getElementById('formulariocep');
        const mensagemSucesso = document.getElementById('mensagem-sucesso');


        function validarCampo(input) {
            const valor = input.value.trim();
            let mensagem = '';

            // Regex
            // CEP
            let cepregex = /^\d{5}-?\d{3}$/;

            // Número
            let numeroregex = /^[0-9]+$/;

            // Estado
            let estadoregex = /^[A-Za-z]{2}$/;

            switch (input.id) {

                case 'cep':
                    if (!valor) {
                        mensagem = 'Informe o CEP.';
                    } else if (!cepregex.test(valor)) {
                        mensagem = 'Informe um CEP válido.';
                    }
                    break;

                case 'rua':
                    if (!valor) {
                        mensagem = 'Informe o nome da rua.';
                    } else if (valor.length < 3) {
                        mensagem = 'Digite pelo menos 3 caracteres.';
                    }
                    break;

                case 'numero':
                    if (!valor) {
                        mensagem = 'Informe o número do endereço.';
                    } else if (!numeroregex.test(valor)) {
                        mensagem = 'Informe um número válido.';
                    }
                    break;


                case 'bairro':
                    if (!valor) {
                        mensagem = 'Informe o bairro.';
                    } else if (valor.length < 2) {
                        mensagem = 'Digite pelo menos 2 caracteres.';
                    }
                    break;

                case 'cidade':
                    if (!valor) {
                        mensagem = 'Informe a cidade.';
                    } else if (valor.length < 2) {
                        mensagem = 'Digite pelo menos 2 caracteres.';
                    }
                    break;

                case 'estado':
                    if (!valor) {
                        mensagem = 'Informe o estado.';
                    } else if (!estadoregex.test(valor)) {
                        mensagem = 'Informe a sigla do estado (ex.: SP).';
                    }
                    break;
            }

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

        document.getElementById('cep-hidden').value =
                document.getElementById('cep').value;
            formulario.submit();
        });

   
    