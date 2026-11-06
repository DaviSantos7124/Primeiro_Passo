
        $('#inicio').mask('00/0000');
        $('#fim').mask('00/0000');

        const formulario = document.getElementById('formulario');

        function limparValidacao(input) {
            const caixa = input.closest('.campo');
            const erro = document.getElementById('erro-' + input.id);

            if (erro) erro.textContent = '';
            if (caixa) caixa.classList.remove('campo-invalido', 'campo-valido');
            input.removeAttribute('aria-invalid');
        }

        function atualizarCampos() {
            const experiencia = document.querySelector('input[name="experiencia"]:checked');
            const campos = formulario.querySelectorAll('input[type="text"]');

            campos.forEach(function (campo) {
                if (experiencia && experiencia.value == 'Sim') {
                    campo.disabled = false;
                } else {
                    campo.disabled = true;
                    campo.value = '';
                    limparValidacao(campo);
                }
            });
        }

        function validarCampo(input) {
            if (input.disabled) {
                limparValidacao(input);
                return true;
            }

            const valor = input.value.trim();
            const textoregex = /^[\p{L}\p{M}\d\s.,()\/-]+$/u;
            const dataregex = /^(0[1-9]|1[0-2])\/\d{4}$/;
            const hoje = new Date();
            const mesAtual = hoje.getFullYear() * 12 + hoje.getMonth() + 1;
            let mensagem = '';

            switch (input.id) {
                case 'empresa':
                    if (!valor) {
                        mensagem = 'Informe o nome da empresa.';
                    } else if (valor.length < 2) {
                        mensagem = 'Digite pelo menos 2 caracteres.';
                    } else if (!textoregex.test(valor)) {
                        mensagem = 'Informe um nome de empresa válido.';
                    }
                    break;

                case 'cargo':
                    if (!valor) {
                        mensagem = 'Informe o cargo que você ocupou.';
                    } else if (valor.length < 3) {
                        mensagem = 'Digite pelo menos 3 caracteres.';
                    } else if (!textoregex.test(valor)) {
                        mensagem = 'Informe um cargo válido.';
                    }
                    break;

                case 'inicio':
                    if (!valor) {
                        mensagem = 'Informe a data de início.';
                    } else if (!dataregex.test(valor)) {
                        mensagem = 'Informe uma data válida (ex.: 01/2024).';
                    } else {
                        const [mes, ano] = valor.split('/').map(Number);
                        const dataInicio = ano * 12 + mes;
                        if (ano < 1950 || dataInicio > mesAtual) {
                            mensagem = 'A data de início deve ser válida e não pode ser futura.';
                        }
                    }
                    break;

                case 'fim':
                   
                    if (valor) {
                        if (!dataregex.test(valor)) {
                            mensagem = 'Informe uma data válida (ex.: 12/2025).';
                        } else {
                            const [mes, ano] = valor.split('/').map(Number);
                            const dataFim = ano * 12 + mes;
                            const inicio = document.getElementById('inicio').value.trim();

                            if (ano < 1950 || dataFim >  mesAtual) {
                                mensagem = 'A data de fim deve ser válida e não pode ser futura.';
                            } else if (dataregex.test(inicio)) {
                                const [mesInicio, anoInicio] = inicio.split('/').map(Number);
                                if (dataFim < anoInicio * 12 + mesInicio) {
                                    mensagem = 'A data de fim não pode ser anterior ao início.';
                                }
                            }
                        }
                    }
                    break;
            }

            const caixa = input.closest('.campo');
            const erro = document.getElementById('erro-' + input.id);

            if (erro) erro.textContent = mensagem;
            if (caixa) {
                caixa.classList.toggle('campo-invalido', mensagem != '');
                caixa.classList.toggle('campo-valido', mensagem == '' && valor != '');
            }
            input.setAttribute('aria-invalid', mensagem ? 'true' : 'false');
            return mensagem == '';
        }

        formulario.querySelectorAll('input[type="text"]').forEach(function (input) {
            input.addEventListener('input', function () {
                validarCampo(input);
                if (input.id == 'inicio' && document.getElementById('fim').value) {
                    validarCampo(document.getElementById('fim'));
                }
            });
            input.addEventListener('blur', function () {
                validarCampo(input);
            });
        });

        formulario.querySelectorAll('input[name="experiencia"]').forEach(function (input) {
            input.addEventListener('change', atualizarCampos);
        });

        atualizarCampos();

        formulario.addEventListener('submit', function (evento) {
            evento.preventDefault();
            const experiencia = document.querySelector('input[name="experiencia"]:checked');

            if (!experiencia) {
                alert('Informe se você já teve experiência profissional.');
                return;
            }

            let formularioValido = true;
            let primeiroCampoInvalido = null;

            formulario.querySelectorAll('input[type="text"]').forEach(function (input) {
                if (!validarCampo(input)) {
                    formularioValido = false;
                    if (!primeiroCampoInvalido) primeiroCampoInvalido = input;
                }
            });

            if (!formularioValido) {
                primeiroCampoInvalido.focus();
                return;
            }

            formulario.submit();
        });
