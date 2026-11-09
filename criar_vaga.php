<?php
include_once('inc/config.php');
include_once('inc/verificacao_login.php');
if (!isset($_SESSION['tipo'])) {
    header('location:dashboard.php');

} elseif ($_SESSION['tipo'] != "empresa") {
    header('location:dashboard.php');

}


?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar vaga - Primeiro Passo Empresas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/criar_vaga.css">
</head>

<body>
    <aside class="menu">
        <img src="Imagem/logo.png" class="logo" alt="Primeiro Passo Empresas">
        <nav>
            <ul>
                <li><a href="dashboard.php"><i class="bi bi-house-door-fill"></i><span>Início</span></a>
                </li>
                <li><a href="vagas.php" class="ativo"><i class="bi bi-briefcase"></i><span>Vagas</span></a></li>
                <li><a href="candidaturas.php"><i class="bi bi-file-earmark-text"></i><span>Candidaturas</span></a></li>
                <li><a href="perfil.php"><i class="bi bi-building"></i><span>Meu Perfil</span></a></li>
                <li><a href="configuracoes.php"><i class="bi bi-gear"></i><span>Configurações</span></a></li>
            </ul>
        </nav>

        <div class="conectando">
            <div class="l1"><i class="bi bi-people-fill"></i>Conectando empresas e talentos.</div>
            <p>Juntos, construímos um futuro melhor.</p>
        </div>
    </aside>

    <div class="pagina">
        <header class="topo">
            <form class="busca" action="candidaturas.php" method="get" role="search">
                <i class="bi bi-search"></i>
                <input type="search" name="q" placeholder="Buscar vagas, candidatos ou áreas de interesse...">
            </form>


            <a href="notificacoes.php" class="sino" aria-label="Notificações">
                <i class="bi bi-bell"></i>
            </a>

            <details class="usuario">
                <summary>
                    <span class="av-emp"><i class="bi bi-buildings-fill"></i></span>
                    <span class="nome"><b>
                            <?= htmlspecialchars($_SESSION['nome_empresa'] ?? $_SESSION['nome'] ?? 'Empresa') ?>
                        </b><small>Empresa</small></span>
                    <i class="bi bi-caret-down-fill" style="font-size:12px"></i>
                </summary>
                <div class="sub">
                    <a href="perfil.php">Perfil da empresa</a>
                    <a href="configuracoes.php">Configurações</a>
                    <a href="inc/logout.php"><i class="bi bi-box-arrow-right"></i> Sair</a>
                </div>
            </details>
        </header>

        <main class="conteudo">
            <div class="caminho"><a href="vagas.php">Vagas</a><i class="bi bi-chevron-right"></i><span>Publicar nova
                    vaga</span></div>
            <div class="cabecalho-pagina">
                <div>
                    <h1>Publicar nova vaga</h1>
                    <p>Preencha as informações para divulgar uma oportunidade aos candidatos.</p>
                </div>
                <a href="vagas.php" class="btn-voltar-topo"><i class="bi bi-arrow-left"></i> Voltar às vagas</a>
            </div>

            <form class="form-vaga" action="#" method="post">
                <section class="card bloco">
                    <div class="cab"><span class="icone-secao azul"><i class="bi bi-briefcase-fill"></i></span>
                        <div>
                            <h2>Informações da vaga</h2>
                            <p>Defina os dados principais da oportunidade.</p>
                        </div>
                    </div>
                    <div class="campos">
                        <div class="campo largura-total">
                            <label for="titulo">Título da vaga
                                <span>*</span>
                            </label><input type="text" id="titulo" name="titulo"
                                placeholder="Ex.: Desenvolvedor Web Júnior" required>
                        </div>
                        <div class="campo">
                            <label for="tipo">
                                Tipo de vaga
                                <span>*</span>
                            </label>
                            <select id="tipo" name="tipo" required>
                                <option value="">Selecione o tipo de vaga</option>
                                <option>Primeiro Emprego</option>
                                <option>Estágio</option>
                                <option>Jovem Aprendiz</option>
                                
                            </select>
                        </div>
                        <div class="campo"><label for="categoria">Categoria <span>*</span></label><select id="categoria"
                                name="categoria" required>
                                <option value="">Selecione uma categoria</option>
                                <option>Tecnologia &amp; TI</option>
                                <option>Administração</option>
                                <option>Vendas &amp; Atendimento</option>
                                <option>Marketing</option>
                                <option>Logística</option><option>Construção</option><option>Produção</option><option>Serviços Gerais</option><option>Alimentação</option>
                            </select></div>
                        <div class="campo"><label for="regime">Regime de contratação <span>*</span></label><select
                                id="regime" name="regime" required>
                                <option value="">Selecione o regime</option>
                                <option>CLT</option>
                                <option>Estágio</option>
                                <option>Aprendizagem</option>
                                <option>Temporário</option>
                                <option>PJ</option>
                            </select></div>
                        <div class="campo"><label for="quantidade">Quantidade de vagas <span>*</span></label><input
                                type="number" id="quantidade" name="quantidade" min="1" value="1" required></div>
                    </div>
                </section>

                <section class="card bloco">
                    <div class="cab"><span class="icone-secao roxo"><i class="bi bi-geo-alt-fill"></i></span>
                        <div>
                            <h2>Localização e modalidade</h2>
                            <p>Informe onde e como o trabalho será realizado.</p>
                        </div>
                    </div>
                    <div class="campos">
                        <div class="campo"><label for="modalidade">Modalidade <span>*</span></label><select
                                id="modalidade" name="modalidade" required>
                                <option value="">Selecione a modalidade</option>
                                <option>Presencial</option>
                                <option>Híbrido</option>
                                <option>Remoto</option>
                            </select></div>
                        <div class="campo"><label for="estado">Estado (UF) <span>*</span></label><select id="estado"
                                name="estado" required>
                                <option value="">Selecione o estado</option>
                                <option value="SP">São Paulo</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PR">Paraná</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="BA">Bahia</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="AC">Acre</option><option value="AL">Alagoas</option><option value="AP">Amapá</option><option value="AM">Amazonas</option><option value="CE">Ceará</option><option value="MA">Maranhão</option><option value="MT">Mato Grosso</option><option value="MS">Mato Grosso do Sul</option><option value="PA">Pará</option><option value="PB">Paraíba</option><option value="PE">Pernambuco</option><option value="PI">Piauí</option><option value="RN">Rio Grande do Norte</option><option value="RO">Rondônia</option><option value="RR">Roraima</option><option value="SE">Sergipe</option><option value="TO">Tocantins</option>
                            </select></div>
                        <div class="campo largura-total"><label for="cidade">Cidade <span>*</span></label><input
                                type="text" id="cidade" name="cidade" placeholder="Ex.: Itanhaém" required></div>
                    </div>
                </section>


                <section class="card bloco">
                    <div class="cab">
                        <span class="icone-secao azul"><i class="bi bi-cash-stack"></i></span>
                        <div><h2>Salário e jornada</h2><p>Informe a remuneração e os horários da oportunidade.</p></div>
                    </div>
                    <div class="campos">
                        <div class="campo">
                            <label for="salario_min">Salário mínimo (R$)</label>
                            <input type="number" id="salario_min" name="salario_min" min="0" step="0.01" placeholder="Ex.: 1200,00">
                        </div>
                        <div class="campo">
                            <label for="salario_max">Salário máximo (R$)</label>
                            <input type="number" id="salario_max" name="salario_max" min="0" step="0.01" placeholder="Ex.: 1800,00">
                        </div>
                        <div class="campo">
                            <label for="carga_horaria">Carga horária semanal</label>
                            <input type="number" id="carga_horaria" name="carga_horaria" min="1" max="168" placeholder="Ex.: 30">
                        </div>
                        <div class="campo">
                            <label for="jornada">Jornada de trabalho</label>
                            <input type="text" id="jornada" name="jornada" maxlength="50" placeholder="Ex.: Segunda a sexta, das 9h às 15h">
                        </div>
                    </div>
                </section>

                <section class="card bloco">
                    <div class="cab">
                        <span class="icone-secao verde"><i class="bi bi-gift-fill"></i></span>
                        <div><h2>Benefícios</h2><p>Selecione todos os benefícios oferecidos pela empresa.</p></div>
                    </div>
                    <div class="beneficios-lista">
                        <label class="beneficio"><input type="checkbox" name="beneficios[]" value="Vale-transporte"> <span>Vale-transporte</span></label>
                        <label class="beneficio"><input type="checkbox" name="beneficios[]" value="Seguro de vida"> <span>Seguro de vida</span></label>
                        <label class="beneficio"><input type="checkbox" name="beneficios[]" value="Possibilidade de efetivação"> <span>Possibilidade de efetivação</span></label>
                        <label class="beneficio"><input type="checkbox" name="beneficios[]" value="Acesso a cursos e treinamentos internos"> <span>Cursos e treinamentos internos</span></label>
                        <label class="beneficio"><input type="checkbox" name="beneficios[]" value="Vale-refeição"> <span>Vale-refeição</span></label>
                    </div>
                </section>

                <section class="card bloco">
                    <div class="cab"><span class="icone-secao verde"><i class="bi bi-card-text"></i></span>
                        <div>
                            <h2>Descrição da oportunidade</h2>
                            <p>Explique as responsabilidades e o perfil procurado.</p>
                        </div>
                    </div>
                    <div class="campos">
                        <div class="campo largura-total">
                            <label for="resumo_requisitos">Resumo dos requisitos</label>
                            <input type="text" id="resumo_requisitos" name="resumo_requisitos" maxlength="150" placeholder="Ex.: Conhecimento básico em informática e boa comunicação">
                        </div>
                        <div class="campo largura-total">
                            <label for="descricao">Descrição da vaga
                                <span>*</span>
                            </label>
                            <textarea id="descricao" name="descricao" rows="5"
                                placeholder="Apresente a vaga, a equipe e a oportunidade..." required></textarea>
                        </div>
                        <div class="campo largura-total">
                            <label for="atividades">Principais atividades
                                <span>*</span></label><textarea id="atividades" name="atividades" rows="5"
                                placeholder="Descreva as atividades que serão realizadas..." required></textarea>
                        </div>
                        <div class="campo largura-total"><label for="requisitos">Requisitos
                                <span>*</span></label><textarea id="requisitos" name="requisitos" rows="5"
                                placeholder="Informe os conhecimentos e requisitos necessários..." required></textarea>
                        </div>
                    </div>
                </section>

                <section class="card bloco">
                    <div class="cab"><span class="icone-secao laranja"><i class="bi bi-calendar-check-fill"></i></span>
                        <div>
                            <h2>Publicação</h2>
                            <p>Defina até quando a vaga ficará disponível.</p>
                        </div>
                    </div>
                    <div class="campos">
                        <div class="campo"><label for="expiracao">Data de encerramento</label><input type="date"
                                id="expiracao" name="expiracao"></div>
                        <div class="campo"><label for="status">Status inicial <span>*</span></label><select id="status"
                                name="status" required>
                                
                                <option value="Ativa" selected>Ativa</option>
                                <option value="Pausada">Pausada</option>
                            </select></div>
                    </div>
                    <div class="aviso"><i class="bi bi-info-circle"></i><span>Esta é uma versão visual. O botão de
                            publicação será conectado ao PHP e ao banco de dados posteriormente.</span></div>
                </section>

                <div class="botoes-form">
                    <a href="vagas.php" class="btn-cancelar"><i class="bi bi-x-lg"></i> Cancelar</a>
                    <button type="button" class="btn-publicar" disabled
                        title="Disponível quando o PHP estiver conectado"><i class="bi bi-send-fill"></i> Publicar
                        vaga</button>
                </div>
            </form>
        </main>
        <footer class="rodape">
            <hr>
            <p>© 2026 Primeiro Passo - Todos os direitos reservados.</p>
        </footer>
    </div>
</body>

</html>