

        $('#conclusao').mask('0000');

        const formulario = document.getElementById('formulario');
        const cursosComp = document.getElementById('cursos_comp');
        const area = document.getElementById('area');

        function limparValidacao(input) {
            const caixa = input.closest('.campo-cadastro, .campo-cadastro2');
            const erro = document.getElementById('erro-' + input.id);

            if (erro) {
                erro.textContent = '';
            }

            if (caixa) {
                caixa.classList.remove('campo-invalido', 'campo-valido');
            }

            input.removeAttribute('aria-invalid');
        }

        function atualizarCampos() {
            const complementar = document.querySelector('input[name="complementar"]:checked');
            const programa = document.querySelector('input[name="programa"]:checked');

            if (complementar && complementar.value == 'Sim') {
                cursosComp.disabled = false;
            } else {
                cursosComp.disabled = true;
                cursosComp.value = '';
                limparValidacao(cursosComp);
            }

            if (programa && programa.value == 'Sim') {
                area.disabled = false;
            } else {
                area.disabled = true;
                area.value = '';
                limparValidacao(area);
            }
        }

        function validarCampo(input) {
            if (input.disabled) {
                limparValidacao(input);
                return true;
            }

            const valor = input.value.trim();
            let mensagem = '';

            let anoregex = /^\d{4}$/;
            let textoregex = /^[\p{L}\p{M}\d\s.,()\/-]+$/u;

            switch (input.id) {

                case 'nivel':
                    if (!valor) {
                        mensagem = 'Selecione seu nível de escolaridade.';
                    }
                    break;

                case 'instituicao':
                    if (!valor) {
                        mensagem = 'Informe a instituição de ensino.';
                    } else if (valor.length < 3) {
                        mensagem = 'Digite pelo menos 3 caracteres.';
                    } else if (!textoregex.test(valor)) {
                        mensagem = 'Informe uma instituição válida.';
                    }
                    break;

                case 'curso':
                    if (!valor) {
                        mensagem = 'Informe seu curso ou formação.';
                    } else if (valor.length < 3) {
                        mensagem = 'Digite pelo menos 3 caracteres.';
                    } else if (!textoregex.test(valor)) {
                        mensagem = 'Informe um curso válido.';
                    }
                    break;

                case 'conclusao':
                    const anoAtual = new Date().getFullYear();

                    if (!valor) {
                        mensagem = 'Informe o ano de conclusão.';
                    } else if (!anoregex.test(valor)) {
                        mensagem = 'Informe um ano válido (ex.: 2026).';
                    } else if (
                        Number(valor) < 1950 ||
                        Number(valor) > anoAtual + 20
                    ) {
                        mensagem = 'Informe um ano de conclusão válido.';
                    }
                    break;

                case 'cursos_comp':
                    if (!valor) {
                        mensagem = 'Informe seus cursos complementares.';
                    } else if (valor.length < 3) {
                        mensagem = 'Digite pelo menos 3 caracteres.';
                    } else if (!textoregex.test(valor)) {
                        mensagem = 'Informe um curso válido.';
                    }
                    break;

                case 'area':
                    if (!valor) {
                        mensagem = 'Informe a área do programa ou estágio.';
                    } else if (valor.length < 3) {
                        mensagem = 'Digite pelo menos 3 caracteres.';
                    } else if (!textoregex.test(valor)) {
                        mensagem = 'Informe uma área válida.';
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
                caixa.classList.toggle(
                    'campo-valido',
                    mensagem == '' && valor != ''
                );
            }

            input.setAttribute(
                'aria-invalid',
                mensagem ? 'true' : 'false'
            );

            return mensagem == '';
        }

        formulario.querySelectorAll(
            'input[type="text"], select'
        ).forEach(function (input) {

            input.addEventListener('input', function () {
                validarCampo(input);
            });

            input.addEventListener('change', function () {
                validarCampo(input);
            });

            input.addEventListener('blur', function () {
                validarCampo(input);
            });
        });

        formulario.querySelectorAll(
            'input[type="radio"]'
        ).forEach(function (input) {

            input.addEventListener('change', function () {
                atualizarCampos();
            });
        });

        atualizarCampos();

        formulario.addEventListener('submit', function (evento) {
            evento.preventDefault();

            let formularioValido = true;
            let primeiroCampoInvalido = null;

            const estudando = document.querySelector('input[name="estudando"]:checked');
            const complementar = document.querySelector('input[name="complementar"]:checked');
            const programa = document.querySelector('input[name="programa"]:checked');

            if (!estudando || !complementar || !programa) {
                formularioValido = false;
                alert('Responda todas as perguntas de Sim ou Não.');
            }

            formulario.querySelectorAll(
                'input[type="text"], select'
            ).forEach(function (input) {

                const campoValido = validarCampo(input);

                if (!campoValido) {
                    formularioValido = false;

                    if (!primeiroCampoInvalido) {
                        primeiroCampoInvalido = input;
                    }
                }
            });

            if (formularioValido == false) {
                if (primeiroCampoInvalido) {
                    primeiroCampoInvalido.focus();
                }
                return;
            }

            formulario.submit();
        });

    