--
-- PostgreSQL database dump
--

-- Dumped from database version 13.10
-- Dumped by pg_dump version 13.10

-- Started on 2023-12-11 11:27:06

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

DROP DATABASE lancelivre;
--
-- TOC entry 2985 (class 1262 OID 18125)
-- Name: lancelivre; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE lancelivre WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Portuguese_Brazil.1252';


ALTER DATABASE lancelivre OWNER TO postgres;

\connect lancelivre

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
-- TOC entry 200 (class 1259 OID 18126)
-- Name: conta; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.conta (
    id integer NOT NULL,
    nome character varying(20) NOT NULL,
    senha character varying(100) NOT NULL,
	email character varying(30) NOT NULL,
    tipo integer NOT NULL
);


ALTER TABLE public.conta OWNER TO postgres;

--
-- TOC entry 2849 (class 2606 OID 18130)
-- Name: conta conta_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.conta
    ADD CONSTRAINT conta_pkey PRIMARY KEY (id);


-- Completed on 2023-12-11 11:27:06

--
-- PostgreSQL database dump complete
--

