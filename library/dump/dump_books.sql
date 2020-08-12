--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: book; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE public.book (
    id integer NOT NULL,
    _user_id integer,
    title character varying(255) NOT NULL,
    image character varying(500) NOT NULL,
    file character varying(500) NOT NULL,
    update_at timestamp(0) without time zone NOT NULL,
    author character varying(500) NOT NULL
);


ALTER TABLE public.book OWNER TO postgres;

--
-- Name: book_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.book_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.book_id_seq OWNER TO postgres;

--
-- Name: doctrine_migration_versions; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE public.doctrine_migration_versions (
    version character varying(191) NOT NULL,
    executed_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    execution_time integer
);


ALTER TABLE public.doctrine_migration_versions OWNER TO postgres;

--
-- Name: user; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE public."user" (
    id integer NOT NULL,
    email character varying(180) NOT NULL,
    roles json NOT NULL,
    password character varying(255) NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE public."user" OWNER TO postgres;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO postgres;

--
-- Data for Name: book; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.book (id, _user_id, title, image, file, update_at, author) FROM stdin;
14	15	Бегающий сейф	dc285ba0470672218d9e6f5864299ba2.jpeg	229a45514b78343801eeefffad660573.pdf	2020-08-12 05:50:04	Сергей Вишневский
15	15	Невеста	c0b1ce8a0d4a56912090d245df2cfeff.jpeg	5886029861653f1b4ce14c9f78e686c1.pdf	2020-08-12 05:56:04	Демина Карина
16	15	Охотник на читеров - Забанены будут все!	b6d9b7ffba3bb1a20df5041251af64ac.jpeg	b3a3093c1b8e1707160e951ef94b07a3.pdf	2020-08-12 05:58:46	Дмитрий Нелин
13	15	Чужак	bd14ab6acf40fb4f91eec94d3e646d22.jpeg	c88e6a1366ea1d148f2d4a04099f851a.pdf	2020-08-12 07:19:41	Макс Фрай
17	18	Многобукаф. Книга для	a46e6dc1bc9b1465840a10fbc6f7d022.jpeg	7ba101bdf3bff21471f2557e7006ebca.pdf	2020-08-12 07:20:00	Бормор Пётр
\.


--
-- Name: book_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.book_id_seq', 17, true);


--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20200616093024	2020-06-16 12:30:32	130
DoctrineMigrations\\Version20200616112446	2020-06-16 14:24:55	2114
DoctrineMigrations\\Version20200616114836	2020-06-16 14:49:32	44
DoctrineMigrations\\Version20200616120228	2020-06-16 15:02:47	118
DoctrineMigrations\\Version20200616120700	2020-06-16 15:07:12	44
DoctrineMigrations\\Version20200616152455	2020-06-16 18:25:13	99
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."user" (id, email, roles, password, name) FROM stdin;
15	admin@mail.ru	["ROLE_ADMIN"]	$argon2id$v=19$m=65536,t=4,p=1$nZeZrFwnkdbtA31tZRtN1A$7MjUXE2KSeqoe+qPM+opBaXk+6sI/4ldYOYYAGzch8Q	Admin
16	user@mail.ru	["ROLE_USER"]	$argon2id$v=19$m=65536,t=4,p=1$sxaQ1UqeSFKYs/hnVcfBhg$8r9idHaiOZBWxCoO61puUVziXwQ9z40qU9kCZqt6kaA	User
18	elfida@mail.ru	["ROLE_USER"]	$argon2id$v=19$m=65536,t=4,p=1$QTV3feScO947swTJjg/2tw$o9o2ow3ckXidTXhpYJEb2Z40R6Kyocq+pe7y3cMJmqs	Даша
\.


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_id_seq', 18, true);


--
-- Name: book_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY public.book
    ADD CONSTRAINT book_pkey PRIMARY KEY (id);


--
-- Name: doctrine_migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY public.doctrine_migration_versions
    ADD CONSTRAINT doctrine_migration_versions_pkey PRIMARY KEY (version);


--
-- Name: user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: idx_cbe5a331d32632e8; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_cbe5a331d32632e8 ON public.book USING btree (_user_id);


--
-- Name: uniq_8d93d649e7927c74; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_8d93d649e7927c74 ON public."user" USING btree (email);


--
-- Name: fk_cbe5a331d32632e8; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.book
    ADD CONSTRAINT fk_cbe5a331d32632e8 FOREIGN KEY (_user_id) REFERENCES public."user"(id);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

