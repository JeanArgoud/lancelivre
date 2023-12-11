--
-- PostgreSQL database dump
--

-- Dumped from database version 13.10
-- Dumped by pg_dump version 13.10

-- Started on 2023-12-11 11:21:46

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

--
-- TOC entry 2980 (class 0 OID 18126)
-- Dependencies: 200
-- Data for Name: conta; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.conta (id, nome, senha, tipo) FROM stdin;
1	admin	1234	1
\.


-- Completed on 2023-12-11 11:21:46

--
-- PostgreSQL database dump complete
--

