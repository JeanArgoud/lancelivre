--
-- PostgreSQL database dump
--

-- Dumped from database version 16.1
-- Dumped by pg_dump version 16.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: avaliacao; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.avaliacao (
    id bigint NOT NULL,
    id_usuario bigint NOT NULL,
    id_servico bigint NOT NULL,
    nota numeric NOT NULL,
    data date NOT NULL,
    comentario character varying
);


ALTER TABLE public.avaliacao OWNER TO postgres;

--
-- Name: avaliacao_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.avaliacao ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.avaliacao_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: canal; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.canal (
    id_colaborador bigint NOT NULL,
    id_usuario bigint NOT NULL,
    id bigint NOT NULL
);


ALTER TABLE public.canal OWNER TO postgres;

--
-- Name: canal_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.canal ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.canal_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: colaborador; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.colaborador (
    id integer NOT NULL,
    nome character varying(50) NOT NULL,
    email character varying(100) NOT NULL,
    data_cad date NOT NULL
);


ALTER TABLE public.colaborador OWNER TO postgres;

--
-- Name: colaborador_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.colaborador_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.colaborador_id_seq OWNER TO postgres;

--
-- Name: colaborador_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.colaborador_id_seq OWNED BY public.colaborador.id;


--
-- Name: conta; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.conta (
    id integer NOT NULL,
    nome character varying(20) NOT NULL,
    senha character varying(15) NOT NULL,
    email character varying(30) NOT NULL,
    tipo integer NOT NULL
);


ALTER TABLE public.conta OWNER TO postgres;

--
-- Name: mensagem; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.mensagem (
    id_canal smallint NOT NULL,
    id bigint NOT NULL,
    data_envio date NOT NULL,
    texto character varying,
    enviado_por character varying
);


ALTER TABLE public.mensagem OWNER TO postgres;

--
-- Name: mensagem_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.mensagem ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.mensagem_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: pergunta; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pergunta (
    id bigint NOT NULL,
    id_usuario bigint NOT NULL,
    id_servico bigint NOT NULL,
    pergunta character varying NOT NULL,
    data date NOT NULL,
    titulo character varying NOT NULL,
    resposta character varying
);


ALTER TABLE public.pergunta OWNER TO postgres;

--
-- Name: pergunta_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.pergunta ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.pergunta_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: servico; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.servico (
    nome character varying(30) NOT NULL,
    preco money NOT NULL,
    colaborador_id smallint,
    id bigint NOT NULL,
    avaliacao smallint DEFAULT 0 NOT NULL,
    categoria character varying(255) DEFAULT 0 NOT NULL,
    descricao character varying(3000) DEFAULT 'descricao'::character varying NOT NULL
);


ALTER TABLE public.servico OWNER TO postgres;

--
-- Name: servico_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.servico ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.servico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: colaborador id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.colaborador ALTER COLUMN id SET DEFAULT nextval('public.colaborador_id_seq'::regclass);


--
-- Data for Name: avaliacao; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.avaliacao (id, id_usuario, id_servico, nota, data, comentario) FROM stdin;
3	1	4	4	2024-01-26	muito bom
4	1	5	3.5	2024-01-26	adorei
1	1	3	5	2024-01-26	demais
\.


--
-- Data for Name: canal; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.canal (id_colaborador, id_usuario, id) FROM stdin;
1	1	0
1	5	1
\.


--
-- Data for Name: colaborador; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.colaborador (id, nome, email, data_cad) FROM stdin;
1	Luis	luis@gmail.com	2023-12-31
\.


--
-- Data for Name: conta; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.conta (id, nome, senha, email, tipo) FROM stdin;
2	jean	1234	jean@gmail.com	4
1	Luis Filipe	1234	luis@gmail.com	3
5	usuario	senha1234	usuario@exemplo.com	4
\.


--
-- Data for Name: mensagem; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.mensagem (id_canal, id, data_envio, texto, enviado_por) FROM stdin;
0	1	2024-01-19	olá	\N
0	2	2024-01-19	como está?	\N
0	3	2024-01-19	oie	\N
0	4	2024-01-19	as	Luis Filipe
1	5	2024-01-19	oi Luis, tudo bem?	usuario
\.


--
-- Data for Name: pergunta; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pergunta (id, id_usuario, id_servico, pergunta, data, titulo, resposta) FROM stdin;
2	2	3	duvida	2024-01-26	Processo	asdsada
1	1	3	qual tecnologia utilizada?	2024-01-26	Tecnologia utilizada	php
3	1	3	qual o prazo de entrega do projeto?	2024-01-27	Prazo	
\.


--
-- Data for Name: servico; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.servico (nome, preco, colaborador_id, id, avaliacao, categoria, descricao) FROM stdin;
programacao	R$ 20.000,00	1	3	5	Programação	descricao
faxina	R$ 50.000,00	1	4	0	Geral	descricao
eletrica	R$ 5.000,00	1	5	0	Geral	descricao
desenvolvimento web	R$ 2.000,00	1	6	0	Programação	asdasd
desenvolvimento mobile	R$ 3.000,00	1	7	0	Programação	desenvolvo qualquer tipo de aplicativo em plataformas android e ios. ficarei feliz em contribuir com o seu projeto!
teste	R$ 2.000,00	1	8	0	Programação	aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
limpeza	R$ 100,00	1	9	0	Geral	faço limpeza de casas e apartamentos.
\.


--
-- Name: avaliacao_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.avaliacao_id_seq', 4, true);


--
-- Name: canal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.canal_id_seq', 1, true);


--
-- Name: colaborador_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.colaborador_id_seq', 1, false);


--
-- Name: mensagem_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.mensagem_id_seq', 5, true);


--
-- Name: pergunta_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pergunta_id_seq', 3, true);


--
-- Name: servico_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.servico_id_seq', 9, true);


--
-- Name: avaliacao avaliacao_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.avaliacao
    ADD CONSTRAINT avaliacao_pkey PRIMARY KEY (id);


--
-- Name: canal canal_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.canal
    ADD CONSTRAINT canal_pkey PRIMARY KEY (id);


--
-- Name: colaborador colaborador_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.colaborador
    ADD CONSTRAINT colaborador_pkey PRIMARY KEY (id);


--
-- Name: conta conta_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.conta
    ADD CONSTRAINT conta_pkey PRIMARY KEY (id);


--
-- Name: mensagem mensagem_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mensagem
    ADD CONSTRAINT mensagem_pkey PRIMARY KEY (id);


--
-- Name: pergunta pergunta_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pergunta
    ADD CONSTRAINT pergunta_pkey PRIMARY KEY (id);


--
-- Name: servico servico_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.servico
    ADD CONSTRAINT servico_pkey PRIMARY KEY (id);


--
-- Name: pergunta id_servico_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pergunta
    ADD CONSTRAINT id_servico_fkey FOREIGN KEY (id_servico) REFERENCES public.servico(id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;


--
-- Name: pergunta id_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pergunta
    ADD CONSTRAINT id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.conta(id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;


--
-- PostgreSQL database dump complete
--

