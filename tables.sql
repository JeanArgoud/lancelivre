-- Table: public.avaliacao

-- DROP TABLE IF EXISTS public.avaliacao;

CREATE TABLE IF NOT EXISTS public.avaliacao
(
    id bigint NOT NULL GENERATED ALWAYS AS IDENTITY ( INCREMENT 1 START 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1 ),
    id_usuario bigint NOT NULL,
    id_servico bigint NOT NULL,
    nota numeric NOT NULL,
    data date NOT NULL,
    comentario character varying COLLATE pg_catalog."default",
    CONSTRAINT avaliacao_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.avaliacao
    OWNER to postgres;

-- Table: public.canal

-- DROP TABLE IF EXISTS public.canal;






CREATE TABLE IF NOT EXISTS public.canal
(
    id_colaborador bigint NOT NULL,
    id_usuario bigint NOT NULL,
    id bigint NOT NULL GENERATED ALWAYS AS IDENTITY ( INCREMENT 1 START 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1 ),
    CONSTRAINT canal_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.canal
    OWNER to postgres;
-- Table: public.colaborador

-- DROP TABLE IF EXISTS public.colaborador;









CREATE TABLE IF NOT EXISTS public.conta
(
    id integer NOT NULL,
    nome character varying(20) COLLATE pg_catalog."default" NOT NULL,
    senha character varying(15) COLLATE pg_catalog."default" NOT NULL,
    email character varying(30) COLLATE pg_catalog."default" NOT NULL,
    tipo integer NOT NULL,
    CONSTRAINT conta_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.conta
    OWNER to postgres;
-- Table: public.mensagem

-- DROP TABLE IF EXISTS public.mensagem;








CREATE TABLE IF NOT EXISTS public.mensagem
(
    id_canal smallint NOT NULL,
    id bigint NOT NULL GENERATED ALWAYS AS IDENTITY ( INCREMENT 1 START 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1 ),
    data_envio date NOT NULL,
    texto character varying COLLATE pg_catalog."default",
    enviado_por character varying COLLATE pg_catalog."default",
    CONSTRAINT mensagem_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.mensagem
    OWNER to postgres;

-- Table: public.pergunta

-- DROP TABLE IF EXISTS public.pergunta;







CREATE TABLE IF NOT EXISTS public.servico
(
    nome character varying(30) COLLATE pg_catalog."default" NOT NULL,
    preco money NOT NULL,
    colaborador_id smallint,
    id bigint NOT NULL GENERATED ALWAYS AS IDENTITY ( INCREMENT 1 START 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1 ),
    avaliacao smallint NOT NULL DEFAULT 0,
    categoria character varying(255) COLLATE pg_catalog."default" NOT NULL DEFAULT 0,
    descricao character varying(3000) COLLATE pg_catalog."default" NOT NULL DEFAULT 'descricao'::character varying,
    CONSTRAINT servico_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.servico
    OWNER to postgres;


-- Table: public.servico

-- DROP TABLE IF EXISTS public.servico;





CREATE TABLE IF NOT EXISTS public.pergunta
(
    id bigint NOT NULL GENERATED ALWAYS AS IDENTITY ( INCREMENT 1 START 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1 ),
    id_usuario bigint NOT NULL,
    id_servico bigint NOT NULL,
    pergunta character varying COLLATE pg_catalog."default" NOT NULL,
    data date NOT NULL,
    titulo character varying COLLATE pg_catalog."default" NOT NULL,
    resposta character varying COLLATE pg_catalog."default",
    CONSTRAINT pergunta_pkey PRIMARY KEY (id),
    CONSTRAINT id_servico_fkey FOREIGN KEY (id_servico)
        REFERENCES public.servico (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID,
    CONSTRAINT id_usuario_fkey FOREIGN KEY (id_usuario)
        REFERENCES public.conta (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.pergunta
    OWNER to postgres;






