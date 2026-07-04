--
-- PostgreSQL database dump
--

\restrict MH64G1IhmysF4qrA9QT16SqDMkc2ahdsgaX4vec3oMmLwk3Ugjucp5GaTG4wzUQ

-- Dumped from database version 17.6
-- Dumped by pg_dump version 17.6

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
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
-- Name: books; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.books (
    id bigint NOT NULL,
    title character varying(255) NOT NULL,
    author character varying(255) NOT NULL,
    image character varying(255),
    is_available boolean DEFAULT true NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    category character varying(255) DEFAULT 'Trending'::character varying NOT NULL,
    penerbit character varying(255),
    thn_edisi character varying(4),
    sinopsis text,
    pdf_file character varying(255),
    total_download integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.books OWNER TO postgres;

--
-- Name: books_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.books_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.books_id_seq OWNER TO postgres;

--
-- Name: books_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.books_id_seq OWNED BY public.books.id;


--
-- Name: cache; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO postgres;

--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO postgres;

--
-- Name: download_logs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.download_logs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.download_logs_id_seq OWNER TO postgres;

--
-- Name: download_logs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.download_logs (
    id bigint DEFAULT nextval('public.download_logs_id_seq'::regclass) NOT NULL,
    user_id bigint NOT NULL,
    book_id bigint,
    reading_material_id bigint,
    downloaded_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.download_logs OWNER TO postgres;

--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: job_batches; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


ALTER TABLE public.job_batches OWNER TO postgres;

--
-- Name: jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jobs_id_seq OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: loans; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.loans (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    book_id bigint NOT NULL,
    borrowed_at date NOT NULL,
    due_date date NOT NULL,
    returned_at date,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.loans OWNER TO postgres;

--
-- Name: loans_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.loans_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.loans_id_seq OWNER TO postgres;

--
-- Name: loans_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.loans_id_seq OWNED BY public.loans.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO postgres;

--
-- Name: reading_materials; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.reading_materials (
    id bigint NOT NULL,
    title character varying(255) NOT NULL,
    author character varying(255) NOT NULL,
    type character varying(50) NOT NULL,
    pdf_file character varying(255) NOT NULL,
    total_download integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.reading_materials OWNER TO postgres;

--
-- Name: reading_materials_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.reading_materials_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.reading_materials_id_seq OWNER TO postgres;

--
-- Name: reading_materials_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.reading_materials_id_seq OWNED BY public.reading_materials.id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO postgres;

--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    nama character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    nim character varying NOT NULL,
    jurusan character varying,
    semester integer,
    role character varying(255) DEFAULT 'member'::character varying NOT NULL,
    jenis_kelamin character varying(15),
    tempat_lahir character varying(100),
    tanggal_lahir date,
    alamat text,
    telepon character varying(20)
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: books id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.books ALTER COLUMN id SET DEFAULT nextval('public.books_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: loans id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.loans ALTER COLUMN id SET DEFAULT nextval('public.loans_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: reading_materials id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reading_materials ALTER COLUMN id SET DEFAULT nextval('public.reading_materials_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: books; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.books (id, title, author, image, is_available, created_at, updated_at, category, penerbit, thn_edisi, sinopsis, pdf_file, total_download) FROM stdin;
16	The Sexual Relationship: An Object Relations View of Sex and the Family	Ky5'Kh}pk'L5'Zjohymm3'T5K5	A8Z1jzJEfyBAupaLKFWBT7BBao4DrvcTSSzJaE74.jpg	t	2026-06-17 18:38:46	2026-06-17 18:38:46	Psychology	Qhzvu'Hyvuzvu3'Puj5	\N	I|r|'pup'tlunlrzwsvyhzp'wlyhu'zlrz'khsht'o|i|unhu'thu|zph3'tlunnhi|unrhu'wlunhshthu'rspupz'wlu|spz'kp'ipkhun'{lyhwp'rls|hynh'khu'wlyuprhohu'klunhu'{lvyp'ylshzp'viqlr'/viqlj{'ylsh{pvuz'{olvy!0'zly{h'wlyrltihunhu'thzh'rhuhr4rhuhr5	wFS0uFgTvI5iZDDU2CuIKEWJfbJwOdHZEuQGGrKw.pdf	0
15	Living with Chronic Depression: A Rehabilitation Approach	Klivyho'Zlyhup3'Wz!5K5	rbBu6a4cPZkqrVpibhE75s1QQ8Afd29TmUA44OxM.jpg	t	2026-06-16 11:22:52	2026-06-16 11:22:52	Psychology	Yv~thu'-'Sp{{slmplsk'W|ispzolyz	\N	I|r|'pup'kp{|spz'vslo'wzprvsvn'rspupz'wltluhun'wlunohynhhu3'Ky5'Klivyho'Zlyhup3'!hun'tltihohz'ilu{|r4ilu{|r'klwylzp'zly{h'jhyh'tlunlsvsh'nlqhshu!h5	nXu3SE2owO2hdZxxmydKSkmASJU3prodv11Df869.pdf	3
\.


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache (key, value, expiration) FROM stdin;
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: download_logs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.download_logs (id, user_id, book_id, reading_material_id, downloaded_at) FROM stdin;
3	5	\N	3	2026-06-16 07:57:03
7	4	15	\N	2026-06-16 11:25:30
8	1	15	\N	2026-06-17 17:42:57
9	13	15	\N	2026-06-18 01:53:52
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: loans; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.loans (id, user_id, book_id, borrowed_at, due_date, returned_at, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
4	2026_04_12_151617_create_books_table	1
5	2026_04_12_152021_create_loans_table	1
6	2026_04_14_133649_add_category_to_books_table	2
7	2026_04_24_120248_add_role_to_users_table	3
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: reading_materials; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.reading_materials (id, title, author, type, pdf_file, total_download, created_at, updated_at) FROM stdin;
2	Modul Praktikum Blade Laravel	MUHAMAT ABDUL ROHIM, S.Kom., M.Si.	Modul	TokneRwXPZxUAaLcged2S0pUy4MQtVhpOgNZukkg.pdf	0	2026-06-16 07:56:16	2026-06-16 07:56:16
3	Modul Praktikum Migration Route	MUHAMAT ABDUL ROHIM, S.Kom., M.Si.	Modul	GFflet7Bjoxm6sQMufMb3b4aikxrhAk7V0LoWWBU.pdf	1	2026-06-16 07:56:59	2026-06-16 07:56:59
4	Modul Praktikum Query Builder	MUHAMAT ABDUL ROHIM, S.Kom., M.Si.	Modul	B9CXxse2cJ2hFViJ2lSKRjskCNOhENVW765HYIIv.pdf	0	2026-06-16 07:59:09	2026-06-16 07:59:09
5	MODUL PRAKTIKUM MENGGUNAKAN ELOQUENT ORM	MUHAMAT ABDUL ROHIM, S.Kom., M.Si.	Modul	HYP2AtuYWw4bzrxRqQA9TWASXs8rEOCAjjWYXNAE.pdf	0	2026-06-16 07:59:56	2026-06-16 07:59:56
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
2WQGWA7r9RKL8Ibp4ih1AZI3eJJneATZvc95lIvU	\N	127.0.0.1	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36	YTo3OntzOjY6Il90b2tlbiI7czo0MDoiTWU5RkVtdEVnbXN5RlRnQjV3S2lOYkZYZkhlN2IwZzg1Nm0xdkxZbiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9saWJyYXJ5IjtzOjU6InJvdXRlIjtzOjEzOiJsaWJyYXJ5LmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxMjoiaXNfbG9nZ2VkX2luIjtiOjE7czo3OiJ1c2VyX2lkIjtpOjU7czo5OiJ1c2VyX25hbWEiO3M6MTU6IkRhZGFuIEhpbmRheWFuYSI7czo5OiJ1c2VyX3JvbGUiO3M6NzoicGV0dWdhcyI7fQ==	1781721527
xOksMOqbWciYZAwzAKyNW0teQRTSXzvJfdW18oPt	\N	127.0.0.1	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36	YTo3OntzOjY6Il90b2tlbiI7czo0MDoiR21KMU9DTXFaU2k3dzhJclI4SDJLMW1VUHozcEVmczg1bWhxQmx5USI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9saWJyYXJ5IjtzOjU6InJvdXRlIjtzOjEzOiJsaWJyYXJ5LmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxMjoiaXNfbG9nZ2VkX2luIjtiOjE7czo3OiJ1c2VyX2lkIjtpOjEzO3M6OToidXNlcl9uYW1hIjtzOjk6IlBhayBSb2hpbSI7czo5OiJ1c2VyX3JvbGUiO3M6NjoibWVtYmVyIjt9	1781747632
VdjHUSKb6kVfEGWuXxf9KnShTPfaEeE3GPyWVcYa	\N	127.0.0.1	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36	YTozOntzOjY6Il90b2tlbiI7czo0MDoiUUhjanNIdDdoMk1TR0V5M3hrVWRSU1BsOElkOG1uWE96VUh6ZE9GTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19	1781930403
mLO3VG2v45rLxHbj62hxWCrnTTv391mN7mtA5ZhA	\N	127.0.0.1	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36	YTo3OntzOjY6Il90b2tlbiI7czo0MDoiWldXMENvdzhETnV0Y3Iyd0luV2F2MFhEWmNOUU5YMlNHdFl3V0Q5MCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjEyOiJpc19sb2dnZWRfaW4iO2I6MTtzOjc6InVzZXJfaWQiO2k6MTtzOjk6InVzZXJfbmFtYSI7czozMToiYWx2aXVzIGpvbmF0aGFuIGRlbmlzIGt1cm5pYXdhbiI7czo5OiJ1c2VyX3JvbGUiO3M6NToiYWRtaW4iO30=	1781720023
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, nama, email, email_verified_at, password, remember_token, created_at, updated_at, nim, jurusan, semester, role, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat, telepon) FROM stdin;
1	alvius jonathan denis kurniawan	denis@gmail.com	\N	denis123	\N	\N	\N	24060013	sti	4	admin	\N	\N	\N	\N	\N
5	Dadan Hindayana	dadan@gmail.com	\N	dadan123	\N	\N	\N	22050091	sti	1	petugas	\N	\N	\N	\N	\N
7	Ferssn	fern@gmail.com	\N	dern123	\N	2026-06-13 08:40:53	2026-06-13 08:40:53	24060010	RPL	6	member	\N	\N	\N	\N	\N
12	dinda	dinda@gmail.com	\N	dinda123	\N	2026-06-13 08:45:58	2026-06-13 08:45:58	24060018	RPL	4	member	\N	\N	\N	\N	\N
4	Mulyono	mulyono@gmail.com	\N	mulyono123	\N	\N	2026-06-17 16:46:52	24060014	sti	12	member	L	\N	\N	\N	\N
6	Nicko Widjaja	nicko@gmail.com	\N	nicko123	\N	\N	2026-06-17 16:47:02	23050056	sti	1	member	L	\N	\N	\N	\N
13	Pak Rohim	snakfns@mfsakfas	\N	dekan123	\N	2026-06-18 01:53:13	2026-06-18 01:53:13	24060021	STI	6	member	\N	\N	\N	\N	\N
\.


--
-- Name: books_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.books_id_seq', 16, true);


--
-- Name: download_logs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.download_logs_id_seq', 9, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: loans_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.loans_id_seq', 9, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 7, true);


--
-- Name: reading_materials_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.reading_materials_id_seq', 5, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 13, true);


--
-- Name: books books_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.books
    ADD CONSTRAINT books_pkey PRIMARY KEY (id);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: download_logs download_logs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.download_logs
    ADD CONSTRAINT download_logs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: loans loans_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.loans
    ADD CONSTRAINT loans_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: reading_materials reading_materials_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reading_materials
    ADD CONSTRAINT reading_materials_pkey PRIMARY KEY (id);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: cache_expiration_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX cache_expiration_index ON public.cache USING btree (expiration);


--
-- Name: cache_locks_expiration_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX cache_locks_expiration_index ON public.cache_locks USING btree (expiration);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: download_logs fk_download_book; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.download_logs
    ADD CONSTRAINT fk_download_book FOREIGN KEY (book_id) REFERENCES public.books(id) ON DELETE CASCADE;


--
-- Name: download_logs fk_download_material; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.download_logs
    ADD CONSTRAINT fk_download_material FOREIGN KEY (reading_material_id) REFERENCES public.reading_materials(id) ON DELETE CASCADE;


--
-- Name: download_logs fk_download_user; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.download_logs
    ADD CONSTRAINT fk_download_user FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: loans loans_book_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.loans
    ADD CONSTRAINT loans_book_id_foreign FOREIGN KEY (book_id) REFERENCES public.books(id) ON DELETE CASCADE;


--
-- Name: loans loans_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.loans
    ADD CONSTRAINT loans_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

\unrestrict MH64G1IhmysF4qrA9QT16SqDMkc2ahdsgaX4vec3oMmLwk3Ugjucp5GaTG4wzUQ

