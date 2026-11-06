CREATE DATABASE primeiro_passo;
USE primeiro_passo;

CREATE TABLE tb_enderecos (
    cd_endereco INT PRIMARY KEY AUTO_INCREMENT,
    nr_cep CHAR(9) NOT NULL,
    ds_rua VARCHAR(150) NOT NULL,
    nr_numero VARCHAR(10) NOT NULL,
    ds_complemento VARCHAR(100),
    nm_bairro VARCHAR(100) NOT NULL,
    nm_cidade VARCHAR(100) NOT NULL,
    sg_uf CHAR(2) NOT NULL

);

CREATE TABLE tb_usuarios (
    cd_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nm_usuario VARCHAR(100) NOT NULL,
    ds_login VARCHAR(50) UNIQUE,
    ds_email VARCHAR(100) NOT NULL UNIQUE,
    ds_senha VARCHAR(255),
    ds_google_id VARCHAR(100) UNIQUE,
    ds_tipo ENUM('administrador', 'aluno', 'empresa') NOT NULL,
    fl_ativo BOOLEAN NOT NULL DEFAULT TRUE,
    fl_dois_fatores BOOLEAN NOT NULL DEFAULT FALSE,
    dt_cadastro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    dt_ultimo_acesso DATETIME,
    dt_exclusao DATETIME

);

CREATE TABLE tb_recuperacao_senha (
    cd_recuperacao INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    ds_token CHAR(64) NOT NULL UNIQUE,
    dt_solicitacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    dt_expiracao DATETIME NOT NULL,
    fl_utilizado BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (id_usuario) REFERENCES tb_usuarios(cd_usuario) ON DELETE CASCADE,
    INDEX idx_recuperacao_expiracao (dt_expiracao)

);

CREATE TABLE tb_codigos_dois_fatores (
    cd_codigo_dois_fatores INT PRIMARY KEY AUTO_INCREMENT,
    ds_codigo_hash CHAR(64) NOT NULL,
    dt_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    dt_expiracao DATETIME NOT NULL,
    dt_utilizacao DATETIME,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES tb_usuarios(cd_usuario) ON DELETE CASCADE,
    INDEX idx_2fa_usuario_validade (id_usuario, dt_expiracao)
);

CREATE TABLE tb_preferencias_notificacoes (
    cd_preferencia INT PRIMARY KEY AUTO_INCREMENT,
    fl_nova_candidatura BOOLEAN NOT NULL DEFAULT TRUE,
    fl_atualizacao_vaga BOOLEAN NOT NULL DEFAULT TRUE,
    fl_novidades BOOLEAN NOT NULL DEFAULT TRUE,
    fl_email BOOLEAN NOT NULL DEFAULT TRUE,
    id_usuario INT NOT NULL UNIQUE,
    FOREIGN KEY (id_usuario) REFERENCES tb_usuarios(cd_usuario) ON DELETE CASCADE

);

CREATE TABLE tb_alunos (
    cd_aluno INT PRIMARY KEY AUTO_INCREMENT,
    nm_aluno VARCHAR(100) NOT NULL,
    dt_nascimento DATE NOT NULL,
    nr_telefone VARCHAR(20),
    ds_genero VARCHAR(30),
    ds_estado_civil VARCHAR(30),
    fl_deficiencia BOOLEAN NOT NULL DEFAULT FALSE,
    fl_possui_experiencia BOOLEAN NOT NULL DEFAULT FALSE,
    ds_foto VARCHAR(255),
    ds_titulo_perfil VARCHAR(100),
    ds_situacao_emprego VARCHAR(30) NOT NULL DEFAULT 'Desempregado',
    ds_sobre TEXT,
    id_usuario INT NOT NULL UNIQUE,
    id_endereco INT,
    FOREIGN KEY (id_usuario) REFERENCES tb_usuarios(cd_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_endereco) REFERENCES tb_enderecos(cd_endereco)

);

CREATE TABLE tb_niveis_escolaridade (
    cd_nivel_escolaridade INT PRIMARY KEY AUTO_INCREMENT,
    nm_nivel VARCHAR(60) NOT NULL

);

CREATE TABLE tb_escolaridades (
    cd_escolaridade INT PRIMARY KEY AUTO_INCREMENT,
    fl_estudando BOOLEAN NOT NULL DEFAULT TRUE,
    nm_instituicao VARCHAR(150),
    nm_curso VARCHAR(100),
    ds_turma VARCHAR(20),
    ds_periodo VARCHAR(50),
    nr_ano_conclusao INT,
    fl_curso_complementar BOOLEAN NOT NULL DEFAULT FALSE,
    ds_curso_complementar VARCHAR(150),
    fl_programa_aprendizagem BOOLEAN NOT NULL DEFAULT FALSE,
    ds_area_programa VARCHAR(100),
    id_aluno INT NOT NULL,
    id_nivel_escolaridade INT NOT NULL,
    FOREIGN KEY (id_aluno) REFERENCES tb_alunos(cd_aluno),
    FOREIGN KEY (id_nivel_escolaridade) REFERENCES tb_niveis_escolaridade(cd_nivel_escolaridade)

);

CREATE TABLE tb_experiencias (
    cd_experiencia INT PRIMARY KEY AUTO_INCREMENT,
    nm_empresa VARCHAR(150),
    ds_cargo VARCHAR(100),
    nr_ano_inicio INT,
    nr_ano_fim INT,
    ds_descricao TEXT,
    id_aluno INT NOT NULL,
    FOREIGN KEY (id_aluno) REFERENCES tb_alunos(cd_aluno)

);

CREATE TABLE tb_cursos_certificacoes (
    cd_curso_certificacao INT PRIMARY KEY AUTO_INCREMENT,
    nm_curso VARCHAR(150) NOT NULL,
    nm_instituicao VARCHAR(150),
    nr_carga_horaria INT,
    nr_ano_conclusao INT,
    ds_certificado VARCHAR(255),
    id_aluno INT NOT NULL,
    FOREIGN KEY (id_aluno) REFERENCES tb_alunos(cd_aluno)

);

CREATE TABLE tb_habilidades (
    cd_habilidade INT PRIMARY KEY AUTO_INCREMENT,
    nm_habilidade VARCHAR(60) NOT NULL UNIQUE

);

CREATE TABLE tb_alunos_habilidades (
    cd_aluno_habilidade INT PRIMARY KEY AUTO_INCREMENT,
    id_aluno INT NOT NULL,
    id_habilidade INT NOT NULL,
    FOREIGN KEY (id_aluno) REFERENCES tb_alunos(cd_aluno),
    FOREIGN KEY (id_habilidade) REFERENCES tb_habilidades(cd_habilidade),
    UNIQUE (id_aluno, id_habilidade)

);

CREATE TABLE tb_curriculos (
    cd_curriculo INT PRIMARY KEY AUTO_INCREMENT,
    ds_objetivo TEXT,
    ds_carta_apresentacao TEXT,
    nr_percentual_completo INT NOT NULL DEFAULT 0,
    dt_atualizacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    id_aluno INT NOT NULL UNIQUE,
    FOREIGN KEY (id_aluno) REFERENCES tb_alunos(cd_aluno)

);

CREATE TABLE tb_setores_empresa (
    cd_setor INT PRIMARY KEY AUTO_INCREMENT,
    nm_setor VARCHAR(80) NOT NULL UNIQUE

);

CREATE TABLE tb_portes_empresa (
    cd_porte INT PRIMARY KEY AUTO_INCREMENT,
    nm_porte VARCHAR(60) NOT NULL UNIQUE

);

CREATE TABLE tb_empresas (
    cd_empresa INT PRIMARY KEY AUTO_INCREMENT,
    nm_razao_social VARCHAR(150) NOT NULL,
    nm_fantasia VARCHAR(100) NOT NULL,
    nr_cnpj VARCHAR(18) UNIQUE,
    nm_email_corporativo VARCHAR(100) NOT NULL,
    nr_telefone VARCHAR(20),
    ds_slogan VARCHAR(150),
    ds_sobre VARCHAR(500),
    ds_missao VARCHAR(300),
    ds_visao VARCHAR(300),
    ds_valores VARCHAR(300),
    ds_site VARCHAR(150),
    ds_linkedin VARCHAR(150),
    ds_instagram VARCHAR(150),
    ds_logo VARCHAR(255),
    ds_banner VARCHAR(255),
    ds_icone_logo VARCHAR(50),
    ds_sigla VARCHAR(5),
    ds_cor_logo VARCHAR(7),
    fl_verificada BOOLEAN NOT NULL DEFAULT FALSE,
    fl_destaque BOOLEAN NOT NULL DEFAULT FALSE,
    id_setor INT,
    id_porte INT,
    id_usuario INT NOT NULL UNIQUE,
    id_endereco INT NOT NULL,
    FOREIGN KEY (id_setor) REFERENCES tb_setores_empresa(cd_setor),
    FOREIGN KEY (id_porte) REFERENCES tb_portes_empresa(cd_porte),
    FOREIGN KEY (id_usuario) REFERENCES tb_usuarios(cd_usuario),
    FOREIGN KEY (id_endereco) REFERENCES tb_enderecos(cd_endereco)

);

CREATE TABLE tb_membros_empresa (
    cd_membro INT PRIMARY KEY AUTO_INCREMENT,
    ds_cargo VARCHAR(100),
    nr_telefone_contato VARCHAR(20),
    ds_permissao ENUM('Administrador', 'Recrutador') NOT NULL DEFAULT 'Recrutador',
    fl_ativo BOOLEAN NOT NULL DEFAULT TRUE,
    dt_convite DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_empresa INT NOT NULL,
    id_usuario INT NOT NULL UNIQUE,
    FOREIGN KEY (id_empresa) REFERENCES tb_empresas(cd_empresa),
    FOREIGN KEY (id_usuario) REFERENCES tb_usuarios(cd_usuario)

);

CREATE TABLE tb_tipos_vaga (
    cd_tipo_vaga INT PRIMARY KEY AUTO_INCREMENT,
    nm_tipo VARCHAR(50) NOT NULL,
    ds_tipo VARCHAR(100),
    ds_icone VARCHAR(50)

);

CREATE TABLE tb_categorias_vaga (
    cd_categoria_vaga INT PRIMARY KEY AUTO_INCREMENT,
    nm_categoria VARCHAR(60) NOT NULL,
    ds_icone VARCHAR(50),
    ds_cor VARCHAR(7)

);

CREATE TABLE tb_vagas (
    cd_vaga INT PRIMARY KEY AUTO_INCREMENT,
    nm_titulo VARCHAR(150) NOT NULL,
    ds_descricao TEXT,
    ds_atividades TEXT,
    ds_requisitos TEXT,
    ds_requisito_resumo VARCHAR(150),
    vl_salario_min DECIMAL(10,2),
    vl_salario_max DECIMAL(10,2),
    nr_carga_horaria_semanal INT,
    ds_jornada VARCHAR(50),
    ds_regime_contratacao VARCHAR(30),
    ds_modalidade ENUM('Presencial', 'Híbrido', 'Remoto') NOT NULL DEFAULT 'Presencial',
    nm_cidade VARCHAR(100) NOT NULL,
    sg_uf CHAR(2) NOT NULL,
    nr_vagas INT NOT NULL DEFAULT 1,
    ds_imagem VARCHAR(255),
    ds_icone_vaga VARCHAR(50),
    ds_cor_icone VARCHAR(7),
    fl_destaque BOOLEAN NOT NULL DEFAULT FALSE,
    ds_status ENUM('Em análise', 'Ativa', 'Pausada', 'Encerrada') NOT NULL DEFAULT 'Em análise',
    dt_publicacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    dt_expiracao DATETIME,
    id_empresa INT NOT NULL,
    id_tipo_vaga INT NOT NULL,
    id_categoria_vaga INT NOT NULL,
    FOREIGN KEY (id_empresa) REFERENCES tb_empresas(cd_empresa),
    FOREIGN KEY (id_tipo_vaga) REFERENCES tb_tipos_vaga(cd_tipo_vaga),
    FOREIGN KEY (id_categoria_vaga) REFERENCES tb_categorias_vaga(cd_categoria_vaga),
    INDEX idx_vagas_busca (ds_status, nm_cidade, sg_uf),
    INDEX idx_vagas_publicacao (dt_publicacao),
    CHECK (nr_vagas > 0),
    CHECK (nr_carga_horaria_semanal IS NULL OR nr_carga_horaria_semanal > 0),
    CHECK (vl_salario_min IS NULL OR vl_salario_min >= 0),
    CHECK (vl_salario_max IS NULL OR vl_salario_max >= 0),
    CHECK (vl_salario_min IS NULL OR vl_salario_max IS NULL OR vl_salario_max >= vl_salario_min),
    CHECK (dt_expiracao IS NULL OR dt_expiracao >= dt_publicacao)

);

CREATE TABLE tb_beneficios (
    cd_beneficio INT PRIMARY KEY AUTO_INCREMENT,
    nm_beneficio VARCHAR(100) NOT NULL UNIQUE

);

CREATE TABLE tb_vagas_beneficios (
    cd_vaga_beneficio INT PRIMARY KEY AUTO_INCREMENT,
    id_vaga INT NOT NULL,
    id_beneficio INT NOT NULL,
    FOREIGN KEY (id_vaga) REFERENCES tb_vagas(cd_vaga) ON DELETE CASCADE,
    FOREIGN KEY (id_beneficio) REFERENCES tb_beneficios(cd_beneficio) ON DELETE CASCADE,
    UNIQUE (id_vaga, id_beneficio)

);

CREATE TABLE tb_vagas_favoritas (
    cd_vaga_favorita INT PRIMARY KEY AUTO_INCREMENT,
    dt_salvamento DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_aluno INT NOT NULL,
    id_vaga INT NOT NULL,
    FOREIGN KEY (id_aluno) REFERENCES tb_alunos(cd_aluno) ON DELETE CASCADE,
    FOREIGN KEY (id_vaga) REFERENCES tb_vagas(cd_vaga) ON DELETE CASCADE,
    UNIQUE (id_aluno, id_vaga)
);

CREATE TABLE tb_etapas_vaga (
    cd_etapa_vaga INT PRIMARY KEY AUTO_INCREMENT,
    nr_ordem INT NOT NULL,
    nm_etapa VARCHAR(100) NOT NULL,
    id_vaga INT NOT NULL,
    FOREIGN KEY (id_vaga) REFERENCES tb_vagas(cd_vaga),
    UNIQUE (id_vaga, nr_ordem),
    UNIQUE (cd_etapa_vaga, id_vaga)

);

CREATE TABLE tb_candidaturas (
    cd_candidatura INT PRIMARY KEY AUTO_INCREMENT,
    dt_candidatura DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ds_status ENUM('Em análise', 'Entrevista', 'Aprovado', 'Reprovado', 'Contratado', 'Cancelado') NOT NULL DEFAULT 'Em análise',
    ds_motivo_reprovacao VARCHAR(255),
    id_aluno INT NOT NULL,
    id_vaga INT NOT NULL,
    FOREIGN KEY (id_aluno) REFERENCES tb_alunos(cd_aluno),
    FOREIGN KEY (id_vaga) REFERENCES tb_vagas(cd_vaga),
    UNIQUE (id_aluno, id_vaga),
    UNIQUE (cd_candidatura, id_vaga),
    INDEX idx_candidaturas_vaga (id_vaga, ds_status)

);

CREATE TABLE tb_candidaturas_etapas (
    cd_candidatura_etapa INT PRIMARY KEY AUTO_INCREMENT,
    ds_status ENUM('Pendente', 'Em andamento', 'Concluída') NOT NULL DEFAULT 'Pendente',
    dt_atualizacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    id_candidatura INT NOT NULL,
    id_etapa_vaga INT NOT NULL,
    id_vaga INT NOT NULL,
    FOREIGN KEY (id_candidatura, id_vaga) REFERENCES tb_candidaturas(cd_candidatura, id_vaga) ON DELETE CASCADE,
    FOREIGN KEY (id_etapa_vaga, id_vaga) REFERENCES tb_etapas_vaga(cd_etapa_vaga, id_vaga) ON DELETE CASCADE,
    UNIQUE (id_candidatura, id_etapa_vaga)

);

CREATE TABLE tb_anotacoes_candidaturas (
    cd_anotacao INT PRIMARY KEY AUTO_INCREMENT,
    ds_anotacao TEXT NOT NULL,
    dt_anotacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_candidatura INT NOT NULL,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_candidatura) REFERENCES tb_candidaturas(cd_candidatura),
    FOREIGN KEY (id_usuario) REFERENCES tb_usuarios(cd_usuario)

);

CREATE TABLE tb_mensagens (
    cd_mensagem INT PRIMARY KEY AUTO_INCREMENT,
    ds_mensagem TEXT NOT NULL,
    fl_lida BOOLEAN NOT NULL DEFAULT FALSE,
    dt_envio DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_candidatura INT,
    id_remetente INT NOT NULL,
    id_destinatario INT NOT NULL,
    FOREIGN KEY (id_candidatura) REFERENCES tb_candidaturas(cd_candidatura),
    FOREIGN KEY (id_remetente) REFERENCES tb_usuarios(cd_usuario),
    FOREIGN KEY (id_destinatario) REFERENCES tb_usuarios(cd_usuario)

);

CREATE TABLE tb_alertas_vagas (
    cd_alerta_vaga INT PRIMARY KEY AUTO_INCREMENT,
    fl_ativo BOOLEAN NOT NULL DEFAULT TRUE,
    dt_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    nm_palavra_chave VARCHAR(100),
    nm_cidade VARCHAR(100),
    sg_uf CHAR(2),
    id_aluno INT NOT NULL,
    id_categoria_vaga INT,
    id_tipo_vaga INT,
    FOREIGN KEY (id_aluno) REFERENCES tb_alunos(cd_aluno),
    FOREIGN KEY (id_categoria_vaga) REFERENCES tb_categorias_vaga(cd_categoria_vaga),
    FOREIGN KEY (id_tipo_vaga) REFERENCES tb_tipos_vaga(cd_tipo_vaga)

);

CREATE TABLE tb_notificacoes (
    cd_notificacao INT PRIMARY KEY AUTO_INCREMENT,
    ds_titulo VARCHAR(150) NOT NULL,
    ds_mensagem VARCHAR(255),
    ds_link VARCHAR(255),
    ds_tipo VARCHAR(30) NOT NULL DEFAULT 'Sistema',
    fl_lida BOOLEAN NOT NULL DEFAULT FALSE,
    dt_notificacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES tb_usuarios(cd_usuario) ON DELETE CASCADE,
    INDEX idx_notificacoes_usuario_data (id_usuario, dt_notificacao)

);

CREATE TABLE tb_categorias_conteudo (
    cd_categoria_conteudo INT PRIMARY KEY AUTO_INCREMENT,
    nm_categoria VARCHAR(50) NOT NULL

);

CREATE TABLE tb_conteudos (
    cd_conteudo INT PRIMARY KEY AUTO_INCREMENT,
    ds_formato ENUM('Vídeo', 'Artigo', 'Dica') NOT NULL,
    ds_titulo VARCHAR(150) NOT NULL,
    ds_resumo VARCHAR(255),
    ds_conteudo LONGTEXT,
    nr_ordem INT NOT NULL DEFAULT 1,
    id_vaga INT,
    ds_capa VARCHAR(255),
    ds_url VARCHAR(255),
    nm_autor VARCHAR(100),
    nr_visualizacoes INT NOT NULL DEFAULT 0,
    nr_minutos_leitura INT,
    fl_destaque BOOLEAN NOT NULL DEFAULT FALSE,
    dt_publicacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_categoria_conteudo INT NOT NULL,
    FOREIGN KEY (id_categoria_conteudo) REFERENCES tb_categorias_conteudo(cd_categoria_conteudo),
    FOREIGN KEY (id_vaga) REFERENCES tb_vagas(cd_vaga) ON DELETE SET NULL,
    INDEX idx_conteudos_formato (ds_formato, id_categoria_conteudo)
);

DELIMITER $$
CREATE TRIGGER trg_limite_habilidades_insert
BEFORE INSERT ON tb_alunos_habilidades
FOR EACH ROW
BEGIN
    IF (SELECT COUNT(*) FROM tb_alunos_habilidades WHERE id_aluno = NEW.id_aluno) >= 5 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'O aluno pode selecionar até 5 habilidades.';
    END IF;
END$$

CREATE TRIGGER trg_limite_habilidades_update
BEFORE UPDATE ON tb_alunos_habilidades
FOR EACH ROW
BEGIN
    IF NEW.id_aluno <> OLD.id_aluno
       AND (SELECT COUNT(*) FROM tb_alunos_habilidades WHERE id_aluno = NEW.id_aluno) >= 5 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'O aluno pode selecionar até 5 habilidades.';
    END IF;
END$$
DELIMITER ;

INSERT INTO tb_niveis_escolaridade (nm_nivel)
VALUES
    ('Ensino Fundamental'),
    ('Ensino Médio'),
    ('Ensino Técnico'),
    ('Ensino Superior Incompleto'),
    ('Ensino Superior Completo'),
    ('Pós-graduação');

INSERT INTO tb_habilidades (nm_habilidade)
VALUES
    ('Comunicação'),
    ('Informática'),
    ('Organização'),
    ('Inglês'),
    ('Trabalho em equipe'),
    ('Espanhol'),
    ('Boa aprendizagem'),
    ('HTML'),
    ('CSS'),
    ('JavaScript'),
    ('MySQL'),
    ('Git'),
    ('Figma');

INSERT INTO tb_setores_empresa (nm_setor)
VALUES
    ('Tecnologia da Informação'),
    ('Marketing'),
    ('Alimentação'),
    ('Varejo'),
    ('Construção'),
    ('Serviços Gerais'),
    ('Saúde'),
    ('Educação'),
    ('Logística');

INSERT INTO tb_portes_empresa (nm_porte)
VALUES
    ('Até 10 funcionários'),
    ('De 11 a 50 funcionários'),
    ('De 51 a 200 funcionários'),
    ('De 201 a 500 funcionários'),
    ('Mais de 500 funcionários');

INSERT INTO tb_tipos_vaga (nm_tipo, ds_tipo, ds_icone)
VALUES
    ('Primeiro Emprego', 'Seu primeiro passo no mercado de trabalho.', 'rocket'),
    ('Estágio', 'Ganhe experiência e construa seu futuro.', 'graduation-cap'),
    ('Jovem Aprendiz', 'Trabalhe e estude ao mesmo tempo.', 'user');

INSERT INTO tb_categorias_vaga (nm_categoria, ds_icone, ds_cor)
VALUES
    ('Tecnologia & TI', 'cpu', '#6DB3EA'),
    ('Administração', 'file-text', '#6EE86E'),
    ('Vendas & Atendimento', 'shopping-cart', '#E03B3B'),
    ('Logística', 'truck', '#F59E0B'),
    ('Construção', 'building', '#0F2A5C'),
    ('Produção', 'settings', '#EF4444'),
    ('Serviços Gerais', 'tool', '#7C3AED'),
    ('Marketing', 'megaphone', '#2563EB'),
    ('Alimentação', 'utensils', '#F97316');

INSERT INTO tb_beneficios (nm_beneficio)
VALUES
    ('Vale-transporte'),
    ('Seguro de vida'),
    ('Possibilidade de efetivação'),
    ('Acesso a cursos e treinamentos internos'),
    ('Vale-refeição');

INSERT INTO tb_categorias_conteudo (nm_categoria)
VALUES
    ('Entrevistas'),
    ('Carreira'),
    ('Habilidades'),
    ('Tecnologia'),
    ('Aumentar chances'),
    ('Currículo'),
    ('Vagas'),
    ('Empresas');


UPDATE tb_usuarios SET dt_ultimo_acesso = NOW() WHERE cd_usuario = 7;


SELECT * FROM tb_enderecos;
SELECT * FROM tb_usuarios;
SELECT * FROM tb_recuperacao_senha;
SELECT * FROM tb_codigos_dois_fatores;
SELECT * FROM tb_preferencias_notificacoes;
SELECT * FROM tb_alunos;
SELECT * FROM tb_niveis_escolaridade;
SELECT * FROM tb_escolaridades;
SELECT * FROM tb_experiencias;
SELECT * FROM tb_cursos_certificacoes;
SELECT * FROM tb_habilidades;
SELECT * FROM tb_alunos_habilidades;
SELECT * FROM tb_curriculos;
SELECT * FROM tb_setores_empresa;
SELECT * FROM tb_portes_empresa;
SELECT * FROM tb_empresas;
SELECT * FROM tb_membros_empresa;
SELECT * FROM tb_tipos_vaga;
SELECT * FROM tb_categorias_vaga;
SELECT * FROM tb_vagas;
SELECT * FROM tb_beneficios;
SELECT * FROM tb_vagas_beneficios;
SELECT * FROM tb_vagas_favoritas;
SELECT * FROM tb_etapas_vaga;
SELECT * FROM tb_candidaturas;
SELECT * FROM tb_candidaturas_etapas;
SELECT * FROM tb_anotacoes_candidaturas;
SELECT * FROM tb_mensagens;
SELECT * FROM tb_alertas_vagas;
SELECT * FROM tb_notificacoes;
SELECT * FROM tb_categorias_conteudo;
SELECT * FROM tb_conteudos;
