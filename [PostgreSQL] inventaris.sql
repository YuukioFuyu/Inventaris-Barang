--
-- PostgreSQL database dump
--

-- Dumped from database version 15.6
-- Dumped by pg_dump version 16.0

-- Started on 2024-12-17 10:44:15

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
-- TOC entry 321 (class 1255 OID 93740)
-- Name: keterangan_mutasi_func(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.keterangan_mutasi_func() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
  UPDATE penempatan
  SET keterangan = NEW.keterangan
  WHERE id_penempatan = NEW.id_penempatan;
  RETURN NEW;
END;
$$;


ALTER FUNCTION public.keterangan_mutasi_func() OWNER TO postgres;

--
-- TOC entry 322 (class 1255 OID 93772)
-- Name: penempatan_barang(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.penempatan_barang() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
  UPDATE barang 
  SET jumlah = jumlah - NEW.jumlah
  WHERE nama_barang = NEW.nama_barang;
  RETURN NEW;
END;
$$;


ALTER FUNCTION public.penempatan_barang() OWNER TO postgres;

--
-- TOC entry 323 (class 1255 OID 93783)
-- Name: pengadaan_barang(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.pengadaan_barang() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
  UPDATE barang 
  SET jumlah = jumlah + NEW.jumlah
  WHERE nama_barang = NEW.nama_barang;
  RETURN NEW;
END;
$$;


ALTER FUNCTION public.pengadaan_barang() OWNER TO postgres;

--
-- TOC entry 324 (class 1255 OID 93795)
-- Name: pengajuan_pinjam(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.pengajuan_pinjam() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
  UPDATE barang 
  SET jumlah = jumlah - NEW.jumlah
  WHERE nama_barang = NEW.nama_barang;
  RETURN NEW;
END;
$$;


ALTER FUNCTION public.pengajuan_pinjam() OWNER TO postgres;

--
-- TOC entry 325 (class 1255 OID 93808)
-- Name: pengembalian_barang(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.pengembalian_barang() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
  UPDATE barang 
  SET jumlah = jumlah + NEW.jumlah
  WHERE nama_barang = NEW.nama_barang;
  RETURN NEW;
END;
$$;


ALTER FUNCTION public.pengembalian_barang() OWNER TO postgres;

--
-- TOC entry 320 (class 1255 OID 93590)
-- Name: update_barang_after_disposal(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.update_barang_after_disposal() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    UPDATE barang
    SET jumlah = jumlah - NEW.jumlah
    WHERE nama_barang = NEW.nama_barang;
    RETURN NEW;
END;
$$;


ALTER FUNCTION public.update_barang_after_disposal() OWNER TO postgres;

--
-- TOC entry 326 (class 1255 OID 93857)
-- Name: update_barang_after_retur(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.update_barang_after_retur() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
  UPDATE barang 
  SET jumlah = jumlah - NEW.jumlah
  WHERE nama_barang = NEW.nama_barang;
  RETURN NEW;
END;
$$;


ALTER FUNCTION public.update_barang_after_retur() OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 216 (class 1259 OID 93375)
-- Name: aauth_group_to_group; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.aauth_group_to_group (
    group_id integer NOT NULL,
    subgroup_id integer NOT NULL
);


ALTER TABLE public.aauth_group_to_group OWNER TO postgres;

--
-- TOC entry 215 (class 1259 OID 93367)
-- Name: aauth_groups; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.aauth_groups (
    id integer NOT NULL,
    name character varying(100),
    definition text
);


ALTER TABLE public.aauth_groups OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 93366)
-- Name: aauth_groups_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.aauth_groups_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.aauth_groups_id_seq OWNER TO postgres;

--
-- TOC entry 3902 (class 0 OID 0)
-- Dependencies: 214
-- Name: aauth_groups_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.aauth_groups_id_seq OWNED BY public.aauth_groups.id;


--
-- TOC entry 218 (class 1259 OID 93381)
-- Name: aauth_login_attempts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.aauth_login_attempts (
    id integer NOT NULL,
    ip_address character varying(39),
    "timestamp" timestamp without time zone,
    login_attempts smallint,
    CONSTRAINT aauth_login_attempts_login_attempts_check CHECK ((login_attempts >= 0))
);


ALTER TABLE public.aauth_login_attempts OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 93380)
-- Name: aauth_login_attempts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.aauth_login_attempts_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.aauth_login_attempts_id_seq OWNER TO postgres;

--
-- TOC entry 3903 (class 0 OID 0)
-- Dependencies: 217
-- Name: aauth_login_attempts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.aauth_login_attempts_id_seq OWNED BY public.aauth_login_attempts.id;


--
-- TOC entry 221 (class 1259 OID 93397)
-- Name: aauth_perm_to_group; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.aauth_perm_to_group (
    perm_id integer NOT NULL,
    group_id integer NOT NULL
);


ALTER TABLE public.aauth_perm_to_group OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 93400)
-- Name: aauth_perm_to_user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.aauth_perm_to_user (
    perm_id integer NOT NULL,
    user_id integer NOT NULL
);


ALTER TABLE public.aauth_perm_to_user OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 93389)
-- Name: aauth_perms; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.aauth_perms (
    id integer NOT NULL,
    name character varying(100),
    definition text
);


ALTER TABLE public.aauth_perms OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 93388)
-- Name: aauth_perms_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.aauth_perms_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.aauth_perms_id_seq OWNER TO postgres;

--
-- TOC entry 3904 (class 0 OID 0)
-- Dependencies: 219
-- Name: aauth_perms_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.aauth_perms_id_seq OWNED BY public.aauth_perms.id;


--
-- TOC entry 224 (class 1259 OID 93406)
-- Name: aauth_pms; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.aauth_pms (
    id integer NOT NULL,
    sender_id integer NOT NULL,
    receiver_id integer NOT NULL,
    title character varying(225) NOT NULL,
    message text,
    date_sent timestamp without time zone,
    date_read timestamp without time zone,
    pm_deleted_sender smallint,
    pm_deleted_receiver smallint
);


ALTER TABLE public.aauth_pms OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 93405)
-- Name: aauth_pms_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.aauth_pms_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.aauth_pms_id_seq OWNER TO postgres;

--
-- TOC entry 3905 (class 0 OID 0)
-- Dependencies: 223
-- Name: aauth_pms_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.aauth_pms_id_seq OWNED BY public.aauth_pms.id;


--
-- TOC entry 226 (class 1259 OID 93415)
-- Name: aauth_user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.aauth_user (
    id integer NOT NULL,
    name character varying(100) DEFAULT NULL::character varying,
    definition text
);


ALTER TABLE public.aauth_user OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 93414)
-- Name: aauth_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.aauth_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.aauth_user_id_seq OWNER TO postgres;

--
-- TOC entry 3906 (class 0 OID 0)
-- Dependencies: 225
-- Name: aauth_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.aauth_user_id_seq OWNED BY public.aauth_user.id;


--
-- TOC entry 229 (class 1259 OID 93435)
-- Name: aauth_user_to_group; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.aauth_user_to_group (
    user_id integer NOT NULL,
    group_id integer NOT NULL
);


ALTER TABLE public.aauth_user_to_group OWNER TO postgres;

--
-- TOC entry 231 (class 1259 OID 93441)
-- Name: aauth_user_variables; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.aauth_user_variables (
    id integer NOT NULL,
    user_id integer NOT NULL,
    data_key character varying(100) NOT NULL,
    value text
);


ALTER TABLE public.aauth_user_variables OWNER TO postgres;

--
-- TOC entry 230 (class 1259 OID 93440)
-- Name: aauth_user_variables_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.aauth_user_variables_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.aauth_user_variables_id_seq OWNER TO postgres;

--
-- TOC entry 3907 (class 0 OID 0)
-- Dependencies: 230
-- Name: aauth_user_variables_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.aauth_user_variables_id_seq OWNED BY public.aauth_user_variables.id;


--
-- TOC entry 228 (class 1259 OID 93425)
-- Name: aauth_users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.aauth_users (
    id integer NOT NULL,
    email character varying(100) NOT NULL,
    pass character varying(64) NOT NULL,
    username character varying(100) NOT NULL,
    full_name character varying(200) NOT NULL,
    avatar text NOT NULL,
    banned SMALLINT DEFAULT 0,
    last_login timestamp without time zone,
    last_activity timestamp without time zone,
    date_created timestamp without time zone,
    forgot_exp text,
    remember_time timestamp without time zone,
    remember_exp text,
    verification_code text,
    top_secret character varying(16) DEFAULT NULL::character varying,
    ip_address text
);


ALTER TABLE public.aauth_users OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 93424)
-- Name: aauth_users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.aauth_users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.aauth_users_id_seq OWNER TO postgres;

--
-- TOC entry 3908 (class 0 OID 0)
-- Dependencies: 227
-- Name: aauth_users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.aauth_users_id_seq OWNED BY public.aauth_users.id;


--
-- TOC entry 233 (class 1259 OID 93450)
-- Name: agama; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.agama (
    id_agama integer NOT NULL,
    agama character varying(10) NOT NULL
);


ALTER TABLE public.agama OWNER TO postgres;

--
-- TOC entry 232 (class 1259 OID 93449)
-- Name: agama_id_agama_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.agama_id_agama_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.agama_id_agama_seq OWNER TO postgres;

--
-- TOC entry 3909 (class 0 OID 0)
-- Dependencies: 232
-- Name: agama_id_agama_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.agama_id_agama_seq OWNED BY public.agama.id_agama;


--
-- TOC entry 235 (class 1259 OID 93457)
-- Name: barang; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.barang (
    id_barang integer NOT NULL,
    nama_barang character varying(50) NOT NULL,
    merek character varying(100) NOT NULL,
    kategori character varying(100) NOT NULL,
    jumlah integer NOT NULL,
    satuan character varying(50) NOT NULL,
    gambar character varying(100) NOT NULL,
    keterangan text NOT NULL
);


ALTER TABLE public.barang OWNER TO postgres;

--
-- TOC entry 234 (class 1259 OID 93456)
-- Name: barang_id_barang_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.barang_id_barang_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.barang_id_barang_seq OWNER TO postgres;

--
-- TOC entry 3910 (class 0 OID 0)
-- Dependencies: 234
-- Name: barang_id_barang_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.barang_id_barang_seq OWNED BY public.barang.id_barang;


--
-- TOC entry 237 (class 1259 OID 93466)
-- Name: blog; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.blog (
    id integer NOT NULL,
    title character varying(200) NOT NULL,
    content text NOT NULL,
    image text NOT NULL,
    category character varying(200) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.blog OWNER TO postgres;

--
-- TOC entry 239 (class 1259 OID 93476)
-- Name: blog_category; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.blog_category (
    category_id integer NOT NULL,
    category_name character varying(200) NOT NULL,
    category_desc text NOT NULL
);


ALTER TABLE public.blog_category OWNER TO postgres;

--
-- TOC entry 238 (class 1259 OID 93475)
-- Name: blog_category_category_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.blog_category_category_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.blog_category_category_id_seq OWNER TO postgres;

--
-- TOC entry 3911 (class 0 OID 0)
-- Dependencies: 238
-- Name: blog_category_category_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.blog_category_category_id_seq OWNED BY public.blog_category.category_id;


--
-- TOC entry 236 (class 1259 OID 93465)
-- Name: blog_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.blog_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.blog_id_seq OWNER TO postgres;

--
-- TOC entry 3912 (class 0 OID 0)
-- Dependencies: 236
-- Name: blog_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.blog_id_seq OWNED BY public.blog.id;


--
-- TOC entry 241 (class 1259 OID 93485)
-- Name: captcha; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.captcha (
    captcha_id integer NOT NULL,
    captcha_time integer,
    ip_address character varying(45) NOT NULL,
    word character varying(20) NOT NULL
);


ALTER TABLE public.captcha OWNER TO postgres;

--
-- TOC entry 240 (class 1259 OID 93484)
-- Name: captcha_captcha_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.captcha_captcha_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.captcha_captcha_id_seq OWNER TO postgres;

--
-- TOC entry 3913 (class 0 OID 0)
-- Dependencies: 240
-- Name: captcha_captcha_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.captcha_captcha_id_seq OWNED BY public.captcha.captcha_id;


--
-- TOC entry 243 (class 1259 OID 93492)
-- Name: cc_options; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cc_options (
    id integer NOT NULL,
    option_name character varying(200) NOT NULL,
    option_value text
);


ALTER TABLE public.cc_options OWNER TO postgres;

--
-- TOC entry 242 (class 1259 OID 93491)
-- Name: cc_options_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cc_options_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.cc_options_id_seq OWNER TO postgres;

--
-- TOC entry 3914 (class 0 OID 0)
-- Dependencies: 242
-- Name: cc_options_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cc_options_id_seq OWNED BY public.cc_options.id;


--
-- TOC entry 245 (class 1259 OID 93501)
-- Name: cc_session; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cc_session (
    id integer NOT NULL,
    ip_address character varying(45) NOT NULL,
    "timestamp" integer NOT NULL,
    data bytea NOT NULL
);


ALTER TABLE public.cc_session OWNER TO postgres;

--
-- TOC entry 244 (class 1259 OID 93500)
-- Name: cc_session_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cc_session_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.cc_session_id_seq OWNER TO postgres;

--
-- TOC entry 3915 (class 0 OID 0)
-- Dependencies: 244
-- Name: cc_session_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cc_session_id_seq OWNED BY public.cc_session.id;


--
-- TOC entry 247 (class 1259 OID 93511)
-- Name: crud; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.crud (
    id integer NOT NULL,
    title character varying(200) NOT NULL,
    subject character varying(200) NOT NULL,
    table_name character varying(200) NOT NULL,
    primary_key character varying(200) NOT NULL,
    page_read character varying(20) DEFAULT NULL::character varying,
    page_create character varying(20) DEFAULT NULL::character varying,
    page_update character varying(20) DEFAULT NULL::character varying
);


ALTER TABLE public.crud OWNER TO postgres;

--
-- TOC entry 249 (class 1259 OID 93523)
-- Name: crud_custom_option; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.crud_custom_option (
    id integer NOT NULL,
    crud_field_id integer NOT NULL,
    crud_id integer NOT NULL,
    option_value text NOT NULL,
    option_label text NOT NULL
);


ALTER TABLE public.crud_custom_option OWNER TO postgres;

--
-- TOC entry 248 (class 1259 OID 93522)
-- Name: crud_custom_option_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.crud_custom_option_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.crud_custom_option_id_seq OWNER TO postgres;

--
-- TOC entry 3916 (class 0 OID 0)
-- Dependencies: 248
-- Name: crud_custom_option_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.crud_custom_option_id_seq OWNED BY public.crud_custom_option.id;


--
-- TOC entry 251 (class 1259 OID 93532)
-- Name: crud_field; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.crud_field (
    id integer NOT NULL,
    crud_id integer NOT NULL,
    field_name character varying(200) NOT NULL,
    input_type character varying(200) NOT NULL,
    show_column character varying(10) DEFAULT NULL::character varying,
    show_add_form character varying(10) DEFAULT NULL::character varying,
    show_update_form character varying(10) DEFAULT NULL::character varying,
    show_detail_page character varying(10) DEFAULT NULL::character varying,
    sort integer NOT NULL,
    relation_table character varying(200) DEFAULT NULL::character varying,
    relation_value character varying(200) DEFAULT NULL::character varying,
    relation_label character varying(200) DEFAULT NULL::character varying
);


ALTER TABLE public.crud_field OWNER TO postgres;

--
-- TOC entry 250 (class 1259 OID 93531)
-- Name: crud_field_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.crud_field_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.crud_field_id_seq OWNER TO postgres;

--
-- TOC entry 3917 (class 0 OID 0)
-- Dependencies: 250
-- Name: crud_field_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.crud_field_id_seq OWNED BY public.crud_field.id;


--
-- TOC entry 253 (class 1259 OID 93548)
-- Name: crud_field_validation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.crud_field_validation (
    id integer NOT NULL,
    crud_field_id integer NOT NULL,
    crud_id integer NOT NULL,
    validation_name character varying(200) NOT NULL,
    validation_value text NOT NULL
);


ALTER TABLE public.crud_field_validation OWNER TO postgres;

--
-- TOC entry 252 (class 1259 OID 93547)
-- Name: crud_field_validation_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.crud_field_validation_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.crud_field_validation_id_seq OWNER TO postgres;

--
-- TOC entry 3918 (class 0 OID 0)
-- Dependencies: 252
-- Name: crud_field_validation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.crud_field_validation_id_seq OWNED BY public.crud_field_validation.id;


--
-- TOC entry 246 (class 1259 OID 93510)
-- Name: crud_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.crud_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.crud_id_seq OWNER TO postgres;

--
-- TOC entry 3919 (class 0 OID 0)
-- Dependencies: 246
-- Name: crud_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.crud_id_seq OWNED BY public.crud.id;


--
-- TOC entry 255 (class 1259 OID 93557)
-- Name: crud_input_type; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.crud_input_type (
    id integer NOT NULL,
    type character varying(200) NOT NULL,
    relation character varying(20) NOT NULL,
    custom_value integer NOT NULL,
    validation_group character varying(200) NOT NULL
);


ALTER TABLE public.crud_input_type OWNER TO postgres;

--
-- TOC entry 254 (class 1259 OID 93556)
-- Name: crud_input_type_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.crud_input_type_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.crud_input_type_id_seq OWNER TO postgres;

--
-- TOC entry 3920 (class 0 OID 0)
-- Dependencies: 254
-- Name: crud_input_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.crud_input_type_id_seq OWNED BY public.crud_input_type.id;


--
-- TOC entry 257 (class 1259 OID 93564)
-- Name: crud_input_validation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.crud_input_validation (
    id integer NOT NULL,
    validation character varying(200) NOT NULL,
    input_able character varying(20) NOT NULL,
    group_input text NOT NULL,
    input_placeholder text NOT NULL,
    call_back character varying(10) NOT NULL,
    input_validation text NOT NULL
);


ALTER TABLE public.crud_input_validation OWNER TO postgres;

--
-- TOC entry 256 (class 1259 OID 93563)
-- Name: crud_input_validation_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.crud_input_validation_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.crud_input_validation_id_seq OWNER TO postgres;

--
-- TOC entry 3921 (class 0 OID 0)
-- Dependencies: 256
-- Name: crud_input_validation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.crud_input_validation_id_seq OWNED BY public.crud_input_validation.id;


--
-- TOC entry 259 (class 1259 OID 93573)
-- Name: departemen; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.departemen (
    id_dep integer NOT NULL,
    nama_departemen character varying(100) NOT NULL,
    keterangan text NOT NULL
);


ALTER TABLE public.departemen OWNER TO postgres;

--
-- TOC entry 258 (class 1259 OID 93572)
-- Name: departemen_id_dep_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.departemen_id_dep_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.departemen_id_dep_seq OWNER TO postgres;

--
-- TOC entry 3922 (class 0 OID 0)
-- Dependencies: 258
-- Name: departemen_id_dep_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.departemen_id_dep_seq OWNED BY public.departemen.id_dep;


--
-- TOC entry 261 (class 1259 OID 93582)
-- Name: disposal; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.disposal (
    id_disposal integer NOT NULL,
    nomor_surat character varying(50) NOT NULL,
    nama_barang character varying(50) NOT NULL,
    jumlah integer NOT NULL,
    berkas character varying(50) NOT NULL,
    deskripsi text NOT NULL
);


ALTER TABLE public.disposal OWNER TO postgres;

--
-- TOC entry 260 (class 1259 OID 93581)
-- Name: disposal_id_disposal_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.disposal_id_disposal_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.disposal_id_disposal_seq OWNER TO postgres;

--
-- TOC entry 3923 (class 0 OID 0)
-- Dependencies: 260
-- Name: disposal_id_disposal_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.disposal_id_disposal_seq OWNED BY public.disposal.id_disposal;


--
-- TOC entry 263 (class 1259 OID 93593)
-- Name: form; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.form (
    id integer NOT NULL,
    title character varying(200) NOT NULL,
    subject character varying(200) NOT NULL,
    table_name character varying(200) NOT NULL
);


ALTER TABLE public.form OWNER TO postgres;

--
-- TOC entry 265 (class 1259 OID 93602)
-- Name: form_custom_attribute; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.form_custom_attribute (
    id integer NOT NULL,
    form_field_id integer NOT NULL,
    form_id integer NOT NULL,
    attribute_value text NOT NULL,
    attribute_label text NOT NULL
);


ALTER TABLE public.form_custom_attribute OWNER TO postgres;

--
-- TOC entry 264 (class 1259 OID 93601)
-- Name: form_custom_attribute_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.form_custom_attribute_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.form_custom_attribute_id_seq OWNER TO postgres;

--
-- TOC entry 3924 (class 0 OID 0)
-- Dependencies: 264
-- Name: form_custom_attribute_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.form_custom_attribute_id_seq OWNED BY public.form_custom_attribute.id;


--
-- TOC entry 267 (class 1259 OID 93611)
-- Name: form_custom_option; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.form_custom_option (
    id integer NOT NULL,
    form_field_id integer NOT NULL,
    form_id integer NOT NULL,
    option_value text NOT NULL,
    option_label text NOT NULL
);


ALTER TABLE public.form_custom_option OWNER TO postgres;

--
-- TOC entry 266 (class 1259 OID 93610)
-- Name: form_custom_option_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.form_custom_option_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.form_custom_option_id_seq OWNER TO postgres;

--
-- TOC entry 3925 (class 0 OID 0)
-- Dependencies: 266
-- Name: form_custom_option_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.form_custom_option_id_seq OWNED BY public.form_custom_option.id;


--
-- TOC entry 269 (class 1259 OID 93620)
-- Name: form_field; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.form_field (
    id integer NOT NULL,
    form_id integer NOT NULL,
    sort integer NOT NULL,
    field_name character varying(200) NOT NULL,
    input_type character varying(200) NOT NULL,
    field_label character varying(200) DEFAULT NULL::character varying,
    placeholder text,
    auto_generate_help_block character varying(10) DEFAULT NULL::character varying,
    help_block text,
    relation_table character varying(200) DEFAULT NULL::character varying,
    relation_value character varying(200) DEFAULT NULL::character varying,
    relation_label character varying(200) DEFAULT NULL::character varying
);


ALTER TABLE public.form_field OWNER TO postgres;

--
-- TOC entry 268 (class 1259 OID 93619)
-- Name: form_field_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.form_field_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.form_field_id_seq OWNER TO postgres;

--
-- TOC entry 3926 (class 0 OID 0)
-- Dependencies: 268
-- Name: form_field_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.form_field_id_seq OWNED BY public.form_field.id;


--
-- TOC entry 271 (class 1259 OID 93634)
-- Name: form_field_validation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.form_field_validation (
    id integer NOT NULL,
    form_field_id integer NOT NULL,
    form_id integer NOT NULL,
    validation_name character varying(200) NOT NULL,
    validation_value text NOT NULL
);


ALTER TABLE public.form_field_validation OWNER TO postgres;

--
-- TOC entry 270 (class 1259 OID 93633)
-- Name: form_field_validation_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.form_field_validation_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.form_field_validation_id_seq OWNER TO postgres;

--
-- TOC entry 3927 (class 0 OID 0)
-- Dependencies: 270
-- Name: form_field_validation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.form_field_validation_id_seq OWNED BY public.form_field_validation.id;


--
-- TOC entry 262 (class 1259 OID 93592)
-- Name: form_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.form_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.form_id_seq OWNER TO postgres;

--
-- TOC entry 3928 (class 0 OID 0)
-- Dependencies: 262
-- Name: form_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.form_id_seq OWNED BY public.form.id;


--
-- TOC entry 273 (class 1259 OID 93643)
-- Name: form_pengajuan_pinjam_barang; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.form_pengajuan_pinjam_barang (
    id integer NOT NULL,
    nik_nidn_nim character varying(225) NOT NULL,
    nama_peminjam character varying(225) NOT NULL,
    no_telp_hp character varying(225) NOT NULL,
    nama_barang character varying(225) NOT NULL,
    dipakai_di character varying(225) NOT NULL,
    digunakan_untuk text NOT NULL,
    jumlah character varying(225) NOT NULL,
    tanggal_pinjam text,
    tanggal_kembali date NOT NULL
);


ALTER TABLE public.form_pengajuan_pinjam_barang OWNER TO postgres;

--
-- TOC entry 272 (class 1259 OID 93642)
-- Name: form_pengajuan_pinjam_barang_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.form_pengajuan_pinjam_barang_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.form_pengajuan_pinjam_barang_id_seq OWNER TO postgres;

--
-- TOC entry 3929 (class 0 OID 0)
-- Dependencies: 272
-- Name: form_pengajuan_pinjam_barang_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.form_pengajuan_pinjam_barang_id_seq OWNED BY public.form_pengajuan_pinjam_barang.id;


--
-- TOC entry 275 (class 1259 OID 93652)
-- Name: jabatan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jabatan (
    id_jabatan integer NOT NULL,
    jabatan character varying(50) NOT NULL
);


ALTER TABLE public.jabatan OWNER TO postgres;

--
-- TOC entry 274 (class 1259 OID 93651)
-- Name: jabatan_id_jabatan_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jabatan_id_jabatan_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jabatan_id_jabatan_seq OWNER TO postgres;

--
-- TOC entry 3930 (class 0 OID 0)
-- Dependencies: 274
-- Name: jabatan_id_jabatan_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jabatan_id_jabatan_seq OWNED BY public.jabatan.id_jabatan;


--
-- TOC entry 277 (class 1259 OID 93659)
-- Name: jenis_pengadaan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jenis_pengadaan (
    id_jenis_pendagaan integer NOT NULL,
    jenis_pengadaan character varying(100) NOT NULL,
    keterangan text NOT NULL
);


ALTER TABLE public.jenis_pengadaan OWNER TO postgres;

--
-- TOC entry 276 (class 1259 OID 93658)
-- Name: jenis_pengadaan_id_jenis_pendagaan_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jenis_pengadaan_id_jenis_pendagaan_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jenis_pengadaan_id_jenis_pendagaan_seq OWNER TO postgres;

--
-- TOC entry 3931 (class 0 OID 0)
-- Dependencies: 276
-- Name: jenis_pengadaan_id_jenis_pendagaan_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jenis_pengadaan_id_jenis_pendagaan_seq OWNED BY public.jenis_pengadaan.id_jenis_pendagaan;


--
-- TOC entry 279 (class 1259 OID 93668)
-- Name: karyawan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.karyawan (
    id_karyawan integer NOT NULL,
    nama_lengkap character varying(50) NOT NULL,
    telp character varying(13) NOT NULL,
    nik character varying(50) NOT NULL,
    jabatan character varying(50) NOT NULL
);


ALTER TABLE public.karyawan OWNER TO postgres;

--
-- TOC entry 278 (class 1259 OID 93667)
-- Name: karyawan_id_karyawan_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.karyawan_id_karyawan_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.karyawan_id_karyawan_seq OWNER TO postgres;

--
-- TOC entry 3932 (class 0 OID 0)
-- Dependencies: 278
-- Name: karyawan_id_karyawan_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.karyawan_id_karyawan_seq OWNED BY public.karyawan.id_karyawan;


--
-- TOC entry 281 (class 1259 OID 93675)
-- Name: kategori; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kategori (
    id_kategori integer NOT NULL,
    kategori character varying(100) NOT NULL,
    keterangan text NOT NULL
);


ALTER TABLE public.kategori OWNER TO postgres;

--
-- TOC entry 280 (class 1259 OID 93674)
-- Name: kategori_id_kategori_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.kategori_id_kategori_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.kategori_id_kategori_seq OWNER TO postgres;

--
-- TOC entry 3933 (class 0 OID 0)
-- Dependencies: 280
-- Name: kategori_id_kategori_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.kategori_id_kategori_seq OWNED BY public.kategori.id_kategori;


--
-- TOC entry 283 (class 1259 OID 93684)
-- Name: keys; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.keys (
    id integer NOT NULL,
    user_id integer NOT NULL,
    key character varying(40) NOT NULL,
    level integer NOT NULL,
    ignore_limits SMALLINT NOT NULL,
    is_private_key SMALLINT NOT NULL,
    ip_addresses text,
    date_created timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.keys OWNER TO postgres;

--
-- TOC entry 282 (class 1259 OID 93683)
-- Name: keys_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.keys_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.keys_id_seq OWNER TO postgres;

--
-- TOC entry 3934 (class 0 OID 0)
-- Dependencies: 282
-- Name: keys_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.keys_id_seq OWNED BY public.keys.id;


--
-- TOC entry 285 (class 1259 OID 93694)
-- Name: lokasi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lokasi (
    id_lok integer NOT NULL,
    nama_lokasi character varying(100) NOT NULL,
    departemen character varying(100) NOT NULL
);


ALTER TABLE public.lokasi OWNER TO postgres;

--
-- TOC entry 284 (class 1259 OID 93693)
-- Name: lokasi_id_lok_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.lokasi_id_lok_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.lokasi_id_lok_seq OWNER TO postgres;

--
-- TOC entry 3935 (class 0 OID 0)
-- Dependencies: 284
-- Name: lokasi_id_lok_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.lokasi_id_lok_seq OWNED BY public.lokasi.id_lok;


--
-- TOC entry 287 (class 1259 OID 93702)
-- Name: menu; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.menu (
    id integer NOT NULL,
    label character varying(200) DEFAULT NULL::character varying,
    type character varying(200) DEFAULT NULL::character varying,
    icon_color character varying(200) DEFAULT NULL::character varying,
    link character varying(200) DEFAULT NULL::character varying,
    sort integer NOT NULL,
    parent integer NOT NULL,
    icon character varying(50) DEFAULT NULL::character varying,
    menu_type_id integer NOT NULL
);


ALTER TABLE public.menu OWNER TO postgres;

--
-- TOC entry 288 (class 1259 OID 93715)
-- Name: menu_icon; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.menu_icon (
    class_name character varying(200) NOT NULL
);


ALTER TABLE public.menu_icon OWNER TO postgres;

--
-- TOC entry 286 (class 1259 OID 93701)
-- Name: menu_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.menu_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.menu_id_seq OWNER TO postgres;

--
-- TOC entry 3936 (class 0 OID 0)
-- Dependencies: 286
-- Name: menu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.menu_id_seq OWNED BY public.menu.id;


--
-- TOC entry 290 (class 1259 OID 93719)
-- Name: menu_type; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.menu_type (
    id integer NOT NULL,
    name character varying(200) NOT NULL,
    definition text
);


ALTER TABLE public.menu_type OWNER TO postgres;

--
-- TOC entry 289 (class 1259 OID 93718)
-- Name: menu_type_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.menu_type_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.menu_type_id_seq OWNER TO postgres;

--
-- TOC entry 3937 (class 0 OID 0)
-- Dependencies: 289
-- Name: menu_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.menu_type_id_seq OWNED BY public.menu_type.id;


--
-- TOC entry 291 (class 1259 OID 93728)
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    version bigint NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- TOC entry 293 (class 1259 OID 93732)
-- Name: mutasi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.mutasi (
    id_mutasi integer NOT NULL,
    id_penempatan character varying(100) NOT NULL,
    tanggal_mutasi date NOT NULL,
    keterangan text NOT NULL,
    departemen character varying(100) NOT NULL,
    lokasi character varying(100) NOT NULL,
    nama_barang character varying(100) NOT NULL
);


ALTER TABLE public.mutasi OWNER TO postgres;

--
-- TOC entry 292 (class 1259 OID 93731)
-- Name: mutasi_id_mutasi_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.mutasi_id_mutasi_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.mutasi_id_mutasi_seq OWNER TO postgres;

--
-- TOC entry 3938 (class 0 OID 0)
-- Dependencies: 292
-- Name: mutasi_id_mutasi_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.mutasi_id_mutasi_seq OWNED BY public.mutasi.id_mutasi;


--
-- TOC entry 295 (class 1259 OID 93743)
-- Name: page; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.page (
    id integer NOT NULL,
    title character varying(200) NOT NULL,
    type character varying(200) NOT NULL,
    content text NOT NULL,
    fresh_content text NOT NULL,
    keyword text,
    description text,
    link character varying(200) DEFAULT NULL::character varying,
    template character varying(200) DEFAULT NULL::character varying,
    created_at timestamp with time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.page OWNER TO postgres;

--
-- TOC entry 297 (class 1259 OID 93755)
-- Name: page_block_element; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.page_block_element (
    id integer NOT NULL,
    group_name character varying(200) NOT NULL,
    content text NOT NULL,
    image_preview character varying(200) NOT NULL,
    block_name character varying(200) NOT NULL,
    content_type character varying(100) NOT NULL
);


ALTER TABLE public.page_block_element OWNER TO postgres;

--
-- TOC entry 296 (class 1259 OID 93754)
-- Name: page_block_element_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.page_block_element_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.page_block_element_id_seq OWNER TO postgres;

--
-- TOC entry 3939 (class 0 OID 0)
-- Dependencies: 296
-- Name: page_block_element_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.page_block_element_id_seq OWNED BY public.page_block_element.id;


--
-- TOC entry 294 (class 1259 OID 93742)
-- Name: page_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.page_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.page_id_seq OWNER TO postgres;

--
-- TOC entry 3940 (class 0 OID 0)
-- Dependencies: 294
-- Name: page_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.page_id_seq OWNED BY public.page.id;


--
-- TOC entry 299 (class 1259 OID 93764)
-- Name: penempatan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.penempatan (
    id_penempatan integer NOT NULL,
    tanggal_penempatan date NOT NULL,
    departemen character varying(100) NOT NULL,
    lokasi character varying(100) NOT NULL,
    keterangan text NOT NULL,
    nama_barang character varying(100) NOT NULL,
    jumlah integer NOT NULL
);


ALTER TABLE public.penempatan OWNER TO postgres;

--
-- TOC entry 298 (class 1259 OID 93763)
-- Name: penempatan_id_penempatan_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.penempatan_id_penempatan_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.penempatan_id_penempatan_seq OWNER TO postgres;

--
-- TOC entry 3941 (class 0 OID 0)
-- Dependencies: 298
-- Name: penempatan_id_penempatan_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.penempatan_id_penempatan_seq OWNED BY public.penempatan.id_penempatan;


--
-- TOC entry 301 (class 1259 OID 93775)
-- Name: pengadaan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pengadaan (
    id_pengadaan integer NOT NULL,
    tanggal_pengadaan date NOT NULL,
    supplier character varying(100) NOT NULL,
    jenis_pengadaan character varying(100) NOT NULL,
    keterangan text NOT NULL,
    nama_barang character varying(100) NOT NULL,
    deskripsi_barang text NOT NULL,
    harga integer NOT NULL,
    total integer NOT NULL,
    jumlah integer NOT NULL
);


ALTER TABLE public.pengadaan OWNER TO postgres;

--
-- TOC entry 300 (class 1259 OID 93774)
-- Name: pengadaan_id_pengadaan_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pengadaan_id_pengadaan_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.pengadaan_id_pengadaan_seq OWNER TO postgres;

--
-- TOC entry 3942 (class 0 OID 0)
-- Dependencies: 300
-- Name: pengadaan_id_pengadaan_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pengadaan_id_pengadaan_seq OWNED BY public.pengadaan.id_pengadaan;


--
-- TOC entry 303 (class 1259 OID 93786)
-- Name: pengajuan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pengajuan (
    id_pengajuan integer NOT NULL,
    departemen character varying(100) NOT NULL,
    nama_barang character varying(50) NOT NULL,
    jumlah character varying(11) NOT NULL,
    lokasi character varying(50) NOT NULL,
    keperluan text NOT NULL,
    tgl_pinjam timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.pengajuan OWNER TO postgres;

--
-- TOC entry 302 (class 1259 OID 93785)
-- Name: pengajuan_id_pengajuan_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pengajuan_id_pengajuan_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.pengajuan_id_pengajuan_seq OWNER TO postgres;

--
-- TOC entry 3943 (class 0 OID 0)
-- Dependencies: 302
-- Name: pengajuan_id_pengajuan_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pengajuan_id_pengajuan_seq OWNED BY public.pengajuan.id_pengajuan;


--
-- TOC entry 305 (class 1259 OID 93799)
-- Name: pengembalian; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pengembalian (
    id_kembali integer NOT NULL,
    nama_barang character varying(100) NOT NULL,
    tanggal_entry timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    departemen_peminjam character varying(100) NOT NULL,
    jumlah integer NOT NULL,
    tanggal_kembali date NOT NULL,
    deskripsi text NOT NULL
);


ALTER TABLE public.pengembalian OWNER TO postgres;

--
-- TOC entry 304 (class 1259 OID 93798)
-- Name: pengembalian_id_kembali_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pengembalian_id_kembali_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.pengembalian_id_kembali_seq OWNER TO postgres;

--
-- TOC entry 3944 (class 0 OID 0)
-- Dependencies: 304
-- Name: pengembalian_id_kembali_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pengembalian_id_kembali_seq OWNED BY public.pengembalian.id_kembali;


--
-- TOC entry 307 (class 1259 OID 93811)
-- Name: rest; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.rest (
    id integer NOT NULL,
    subject character varying(200) NOT NULL,
    table_name character varying(200) NOT NULL,
    primary_key character varying(200) NOT NULL,
    x_api_key character varying(20) DEFAULT NULL::character varying,
    x_token character varying(20) DEFAULT NULL::character varying
);


ALTER TABLE public.rest OWNER TO postgres;

--
-- TOC entry 309 (class 1259 OID 93822)
-- Name: rest_field; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.rest_field (
    id integer NOT NULL,
    rest_id integer NOT NULL,
    field_name character varying(200) NOT NULL,
    input_type character varying(200) NOT NULL,
    show_column character varying(10) DEFAULT NULL::character varying,
    show_add_api character varying(10) DEFAULT NULL::character varying,
    show_update_api character varying(10) DEFAULT NULL::character varying,
    show_detail_api character varying(10) DEFAULT NULL::character varying
);


ALTER TABLE public.rest_field OWNER TO postgres;

--
-- TOC entry 308 (class 1259 OID 93821)
-- Name: rest_field_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.rest_field_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.rest_field_id_seq OWNER TO postgres;

--
-- TOC entry 3945 (class 0 OID 0)
-- Dependencies: 308
-- Name: rest_field_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.rest_field_id_seq OWNED BY public.rest_field.id;


--
-- TOC entry 311 (class 1259 OID 93833)
-- Name: rest_field_validation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.rest_field_validation (
    id integer NOT NULL,
    rest_field_id integer NOT NULL,
    rest_id integer NOT NULL,
    validation_name character varying(200) NOT NULL,
    validation_value text NOT NULL
);


ALTER TABLE public.rest_field_validation OWNER TO postgres;

--
-- TOC entry 310 (class 1259 OID 93832)
-- Name: rest_field_validation_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.rest_field_validation_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.rest_field_validation_id_seq OWNER TO postgres;

--
-- TOC entry 3946 (class 0 OID 0)
-- Dependencies: 310
-- Name: rest_field_validation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.rest_field_validation_id_seq OWNED BY public.rest_field_validation.id;


--
-- TOC entry 306 (class 1259 OID 93810)
-- Name: rest_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.rest_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.rest_id_seq OWNER TO postgres;

--
-- TOC entry 3947 (class 0 OID 0)
-- Dependencies: 306
-- Name: rest_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.rest_id_seq OWNED BY public.rest.id;


--
-- TOC entry 313 (class 1259 OID 93842)
-- Name: rest_input_type; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.rest_input_type (
    id integer NOT NULL,
    type character varying(200) NOT NULL,
    relation character varying(20) NOT NULL,
    validation_group character varying(200) NOT NULL
);


ALTER TABLE public.rest_input_type OWNER TO postgres;

--
-- TOC entry 312 (class 1259 OID 93841)
-- Name: rest_input_type_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.rest_input_type_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.rest_input_type_id_seq OWNER TO postgres;

--
-- TOC entry 3948 (class 0 OID 0)
-- Dependencies: 312
-- Name: rest_input_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.rest_input_type_id_seq OWNED BY public.rest_input_type.id;


--
-- TOC entry 315 (class 1259 OID 93849)
-- Name: retur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.retur (
    id_retur integer NOT NULL,
    nomor_surat character varying(50) NOT NULL,
    nama_barang character varying(50) NOT NULL,
    jumlah integer NOT NULL,
    penerima_barang character varying(50) NOT NULL,
    berkas character varying(50) NOT NULL,
    deskripsi text NOT NULL
);


ALTER TABLE public.retur OWNER TO postgres;

--
-- TOC entry 314 (class 1259 OID 93848)
-- Name: retur_id_retur_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.retur_id_retur_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.retur_id_retur_seq OWNER TO postgres;

--
-- TOC entry 3949 (class 0 OID 0)
-- Dependencies: 314
-- Name: retur_id_retur_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.retur_id_retur_seq OWNED BY public.retur.id_retur;


--
-- TOC entry 317 (class 1259 OID 93861)
-- Name: ruangan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ruangan (
    id_ruangan integer NOT NULL,
    ruangan character varying(50) NOT NULL,
    deskripsi text NOT NULL
);


ALTER TABLE public.ruangan OWNER TO postgres;

--
-- TOC entry 316 (class 1259 OID 93860)
-- Name: ruangan_id_ruangan_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ruangan_id_ruangan_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.ruangan_id_ruangan_seq OWNER TO postgres;

--
-- TOC entry 3950 (class 0 OID 0)
-- Dependencies: 316
-- Name: ruangan_id_ruangan_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ruangan_id_ruangan_seq OWNED BY public.ruangan.id_ruangan;


--
-- TOC entry 319 (class 1259 OID 93870)
-- Name: supplier; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.supplier (
    id_sup integer NOT NULL,
    nama_supplier character varying(100) NOT NULL,
    alamat_lengkap text NOT NULL,
    no_telp character varying(15) NOT NULL
);


ALTER TABLE public.supplier OWNER TO postgres;

--
-- TOC entry 318 (class 1259 OID 93869)
-- Name: supplier_id_sup_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.supplier_id_sup_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.supplier_id_sup_seq OWNER TO postgres;

--
-- TOC entry 3951 (class 0 OID 0)
-- Dependencies: 318
-- Name: supplier_id_sup_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.supplier_id_sup_seq OWNED BY public.supplier.id_sup;


--
-- TOC entry 3449 (class 2604 OID 93370)
-- Name: aauth_groups id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aauth_groups ALTER COLUMN id SET DEFAULT nextval('public.aauth_groups_id_seq'::regclass);


--
-- TOC entry 3450 (class 2604 OID 93384)
-- Name: aauth_login_attempts id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aauth_login_attempts ALTER COLUMN id SET DEFAULT nextval('public.aauth_login_attempts_id_seq'::regclass);


--
-- TOC entry 3451 (class 2604 OID 93392)
-- Name: aauth_perms id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aauth_perms ALTER COLUMN id SET DEFAULT nextval('public.aauth_perms_id_seq'::regclass);


--
-- TOC entry 3452 (class 2604 OID 93409)
-- Name: aauth_pms id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aauth_pms ALTER COLUMN id SET DEFAULT nextval('public.aauth_pms_id_seq'::regclass);


--
-- TOC entry 3453 (class 2604 OID 93418)
-- Name: aauth_user id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aauth_user ALTER COLUMN id SET DEFAULT nextval('public.aauth_user_id_seq'::regclass);


--
-- TOC entry 3458 (class 2604 OID 93444)
-- Name: aauth_user_variables id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aauth_user_variables ALTER COLUMN id SET DEFAULT nextval('public.aauth_user_variables_id_seq'::regclass);


--
-- TOC entry 3455 (class 2604 OID 93428)
-- Name: aauth_users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aauth_users ALTER COLUMN id SET DEFAULT nextval('public.aauth_users_id_seq'::regclass);


--
-- TOC entry 3459 (class 2604 OID 93453)
-- Name: agama id_agama; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agama ALTER COLUMN id_agama SET DEFAULT nextval('public.agama_id_agama_seq'::regclass);


--
-- TOC entry 3460 (class 2604 OID 93460)
-- Name: barang id_barang; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.barang ALTER COLUMN id_barang SET DEFAULT nextval('public.barang_id_barang_seq'::regclass);


--
-- TOC entry 3461 (class 2604 OID 93469)
-- Name: blog id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.blog ALTER COLUMN id SET DEFAULT nextval('public.blog_id_seq'::regclass);


--
-- TOC entry 3463 (class 2604 OID 93479)
-- Name: blog_category category_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.blog_category ALTER COLUMN category_id SET DEFAULT nextval('public.blog_category_category_id_seq'::regclass);


--
-- TOC entry 3464 (class 2604 OID 93488)
-- Name: captcha captcha_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.captcha ALTER COLUMN captcha_id SET DEFAULT nextval('public.captcha_captcha_id_seq'::regclass);


--
-- TOC entry 3465 (class 2604 OID 93495)
-- Name: cc_options id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cc_options ALTER COLUMN id SET DEFAULT nextval('public.cc_options_id_seq'::regclass);


--
-- TOC entry 3466 (class 2604 OID 93504)
-- Name: cc_session id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cc_session ALTER COLUMN id SET DEFAULT nextval('public.cc_session_id_seq'::regclass);


--
-- TOC entry 3467 (class 2604 OID 93514)
-- Name: crud id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.crud ALTER COLUMN id SET DEFAULT nextval('public.crud_id_seq'::regclass);


--
-- TOC entry 3471 (class 2604 OID 93526)
-- Name: crud_custom_option id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.crud_custom_option ALTER COLUMN id SET DEFAULT nextval('public.crud_custom_option_id_seq'::regclass);


--
-- TOC entry 3472 (class 2604 OID 93535)
-- Name: crud_field id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.crud_field ALTER COLUMN id SET DEFAULT nextval('public.crud_field_id_seq'::regclass);


--
-- TOC entry 3480 (class 2604 OID 93551)
-- Name: crud_field_validation id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.crud_field_validation ALTER COLUMN id SET DEFAULT nextval('public.crud_field_validation_id_seq'::regclass);


--
-- TOC entry 3481 (class 2604 OID 93560)
-- Name: crud_input_type id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.crud_input_type ALTER COLUMN id SET DEFAULT nextval('public.crud_input_type_id_seq'::regclass);


--
-- TOC entry 3482 (class 2604 OID 93567)
-- Name: crud_input_validation id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.crud_input_validation ALTER COLUMN id SET DEFAULT nextval('public.crud_input_validation_id_seq'::regclass);


--
-- TOC entry 3483 (class 2604 OID 93576)
-- Name: departemen id_dep; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.departemen ALTER COLUMN id_dep SET DEFAULT nextval('public.departemen_id_dep_seq'::regclass);


--
-- TOC entry 3484 (class 2604 OID 93585)
-- Name: disposal id_disposal; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.disposal ALTER COLUMN id_disposal SET DEFAULT nextval('public.disposal_id_disposal_seq'::regclass);


--
-- TOC entry 3485 (class 2604 OID 93596)
-- Name: form id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.form ALTER COLUMN id SET DEFAULT nextval('public.form_id_seq'::regclass);


--
-- TOC entry 3486 (class 2604 OID 93605)
-- Name: form_custom_attribute id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.form_custom_attribute ALTER COLUMN id SET DEFAULT nextval('public.form_custom_attribute_id_seq'::regclass);


--
-- TOC entry 3487 (class 2604 OID 93614)
-- Name: form_custom_option id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.form_custom_option ALTER COLUMN id SET DEFAULT nextval('public.form_custom_option_id_seq'::regclass);


--
-- TOC entry 3488 (class 2604 OID 93623)
-- Name: form_field id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.form_field ALTER COLUMN id SET DEFAULT nextval('public.form_field_id_seq'::regclass);


--
-- TOC entry 3494 (class 2604 OID 93637)
-- Name: form_field_validation id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.form_field_validation ALTER COLUMN id SET DEFAULT nextval('public.form_field_validation_id_seq'::regclass);


--
-- TOC entry 3495 (class 2604 OID 93646)
-- Name: form_pengajuan_pinjam_barang id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.form_pengajuan_pinjam_barang ALTER COLUMN id SET DEFAULT nextval('public.form_pengajuan_pinjam_barang_id_seq'::regclass);


--
-- TOC entry 3496 (class 2604 OID 93655)
-- Name: jabatan id_jabatan; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jabatan ALTER COLUMN id_jabatan SET DEFAULT nextval('public.jabatan_id_jabatan_seq'::regclass);


--
-- TOC entry 3497 (class 2604 OID 93662)
-- Name: jenis_pengadaan id_jenis_pendagaan; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jenis_pengadaan ALTER COLUMN id_jenis_pendagaan SET DEFAULT nextval('public.jenis_pengadaan_id_jenis_pendagaan_seq'::regclass);


--
-- TOC entry 3498 (class 2604 OID 93671)
-- Name: karyawan id_karyawan; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.karyawan ALTER COLUMN id_karyawan SET DEFAULT nextval('public.karyawan_id_karyawan_seq'::regclass);


--
-- TOC entry 3499 (class 2604 OID 93678)
-- Name: kategori id_kategori; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kategori ALTER COLUMN id_kategori SET DEFAULT nextval('public.kategori_id_kategori_seq'::regclass);


--
-- TOC entry 3500 (class 2604 OID 93687)
-- Name: keys id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.keys ALTER COLUMN id SET DEFAULT nextval('public.keys_id_seq'::regclass);


--
-- TOC entry 3502 (class 2604 OID 93697)
-- Name: lokasi id_lok; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lokasi ALTER COLUMN id_lok SET DEFAULT nextval('public.lokasi_id_lok_seq'::regclass);


--
-- TOC entry 3503 (class 2604 OID 93705)
-- Name: menu id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menu ALTER COLUMN id SET DEFAULT nextval('public.menu_id_seq'::regclass);


--
-- TOC entry 3509 (class 2604 OID 93722)
-- Name: menu_type id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menu_type ALTER COLUMN id SET DEFAULT nextval('public.menu_type_id_seq'::regclass);


--
-- TOC entry 3510 (class 2604 OID 93735)
-- Name: mutasi id_mutasi; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mutasi ALTER COLUMN id_mutasi SET DEFAULT nextval('public.mutasi_id_mutasi_seq'::regclass);


--
-- TOC entry 3511 (class 2604 OID 93746)
-- Name: page id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.page ALTER COLUMN id SET DEFAULT nextval('public.page_id_seq'::regclass);


--
-- TOC entry 3515 (class 2604 OID 93758)
-- Name: page_block_element id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.page_block_element ALTER COLUMN id SET DEFAULT nextval('public.page_block_element_id_seq'::regclass);


--
-- TOC entry 3516 (class 2604 OID 93767)
-- Name: penempatan id_penempatan; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.penempatan ALTER COLUMN id_penempatan SET DEFAULT nextval('public.penempatan_id_penempatan_seq'::regclass);


--
-- TOC entry 3517 (class 2604 OID 93778)
-- Name: pengadaan id_pengadaan; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengadaan ALTER COLUMN id_pengadaan SET DEFAULT nextval('public.pengadaan_id_pengadaan_seq'::regclass);


--
-- TOC entry 3518 (class 2604 OID 93789)
-- Name: pengajuan id_pengajuan; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengajuan ALTER COLUMN id_pengajuan SET DEFAULT nextval('public.pengajuan_id_pengajuan_seq'::regclass);


--
-- TOC entry 3520 (class 2604 OID 93802)
-- Name: pengembalian id_kembali; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengembalian ALTER COLUMN id_kembali SET DEFAULT nextval('public.pengembalian_id_kembali_seq'::regclass);


--
-- TOC entry 3522 (class 2604 OID 93814)
-- Name: rest id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rest ALTER COLUMN id SET DEFAULT nextval('public.rest_id_seq'::regclass);


--
-- TOC entry 3525 (class 2604 OID 93825)
-- Name: rest_field id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rest_field ALTER COLUMN id SET DEFAULT nextval('public.rest_field_id_seq'::regclass);


--
-- TOC entry 3530 (class 2604 OID 93836)
-- Name: rest_field_validation id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rest_field_validation ALTER COLUMN id SET DEFAULT nextval('public.rest_field_validation_id_seq'::regclass);


--
-- TOC entry 3531 (class 2604 OID 93845)
-- Name: rest_input_type id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rest_input_type ALTER COLUMN id SET DEFAULT nextval('public.rest_input_type_id_seq'::regclass);


--
-- TOC entry 3532 (class 2604 OID 93852)
-- Name: retur id_retur; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.retur ALTER COLUMN id_retur SET DEFAULT nextval('public.retur_id_retur_seq'::regclass);


--
-- TOC entry 3533 (class 2604 OID 93864)
-- Name: ruangan id_ruangan; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ruangan ALTER COLUMN id_ruangan SET DEFAULT nextval('public.ruangan_id_ruangan_seq'::regclass);


--
-- TOC entry 3534 (class 2604 OID 93873)
-- Name: supplier id_sup; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.supplier ALTER COLUMN id_sup SET DEFAULT nextval('public.supplier_id_sup_seq'::regclass);


--
-- TOC entry 3793 (class 0 OID 93375)
-- Dependencies: 216
-- Data for Name: aauth_group_to_group; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3792 (class 0 OID 93367)
-- Dependencies: 215
-- Data for Name: aauth_groups; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.aauth_groups VALUES (1, 'Admin', 'Akun Tidak Memiliki Semua Akses Menu');
INSERT INTO public.aauth_groups VALUES (2, 'Staff', 'Akun Memiliki Akses Menu Terbatas');
INSERT INTO public.aauth_groups VALUES (3, 'Guest', 'Akun Tidak Memiliki Akses Menu');


--
-- TOC entry 3795 (class 0 OID 93381)
-- Dependencies: 218
-- Data for Name: aauth_login_attempts; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3798 (class 0 OID 93397)
-- Dependencies: 221
-- Data for Name: aauth_perm_to_group; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.aauth_perm_to_group VALUES (116, 0);
INSERT INTO public.aauth_perm_to_group VALUES (117, 0);
INSERT INTO public.aauth_perm_to_group VALUES (1, 5);
INSERT INTO public.aauth_perm_to_group VALUES (139, 5);
INSERT INTO public.aauth_perm_to_group VALUES (150, 5);
INSERT INTO public.aauth_perm_to_group VALUES (151, 5);
INSERT INTO public.aauth_perm_to_group VALUES (194, 5);
INSERT INTO public.aauth_perm_to_group VALUES (195, 5);
INSERT INTO public.aauth_perm_to_group VALUES (206, 5);
INSERT INTO public.aauth_perm_to_group VALUES (207, 5);
INSERT INTO public.aauth_perm_to_group VALUES (246, 5);
INSERT INTO public.aauth_perm_to_group VALUES (20, 5);
INSERT INTO public.aauth_perm_to_group VALUES (21, 5);
INSERT INTO public.aauth_perm_to_group VALUES (22, 5);
INSERT INTO public.aauth_perm_to_group VALUES (189, 5);
INSERT INTO public.aauth_perm_to_group VALUES (191, 5);
INSERT INTO public.aauth_perm_to_group VALUES (193, 5);
INSERT INTO public.aauth_perm_to_group VALUES (256, 5);
INSERT INTO public.aauth_perm_to_group VALUES (258, 5);
INSERT INTO public.aauth_perm_to_group VALUES (259, 5);
INSERT INTO public.aauth_perm_to_group VALUES (261, 5);
INSERT INTO public.aauth_perm_to_group VALUES (263, 5);
INSERT INTO public.aauth_perm_to_group VALUES (264, 5);
INSERT INTO public.aauth_perm_to_group VALUES (266, 5);
INSERT INTO public.aauth_perm_to_group VALUES (268, 5);
INSERT INTO public.aauth_perm_to_group VALUES (1, 6);
INSERT INTO public.aauth_perm_to_group VALUES (139, 6);
INSERT INTO public.aauth_perm_to_group VALUES (239, 6);
INSERT INTO public.aauth_perm_to_group VALUES (278, 6);
INSERT INTO public.aauth_perm_to_group VALUES (280, 6);
INSERT INTO public.aauth_perm_to_group VALUES (1, 1);
INSERT INTO public.aauth_perm_to_group VALUES (2, 1);
INSERT INTO public.aauth_perm_to_group VALUES (3, 1);
INSERT INTO public.aauth_perm_to_group VALUES (4, 1);
INSERT INTO public.aauth_perm_to_group VALUES (5, 1);
INSERT INTO public.aauth_perm_to_group VALUES (6, 1);
INSERT INTO public.aauth_perm_to_group VALUES (7, 1);
INSERT INTO public.aauth_perm_to_group VALUES (8, 1);
INSERT INTO public.aauth_perm_to_group VALUES (9, 1);
INSERT INTO public.aauth_perm_to_group VALUES (10, 1);
INSERT INTO public.aauth_perm_to_group VALUES (11, 1);
INSERT INTO public.aauth_perm_to_group VALUES (12, 1);
INSERT INTO public.aauth_perm_to_group VALUES (13, 1);
INSERT INTO public.aauth_perm_to_group VALUES (14, 1);
INSERT INTO public.aauth_perm_to_group VALUES (65, 1);
INSERT INTO public.aauth_perm_to_group VALUES (66, 1);
INSERT INTO public.aauth_perm_to_group VALUES (67, 1);
INSERT INTO public.aauth_perm_to_group VALUES (68, 1);
INSERT INTO public.aauth_perm_to_group VALUES (69, 1);
INSERT INTO public.aauth_perm_to_group VALUES (70, 1);
INSERT INTO public.aauth_perm_to_group VALUES (79, 1);
INSERT INTO public.aauth_perm_to_group VALUES (80, 1);
INSERT INTO public.aauth_perm_to_group VALUES (81, 1);
INSERT INTO public.aauth_perm_to_group VALUES (82, 1);
INSERT INTO public.aauth_perm_to_group VALUES (113, 1);
INSERT INTO public.aauth_perm_to_group VALUES (114, 1);
INSERT INTO public.aauth_perm_to_group VALUES (115, 1);
INSERT INTO public.aauth_perm_to_group VALUES (116, 1);
INSERT INTO public.aauth_perm_to_group VALUES (117, 1);
INSERT INTO public.aauth_perm_to_group VALUES (118, 1);
INSERT INTO public.aauth_perm_to_group VALUES (129, 1);
INSERT INTO public.aauth_perm_to_group VALUES (130, 1);
INSERT INTO public.aauth_perm_to_group VALUES (131, 1);
INSERT INTO public.aauth_perm_to_group VALUES (136, 1);
INSERT INTO public.aauth_perm_to_group VALUES (137, 1);
INSERT INTO public.aauth_perm_to_group VALUES (138, 1);
INSERT INTO public.aauth_perm_to_group VALUES (139, 1);
INSERT INTO public.aauth_perm_to_group VALUES (150, 1);
INSERT INTO public.aauth_perm_to_group VALUES (151, 1);
INSERT INTO public.aauth_perm_to_group VALUES (152, 1);
INSERT INTO public.aauth_perm_to_group VALUES (194, 1);
INSERT INTO public.aauth_perm_to_group VALUES (195, 1);
INSERT INTO public.aauth_perm_to_group VALUES (206, 1);
INSERT INTO public.aauth_perm_to_group VALUES (207, 1);
INSERT INTO public.aauth_perm_to_group VALUES (208, 1);
INSERT INTO public.aauth_perm_to_group VALUES (214, 1);
INSERT INTO public.aauth_perm_to_group VALUES (225, 1);
INSERT INTO public.aauth_perm_to_group VALUES (226, 1);
INSERT INTO public.aauth_perm_to_group VALUES (232, 1);
INSERT INTO public.aauth_perm_to_group VALUES (233, 1);
INSERT INTO public.aauth_perm_to_group VALUES (239, 1);
INSERT INTO public.aauth_perm_to_group VALUES (240, 1);
INSERT INTO public.aauth_perm_to_group VALUES (246, 1);
INSERT INTO public.aauth_perm_to_group VALUES (252, 1);
INSERT INTO public.aauth_perm_to_group VALUES (253, 1);
INSERT INTO public.aauth_perm_to_group VALUES (274, 1);
INSERT INTO public.aauth_perm_to_group VALUES (275, 1);
INSERT INTO public.aauth_perm_to_group VALUES (15, 1);
INSERT INTO public.aauth_perm_to_group VALUES (16, 1);
INSERT INTO public.aauth_perm_to_group VALUES (17, 1);
INSERT INTO public.aauth_perm_to_group VALUES (18, 1);
INSERT INTO public.aauth_perm_to_group VALUES (19, 1);
INSERT INTO public.aauth_perm_to_group VALUES (20, 1);
INSERT INTO public.aauth_perm_to_group VALUES (21, 1);
INSERT INTO public.aauth_perm_to_group VALUES (22, 1);
INSERT INTO public.aauth_perm_to_group VALUES (23, 1);
INSERT INTO public.aauth_perm_to_group VALUES (24, 1);
INSERT INTO public.aauth_perm_to_group VALUES (25, 1);
INSERT INTO public.aauth_perm_to_group VALUES (26, 1);
INSERT INTO public.aauth_perm_to_group VALUES (27, 1);
INSERT INTO public.aauth_perm_to_group VALUES (28, 1);
INSERT INTO public.aauth_perm_to_group VALUES (29, 1);
INSERT INTO public.aauth_perm_to_group VALUES (30, 1);
INSERT INTO public.aauth_perm_to_group VALUES (124, 1);
INSERT INTO public.aauth_perm_to_group VALUES (125, 1);
INSERT INTO public.aauth_perm_to_group VALUES (126, 1);
INSERT INTO public.aauth_perm_to_group VALUES (127, 1);
INSERT INTO public.aauth_perm_to_group VALUES (128, 1);
INSERT INTO public.aauth_perm_to_group VALUES (31, 1);
INSERT INTO public.aauth_perm_to_group VALUES (32, 1);
INSERT INTO public.aauth_perm_to_group VALUES (33, 1);
INSERT INTO public.aauth_perm_to_group VALUES (34, 1);
INSERT INTO public.aauth_perm_to_group VALUES (35, 1);
INSERT INTO public.aauth_perm_to_group VALUES (36, 1);
INSERT INTO public.aauth_perm_to_group VALUES (37, 1);
INSERT INTO public.aauth_perm_to_group VALUES (132, 1);
INSERT INTO public.aauth_perm_to_group VALUES (133, 1);
INSERT INTO public.aauth_perm_to_group VALUES (134, 1);
INSERT INTO public.aauth_perm_to_group VALUES (135, 1);
INSERT INTO public.aauth_perm_to_group VALUES (38, 1);
INSERT INTO public.aauth_perm_to_group VALUES (39, 1);
INSERT INTO public.aauth_perm_to_group VALUES (40, 1);
INSERT INTO public.aauth_perm_to_group VALUES (41, 1);
INSERT INTO public.aauth_perm_to_group VALUES (42, 1);
INSERT INTO public.aauth_perm_to_group VALUES (43, 1);
INSERT INTO public.aauth_perm_to_group VALUES (44, 1);
INSERT INTO public.aauth_perm_to_group VALUES (45, 1);
INSERT INTO public.aauth_perm_to_group VALUES (46, 1);
INSERT INTO public.aauth_perm_to_group VALUES (47, 1);
INSERT INTO public.aauth_perm_to_group VALUES (48, 1);
INSERT INTO public.aauth_perm_to_group VALUES (49, 1);
INSERT INTO public.aauth_perm_to_group VALUES (50, 1);
INSERT INTO public.aauth_perm_to_group VALUES (51, 1);
INSERT INTO public.aauth_perm_to_group VALUES (52, 1);
INSERT INTO public.aauth_perm_to_group VALUES (53, 1);
INSERT INTO public.aauth_perm_to_group VALUES (54, 1);
INSERT INTO public.aauth_perm_to_group VALUES (55, 1);
INSERT INTO public.aauth_perm_to_group VALUES (56, 1);
INSERT INTO public.aauth_perm_to_group VALUES (57, 1);
INSERT INTO public.aauth_perm_to_group VALUES (58, 1);
INSERT INTO public.aauth_perm_to_group VALUES (59, 1);
INSERT INTO public.aauth_perm_to_group VALUES (60, 1);
INSERT INTO public.aauth_perm_to_group VALUES (61, 1);
INSERT INTO public.aauth_perm_to_group VALUES (62, 1);
INSERT INTO public.aauth_perm_to_group VALUES (63, 1);
INSERT INTO public.aauth_perm_to_group VALUES (64, 1);
INSERT INTO public.aauth_perm_to_group VALUES (71, 1);
INSERT INTO public.aauth_perm_to_group VALUES (72, 1);
INSERT INTO public.aauth_perm_to_group VALUES (73, 1);
INSERT INTO public.aauth_perm_to_group VALUES (74, 1);
INSERT INTO public.aauth_perm_to_group VALUES (75, 1);
INSERT INTO public.aauth_perm_to_group VALUES (76, 1);
INSERT INTO public.aauth_perm_to_group VALUES (77, 1);
INSERT INTO public.aauth_perm_to_group VALUES (78, 1);
INSERT INTO public.aauth_perm_to_group VALUES (88, 1);
INSERT INTO public.aauth_perm_to_group VALUES (89, 1);
INSERT INTO public.aauth_perm_to_group VALUES (90, 1);
INSERT INTO public.aauth_perm_to_group VALUES (91, 1);
INSERT INTO public.aauth_perm_to_group VALUES (92, 1);
INSERT INTO public.aauth_perm_to_group VALUES (189, 1);
INSERT INTO public.aauth_perm_to_group VALUES (190, 1);
INSERT INTO public.aauth_perm_to_group VALUES (191, 1);
INSERT INTO public.aauth_perm_to_group VALUES (192, 1);
INSERT INTO public.aauth_perm_to_group VALUES (193, 1);
INSERT INTO public.aauth_perm_to_group VALUES (196, 1);
INSERT INTO public.aauth_perm_to_group VALUES (197, 1);
INSERT INTO public.aauth_perm_to_group VALUES (198, 1);
INSERT INTO public.aauth_perm_to_group VALUES (199, 1);
INSERT INTO public.aauth_perm_to_group VALUES (200, 1);
INSERT INTO public.aauth_perm_to_group VALUES (209, 1);
INSERT INTO public.aauth_perm_to_group VALUES (210, 1);
INSERT INTO public.aauth_perm_to_group VALUES (211, 1);
INSERT INTO public.aauth_perm_to_group VALUES (212, 1);
INSERT INTO public.aauth_perm_to_group VALUES (213, 1);
INSERT INTO public.aauth_perm_to_group VALUES (215, 1);
INSERT INTO public.aauth_perm_to_group VALUES (216, 1);
INSERT INTO public.aauth_perm_to_group VALUES (217, 1);
INSERT INTO public.aauth_perm_to_group VALUES (218, 1);
INSERT INTO public.aauth_perm_to_group VALUES (219, 1);
INSERT INTO public.aauth_perm_to_group VALUES (220, 1);
INSERT INTO public.aauth_perm_to_group VALUES (221, 1);
INSERT INTO public.aauth_perm_to_group VALUES (222, 1);
INSERT INTO public.aauth_perm_to_group VALUES (223, 1);
INSERT INTO public.aauth_perm_to_group VALUES (224, 1);
INSERT INTO public.aauth_perm_to_group VALUES (227, 1);
INSERT INTO public.aauth_perm_to_group VALUES (228, 1);
INSERT INTO public.aauth_perm_to_group VALUES (229, 1);
INSERT INTO public.aauth_perm_to_group VALUES (230, 1);
INSERT INTO public.aauth_perm_to_group VALUES (231, 1);
INSERT INTO public.aauth_perm_to_group VALUES (234, 1);
INSERT INTO public.aauth_perm_to_group VALUES (235, 1);
INSERT INTO public.aauth_perm_to_group VALUES (236, 1);
INSERT INTO public.aauth_perm_to_group VALUES (237, 1);
INSERT INTO public.aauth_perm_to_group VALUES (238, 1);
INSERT INTO public.aauth_perm_to_group VALUES (247, 1);
INSERT INTO public.aauth_perm_to_group VALUES (248, 1);
INSERT INTO public.aauth_perm_to_group VALUES (249, 1);
INSERT INTO public.aauth_perm_to_group VALUES (250, 1);
INSERT INTO public.aauth_perm_to_group VALUES (251, 1);
INSERT INTO public.aauth_perm_to_group VALUES (254, 1);
INSERT INTO public.aauth_perm_to_group VALUES (255, 1);
INSERT INTO public.aauth_perm_to_group VALUES (256, 1);
INSERT INTO public.aauth_perm_to_group VALUES (257, 1);
INSERT INTO public.aauth_perm_to_group VALUES (258, 1);
INSERT INTO public.aauth_perm_to_group VALUES (259, 1);
INSERT INTO public.aauth_perm_to_group VALUES (260, 1);
INSERT INTO public.aauth_perm_to_group VALUES (261, 1);
INSERT INTO public.aauth_perm_to_group VALUES (262, 1);
INSERT INTO public.aauth_perm_to_group VALUES (263, 1);
INSERT INTO public.aauth_perm_to_group VALUES (264, 1);
INSERT INTO public.aauth_perm_to_group VALUES (265, 1);
INSERT INTO public.aauth_perm_to_group VALUES (266, 1);
INSERT INTO public.aauth_perm_to_group VALUES (267, 1);
INSERT INTO public.aauth_perm_to_group VALUES (268, 1);
INSERT INTO public.aauth_perm_to_group VALUES (276, 1);
INSERT INTO public.aauth_perm_to_group VALUES (277, 1);
INSERT INTO public.aauth_perm_to_group VALUES (278, 1);
INSERT INTO public.aauth_perm_to_group VALUES (279, 1);
INSERT INTO public.aauth_perm_to_group VALUES (280, 1);
INSERT INTO public.aauth_perm_to_group VALUES (286, 1);
INSERT INTO public.aauth_perm_to_group VALUES (287, 1);
INSERT INTO public.aauth_perm_to_group VALUES (288, 1);
INSERT INTO public.aauth_perm_to_group VALUES (289, 1);
INSERT INTO public.aauth_perm_to_group VALUES (290, 1);
INSERT INTO public.aauth_perm_to_group VALUES (1, 3);
INSERT INTO public.aauth_perm_to_group VALUES (1, 2);
INSERT INTO public.aauth_perm_to_group VALUES (131, 2);
INSERT INTO public.aauth_perm_to_group VALUES (136, 2);
INSERT INTO public.aauth_perm_to_group VALUES (137, 2);
INSERT INTO public.aauth_perm_to_group VALUES (138, 2);
INSERT INTO public.aauth_perm_to_group VALUES (139, 2);
INSERT INTO public.aauth_perm_to_group VALUES (150, 2);
INSERT INTO public.aauth_perm_to_group VALUES (151, 2);
INSERT INTO public.aauth_perm_to_group VALUES (152, 2);
INSERT INTO public.aauth_perm_to_group VALUES (194, 2);
INSERT INTO public.aauth_perm_to_group VALUES (195, 2);
INSERT INTO public.aauth_perm_to_group VALUES (206, 2);
INSERT INTO public.aauth_perm_to_group VALUES (207, 2);
INSERT INTO public.aauth_perm_to_group VALUES (208, 2);
INSERT INTO public.aauth_perm_to_group VALUES (214, 2);
INSERT INTO public.aauth_perm_to_group VALUES (225, 2);
INSERT INTO public.aauth_perm_to_group VALUES (226, 2);
INSERT INTO public.aauth_perm_to_group VALUES (232, 2);
INSERT INTO public.aauth_perm_to_group VALUES (233, 2);
INSERT INTO public.aauth_perm_to_group VALUES (239, 2);
INSERT INTO public.aauth_perm_to_group VALUES (240, 2);
INSERT INTO public.aauth_perm_to_group VALUES (246, 2);
INSERT INTO public.aauth_perm_to_group VALUES (252, 2);
INSERT INTO public.aauth_perm_to_group VALUES (253, 2);
INSERT INTO public.aauth_perm_to_group VALUES (274, 2);
INSERT INTO public.aauth_perm_to_group VALUES (275, 2);
INSERT INTO public.aauth_perm_to_group VALUES (19, 2);
INSERT INTO public.aauth_perm_to_group VALUES (20, 2);
INSERT INTO public.aauth_perm_to_group VALUES (21, 2);
INSERT INTO public.aauth_perm_to_group VALUES (22, 2);
INSERT INTO public.aauth_perm_to_group VALUES (132, 2);
INSERT INTO public.aauth_perm_to_group VALUES (133, 2);
INSERT INTO public.aauth_perm_to_group VALUES (134, 2);
INSERT INTO public.aauth_perm_to_group VALUES (135, 2);
INSERT INTO public.aauth_perm_to_group VALUES (44, 2);
INSERT INTO public.aauth_perm_to_group VALUES (45, 2);
INSERT INTO public.aauth_perm_to_group VALUES (46, 2);
INSERT INTO public.aauth_perm_to_group VALUES (47, 2);
INSERT INTO public.aauth_perm_to_group VALUES (48, 2);
INSERT INTO public.aauth_perm_to_group VALUES (49, 2);
INSERT INTO public.aauth_perm_to_group VALUES (56, 2);
INSERT INTO public.aauth_perm_to_group VALUES (57, 2);
INSERT INTO public.aauth_perm_to_group VALUES (58, 2);
INSERT INTO public.aauth_perm_to_group VALUES (59, 2);
INSERT INTO public.aauth_perm_to_group VALUES (60, 2);
INSERT INTO public.aauth_perm_to_group VALUES (61, 2);
INSERT INTO public.aauth_perm_to_group VALUES (71, 2);
INSERT INTO public.aauth_perm_to_group VALUES (72, 2);
INSERT INTO public.aauth_perm_to_group VALUES (73, 2);
INSERT INTO public.aauth_perm_to_group VALUES (74, 2);
INSERT INTO public.aauth_perm_to_group VALUES (75, 2);
INSERT INTO public.aauth_perm_to_group VALUES (76, 2);
INSERT INTO public.aauth_perm_to_group VALUES (189, 2);
INSERT INTO public.aauth_perm_to_group VALUES (190, 2);
INSERT INTO public.aauth_perm_to_group VALUES (191, 2);
INSERT INTO public.aauth_perm_to_group VALUES (192, 2);
INSERT INTO public.aauth_perm_to_group VALUES (193, 2);
INSERT INTO public.aauth_perm_to_group VALUES (247, 2);
INSERT INTO public.aauth_perm_to_group VALUES (248, 2);
INSERT INTO public.aauth_perm_to_group VALUES (249, 2);
INSERT INTO public.aauth_perm_to_group VALUES (250, 2);
INSERT INTO public.aauth_perm_to_group VALUES (251, 2);
INSERT INTO public.aauth_perm_to_group VALUES (254, 2);
INSERT INTO public.aauth_perm_to_group VALUES (255, 2);
INSERT INTO public.aauth_perm_to_group VALUES (256, 2);
INSERT INTO public.aauth_perm_to_group VALUES (257, 2);
INSERT INTO public.aauth_perm_to_group VALUES (258, 2);
INSERT INTO public.aauth_perm_to_group VALUES (259, 2);
INSERT INTO public.aauth_perm_to_group VALUES (260, 2);
INSERT INTO public.aauth_perm_to_group VALUES (261, 2);
INSERT INTO public.aauth_perm_to_group VALUES (262, 2);
INSERT INTO public.aauth_perm_to_group VALUES (263, 2);
INSERT INTO public.aauth_perm_to_group VALUES (264, 2);
INSERT INTO public.aauth_perm_to_group VALUES (265, 2);
INSERT INTO public.aauth_perm_to_group VALUES (266, 2);
INSERT INTO public.aauth_perm_to_group VALUES (267, 2);
INSERT INTO public.aauth_perm_to_group VALUES (268, 2);
INSERT INTO public.aauth_perm_to_group VALUES (276, 2);
INSERT INTO public.aauth_perm_to_group VALUES (277, 2);
INSERT INTO public.aauth_perm_to_group VALUES (278, 2);
INSERT INTO public.aauth_perm_to_group VALUES (279, 2);
INSERT INTO public.aauth_perm_to_group VALUES (280, 2);
INSERT INTO public.aauth_perm_to_group VALUES (286, 2);
INSERT INTO public.aauth_perm_to_group VALUES (287, 2);
INSERT INTO public.aauth_perm_to_group VALUES (288, 2);
INSERT INTO public.aauth_perm_to_group VALUES (289, 2);
INSERT INTO public.aauth_perm_to_group VALUES (290, 2);


--
-- TOC entry 3799 (class 0 OID 93400)
-- Dependencies: 222
-- Data for Name: aauth_perm_to_user; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3797 (class 0 OID 93389)
-- Dependencies: 220
-- Data for Name: aauth_perms; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.aauth_perms VALUES (1, 'menu_dashboard', NULL);
INSERT INTO public.aauth_perms VALUES (2, 'menu_crud_builder', NULL);
INSERT INTO public.aauth_perms VALUES (3, 'menu_api_builder', NULL);
INSERT INTO public.aauth_perms VALUES (4, 'menu_page_builder', NULL);
INSERT INTO public.aauth_perms VALUES (5, 'menu_form_builder', NULL);
INSERT INTO public.aauth_perms VALUES (6, 'menu_menu', NULL);
INSERT INTO public.aauth_perms VALUES (7, 'menu_auth', NULL);
INSERT INTO public.aauth_perms VALUES (8, 'menu_user', NULL);
INSERT INTO public.aauth_perms VALUES (9, 'menu_group', NULL);
INSERT INTO public.aauth_perms VALUES (10, 'menu_akses', NULL);
INSERT INTO public.aauth_perms VALUES (11, 'menu_permission', NULL);
INSERT INTO public.aauth_perms VALUES (12, 'menu_api_documentation', NULL);
INSERT INTO public.aauth_perms VALUES (13, 'menu_web_documentation', NULL);
INSERT INTO public.aauth_perms VALUES (14, 'menu_settings', NULL);
INSERT INTO public.aauth_perms VALUES (15, 'user_list', NULL);
INSERT INTO public.aauth_perms VALUES (16, 'user_update_status', NULL);
INSERT INTO public.aauth_perms VALUES (17, 'user_export', NULL);
INSERT INTO public.aauth_perms VALUES (18, 'user_add', NULL);
INSERT INTO public.aauth_perms VALUES (19, 'user_update', NULL);
INSERT INTO public.aauth_perms VALUES (20, 'user_update_profile', NULL);
INSERT INTO public.aauth_perms VALUES (21, 'user_update_password', NULL);
INSERT INTO public.aauth_perms VALUES (22, 'user_profile', NULL);
INSERT INTO public.aauth_perms VALUES (23, 'user_view', NULL);
INSERT INTO public.aauth_perms VALUES (24, 'user_delete', NULL);
INSERT INTO public.aauth_perms VALUES (25, 'blog_list', NULL);
INSERT INTO public.aauth_perms VALUES (26, 'blog_export', NULL);
INSERT INTO public.aauth_perms VALUES (27, 'blog_add', NULL);
INSERT INTO public.aauth_perms VALUES (28, 'blog_update', NULL);
INSERT INTO public.aauth_perms VALUES (29, 'blog_view', NULL);
INSERT INTO public.aauth_perms VALUES (30, 'blog_delete', NULL);
INSERT INTO public.aauth_perms VALUES (31, 'form_list', NULL);
INSERT INTO public.aauth_perms VALUES (32, 'form_export', NULL);
INSERT INTO public.aauth_perms VALUES (33, 'form_add', NULL);
INSERT INTO public.aauth_perms VALUES (34, 'form_update', NULL);
INSERT INTO public.aauth_perms VALUES (35, 'form_view', NULL);
INSERT INTO public.aauth_perms VALUES (36, 'form_manage', NULL);
INSERT INTO public.aauth_perms VALUES (37, 'form_delete', NULL);
INSERT INTO public.aauth_perms VALUES (38, 'crud_list', NULL);
INSERT INTO public.aauth_perms VALUES (39, 'crud_export', NULL);
INSERT INTO public.aauth_perms VALUES (40, 'crud_add', NULL);
INSERT INTO public.aauth_perms VALUES (41, 'crud_update', NULL);
INSERT INTO public.aauth_perms VALUES (42, 'crud_view', NULL);
INSERT INTO public.aauth_perms VALUES (43, 'crud_delete', NULL);
INSERT INTO public.aauth_perms VALUES (44, 'rest_list', NULL);
INSERT INTO public.aauth_perms VALUES (45, 'rest_export', NULL);
INSERT INTO public.aauth_perms VALUES (46, 'rest_add', NULL);
INSERT INTO public.aauth_perms VALUES (47, 'rest_update', NULL);
INSERT INTO public.aauth_perms VALUES (48, 'rest_view', NULL);
INSERT INTO public.aauth_perms VALUES (49, 'rest_delete', NULL);
INSERT INTO public.aauth_perms VALUES (50, 'group_list', NULL);
INSERT INTO public.aauth_perms VALUES (51, 'group_export', NULL);
INSERT INTO public.aauth_perms VALUES (52, 'group_add', NULL);
INSERT INTO public.aauth_perms VALUES (53, 'group_update', NULL);
INSERT INTO public.aauth_perms VALUES (54, 'group_view', NULL);
INSERT INTO public.aauth_perms VALUES (55, 'group_delete', NULL);
INSERT INTO public.aauth_perms VALUES (56, 'permission_list', NULL);
INSERT INTO public.aauth_perms VALUES (57, 'permission_export', NULL);
INSERT INTO public.aauth_perms VALUES (58, 'permission_add', NULL);
INSERT INTO public.aauth_perms VALUES (59, 'permission_update', NULL);
INSERT INTO public.aauth_perms VALUES (60, 'permission_view', NULL);
INSERT INTO public.aauth_perms VALUES (61, 'permission_delete', NULL);
INSERT INTO public.aauth_perms VALUES (62, 'akses_list', NULL);
INSERT INTO public.aauth_perms VALUES (63, 'akses_add', NULL);
INSERT INTO public.aauth_perms VALUES (64, 'akses_update', NULL);
INSERT INTO public.aauth_perms VALUES (65, 'menu_list', NULL);
INSERT INTO public.aauth_perms VALUES (66, 'menu_add', NULL);
INSERT INTO public.aauth_perms VALUES (67, 'menu_update', NULL);
INSERT INTO public.aauth_perms VALUES (68, 'menu_delete', NULL);
INSERT INTO public.aauth_perms VALUES (69, 'menu_save_ordering', NULL);
INSERT INTO public.aauth_perms VALUES (70, 'menu_type_add', NULL);
INSERT INTO public.aauth_perms VALUES (71, 'page_list', NULL);
INSERT INTO public.aauth_perms VALUES (72, 'page_export', NULL);
INSERT INTO public.aauth_perms VALUES (73, 'page_add', NULL);
INSERT INTO public.aauth_perms VALUES (74, 'page_update', NULL);
INSERT INTO public.aauth_perms VALUES (75, 'page_view', NULL);
INSERT INTO public.aauth_perms VALUES (76, 'page_delete', NULL);
INSERT INTO public.aauth_perms VALUES (77, 'setting', NULL);
INSERT INTO public.aauth_perms VALUES (78, 'setting_update', NULL);
INSERT INTO public.aauth_perms VALUES (79, 'menu_builder', '');
INSERT INTO public.aauth_perms VALUES (80, 'menu_akun', '');
INSERT INTO public.aauth_perms VALUES (81, 'menu_other', '');
INSERT INTO public.aauth_perms VALUES (82, 'menu_kofigurasi', '');
INSERT INTO public.aauth_perms VALUES (88, 'jabatan_add', '');
INSERT INTO public.aauth_perms VALUES (89, 'jabatan_update', '');
INSERT INTO public.aauth_perms VALUES (90, 'jabatan_view', '');
INSERT INTO public.aauth_perms VALUES (91, 'jabatan_delete', '');
INSERT INTO public.aauth_perms VALUES (92, 'jabatan_list', '');
INSERT INTO public.aauth_perms VALUES (113, 'menu_data_utama', '');
INSERT INTO public.aauth_perms VALUES (114, 'menu_karyawan', '');
INSERT INTO public.aauth_perms VALUES (115, 'menu_agama', '');
INSERT INTO public.aauth_perms VALUES (116, 'menu_barang', '');
INSERT INTO public.aauth_perms VALUES (117, 'menu_jabatan', '');
INSERT INTO public.aauth_perms VALUES (118, 'menu_ruangan', '');
INSERT INTO public.aauth_perms VALUES (124, 'blog_category_add', '');
INSERT INTO public.aauth_perms VALUES (125, 'blog_category_update', '');
INSERT INTO public.aauth_perms VALUES (126, 'blog_category_view', '');
INSERT INTO public.aauth_perms VALUES (127, 'blog_category_delete', '');
INSERT INTO public.aauth_perms VALUES (128, 'blog_category_list', '');
INSERT INTO public.aauth_perms VALUES (129, 'menu_blog', '');
INSERT INTO public.aauth_perms VALUES (130, 'menu_creat_blog', '');
INSERT INTO public.aauth_perms VALUES (131, 'menu_category', '');
INSERT INTO public.aauth_perms VALUES (132, 'form_pengajuan_pinjam_barang_add', '');
INSERT INTO public.aauth_perms VALUES (133, 'form_pengajuan_pinjam_barang_update', '');
INSERT INTO public.aauth_perms VALUES (134, 'form_pengajuan_pinjam_barang_view', '');
INSERT INTO public.aauth_perms VALUES (135, 'form_pengajuan_pinjam_barang_delete', '');
INSERT INTO public.aauth_perms VALUES (136, 'menu_home', '');
INSERT INTO public.aauth_perms VALUES (137, 'menu_pengajuan', '');
INSERT INTO public.aauth_perms VALUES (138, 'menu_input_pengajuan', '');
INSERT INTO public.aauth_perms VALUES (139, 'menu_view', '');
INSERT INTO public.aauth_perms VALUES (150, 'menu_pengembalian', '');
INSERT INTO public.aauth_perms VALUES (151, 'menu_input_barang_kembali', '');
INSERT INTO public.aauth_perms VALUES (152, 'menu_data_peminjam', '');
INSERT INTO public.aauth_perms VALUES (182, 'disposal_add', '');
INSERT INTO public.aauth_perms VALUES (183, 'disposal_update', '');
INSERT INTO public.aauth_perms VALUES (184, 'disposal_view', '');
INSERT INTO public.aauth_perms VALUES (185, 'disposal_delete', '');
INSERT INTO public.aauth_perms VALUES (186, 'disposal_list', '');
INSERT INTO public.aauth_perms VALUES (187, 'menu_disposal', '');
INSERT INTO public.aauth_perms VALUES (188, 'menu_input_disposal', '');
INSERT INTO public.aauth_perms VALUES (189, 'retur_add', '');
INSERT INTO public.aauth_perms VALUES (190, 'retur_update', '');
INSERT INTO public.aauth_perms VALUES (191, 'retur_view', '');
INSERT INTO public.aauth_perms VALUES (192, 'retur_delete', '');
INSERT INTO public.aauth_perms VALUES (193, 'retur_list', '');
INSERT INTO public.aauth_perms VALUES (194, 'menu_retur', '');
INSERT INTO public.aauth_perms VALUES (195, 'menu_input_retur', '');
INSERT INTO public.aauth_perms VALUES (196, 'karyawan_add', '');
INSERT INTO public.aauth_perms VALUES (197, 'karyawan_update', '');
INSERT INTO public.aauth_perms VALUES (198, 'karyawan_view', '');
INSERT INTO public.aauth_perms VALUES (199, 'karyawan_delete', '');
INSERT INTO public.aauth_perms VALUES (200, 'karyawan_list', '');
INSERT INTO public.aauth_perms VALUES (206, 'menu_peminjaman', '');
INSERT INTO public.aauth_perms VALUES (207, 'menu_input_peminjaman', '');
INSERT INTO public.aauth_perms VALUES (208, 'menu_crud', '');
INSERT INTO public.aauth_perms VALUES (209, 'departemen_add', '');
INSERT INTO public.aauth_perms VALUES (210, 'departemen_update', '');
INSERT INTO public.aauth_perms VALUES (211, 'departemen_view', '');
INSERT INTO public.aauth_perms VALUES (212, 'departemen_delete', '');
INSERT INTO public.aauth_perms VALUES (213, 'departemen_list', '');
INSERT INTO public.aauth_perms VALUES (214, 'menu_departemen', '');
INSERT INTO public.aauth_perms VALUES (215, 'supplier_add', '');
INSERT INTO public.aauth_perms VALUES (216, 'supplier_update', '');
INSERT INTO public.aauth_perms VALUES (217, 'supplier_view', '');
INSERT INTO public.aauth_perms VALUES (218, 'supplier_delete', '');
INSERT INTO public.aauth_perms VALUES (219, 'supplier_list', '');
INSERT INTO public.aauth_perms VALUES (220, 'lokasi_add', '');
INSERT INTO public.aauth_perms VALUES (221, 'lokasi_update', '');
INSERT INTO public.aauth_perms VALUES (222, 'lokasi_view', '');
INSERT INTO public.aauth_perms VALUES (223, 'lokasi_delete', '');
INSERT INTO public.aauth_perms VALUES (224, 'lokasi_list', '');
INSERT INTO public.aauth_perms VALUES (225, 'menu_supplier', '');
INSERT INTO public.aauth_perms VALUES (226, 'menu_lokasi', '');
INSERT INTO public.aauth_perms VALUES (227, 'jenis_pengadaan_add', '');
INSERT INTO public.aauth_perms VALUES (228, 'jenis_pengadaan_update', '');
INSERT INTO public.aauth_perms VALUES (229, 'jenis_pengadaan_view', '');
INSERT INTO public.aauth_perms VALUES (230, 'jenis_pengadaan_delete', '');
INSERT INTO public.aauth_perms VALUES (231, 'jenis_pengadaan_list', '');
INSERT INTO public.aauth_perms VALUES (232, 'menu_jenis_pengadaan', '');
INSERT INTO public.aauth_perms VALUES (233, 'menu_kategori', '');
INSERT INTO public.aauth_perms VALUES (234, 'kategori_add', '');
INSERT INTO public.aauth_perms VALUES (235, 'kategori_update', '');
INSERT INTO public.aauth_perms VALUES (236, 'kategori_view', '');
INSERT INTO public.aauth_perms VALUES (237, 'kategori_delete', '');
INSERT INTO public.aauth_perms VALUES (238, 'kategori_list', '');
INSERT INTO public.aauth_perms VALUES (239, 'menu_pengadaan', '');
INSERT INTO public.aauth_perms VALUES (240, 'menu_input_pengadaan', '');
INSERT INTO public.aauth_perms VALUES (246, 'menu_data_barang', '');
INSERT INTO public.aauth_perms VALUES (247, 'penempatan_add', '');
INSERT INTO public.aauth_perms VALUES (248, 'penempatan_update', '');
INSERT INTO public.aauth_perms VALUES (249, 'penempatan_view', '');
INSERT INTO public.aauth_perms VALUES (250, 'penempatan_delete', '');
INSERT INTO public.aauth_perms VALUES (251, 'penempatan_list', '');
INSERT INTO public.aauth_perms VALUES (252, 'menu_penempatan', '');
INSERT INTO public.aauth_perms VALUES (253, 'menu_input_penempatan', '');
INSERT INTO public.aauth_perms VALUES (254, 'barang_add', '');
INSERT INTO public.aauth_perms VALUES (255, 'barang_update', '');
INSERT INTO public.aauth_perms VALUES (256, 'barang_view', '');
INSERT INTO public.aauth_perms VALUES (257, 'barang_delete', '');
INSERT INTO public.aauth_perms VALUES (258, 'barang_list', '');
INSERT INTO public.aauth_perms VALUES (259, 'pengajuan_add', '');
INSERT INTO public.aauth_perms VALUES (260, 'pengajuan_update', '');
INSERT INTO public.aauth_perms VALUES (261, 'pengajuan_view', '');
INSERT INTO public.aauth_perms VALUES (262, 'pengajuan_delete', '');
INSERT INTO public.aauth_perms VALUES (263, 'pengajuan_list', '');
INSERT INTO public.aauth_perms VALUES (264, 'pengembalian_add', '');
INSERT INTO public.aauth_perms VALUES (265, 'pengembalian_update', '');
INSERT INTO public.aauth_perms VALUES (266, 'pengembalian_view', '');
INSERT INTO public.aauth_perms VALUES (267, 'pengembalian_delete', '');
INSERT INTO public.aauth_perms VALUES (268, 'pengembalian_list', '');
INSERT INTO public.aauth_perms VALUES (274, 'menu_mutasi', '');
INSERT INTO public.aauth_perms VALUES (275, 'menu_input_mutasi', '');
INSERT INTO public.aauth_perms VALUES (276, 'pengadaan_add', '');
INSERT INTO public.aauth_perms VALUES (277, 'pengadaan_update', '');
INSERT INTO public.aauth_perms VALUES (278, 'pengadaan_view', '');
INSERT INTO public.aauth_perms VALUES (279, 'pengadaan_delete', '');
INSERT INTO public.aauth_perms VALUES (280, 'pengadaan_list', '');
INSERT INTO public.aauth_perms VALUES (286, 'mutasi_add', '');
INSERT INTO public.aauth_perms VALUES (287, 'mutasi_update', '');
INSERT INTO public.aauth_perms VALUES (288, 'mutasi_view', '');
INSERT INTO public.aauth_perms VALUES (289, 'mutasi_delete', '');
INSERT INTO public.aauth_perms VALUES (290, 'mutasi_list', '');
INSERT INTO public.aauth_perms VALUES (291, 'menu_informasi', '');


--
-- TOC entry 3801 (class 0 OID 93406)
-- Dependencies: 224
-- Data for Name: aauth_pms; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3803 (class 0 OID 93415)
-- Dependencies: 226
-- Data for Name: aauth_user; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3806 (class 0 OID 93435)
-- Dependencies: 229
-- Data for Name: aauth_user_to_group; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.aauth_user_to_group VALUES (1, 1);
INSERT INTO public.aauth_user_to_group VALUES (2, 2);
INSERT INTO public.aauth_user_to_group VALUES (3, 3);
INSERT INTO public.aauth_user_to_group VALUES (4, 3);


--
-- TOC entry 3808 (class 0 OID 93441)
-- Dependencies: 231
-- Data for Name: aauth_user_variables; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3805 (class 0 OID 93425)
-- Dependencies: 228
-- Data for Name: aauth_users; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.aauth_users VALUES (1, '', '3783a5063e48003fd64eb62d2f06125430b4d63e62aeda455564932654079c80', 'admin', 'Administrator', '', 0, '2022-09-08 00:00:00', '2022-09-08 00:00:00', '2022-09-08 00:00:00', NULL, '2022-09-08 00:00:00', '6egq9NoGxYKnb21w', NULL, NULL, '::1');
INSERT INTO public.aauth_users VALUES (2, '', '966184da7770dec434b72a7e46f70fea2a226edbd8a6f4e843bcfe1fd366f804', 'staff', 'Staff', '', 0, '2022-09-08 00:00:00', '2022-09-08 00:00:00', '2022-09-08 00:00:00', NULL, '2022-09-08 00:00:00', '', NULL, NULL, '::1');
INSERT INTO public.aauth_users VALUES (3, '', '80122e8b1bf742d2f44cd20e3e4b1e71e43984b87c74bec68ec227c9103d41e5', 'guest', 'Guest', '', 0, '2022-09-08 00:00:00', '2022-09-08 00:00:00', '2022-09-08 00:00:00', NULL, '2022-09-08 00:00:00', '', NULL, NULL, '::1');


--
-- TOC entry 3810 (class 0 OID 93450)
-- Dependencies: 233
-- Data for Name: agama; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3812 (class 0 OID 93457)
-- Dependencies: 235
-- Data for Name: barang; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3814 (class 0 OID 93466)
-- Dependencies: 237
-- Data for Name: blog; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3816 (class 0 OID 93476)
-- Dependencies: 239
-- Data for Name: blog_category; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3818 (class 0 OID 93485)
-- Dependencies: 241
-- Data for Name: captcha; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.captcha VALUES (47, 1687389895, '::1', 'J4FO');
INSERT INTO public.captcha VALUES (48, 1687389909, '::1', 'H54R');
INSERT INTO public.captcha VALUES (49, 1687390628, '::1', '2G3Z');


--
-- TOC entry 3820 (class 0 OID 93492)
-- Dependencies: 243
-- Data for Name: cc_options; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.cc_options VALUES (1, 'active_theme', 'cicool');
INSERT INTO public.cc_options VALUES (2, 'favicon', 'default.png');
INSERT INTO public.cc_options VALUES (3, 'site_name', 'Sistem Inventaris');
INSERT INTO public.cc_options VALUES (4, 'email', 'email@yuuki0.net');
INSERT INTO public.cc_options VALUES (5, 'author', 'Yuukio Fuyu');
INSERT INTO public.cc_options VALUES (6, 'site_description', 'Sistem Pengelola Data Inventaris Barang');
INSERT INTO public.cc_options VALUES (7, 'keywords', 'Aplikasi Inventaris Barang\r\nManajemen Inventaris Barang\r\nSistem Inventaris Barang\r\nSoftware Inventaris Barang\r\nAplikasi Pengelolaan Stok Barang\r\nSistem Manajemen Inventaris\r\nAplikasi Tracking Barang\r\nInventarisasi Barang Digital\r\nAplikasi Pencatatan Inventaris\r\nAlat Inventaris Barang Online');
INSERT INTO public.cc_options VALUES (8, 'landing_page_id', 'default');


--
-- TOC entry 3822 (class 0 OID 93501)
-- Dependencies: 245
-- Data for Name: cc_session; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3824 (class 0 OID 93511)
-- Dependencies: 247
-- Data for Name: crud; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.crud VALUES (2, 'Jabatan', 'Jabatan', 'jabatan', 'id_jabatan', 'yes', 'yes', 'yes');
INSERT INTO public.crud VALUES (8, 'Blog', 'Blog', 'blog', 'id', 'yes', 'yes', 'yes');
INSERT INTO public.crud VALUES (9, 'Blog Category', 'Blog Category', 'blog_category', 'category_id', 'yes', 'yes', 'yes');
INSERT INTO public.crud VALUES (18, 'Disposal', 'Disposal', 'disposal', 'id_disposal', 'yes', 'yes', 'yes');
INSERT INTO public.crud VALUES (19, 'Retur', 'Retur', 'retur', 'id_retur', 'yes', 'yes', 'yes');
INSERT INTO public.crud VALUES (20, 'Data Peminjam', 'Data Peminjam', 'karyawan', 'id_karyawan', 'yes', 'yes', 'yes');
INSERT INTO public.crud VALUES (22, 'Departemen', 'Departemen', 'departemen', 'id_dep', 'yes', 'yes', 'yes');
INSERT INTO public.crud VALUES (23, 'Supplier', 'Supplier', 'supplier', 'id_sup', 'yes', 'yes', 'yes');
INSERT INTO public.crud VALUES (24, 'Lokasi', 'Lokasi', 'lokasi', 'id_lok', 'yes', 'yes', 'yes');
INSERT INTO public.crud VALUES (25, 'Jenis Pengadaan', 'Jenis Pengadaan', 'jenis_pengadaan', 'id_jenis_pendagaan', 'yes', 'yes', 'yes');
INSERT INTO public.crud VALUES (26, 'Kategori', 'Kategori', 'kategori', 'id_kategori', 'yes', 'yes', 'yes');
INSERT INTO public.crud VALUES (28, 'Penempatan', 'Penempatan', 'penempatan', 'id_penempatan', 'yes', 'yes', 'yes');
INSERT INTO public.crud VALUES (29, 'Barang', 'Barang', 'barang', 'id_barang', 'yes', 'yes', 'yes');
INSERT INTO public.crud VALUES (30, 'Peminjaman', 'Peminjaman', 'pengajuan', 'id_pengajuan', 'yes', 'yes', 'yes');
INSERT INTO public.crud VALUES (31, 'Pengembalian', 'Pengembalian', 'pengembalian', 'id_kembali', 'yes', 'yes', 'yes');
INSERT INTO public.crud VALUES (33, 'Pengadaan', 'Pengadaan', 'pengadaan', 'id_pengadaan', 'yes', 'yes', 'yes');
INSERT INTO public.crud VALUES (35, 'Mutasi', 'Mutasi', 'mutasi', 'id_mutasi', 'yes', 'yes', 'yes');


--
-- TOC entry 3826 (class 0 OID 93523)
-- Dependencies: 249
-- Data for Name: crud_custom_option; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.crud_custom_option VALUES (11, 175, 4, 'Laki-laki', 'Laki-laki');
INSERT INTO public.crud_custom_option VALUES (12, 175, 4, 'Perempuan', 'Perempuan');


--
-- TOC entry 3828 (class 0 OID 93532)
-- Dependencies: 251
-- Data for Name: crud_field; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.crud_field VALUES (1, 1, 'id_agama', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (2, 1, 'agama', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (3, 2, 'id_jabatan', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (4, 2, 'jabatan', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (15, 5, 'id_barang', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (16, 5, 'nama_barang', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (17, 5, 'deskripsi', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (27, 6, 'id_pengajuan', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (28, 6, 'nama_pemohon', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'karyawan', 'nama_lengkap', 'nama_lengkap');
INSERT INTO public.crud_field VALUES (29, 6, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'barang', 'nama_barang', 'nama_barang');
INSERT INTO public.crud_field VALUES (30, 6, 'jumlah_barang', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', '');
INSERT INTO public.crud_field VALUES (31, 6, 'keperluan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 5, '', '', '');
INSERT INTO public.crud_field VALUES (32, 6, 'ruangan', 'select', 'yes', 'yes', 'yes', 'yes', 6, 'ruangan', 'ruangan', 'ruangan');
INSERT INTO public.crud_field VALUES (33, 6, 'tanggal_pinjam', 'date', '', 'yes', 'yes', 'yes', 7, '', '', '');
INSERT INTO public.crud_field VALUES (34, 6, 'tanggal_kembali', 'date', 'yes', 'yes', 'yes', 'yes', 8, '', '', '');
INSERT INTO public.crud_field VALUES (35, 6, 'tanggal_input', 'timestamp', 'yes', 'yes', 'yes', 'yes', 9, '', '', '');
INSERT INTO public.crud_field VALUES (36, 7, 'id_barang', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (37, 7, 'nama_barang', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (38, 7, 'stok', 'number', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (39, 7, 'deskripsi', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 4, '', '', '');
INSERT INTO public.crud_field VALUES (40, 3, 'id_ruangan', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (41, 3, 'ruangan', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (42, 3, 'deskripsi', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (63, 9, 'category_id', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (64, 9, 'category_name', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (65, 9, 'category_desc', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (66, 8, 'id', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (67, 8, 'title', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (68, 8, 'content', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (69, 8, 'image', 'file', 'yes', 'yes', 'yes', 'yes', 4, '', '', '');
INSERT INTO public.crud_field VALUES (70, 8, 'category', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'blog_category', 'category_name', 'category_name');
INSERT INTO public.crud_field VALUES (71, 8, 'created_at', 'datetime', 'yes', '', '', 'yes', 6, '', '', '');
INSERT INTO public.crud_field VALUES (72, 10, 'id_barang', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (73, 10, 'nama_barang', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (74, 10, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (75, 10, 'deskripsi', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 4, '', '', '');
INSERT INTO public.crud_field VALUES (111, 12, 'id_pengajuan', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (112, 12, 'nik', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'karyawan', 'nik', 'nik');
INSERT INTO public.crud_field VALUES (113, 12, 'nama_pemohon', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'karyawan', 'nama_lengkap', 'nama_lengkap');
INSERT INTO public.crud_field VALUES (114, 12, 'no_telp', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', '');
INSERT INTO public.crud_field VALUES (115, 12, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'barang', 'nama_barang', 'nama_barang');
INSERT INTO public.crud_field VALUES (116, 12, 'jumlah_barang', 'number', 'yes', 'yes', 'yes', 'yes', 6, '', '', '');
INSERT INTO public.crud_field VALUES (117, 12, 'ruangan', 'select', 'yes', 'yes', 'yes', 'yes', 7, 'ruangan', 'ruangan', 'ruangan');
INSERT INTO public.crud_field VALUES (118, 12, 'keperluan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 8, '', '', '');
INSERT INTO public.crud_field VALUES (119, 12, 'tgl_pinjam', 'timestamp', 'yes', 'yes', 'yes', 'yes', 9, '', '', '');
INSERT INTO public.crud_field VALUES (120, 12, 'tanggal_kembali', 'date', 'yes', 'yes', 'yes', 'yes', 10, '', '', '');
INSERT INTO public.crud_field VALUES (121, 13, 'id_pengajuan', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (122, 13, 'nik', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'karyawan', 'nik', 'nik');
INSERT INTO public.crud_field VALUES (123, 13, 'nama_pemohon', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (124, 13, 'no_telp', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', '');
INSERT INTO public.crud_field VALUES (125, 13, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'barang', 'nama_barang', 'nama_barang');
INSERT INTO public.crud_field VALUES (126, 13, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 6, '', '', '');
INSERT INTO public.crud_field VALUES (127, 13, 'ruangan', 'select', 'yes', 'yes', 'yes', 'yes', 7, 'ruangan', 'ruangan', 'ruangan');
INSERT INTO public.crud_field VALUES (128, 13, 'keperluan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 8, '', '', '');
INSERT INTO public.crud_field VALUES (129, 13, 'tgl_pinjam', 'timestamp', 'yes', 'yes', 'yes', 'yes', 9, '', '', '');
INSERT INTO public.crud_field VALUES (130, 13, 'tanggal_kembali', 'date', 'yes', 'yes', 'yes', 'yes', 10, '', '', '');
INSERT INTO public.crud_field VALUES (131, 14, 'id_pengajuan', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (132, 14, 'nik', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'karyawan', 'nik', 'nik');
INSERT INTO public.crud_field VALUES (133, 14, 'nama_lengkap', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (134, 14, 'no_telp', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', '');
INSERT INTO public.crud_field VALUES (135, 14, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'barang', 'nama_barang', 'nama_barang');
INSERT INTO public.crud_field VALUES (136, 14, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 6, '', '', '');
INSERT INTO public.crud_field VALUES (137, 14, 'ruangan', 'select', 'yes', 'yes', 'yes', 'yes', 7, 'ruangan', 'ruangan', 'ruangan');
INSERT INTO public.crud_field VALUES (138, 14, 'keperluan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 8, '', '', '');
INSERT INTO public.crud_field VALUES (139, 14, 'tgl_pinjam', 'timestamp', 'yes', 'yes', 'yes', 'yes', 9, '', '', '');
INSERT INTO public.crud_field VALUES (140, 14, 'tanggal_kembali', 'date', 'yes', 'yes', 'yes', 'yes', 10, '', '', '');
INSERT INTO public.crud_field VALUES (148, 15, 'id_pengajuan', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (149, 15, 'nama_lengkap', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'karyawan', 'nama_lengkap', 'nama_lengkap');
INSERT INTO public.crud_field VALUES (150, 15, 'no_telp', 'number', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (151, 15, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'barang', 'nama_barang', 'nama_barang');
INSERT INTO public.crud_field VALUES (152, 15, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 5, '', '', '');
INSERT INTO public.crud_field VALUES (153, 15, 'ruangan', 'select', 'yes', 'yes', 'yes', 'yes', 6, 'ruangan', 'ruangan', 'ruangan');
INSERT INTO public.crud_field VALUES (154, 15, 'keperluan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 7, '', '', '');
INSERT INTO public.crud_field VALUES (155, 15, 'tgl_pinjam', 'timestamp', 'yes', 'yes', 'yes', 'yes', 8, '', '', '');
INSERT INTO public.crud_field VALUES (156, 15, 'tanggal_kembali', 'date', 'yes', 'yes', 'yes', 'yes', 9, '', '', '');
INSERT INTO public.crud_field VALUES (157, 11, 'id_kembali', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (158, 11, 'tanggal_entry', 'timestamp', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (159, 11, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'pengajuan', 'nama_barang', 'nama_barang');
INSERT INTO public.crud_field VALUES (160, 11, 'nama_peminjam', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'pengajuan', 'nama_lengkap', 'nama_lengkap');
INSERT INTO public.crud_field VALUES (161, 11, 'jumlah', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'pengajuan', 'jumlah', 'jumlah');
INSERT INTO public.crud_field VALUES (162, 11, 'tanggal_kembali', 'date', 'yes', 'yes', 'yes', 'yes', 6, '', '', '');
INSERT INTO public.crud_field VALUES (163, 11, 'deskripsi', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 7, '', '', '');
INSERT INTO public.crud_field VALUES (164, 16, 'id_barang', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (165, 16, 'nama_barang', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (166, 16, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (167, 16, 'gambar', 'file', 'yes', 'yes', 'yes', 'yes', 4, '', '', '');
INSERT INTO public.crud_field VALUES (168, 16, 'deskripsi', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 5, '', '', '');
INSERT INTO public.crud_field VALUES (169, 4, 'id_karyawan', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (170, 4, 'nama_lengkap', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (171, 4, 'nik', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (172, 4, 'jabatan', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'jabatan', 'jabatan', 'jabatan');
INSERT INTO public.crud_field VALUES (173, 4, 'alamat', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 5, '', '', '');
INSERT INTO public.crud_field VALUES (174, 4, 'agama', 'input', 'yes', 'yes', 'yes', 'yes', 6, '', '', '');
INSERT INTO public.crud_field VALUES (175, 4, 'jenis_kelamin', 'custom_option', 'yes', 'yes', 'yes', 'yes', 7, '', '', '');
INSERT INTO public.crud_field VALUES (180, 17, 'id_karyawan', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (181, 17, 'nama_lengkap', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (182, 17, 'nik', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (183, 17, 'jabatan', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'jabatan', 'jabatan', 'jabatan');
INSERT INTO public.crud_field VALUES (184, 18, 'id_barang', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (185, 18, 'nama_barang', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (186, 18, 'tipe_barang', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (187, 18, 'serial_number', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', '');
INSERT INTO public.crud_field VALUES (188, 18, 'nomor_barang', 'input', 'yes', 'yes', 'yes', 'yes', 5, '', '', '');
INSERT INTO public.crud_field VALUES (189, 18, 'tahun', 'year', 'yes', 'yes', 'yes', 'yes', 6, '', '', '');
INSERT INTO public.crud_field VALUES (190, 18, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 7, '', '', '');
INSERT INTO public.crud_field VALUES (191, 18, 'gambar', 'file', 'yes', 'yes', 'yes', 'yes', 8, '', '', '');
INSERT INTO public.crud_field VALUES (192, 18, 'deskripsi', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 9, '', '', '');
INSERT INTO public.crud_field VALUES (200, 20, 'id_karyawan', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (201, 20, 'nama_lengkap', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (202, 20, 'telp', 'number', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (203, 20, 'nik', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', '');
INSERT INTO public.crud_field VALUES (204, 20, 'jabatan', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'jabatan', 'jabatan', 'jabatan');
INSERT INTO public.crud_field VALUES (205, 21, 'id_pengajuan', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (206, 21, 'nama_lengkap', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'karyawan', 'nama_lengkap', 'nama_lengkap');
INSERT INTO public.crud_field VALUES (207, 21, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'barang', 'nama_barang', 'nama_barang');
INSERT INTO public.crud_field VALUES (208, 21, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', '');
INSERT INTO public.crud_field VALUES (209, 21, 'ruangan', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'ruangan', 'ruangan', 'ruangan');
INSERT INTO public.crud_field VALUES (210, 21, 'keperluan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 6, '', '', '');
INSERT INTO public.crud_field VALUES (211, 21, 'tgl_pinjam', 'timestamp', 'yes', 'yes', 'yes', 'yes', 7, '', '', '');
INSERT INTO public.crud_field VALUES (212, 22, 'id_dep', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (213, 22, 'nama_departemen', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (214, 22, 'keterangan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (215, 23, 'id_sup', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (216, 23, 'nama_supplier', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (217, 23, 'alamat_lengkap', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (218, 23, 'no_telp', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', '');
INSERT INTO public.crud_field VALUES (219, 24, 'id_lok', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (220, 24, 'nama_lokasi', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (221, 24, 'departemen', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'departemen', 'nama_departemen', 'nama_departemen');
INSERT INTO public.crud_field VALUES (222, 25, 'id_jenis_pendagaan', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (223, 25, 'jenis_pengadaan', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (224, 25, 'keterangan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (225, 26, 'id_kategori', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (226, 26, 'katerogi', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (227, 26, 'keterangan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (237, 27, 'id_pengadaan', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (238, 27, 'tanggal_pengadaan', 'date', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (239, 27, 'supplier', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'supplier', 'nama_supplier', 'nama_supplier');
INSERT INTO public.crud_field VALUES (240, 27, 'jenis_pengadaan', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'jenis_pengadaan', 'jenis_pengadaan', 'jenis_pengadaan');
INSERT INTO public.crud_field VALUES (241, 27, 'keterangan', 'editor_wysiwyg', '', 'yes', 'yes', 'yes', 5, '', '', '');
INSERT INTO public.crud_field VALUES (242, 27, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 6, 'barang', 'nama_barang', 'nama_barang');
INSERT INTO public.crud_field VALUES (243, 27, 'deskripsi_barang', 'editor_wysiwyg', '', 'yes', 'yes', 'yes', 7, '', '', '');
INSERT INTO public.crud_field VALUES (244, 27, 'harga', 'number', 'yes', 'yes', 'yes', 'yes', 8, '', '', '');
INSERT INTO public.crud_field VALUES (245, 27, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 9, '', '', '');
INSERT INTO public.crud_field VALUES (261, 29, 'id_barang', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (262, 29, 'nama_barang', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (263, 29, 'merek', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (264, 29, 'kategori', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'kategori', 'katerogi', 'katerogi');
INSERT INTO public.crud_field VALUES (265, 29, 'jumlah', 'number', 'yes', '', '', 'yes', 5, '', '', '');
INSERT INTO public.crud_field VALUES (266, 29, 'satuan', 'input', 'yes', 'yes', 'yes', 'yes', 6, '', '', '');
INSERT INTO public.crud_field VALUES (267, 29, 'gambar', 'file', 'yes', 'yes', 'yes', 'yes', 7, '', '', '');
INSERT INTO public.crud_field VALUES (268, 29, 'keterangan', 'editor_wysiwyg', '', 'yes', 'yes', 'yes', 8, '', '', '');
INSERT INTO public.crud_field VALUES (275, 19, 'id_disposal', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (276, 19, 'id_retur', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (277, 19, 'nomor_surat', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (278, 19, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'barang', 'nama_barang', 'nama_barang');
INSERT INTO public.crud_field VALUES (279, 19, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', '');
INSERT INTO public.crud_field VALUES (280, 19, 'penerima_barang', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'departemen', 'nama_departemen', 'nama_departemen');
INSERT INTO public.crud_field VALUES (281, 19, 'berkas', 'file', 'yes', 'yes', 'yes', 'yes', 6, '', '', '');
INSERT INTO public.crud_field VALUES (282, 19, 'deskripsi', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 7, '', '', '');
INSERT INTO public.crud_field VALUES (290, 31, 'id_kembali', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (291, 31, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'barang', 'nama_barang', 'nama_barang');
INSERT INTO public.crud_field VALUES (292, 31, 'tanggal_entry', 'timestamp', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (293, 31, 'departemen_peminjam', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'departemen', 'nama_departemen', 'nama_departemen');
INSERT INTO public.crud_field VALUES (294, 31, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 5, '', '', '');
INSERT INTO public.crud_field VALUES (295, 31, 'tanggal_kembali', 'date', 'yes', 'yes', 'yes', 'yes', 6, '', '', '');
INSERT INTO public.crud_field VALUES (296, 31, 'deskripsi', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 7, '', '', '');
INSERT INTO public.crud_field VALUES (297, 30, 'id_pengajuan', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (298, 30, 'departemen', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'departemen', 'nama_departemen', 'nama_departemen');
INSERT INTO public.crud_field VALUES (299, 30, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'barang', 'nama_barang', 'nama_barang');
INSERT INTO public.crud_field VALUES (300, 30, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', '');
INSERT INTO public.crud_field VALUES (301, 30, 'lokasi', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'lokasi', 'nama_lokasi', 'nama_lokasi');
INSERT INTO public.crud_field VALUES (302, 30, 'keperluan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 6, '', '', '');
INSERT INTO public.crud_field VALUES (303, 30, 'tgl_pinjam', 'timestamp', 'yes', 'yes', 'yes', 'yes', 7, '', '', '');
INSERT INTO public.crud_field VALUES (304, 32, 'id_mutasi', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (305, 32, 'tanggal_mutasi', 'date', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (306, 32, 'keterangan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (307, 32, 'departemen', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'departemen', 'nama_departemen', 'nama_departemen');
INSERT INTO public.crud_field VALUES (308, 32, 'lokasi', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'lokasi', 'nama_lokasi', 'nama_lokasi');
INSERT INTO public.crud_field VALUES (309, 32, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 6, 'barang', 'nama_barang', 'nama_barang');
INSERT INTO public.crud_field VALUES (350, 33, 'id_pengadaan', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (351, 33, 'tanggal_pengadaan', 'date', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (352, 33, 'supplier', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'supplier', 'nama_supplier', 'nama_supplier');
INSERT INTO public.crud_field VALUES (353, 33, 'jenis_pengadaan', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'jenis_pengadaan', 'jenis_pengadaan', 'jenis_pengadaan');
INSERT INTO public.crud_field VALUES (354, 33, 'keterangan', 'editor_wysiwyg', '', 'yes', 'yes', 'yes', 5, '', '', '');
INSERT INTO public.crud_field VALUES (355, 33, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 6, 'barang', 'nama_barang', 'nama_barang');
INSERT INTO public.crud_field VALUES (356, 33, 'deskripsi_barang', 'editor_wysiwyg', '', 'yes', 'yes', 'yes', 7, '', '', '');
INSERT INTO public.crud_field VALUES (357, 33, 'harga', 'number', 'yes', 'yes', 'yes', 'yes', 8, '', '', '');
INSERT INTO public.crud_field VALUES (358, 33, 'total', 'number', 'yes', '', '', 'yes', 9, '', '', '');
INSERT INTO public.crud_field VALUES (359, 33, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 10, '', '', '');
INSERT INTO public.crud_field VALUES (374, 34, 'id_mutasi', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (375, 34, 'cari_id_penempatan', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'penempatan', 'lokasi', 'id_penempatan');
INSERT INTO public.crud_field VALUES (376, 34, 'tanggal_mutasi', 'date', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (377, 34, 'keterangan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 4, '', '', '');
INSERT INTO public.crud_field VALUES (378, 34, 'departemen', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'departemen', 'nama_departemen', 'nama_departemen');
INSERT INTO public.crud_field VALUES (379, 34, 'lokasi', 'select', 'yes', 'yes', 'yes', 'yes', 6, 'lokasi', 'nama_lokasi', 'nama_lokasi');
INSERT INTO public.crud_field VALUES (380, 34, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 7, 'barang', 'nama_barang', 'nama_barang');
INSERT INTO public.crud_field VALUES (381, 35, 'id_mutasi', 'number', '', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (382, 35, 'id_penempatan', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'penempatan', 'lokasi', 'id_penempatan');
INSERT INTO public.crud_field VALUES (383, 35, 'tanggal_mutasi', 'date', 'yes', 'yes', 'yes', 'yes', 3, '', '', '');
INSERT INTO public.crud_field VALUES (384, 35, 'keterangan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 4, '', '', '');
INSERT INTO public.crud_field VALUES (385, 35, 'departemen', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'departemen', 'nama_departemen', 'nama_departemen');
INSERT INTO public.crud_field VALUES (386, 35, 'lokasi', 'select', 'yes', 'yes', 'yes', 'yes', 6, 'lokasi', 'nama_lokasi', 'nama_lokasi');
INSERT INTO public.crud_field VALUES (387, 35, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 7, 'barang', 'nama_barang', 'nama_barang');
INSERT INTO public.crud_field VALUES (388, 28, 'id_penempatan', 'number', 'yes', '', '', 'yes', 1, '', '', '');
INSERT INTO public.crud_field VALUES (389, 28, 'tanggal_penempatan', 'date', 'yes', 'yes', 'yes', 'yes', 2, '', '', '');
INSERT INTO public.crud_field VALUES (390, 28, 'departemen', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'departemen', 'nama_departemen', 'nama_departemen');
INSERT INTO public.crud_field VALUES (391, 28, 'lokasi', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'lokasi', 'nama_lokasi', 'nama_lokasi');
INSERT INTO public.crud_field VALUES (392, 28, 'keterangan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 5, '', '', '');
INSERT INTO public.crud_field VALUES (393, 28, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 6, 'barang', 'nama_barang', 'nama_barang');
INSERT INTO public.crud_field VALUES (394, 28, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 7, '', '', '');


--
-- TOC entry 3830 (class 0 OID 93548)
-- Dependencies: 253
-- Data for Name: crud_field_validation; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.crud_field_validation VALUES (1, 2, 1, 'required', '');
INSERT INTO public.crud_field_validation VALUES (2, 2, 1, 'max_length', '10');
INSERT INTO public.crud_field_validation VALUES (3, 4, 2, 'required', '');
INSERT INTO public.crud_field_validation VALUES (4, 4, 2, 'max_length', '50');
INSERT INTO public.crud_field_validation VALUES (19, 16, 5, 'required', '');
INSERT INTO public.crud_field_validation VALUES (20, 16, 5, 'max_length', '50');
INSERT INTO public.crud_field_validation VALUES (21, 17, 5, 'required', '');
INSERT INTO public.crud_field_validation VALUES (34, 28, 6, 'required', '');
INSERT INTO public.crud_field_validation VALUES (35, 28, 6, 'max_length', '50');
INSERT INTO public.crud_field_validation VALUES (36, 29, 6, 'required', '');
INSERT INTO public.crud_field_validation VALUES (37, 29, 6, 'max_length', '50');
INSERT INTO public.crud_field_validation VALUES (38, 30, 6, 'required', '');
INSERT INTO public.crud_field_validation VALUES (39, 30, 6, 'max_length', '11');
INSERT INTO public.crud_field_validation VALUES (40, 31, 6, 'required', '');
INSERT INTO public.crud_field_validation VALUES (41, 32, 6, 'required', '');
INSERT INTO public.crud_field_validation VALUES (42, 32, 6, 'max_length', '50');
INSERT INTO public.crud_field_validation VALUES (43, 33, 6, 'required', '');
INSERT INTO public.crud_field_validation VALUES (44, 34, 6, 'required', '');
INSERT INTO public.crud_field_validation VALUES (45, 37, 7, 'required', '');
INSERT INTO public.crud_field_validation VALUES (46, 37, 7, 'max_length', '50');
INSERT INTO public.crud_field_validation VALUES (47, 38, 7, 'required', '');
INSERT INTO public.crud_field_validation VALUES (48, 38, 7, 'max_length', '11');
INSERT INTO public.crud_field_validation VALUES (49, 39, 7, 'required', '');
INSERT INTO public.crud_field_validation VALUES (50, 41, 3, 'required', '');
INSERT INTO public.crud_field_validation VALUES (51, 41, 3, 'max_length', '50');
INSERT INTO public.crud_field_validation VALUES (80, 64, 9, 'required', '');
INSERT INTO public.crud_field_validation VALUES (81, 64, 9, 'max_length', '200');
INSERT INTO public.crud_field_validation VALUES (82, 67, 8, 'required', '');
INSERT INTO public.crud_field_validation VALUES (83, 67, 8, 'max_length', '200');
INSERT INTO public.crud_field_validation VALUES (84, 68, 8, 'required', '');
INSERT INTO public.crud_field_validation VALUES (85, 69, 8, 'allowed_extension', 'jpg,jpeg,png');
INSERT INTO public.crud_field_validation VALUES (86, 69, 8, 'max_size', '2000');
INSERT INTO public.crud_field_validation VALUES (87, 70, 8, 'required', '');
INSERT INTO public.crud_field_validation VALUES (88, 70, 8, 'max_length', '200');
INSERT INTO public.crud_field_validation VALUES (89, 71, 8, 'required', '');
INSERT INTO public.crud_field_validation VALUES (90, 73, 10, 'required', '');
INSERT INTO public.crud_field_validation VALUES (91, 74, 10, 'required', '');
INSERT INTO public.crud_field_validation VALUES (92, 74, 10, 'valid_number', '');
INSERT INTO public.crud_field_validation VALUES (128, 112, 12, 'required', '');
INSERT INTO public.crud_field_validation VALUES (129, 113, 12, 'required', '');
INSERT INTO public.crud_field_validation VALUES (130, 114, 12, 'required', '');
INSERT INTO public.crud_field_validation VALUES (131, 114, 12, 'valid_number', '');
INSERT INTO public.crud_field_validation VALUES (132, 115, 12, 'required', '');
INSERT INTO public.crud_field_validation VALUES (133, 116, 12, 'required', '');
INSERT INTO public.crud_field_validation VALUES (134, 116, 12, 'valid_number', '');
INSERT INTO public.crud_field_validation VALUES (135, 117, 12, 'required', '');
INSERT INTO public.crud_field_validation VALUES (136, 118, 12, 'required', '');
INSERT INTO public.crud_field_validation VALUES (137, 119, 12, 'required', '');
INSERT INTO public.crud_field_validation VALUES (138, 122, 13, 'required', '');
INSERT INTO public.crud_field_validation VALUES (139, 123, 13, 'required', '');
INSERT INTO public.crud_field_validation VALUES (140, 124, 13, 'required', '');
INSERT INTO public.crud_field_validation VALUES (141, 124, 13, 'valid_number', '');
INSERT INTO public.crud_field_validation VALUES (142, 125, 13, 'required', '');
INSERT INTO public.crud_field_validation VALUES (143, 126, 13, 'required', '');
INSERT INTO public.crud_field_validation VALUES (144, 126, 13, 'valid_number', '');
INSERT INTO public.crud_field_validation VALUES (145, 127, 13, 'required', '');
INSERT INTO public.crud_field_validation VALUES (146, 129, 13, 'required', '');
INSERT INTO public.crud_field_validation VALUES (147, 130, 13, 'required', '');
INSERT INTO public.crud_field_validation VALUES (148, 132, 14, 'required', '');
INSERT INTO public.crud_field_validation VALUES (149, 133, 14, 'required', '');
INSERT INTO public.crud_field_validation VALUES (150, 134, 14, 'required', '');
INSERT INTO public.crud_field_validation VALUES (151, 134, 14, 'valid_number', '');
INSERT INTO public.crud_field_validation VALUES (152, 135, 14, 'required', '');
INSERT INTO public.crud_field_validation VALUES (153, 136, 14, 'required', '');
INSERT INTO public.crud_field_validation VALUES (154, 136, 14, 'valid_number', '');
INSERT INTO public.crud_field_validation VALUES (155, 137, 14, 'required', '');
INSERT INTO public.crud_field_validation VALUES (156, 139, 14, 'required', '');
INSERT INTO public.crud_field_validation VALUES (157, 140, 14, 'required', '');
INSERT INTO public.crud_field_validation VALUES (163, 149, 15, 'required', '');
INSERT INTO public.crud_field_validation VALUES (164, 150, 15, 'required', '');
INSERT INTO public.crud_field_validation VALUES (165, 150, 15, 'valid_number', '');
INSERT INTO public.crud_field_validation VALUES (166, 151, 15, 'required', '');
INSERT INTO public.crud_field_validation VALUES (167, 152, 15, 'required', '');
INSERT INTO public.crud_field_validation VALUES (168, 152, 15, 'valid_number', '');
INSERT INTO public.crud_field_validation VALUES (169, 153, 15, 'required', '');
INSERT INTO public.crud_field_validation VALUES (170, 155, 15, 'required', '');
INSERT INTO public.crud_field_validation VALUES (171, 156, 15, 'required', '');
INSERT INTO public.crud_field_validation VALUES (172, 159, 11, 'required', '');
INSERT INTO public.crud_field_validation VALUES (173, 160, 11, 'required', '');
INSERT INTO public.crud_field_validation VALUES (174, 161, 11, 'required', '');
INSERT INTO public.crud_field_validation VALUES (175, 162, 11, 'required', '');
INSERT INTO public.crud_field_validation VALUES (176, 165, 16, 'required', '');
INSERT INTO public.crud_field_validation VALUES (177, 166, 16, 'required', '');
INSERT INTO public.crud_field_validation VALUES (178, 166, 16, 'valid_number', '');
INSERT INTO public.crud_field_validation VALUES (179, 167, 16, 'allowed_extension', 'jpg,jpeg,png');
INSERT INTO public.crud_field_validation VALUES (180, 170, 4, 'required', '');
INSERT INTO public.crud_field_validation VALUES (181, 170, 4, 'max_length', '50');
INSERT INTO public.crud_field_validation VALUES (182, 171, 4, 'required', '');
INSERT INTO public.crud_field_validation VALUES (183, 171, 4, 'max_length', '50');
INSERT INTO public.crud_field_validation VALUES (184, 172, 4, 'required', '');
INSERT INTO public.crud_field_validation VALUES (185, 172, 4, 'max_length', '50');
INSERT INTO public.crud_field_validation VALUES (186, 173, 4, 'required', '');
INSERT INTO public.crud_field_validation VALUES (187, 174, 4, 'max_length', '15');
INSERT INTO public.crud_field_validation VALUES (188, 175, 4, 'required', '');
INSERT INTO public.crud_field_validation VALUES (193, 181, 17, 'required', '');
INSERT INTO public.crud_field_validation VALUES (194, 181, 17, 'max_length', '50');
INSERT INTO public.crud_field_validation VALUES (195, 182, 17, 'required', '');
INSERT INTO public.crud_field_validation VALUES (196, 183, 17, 'required', '');
INSERT INTO public.crud_field_validation VALUES (197, 185, 18, 'required', '');
INSERT INTO public.crud_field_validation VALUES (198, 186, 18, 'required', '');
INSERT INTO public.crud_field_validation VALUES (199, 187, 18, 'required', '');
INSERT INTO public.crud_field_validation VALUES (200, 188, 18, 'required', '');
INSERT INTO public.crud_field_validation VALUES (201, 189, 18, 'required', '');
INSERT INTO public.crud_field_validation VALUES (202, 190, 18, 'required', '');
INSERT INTO public.crud_field_validation VALUES (203, 191, 18, 'required', '');
INSERT INTO public.crud_field_validation VALUES (204, 192, 18, 'required', '');
INSERT INTO public.crud_field_validation VALUES (210, 201, 20, 'required', '');
INSERT INTO public.crud_field_validation VALUES (211, 202, 20, 'required', '');
INSERT INTO public.crud_field_validation VALUES (212, 203, 20, 'required', '');
INSERT INTO public.crud_field_validation VALUES (213, 204, 20, 'required', '');
INSERT INTO public.crud_field_validation VALUES (214, 206, 21, 'required', '');
INSERT INTO public.crud_field_validation VALUES (215, 207, 21, 'required', '');
INSERT INTO public.crud_field_validation VALUES (216, 208, 21, 'required', '');
INSERT INTO public.crud_field_validation VALUES (217, 209, 21, 'required', '');
INSERT INTO public.crud_field_validation VALUES (218, 210, 21, 'required', '');
INSERT INTO public.crud_field_validation VALUES (219, 211, 21, 'required', '');
INSERT INTO public.crud_field_validation VALUES (220, 213, 22, 'required', '');
INSERT INTO public.crud_field_validation VALUES (221, 216, 23, 'required', '');
INSERT INTO public.crud_field_validation VALUES (222, 220, 24, 'required', '');
INSERT INTO public.crud_field_validation VALUES (223, 221, 24, 'required', '');
INSERT INTO public.crud_field_validation VALUES (224, 223, 25, 'required', '');
INSERT INTO public.crud_field_validation VALUES (225, 226, 26, 'required', '');
INSERT INTO public.crud_field_validation VALUES (231, 238, 27, 'required', '');
INSERT INTO public.crud_field_validation VALUES (232, 239, 27, 'required', '');
INSERT INTO public.crud_field_validation VALUES (233, 242, 27, 'required', '');
INSERT INTO public.crud_field_validation VALUES (234, 244, 27, 'required', '');
INSERT INTO public.crud_field_validation VALUES (235, 245, 27, 'required', '');
INSERT INTO public.crud_field_validation VALUES (245, 262, 29, 'required', '');
INSERT INTO public.crud_field_validation VALUES (246, 263, 29, 'required', '');
INSERT INTO public.crud_field_validation VALUES (247, 264, 29, 'required', '');
INSERT INTO public.crud_field_validation VALUES (248, 267, 29, 'allowed_extension', 'jpg,png,JPG,PNG,JPEG,jpeg');
INSERT INTO public.crud_field_validation VALUES (254, 277, 19, 'required', '');
INSERT INTO public.crud_field_validation VALUES (255, 278, 19, 'required', '');
INSERT INTO public.crud_field_validation VALUES (256, 279, 19, 'required', '');
INSERT INTO public.crud_field_validation VALUES (257, 280, 19, 'required', '');
INSERT INTO public.crud_field_validation VALUES (264, 291, 31, 'required', '');
INSERT INTO public.crud_field_validation VALUES (265, 292, 31, 'required', '');
INSERT INTO public.crud_field_validation VALUES (266, 293, 31, 'required', '');
INSERT INTO public.crud_field_validation VALUES (267, 294, 31, 'required', '');
INSERT INTO public.crud_field_validation VALUES (268, 295, 31, 'required', '');
INSERT INTO public.crud_field_validation VALUES (269, 298, 30, 'required', '');
INSERT INTO public.crud_field_validation VALUES (270, 299, 30, 'required', '');
INSERT INTO public.crud_field_validation VALUES (271, 300, 30, 'required', '');
INSERT INTO public.crud_field_validation VALUES (272, 301, 30, 'required', '');
INSERT INTO public.crud_field_validation VALUES (273, 302, 30, 'required', '');
INSERT INTO public.crud_field_validation VALUES (274, 305, 32, 'required', '');
INSERT INTO public.crud_field_validation VALUES (275, 307, 32, 'required', '');
INSERT INTO public.crud_field_validation VALUES (276, 308, 32, 'required', '');
INSERT INTO public.crud_field_validation VALUES (277, 309, 32, 'required', '');
INSERT INTO public.crud_field_validation VALUES (305, 351, 33, 'required', '');
INSERT INTO public.crud_field_validation VALUES (306, 352, 33, 'required', '');
INSERT INTO public.crud_field_validation VALUES (307, 353, 33, 'required', '');
INSERT INTO public.crud_field_validation VALUES (308, 355, 33, 'required', '');
INSERT INTO public.crud_field_validation VALUES (309, 357, 33, 'required', '');
INSERT INTO public.crud_field_validation VALUES (310, 359, 33, 'required', '');
INSERT INTO public.crud_field_validation VALUES (321, 375, 34, 'required', '');
INSERT INTO public.crud_field_validation VALUES (322, 376, 34, 'required', '');
INSERT INTO public.crud_field_validation VALUES (323, 378, 34, 'required', '');
INSERT INTO public.crud_field_validation VALUES (324, 379, 34, 'required', '');
INSERT INTO public.crud_field_validation VALUES (325, 380, 34, 'required', '');
INSERT INTO public.crud_field_validation VALUES (326, 382, 35, 'required', '');
INSERT INTO public.crud_field_validation VALUES (327, 383, 35, 'required', '');
INSERT INTO public.crud_field_validation VALUES (328, 385, 35, 'required', '');
INSERT INTO public.crud_field_validation VALUES (329, 386, 35, 'required', '');
INSERT INTO public.crud_field_validation VALUES (330, 387, 35, 'required', '');
INSERT INTO public.crud_field_validation VALUES (331, 389, 28, 'required', '');
INSERT INTO public.crud_field_validation VALUES (332, 390, 28, 'required', '');
INSERT INTO public.crud_field_validation VALUES (333, 391, 28, 'required', '');
INSERT INTO public.crud_field_validation VALUES (334, 393, 28, 'required', '');
INSERT INTO public.crud_field_validation VALUES (335, 394, 28, 'required', '');


--
-- TOC entry 3832 (class 0 OID 93557)
-- Dependencies: 255
-- Data for Name: crud_input_type; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.crud_input_type VALUES (1, 'input', '0', 0, 'input');
INSERT INTO public.crud_input_type VALUES (2, 'textarea', '0', 0, 'text');
INSERT INTO public.crud_input_type VALUES (3, 'select', '1', 0, 'select');
INSERT INTO public.crud_input_type VALUES (4, 'editor_wysiwyg', '0', 0, 'editor');
INSERT INTO public.crud_input_type VALUES (5, 'password', '0', 0, 'password');
INSERT INTO public.crud_input_type VALUES (6, 'email', '0', 0, 'email');
INSERT INTO public.crud_input_type VALUES (7, 'address_map', '0', 0, 'address_map');
INSERT INTO public.crud_input_type VALUES (8, 'file', '0', 0, 'file');
INSERT INTO public.crud_input_type VALUES (9, 'file_multiple', '0', 0, 'file_multiple');
INSERT INTO public.crud_input_type VALUES (10, 'datetime', '0', 0, 'datetime');
INSERT INTO public.crud_input_type VALUES (11, 'date', '0', 0, 'date');
INSERT INTO public.crud_input_type VALUES (12, 'timestamp', '0', 0, 'timestamp');
INSERT INTO public.crud_input_type VALUES (13, 'number', '0', 0, 'number');
INSERT INTO public.crud_input_type VALUES (14, 'yes_no', '0', 0, 'yes_no');
INSERT INTO public.crud_input_type VALUES (15, 'time', '0', 0, 'time');
INSERT INTO public.crud_input_type VALUES (16, 'year', '0', 0, 'year');
INSERT INTO public.crud_input_type VALUES (17, 'select_multiple', '1', 0, 'select_multiple');
INSERT INTO public.crud_input_type VALUES (18, 'checkboxes', '1', 0, 'checkboxes');
INSERT INTO public.crud_input_type VALUES (19, 'options', '1', 0, 'options');
INSERT INTO public.crud_input_type VALUES (20, 'true_false', '0', 0, 'true_false');
INSERT INTO public.crud_input_type VALUES (21, 'current_user_username', '0', 0, 'user_username');
INSERT INTO public.crud_input_type VALUES (22, 'current_user_id', '0', 0, 'current_user_id');
INSERT INTO public.crud_input_type VALUES (23, 'custom_option', '0', 1, 'custom_option');
INSERT INTO public.crud_input_type VALUES (24, 'custom_checkbox', '0', 1, 'custom_checkbox');
INSERT INTO public.crud_input_type VALUES (25, 'custom_select_multiple', '0', 1, 'custom_select_multiple');
INSERT INTO public.crud_input_type VALUES (26, 'custom_select', '0', 1, 'custom_select');


--
-- TOC entry 3834 (class 0 OID 93564)
-- Dependencies: 257
-- Data for Name: crud_input_validation; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.crud_input_validation VALUES (1, 'required', 'no', 'input, file, number, text, datetime, select, password, email, editor, date, yes_no, time, year, select_multiple, options, checkboxes, true_false, address_map, custom_option, custom_checkbox, custom_select_multiple, custom_select, file_multiple', '', '', '');
INSERT INTO public.crud_input_validation VALUES (2, 'max_length', 'yes', 'input, number, text, select, password, email, editor, yes_no, time, year, select_multiple, options, checkboxes, address_map', '', '', 'numeric');
INSERT INTO public.crud_input_validation VALUES (3, 'min_length', 'yes', 'input, number, text, select, password, email, editor, time, year, select_multiple, address_map', '', '', 'numeric');
INSERT INTO public.crud_input_validation VALUES (4, 'valid_email', 'no', 'input, email', '', '', '');
INSERT INTO public.crud_input_validation VALUES (5, 'valid_emails', 'no', 'input, email', '', '', '');
INSERT INTO public.crud_input_validation VALUES (6, 'regex', 'yes', 'input, number, text, datetime, select, password, email, editor, date, yes_no, time, year, select_multiple, options, checkboxes', '', 'yes', 'callback_valid_regex');
INSERT INTO public.crud_input_validation VALUES (7, 'decimal', 'no', 'input, number, text, select', '', '', '');
INSERT INTO public.crud_input_validation VALUES (8, 'allowed_extension', 'yes', 'file, file_multiple', 'ex : jpg,png,..', '', 'callback_valid_extension_list');
INSERT INTO public.crud_input_validation VALUES (9, 'max_width', 'yes', 'file, file_multiple', '', '', 'numeric');
INSERT INTO public.crud_input_validation VALUES (10, 'max_height', 'yes', 'file, file_multiple', '', '', 'numeric');
INSERT INTO public.crud_input_validation VALUES (11, 'max_size', 'yes', 'file, file_multiple', '... kb', '', 'numeric');
INSERT INTO public.crud_input_validation VALUES (12, 'max_item', 'yes', 'file_multiple', '', '', 'numeric');
INSERT INTO public.crud_input_validation VALUES (13, 'valid_url', 'no', 'input, text', '', '', '');
INSERT INTO public.crud_input_validation VALUES (14, 'alpha', 'no', 'input, text, select, password, editor, yes_no', '', '', '');
INSERT INTO public.crud_input_validation VALUES (15, 'alpha_numeric', 'no', 'input, number, text, select, password, editor', '', '', '');
INSERT INTO public.crud_input_validation VALUES (16, 'alpha_numeric_spaces', 'no', 'input, number, text,select, password, editor', '', '', '');
INSERT INTO public.crud_input_validation VALUES (17, 'valid_number', 'no', 'input, number, text, password, editor, true_false', '', 'yes', '');
INSERT INTO public.crud_input_validation VALUES (18, 'valid_datetime', 'no', 'input, datetime, text', '', 'yes', '');
INSERT INTO public.crud_input_validation VALUES (19, 'valid_date', 'no', 'input, datetime, date, text', '', 'yes', '');
INSERT INTO public.crud_input_validation VALUES (20, 'valid_max_selected_option', 'yes', 'select_multiple, custom_select_multiple, custom_checkbox, checkboxes', '', 'yes', 'numeric');
INSERT INTO public.crud_input_validation VALUES (21, 'valid_min_selected_option', 'yes', 'select_multiple, custom_select_multiple, custom_checkbox, checkboxes', '', 'yes', 'numeric');
INSERT INTO public.crud_input_validation VALUES (22, 'valid_alpha_numeric_spaces_underscores', 'no', 'input, text,select, password, editor', '', 'yes', '');
INSERT INTO public.crud_input_validation VALUES (23, 'matches', 'yes', 'input, number, text, password, email', 'any field', 'no', 'callback_valid_alpha_numeric_spaces_underscores');
INSERT INTO public.crud_input_validation VALUES (24, 'valid_json', 'no', 'input, text, editor', '', 'yes', ' ');
INSERT INTO public.crud_input_validation VALUES (25, 'valid_url', 'no', 'input, text, editor', '', 'no', ' ');
INSERT INTO public.crud_input_validation VALUES (26, 'exact_length', 'yes', 'input, text, number', '0 - 99999*', 'no', 'numeric');
INSERT INTO public.crud_input_validation VALUES (27, 'alpha_dash', 'no', 'input, text', '', 'no', '');
INSERT INTO public.crud_input_validation VALUES (28, 'integer', 'no', 'input, text, number', '', 'no', '');
INSERT INTO public.crud_input_validation VALUES (29, 'differs', 'yes', 'input, text, number, email, password, editor, options, select', 'any field', 'no', 'callback_valid_alpha_numeric_spaces_underscores');
INSERT INTO public.crud_input_validation VALUES (30, 'is_natural', 'no', 'input, text, number', '', 'no', '');
INSERT INTO public.crud_input_validation VALUES (31, 'is_natural_no_zero', 'no', 'input, text, number', '', 'no', '');
INSERT INTO public.crud_input_validation VALUES (32, 'less_than', 'yes', 'input, text, number', '', 'no', 'numeric');
INSERT INTO public.crud_input_validation VALUES (33, 'less_than_equal_to', 'yes', 'input, text, number', '', 'no', 'numeric');
INSERT INTO public.crud_input_validation VALUES (34, 'greater_than', 'yes', 'input, text, number', '', 'no', 'numeric');
INSERT INTO public.crud_input_validation VALUES (35, 'greater_than_equal_to', 'yes', 'input, text, number', '', 'no', 'numeric');
INSERT INTO public.crud_input_validation VALUES (36, 'in_list', 'yes', 'input, text, number, select, options', '', 'no', 'callback_valid_multiple_value');
INSERT INTO public.crud_input_validation VALUES (37, 'valid_ip', 'no', 'input, text', '', 'no', '');


--
-- TOC entry 3836 (class 0 OID 93573)
-- Dependencies: 259
-- Data for Name: departemen; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3838 (class 0 OID 93582)
-- Dependencies: 261
-- Data for Name: disposal; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3840 (class 0 OID 93593)
-- Dependencies: 263
-- Data for Name: form; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.form VALUES (1, 'Pengajuan Pinjam Barang', 'Pengajuan Pinjam Barang', 'form_pengajuan_pinjam_barang');


--
-- TOC entry 3842 (class 0 OID 93602)
-- Dependencies: 265
-- Data for Name: form_custom_attribute; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3844 (class 0 OID 93611)
-- Dependencies: 267
-- Data for Name: form_custom_option; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3846 (class 0 OID 93620)
-- Dependencies: 269
-- Data for Name: form_field; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.form_field VALUES (58, 1, 1, 'nik_nidn_nim', 'select', 'NIK/NIDN/NIM', '', 'yes', '', 'karyawan', 'nik', 'nik');
INSERT INTO public.form_field VALUES (59, 1, 2, 'nama_peminjam', 'select', 'Nama Peminjam', '', 'yes', '', 'karyawan', 'nama_lengkap', 'nama_lengkap');
INSERT INTO public.form_field VALUES (60, 1, 3, 'no_telp_hp', 'input', 'No Telp / Hp', '', 'yes', '', '', '', '');
INSERT INTO public.form_field VALUES (61, 1, 4, 'nama_barang', 'select', 'Nama Barang', '', 'yes', '', 'barang', 'nama_barang', 'nama_barang');
INSERT INTO public.form_field VALUES (62, 1, 5, 'dipakai_di', 'select', 'Dipakai di', '', 'yes', '', 'ruangan', 'ruangan', 'ruangan');
INSERT INTO public.form_field VALUES (63, 1, 6, 'digunakan_untuk', 'editor_wysiwyg', 'Digunakan Untuk', '', 'yes', '', '', '', '');
INSERT INTO public.form_field VALUES (64, 1, 7, 'jumlah', 'input', 'Jumlah', '', 'yes', '', '', '', '');
INSERT INTO public.form_field VALUES (65, 1, 8, 'tanggal_pinjam', 'timestamp', 'Tanggal Pinjam', '', 'yes', '', '', '', '');
INSERT INTO public.form_field VALUES (66, 1, 9, 'tanggal_kembali', 'date', 'Tanggal Kembali', '', 'yes', '', '', '', '');


--
-- TOC entry 3848 (class 0 OID 93634)
-- Dependencies: 271
-- Data for Name: form_field_validation; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.form_field_validation VALUES (50, 58, 1, 'required', '');
INSERT INTO public.form_field_validation VALUES (51, 59, 1, 'required', '');
INSERT INTO public.form_field_validation VALUES (52, 60, 1, 'required', '');
INSERT INTO public.form_field_validation VALUES (53, 61, 1, 'required', '');
INSERT INTO public.form_field_validation VALUES (54, 62, 1, 'required', '');
INSERT INTO public.form_field_validation VALUES (55, 63, 1, 'required', '');
INSERT INTO public.form_field_validation VALUES (56, 64, 1, 'required', '');
INSERT INTO public.form_field_validation VALUES (57, 66, 1, 'required', '');


--
-- TOC entry 3850 (class 0 OID 93643)
-- Dependencies: 273
-- Data for Name: form_pengajuan_pinjam_barang; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3852 (class 0 OID 93652)
-- Dependencies: 275
-- Data for Name: jabatan; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3854 (class 0 OID 93659)
-- Dependencies: 277
-- Data for Name: jenis_pengadaan; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3856 (class 0 OID 93668)
-- Dependencies: 279
-- Data for Name: karyawan; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3858 (class 0 OID 93675)
-- Dependencies: 281
-- Data for Name: kategori; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3860 (class 0 OID 93684)
-- Dependencies: 283
-- Data for Name: keys; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.keys VALUES (1, 0, '7DCB64B2EC9B51D0460B856BA533D3FD', 0, 0, 0, NULL, '2018-07-18 06:31:08');


--
-- TOC entry 3862 (class 0 OID 93694)
-- Dependencies: 285
-- Data for Name: lokasi; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3864 (class 0 OID 93702)
-- Dependencies: 287
-- Data for Name: menu; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.menu VALUES (1, 'Daftar Menu', 'label', '', 'administrator/dashboard', 1, 0, '', 1);
INSERT INTO public.menu VALUES (2, 'Dashboard', 'menu', '', 'administrator/dashboard', 2, 0, 'fa-dashboard', 1);
INSERT INTO public.menu VALUES (3, 'Informasi', 'menu', '', 'administrator/informasi', 100, 0, 'fa-info', 1);
INSERT INTO public.menu VALUES (8, 'Akun', 'menu', 'default', '#', 31, 0, 'fa-user', 1);
INSERT INTO public.menu VALUES (9, 'Pengguna', 'menu', '', 'administrator/user', 32, 8, '', 1);
INSERT INTO public.menu VALUES (10, 'Group', 'menu', '', 'administrator/group', 33, 8, '', 1);
INSERT INTO public.menu VALUES (11, 'Akses', 'menu', '', 'administrator/akses', 34, 8, '', 1);
INSERT INTO public.menu VALUES (14, 'Kofigurasi', 'menu', 'default', '#', 35, 0, 'fa-cogs', 1);
INSERT INTO public.menu VALUES (15, 'Pengaturan', 'menu', 'text-red', 'administrator/setting', 36, 14, 'fa-circle-o', 1);
INSERT INTO public.menu VALUES (18, 'Home', 'menu', 'default', '/', 1, 0, '', 2);
INSERT INTO public.menu VALUES (21, 'Dashboard', 'menu', '', 'administrator/dashboard', 4, 0, '', 2);
INSERT INTO public.menu VALUES (23, 'Data Utama', 'menu', 'default', '#', 3, 0, 'fa-database', 1);
INSERT INTO public.menu VALUES (32, 'Peminjaman', 'menu', 'default', '#', 19, 0, 'fa-edit', 1);
INSERT INTO public.menu VALUES (33, 'Input Peminjaman', 'menu', 'default', 'administrator/pengajuan/add', 20, 32, '', 1);
INSERT INTO public.menu VALUES (34, 'View', 'menu', 'default', 'administrator/pengajuan', 21, 32, '', 1);
INSERT INTO public.menu VALUES (35, 'Pengembalian', 'menu', 'default', '#', 22, 0, 'fa-undo', 1);
INSERT INTO public.menu VALUES (36, 'Input Barang Kembali', 'menu', 'default', 'administrator/pengembalian/add', 23, 35, '', 1);
INSERT INTO public.menu VALUES (37, 'View', 'menu', 'default', 'administrator/pengembalian', 24, 35, '', 1);
INSERT INTO public.menu VALUES (38, 'Disposal', 'menu', 'default', 'administrator/disposal', 28, 0, 'fa-trash', 1);
INSERT INTO public.menu VALUES (39, 'Input Disposal', 'menu', 'default', 'administrator/disposal/add', 29, 38, '', 1);
INSERT INTO public.menu VALUES (40, 'View', 'menu', 'default', 'administrator/disposal', 30, 38, '', 1);
INSERT INTO public.menu VALUES (41, 'Retur', 'menu', 'default', 'administrator/retur', 25, 0, 'fa-mail-reply', 1);
INSERT INTO public.menu VALUES (42, 'Input Retur', 'menu', 'default', 'administrator/retur/add', 26, 41, '', 1);
INSERT INTO public.menu VALUES (43, 'View', 'menu', 'default', 'administrator/retur', 27, 41, '', 1);
INSERT INTO public.menu VALUES (47, 'Departemen', 'menu', 'default', 'administrator/departemen', 4, 23, '', 1);
INSERT INTO public.menu VALUES (48, 'Supplier', 'menu', 'default', 'administrator/supplier', 5, 23, '', 1);
INSERT INTO public.menu VALUES (49, 'Lokasi', 'menu', 'default', 'administrator/lokasi', 6, 23, '', 1);
INSERT INTO public.menu VALUES (50, 'Jenis Pengadaan', 'menu', 'default', 'administrator/jenis_pengadaan', 7, 23, '', 1);
INSERT INTO public.menu VALUES (51, 'Kategori', 'menu', 'default', 'administrator/kategori', 8, 23, '', 1);
INSERT INTO public.menu VALUES (52, 'Pengadaan', 'menu', 'default', '#', 10, 0, 'fa-money', 1);
INSERT INTO public.menu VALUES (53, 'View', 'menu', 'default', 'administrator/pengadaan', 12, 52, '', 1);
INSERT INTO public.menu VALUES (54, 'Input Pengadaan', 'menu', 'default', 'administrator/pengadaan/add', 11, 52, '', 1);
INSERT INTO public.menu VALUES (55, 'Data Barang', 'menu', 'default', 'administrator/barang', 9, 0, 'fa-briefcase', 1);
INSERT INTO public.menu VALUES (56, 'Penempatan', 'menu', 'default', '#', 13, 0, 'fa-map-marker', 1);
INSERT INTO public.menu VALUES (57, 'Input Penempatan', 'menu', 'default', 'administrator/penempatan/add', 14, 56, '', 1);
INSERT INTO public.menu VALUES (58, 'View', 'menu', 'default', 'administrator/penempatan', 15, 56, '', 1);
INSERT INTO public.menu VALUES (59, 'Mutasi', 'menu', 'default', '#', 16, 0, 'fa-cut', 1);
INSERT INTO public.menu VALUES (60, 'Input Mutasi', 'menu', 'default', 'administrator/mutasi/add', 17, 59, '', 1);
INSERT INTO public.menu VALUES (61, 'View', 'menu', 'default', 'administrator/mutasi', 18, 59, '', 1);


--
-- TOC entry 3865 (class 0 OID 93715)
-- Dependencies: 288
-- Data for Name: menu_icon; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.menu_icon VALUES ('fa-500px');
INSERT INTO public.menu_icon VALUES ('fa-adjust');
INSERT INTO public.menu_icon VALUES ('fa-adn');
INSERT INTO public.menu_icon VALUES ('fa-align');
INSERT INTO public.menu_icon VALUES ('fa-align');
INSERT INTO public.menu_icon VALUES ('fa-align');
INSERT INTO public.menu_icon VALUES ('fa-align');
INSERT INTO public.menu_icon VALUES ('fa-amazon');
INSERT INTO public.menu_icon VALUES ('fa-ambulance');
INSERT INTO public.menu_icon VALUES ('fa-american');
INSERT INTO public.menu_icon VALUES ('fa-anchor');
INSERT INTO public.menu_icon VALUES ('fa-android');
INSERT INTO public.menu_icon VALUES ('fa-angellist');
INSERT INTO public.menu_icon VALUES ('fa-angle');
INSERT INTO public.menu_icon VALUES ('fa-angle');
INSERT INTO public.menu_icon VALUES ('fa-angle');
INSERT INTO public.menu_icon VALUES ('fa-angle');
INSERT INTO public.menu_icon VALUES ('fa-angle');
INSERT INTO public.menu_icon VALUES ('fa-angle');
INSERT INTO public.menu_icon VALUES ('fa-angle');
INSERT INTO public.menu_icon VALUES ('fa-angle');
INSERT INTO public.menu_icon VALUES ('fa-apple');
INSERT INTO public.menu_icon VALUES ('fa-archive');
INSERT INTO public.menu_icon VALUES ('fa-area');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrows');
INSERT INTO public.menu_icon VALUES ('fa-arrows');
INSERT INTO public.menu_icon VALUES ('fa-arrows');
INSERT INTO public.menu_icon VALUES ('fa-arrows');
INSERT INTO public.menu_icon VALUES ('fa-asl');
INSERT INTO public.menu_icon VALUES ('fa-assistive');
INSERT INTO public.menu_icon VALUES ('fa-asterisk');
INSERT INTO public.menu_icon VALUES ('fa-at');
INSERT INTO public.menu_icon VALUES ('fa-audio');
INSERT INTO public.menu_icon VALUES ('fa-automobile');
INSERT INTO public.menu_icon VALUES ('fa-backward');
INSERT INTO public.menu_icon VALUES ('fa-balance');
INSERT INTO public.menu_icon VALUES ('fa-ban');
INSERT INTO public.menu_icon VALUES ('fa-bank');
INSERT INTO public.menu_icon VALUES ('fa-bar');
INSERT INTO public.menu_icon VALUES ('fa-bar');
INSERT INTO public.menu_icon VALUES ('fa-barcode');
INSERT INTO public.menu_icon VALUES ('fa-bars');
INSERT INTO public.menu_icon VALUES ('fa-battery');
INSERT INTO public.menu_icon VALUES ('fa-battery');
INSERT INTO public.menu_icon VALUES ('fa-battery');
INSERT INTO public.menu_icon VALUES ('fa-battery');
INSERT INTO public.menu_icon VALUES ('fa-battery');
INSERT INTO public.menu_icon VALUES ('fa-battery');
INSERT INTO public.menu_icon VALUES ('fa-battery');
INSERT INTO public.menu_icon VALUES ('fa-battery');
INSERT INTO public.menu_icon VALUES ('fa-battery');
INSERT INTO public.menu_icon VALUES ('fa-battery');
INSERT INTO public.menu_icon VALUES ('fa-bed');
INSERT INTO public.menu_icon VALUES ('fa-beer');
INSERT INTO public.menu_icon VALUES ('fa-behance');
INSERT INTO public.menu_icon VALUES ('fa-behance');
INSERT INTO public.menu_icon VALUES ('fa-bell');
INSERT INTO public.menu_icon VALUES ('fa-bell');
INSERT INTO public.menu_icon VALUES ('fa-bell');
INSERT INTO public.menu_icon VALUES ('fa-bell');
INSERT INTO public.menu_icon VALUES ('fa-bicycle');
INSERT INTO public.menu_icon VALUES ('fa-binoculars');
INSERT INTO public.menu_icon VALUES ('fa-birthday');
INSERT INTO public.menu_icon VALUES ('fa-bitbucket');
INSERT INTO public.menu_icon VALUES ('fa-bitbucket');
INSERT INTO public.menu_icon VALUES ('fa-bitcoin');
INSERT INTO public.menu_icon VALUES ('fa-black');
INSERT INTO public.menu_icon VALUES ('fa-blind');
INSERT INTO public.menu_icon VALUES ('fa-bluetooth');
INSERT INTO public.menu_icon VALUES ('fa-bluetooth');
INSERT INTO public.menu_icon VALUES ('fa-bold');
INSERT INTO public.menu_icon VALUES ('fa-bolt');
INSERT INTO public.menu_icon VALUES ('fa-bomb');
INSERT INTO public.menu_icon VALUES ('fa-book');
INSERT INTO public.menu_icon VALUES ('fa-bookmark');
INSERT INTO public.menu_icon VALUES ('fa-bookmark');
INSERT INTO public.menu_icon VALUES ('fa-braille');
INSERT INTO public.menu_icon VALUES ('fa-briefcase');
INSERT INTO public.menu_icon VALUES ('fa-btc');
INSERT INTO public.menu_icon VALUES ('fa-bug');
INSERT INTO public.menu_icon VALUES ('fa-building');
INSERT INTO public.menu_icon VALUES ('fa-building');
INSERT INTO public.menu_icon VALUES ('fa-bullhorn');
INSERT INTO public.menu_icon VALUES ('fa-bullseye');
INSERT INTO public.menu_icon VALUES ('fa-bus');
INSERT INTO public.menu_icon VALUES ('fa-buysellads');
INSERT INTO public.menu_icon VALUES ('fa-cab');
INSERT INTO public.menu_icon VALUES ('fa-calculator');
INSERT INTO public.menu_icon VALUES ('fa-calendar');
INSERT INTO public.menu_icon VALUES ('fa-calendar');
INSERT INTO public.menu_icon VALUES ('fa-calendar');
INSERT INTO public.menu_icon VALUES ('fa-calendar');
INSERT INTO public.menu_icon VALUES ('fa-calendar');
INSERT INTO public.menu_icon VALUES ('fa-calendar');
INSERT INTO public.menu_icon VALUES ('fa-camera');
INSERT INTO public.menu_icon VALUES ('fa-camera');
INSERT INTO public.menu_icon VALUES ('fa-car');
INSERT INTO public.menu_icon VALUES ('fa-caret');
INSERT INTO public.menu_icon VALUES ('fa-caret');
INSERT INTO public.menu_icon VALUES ('fa-caret');
INSERT INTO public.menu_icon VALUES ('fa-caret');
INSERT INTO public.menu_icon VALUES ('fa-caret');
INSERT INTO public.menu_icon VALUES ('fa-caret');
INSERT INTO public.menu_icon VALUES ('fa-caret');
INSERT INTO public.menu_icon VALUES ('fa-caret');
INSERT INTO public.menu_icon VALUES ('fa-cart');
INSERT INTO public.menu_icon VALUES ('fa-cart');
INSERT INTO public.menu_icon VALUES ('fa-cc');
INSERT INTO public.menu_icon VALUES ('fa-cc');
INSERT INTO public.menu_icon VALUES ('fa-cc');
INSERT INTO public.menu_icon VALUES ('fa-cc');
INSERT INTO public.menu_icon VALUES ('fa-cc');
INSERT INTO public.menu_icon VALUES ('fa-cc');
INSERT INTO public.menu_icon VALUES ('fa-cc');
INSERT INTO public.menu_icon VALUES ('fa-cc');
INSERT INTO public.menu_icon VALUES ('fa-cc');
INSERT INTO public.menu_icon VALUES ('fa-certificate');
INSERT INTO public.menu_icon VALUES ('fa-chain');
INSERT INTO public.menu_icon VALUES ('fa-chain');
INSERT INTO public.menu_icon VALUES ('fa-check');
INSERT INTO public.menu_icon VALUES ('fa-check');
INSERT INTO public.menu_icon VALUES ('fa-check');
INSERT INTO public.menu_icon VALUES ('fa-check');
INSERT INTO public.menu_icon VALUES ('fa-check');
INSERT INTO public.menu_icon VALUES ('fa-chevron');
INSERT INTO public.menu_icon VALUES ('fa-chevron');
INSERT INTO public.menu_icon VALUES ('fa-chevron');
INSERT INTO public.menu_icon VALUES ('fa-chevron');
INSERT INTO public.menu_icon VALUES ('fa-chevron');
INSERT INTO public.menu_icon VALUES ('fa-chevron');
INSERT INTO public.menu_icon VALUES ('fa-chevron');
INSERT INTO public.menu_icon VALUES ('fa-chevron');
INSERT INTO public.menu_icon VALUES ('fa-child');
INSERT INTO public.menu_icon VALUES ('fa-chrome');
INSERT INTO public.menu_icon VALUES ('fa-circle');
INSERT INTO public.menu_icon VALUES ('fa-circle');
INSERT INTO public.menu_icon VALUES ('fa-circle');
INSERT INTO public.menu_icon VALUES ('fa-circle');
INSERT INTO public.menu_icon VALUES ('fa-clipboard');
INSERT INTO public.menu_icon VALUES ('fa-clock');
INSERT INTO public.menu_icon VALUES ('fa-clone');
INSERT INTO public.menu_icon VALUES ('fa-close');
INSERT INTO public.menu_icon VALUES ('fa-cloud');
INSERT INTO public.menu_icon VALUES ('fa-cloud');
INSERT INTO public.menu_icon VALUES ('fa-cloud');
INSERT INTO public.menu_icon VALUES ('fa-cny');
INSERT INTO public.menu_icon VALUES ('fa-code');
INSERT INTO public.menu_icon VALUES ('fa-code');
INSERT INTO public.menu_icon VALUES ('fa-codepen');
INSERT INTO public.menu_icon VALUES ('fa-codiepie');
INSERT INTO public.menu_icon VALUES ('fa-coffee');
INSERT INTO public.menu_icon VALUES ('fa-cog');
INSERT INTO public.menu_icon VALUES ('fa-cogs');
INSERT INTO public.menu_icon VALUES ('fa-columns');
INSERT INTO public.menu_icon VALUES ('fa-comment');
INSERT INTO public.menu_icon VALUES ('fa-comment');
INSERT INTO public.menu_icon VALUES ('fa-commenting');
INSERT INTO public.menu_icon VALUES ('fa-commenting');
INSERT INTO public.menu_icon VALUES ('fa-comments');
INSERT INTO public.menu_icon VALUES ('fa-comments');
INSERT INTO public.menu_icon VALUES ('fa-compass');
INSERT INTO public.menu_icon VALUES ('fa-compress');
INSERT INTO public.menu_icon VALUES ('fa-connectdevelop');
INSERT INTO public.menu_icon VALUES ('fa-contao');
INSERT INTO public.menu_icon VALUES ('fa-copy');
INSERT INTO public.menu_icon VALUES ('fa-copyright');
INSERT INTO public.menu_icon VALUES ('fa-creative');
INSERT INTO public.menu_icon VALUES ('fa-credit');
INSERT INTO public.menu_icon VALUES ('fa-credit');
INSERT INTO public.menu_icon VALUES ('fa-crop');
INSERT INTO public.menu_icon VALUES ('fa-crosshairs');
INSERT INTO public.menu_icon VALUES ('fa-css3');
INSERT INTO public.menu_icon VALUES ('fa-cube');
INSERT INTO public.menu_icon VALUES ('fa-cubes');
INSERT INTO public.menu_icon VALUES ('fa-cut');
INSERT INTO public.menu_icon VALUES ('fa-cutlery');
INSERT INTO public.menu_icon VALUES ('fa-dashboard');
INSERT INTO public.menu_icon VALUES ('fa-dashcube');
INSERT INTO public.menu_icon VALUES ('fa-database');
INSERT INTO public.menu_icon VALUES ('fa-deaf');
INSERT INTO public.menu_icon VALUES ('fa-deafness');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-dedent');
INSERT INTO public.menu_icon VALUES ('fa-delicious');
INSERT INTO public.menu_icon VALUES ('fa-desktop');
INSERT INTO public.menu_icon VALUES ('fa-deviantart');
INSERT INTO public.menu_icon VALUES ('fa-diamond');
INSERT INTO public.menu_icon VALUES ('fa-digg');
INSERT INTO public.menu_icon VALUES ('fa-dollar');
INSERT INTO public.menu_icon VALUES ('fa-dot');
INSERT INTO public.menu_icon VALUES ('fa-download');
INSERT INTO public.menu_icon VALUES ('fa-dribbble');
INSERT INTO public.menu_icon VALUES ('fa-dropbox');
INSERT INTO public.menu_icon VALUES ('fa-drupal');
INSERT INTO public.menu_icon VALUES ('fa-edge');
INSERT INTO public.menu_icon VALUES ('fa-edit');
INSERT INTO public.menu_icon VALUES ('fa-eject');
INSERT INTO public.menu_icon VALUES ('fa-ellipsis');
INSERT INTO public.menu_icon VALUES ('fa-ellipsis');
INSERT INTO public.menu_icon VALUES ('fa-empire');
INSERT INTO public.menu_icon VALUES ('fa-envelope');
INSERT INTO public.menu_icon VALUES ('fa-envelope');
INSERT INTO public.menu_icon VALUES ('fa-envelope');
INSERT INTO public.menu_icon VALUES ('fa-envira');
INSERT INTO public.menu_icon VALUES ('fa-eraser');
INSERT INTO public.menu_icon VALUES ('fa-eur');
INSERT INTO public.menu_icon VALUES ('fa-euro');
INSERT INTO public.menu_icon VALUES ('fa-exchange');
INSERT INTO public.menu_icon VALUES ('fa-exclamation');
INSERT INTO public.menu_icon VALUES ('fa-exclamation');
INSERT INTO public.menu_icon VALUES ('fa-exclamation');
INSERT INTO public.menu_icon VALUES ('fa-expand');
INSERT INTO public.menu_icon VALUES ('fa-expeditedssl');
INSERT INTO public.menu_icon VALUES ('fa-external');
INSERT INTO public.menu_icon VALUES ('fa-external');
INSERT INTO public.menu_icon VALUES ('fa-eye');
INSERT INTO public.menu_icon VALUES ('fa-eye');
INSERT INTO public.menu_icon VALUES ('fa-eyedropper');
INSERT INTO public.menu_icon VALUES ('fa-fa');
INSERT INTO public.menu_icon VALUES ('fa-facebook');
INSERT INTO public.menu_icon VALUES ('fa-facebook');
INSERT INTO public.menu_icon VALUES ('fa-facebook');
INSERT INTO public.menu_icon VALUES ('fa-facebook');
INSERT INTO public.menu_icon VALUES ('fa-fast');
INSERT INTO public.menu_icon VALUES ('fa-fast');
INSERT INTO public.menu_icon VALUES ('fa-fax');
INSERT INTO public.menu_icon VALUES ('fa-feed');
INSERT INTO public.menu_icon VALUES ('fa-female');
INSERT INTO public.menu_icon VALUES ('fa-fighter');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-files');
INSERT INTO public.menu_icon VALUES ('fa-film');
INSERT INTO public.menu_icon VALUES ('fa-filter');
INSERT INTO public.menu_icon VALUES ('fa-fire');
INSERT INTO public.menu_icon VALUES ('fa-fire');
INSERT INTO public.menu_icon VALUES ('fa-firefox');
INSERT INTO public.menu_icon VALUES ('fa-first');
INSERT INTO public.menu_icon VALUES ('fa-flag');
INSERT INTO public.menu_icon VALUES ('fa-flag');
INSERT INTO public.menu_icon VALUES ('fa-flag');
INSERT INTO public.menu_icon VALUES ('fa-flash');
INSERT INTO public.menu_icon VALUES ('fa-flask');
INSERT INTO public.menu_icon VALUES ('fa-flickr');
INSERT INTO public.menu_icon VALUES ('fa-floppy');
INSERT INTO public.menu_icon VALUES ('fa-folder');
INSERT INTO public.menu_icon VALUES ('fa-folder');
INSERT INTO public.menu_icon VALUES ('fa-folder');
INSERT INTO public.menu_icon VALUES ('fa-folder');
INSERT INTO public.menu_icon VALUES ('fa-font');
INSERT INTO public.menu_icon VALUES ('fa-font');
INSERT INTO public.menu_icon VALUES ('fa-fonticons');
INSERT INTO public.menu_icon VALUES ('fa-fort');
INSERT INTO public.menu_icon VALUES ('fa-forumbee');
INSERT INTO public.menu_icon VALUES ('fa-forward');
INSERT INTO public.menu_icon VALUES ('fa-foursquare');
INSERT INTO public.menu_icon VALUES ('fa-frown');
INSERT INTO public.menu_icon VALUES ('fa-futbol');
INSERT INTO public.menu_icon VALUES ('fa-gamepad');
INSERT INTO public.menu_icon VALUES ('fa-gavel');
INSERT INTO public.menu_icon VALUES ('fa-gbp');
INSERT INTO public.menu_icon VALUES ('fa-ge');
INSERT INTO public.menu_icon VALUES ('fa-gear');
INSERT INTO public.menu_icon VALUES ('fa-gears');
INSERT INTO public.menu_icon VALUES ('fa-genderless');
INSERT INTO public.menu_icon VALUES ('fa-get');
INSERT INTO public.menu_icon VALUES ('fa-gg');
INSERT INTO public.menu_icon VALUES ('fa-gg');
INSERT INTO public.menu_icon VALUES ('fa-gift');
INSERT INTO public.menu_icon VALUES ('fa-git');
INSERT INTO public.menu_icon VALUES ('fa-git');
INSERT INTO public.menu_icon VALUES ('fa-github');
INSERT INTO public.menu_icon VALUES ('fa-github');
INSERT INTO public.menu_icon VALUES ('fa-github');
INSERT INTO public.menu_icon VALUES ('fa-gitlab');
INSERT INTO public.menu_icon VALUES ('fa-gittip');
INSERT INTO public.menu_icon VALUES ('fa-glass');
INSERT INTO public.menu_icon VALUES ('fa-glide');
INSERT INTO public.menu_icon VALUES ('fa-glide');
INSERT INTO public.menu_icon VALUES ('fa-globe');
INSERT INTO public.menu_icon VALUES ('fa-google');
INSERT INTO public.menu_icon VALUES ('fa-google');
INSERT INTO public.menu_icon VALUES ('fa-google');
INSERT INTO public.menu_icon VALUES ('fa-google');
INSERT INTO public.menu_icon VALUES ('fa-google');
INSERT INTO public.menu_icon VALUES ('fa-google');
INSERT INTO public.menu_icon VALUES ('fa-graduation');
INSERT INTO public.menu_icon VALUES ('fa-gratipay');
INSERT INTO public.menu_icon VALUES ('fa-group');
INSERT INTO public.menu_icon VALUES ('fa-h');
INSERT INTO public.menu_icon VALUES ('fa-hacker');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hard');
INSERT INTO public.menu_icon VALUES ('fa-hashtag');
INSERT INTO public.menu_icon VALUES ('fa-hdd');
INSERT INTO public.menu_icon VALUES ('fa-header');
INSERT INTO public.menu_icon VALUES ('fa-headphones');
INSERT INTO public.menu_icon VALUES ('fa-heart');
INSERT INTO public.menu_icon VALUES ('fa-heart');
INSERT INTO public.menu_icon VALUES ('fa-heartbeat');
INSERT INTO public.menu_icon VALUES ('fa-history');
INSERT INTO public.menu_icon VALUES ('fa-home');
INSERT INTO public.menu_icon VALUES ('fa-hospital');
INSERT INTO public.menu_icon VALUES ('fa-hotel');
INSERT INTO public.menu_icon VALUES ('fa-hourglass');
INSERT INTO public.menu_icon VALUES ('fa-hourglass');
INSERT INTO public.menu_icon VALUES ('fa-hourglass');
INSERT INTO public.menu_icon VALUES ('fa-hourglass');
INSERT INTO public.menu_icon VALUES ('fa-hourglass');
INSERT INTO public.menu_icon VALUES ('fa-hourglass');
INSERT INTO public.menu_icon VALUES ('fa-hourglass');
INSERT INTO public.menu_icon VALUES ('fa-hourglass');
INSERT INTO public.menu_icon VALUES ('fa-houzz');
INSERT INTO public.menu_icon VALUES ('fa-html5');
INSERT INTO public.menu_icon VALUES ('fa-i');
INSERT INTO public.menu_icon VALUES ('fa-ils');
INSERT INTO public.menu_icon VALUES ('fa-image');
INSERT INTO public.menu_icon VALUES ('fa-inbox');
INSERT INTO public.menu_icon VALUES ('fa-indent');
INSERT INTO public.menu_icon VALUES ('fa-industry');
INSERT INTO public.menu_icon VALUES ('fa-info');
INSERT INTO public.menu_icon VALUES ('fa-info');
INSERT INTO public.menu_icon VALUES ('fa-inr');
INSERT INTO public.menu_icon VALUES ('fa-instagram');
INSERT INTO public.menu_icon VALUES ('fa-institution');
INSERT INTO public.menu_icon VALUES ('fa-internet');
INSERT INTO public.menu_icon VALUES ('fa-intersex');
INSERT INTO public.menu_icon VALUES ('fa-ioxhost');
INSERT INTO public.menu_icon VALUES ('fa-italic');
INSERT INTO public.menu_icon VALUES ('fa-joomla');
INSERT INTO public.menu_icon VALUES ('fa-jpy');
INSERT INTO public.menu_icon VALUES ('fa-jsfiddle');
INSERT INTO public.menu_icon VALUES ('fa-key');
INSERT INTO public.menu_icon VALUES ('fa-keyboard');
INSERT INTO public.menu_icon VALUES ('fa-krw');
INSERT INTO public.menu_icon VALUES ('fa-language');
INSERT INTO public.menu_icon VALUES ('fa-laptop');
INSERT INTO public.menu_icon VALUES ('fa-lastfm');
INSERT INTO public.menu_icon VALUES ('fa-lastfm');
INSERT INTO public.menu_icon VALUES ('fa-leaf');
INSERT INTO public.menu_icon VALUES ('fa-leanpub');
INSERT INTO public.menu_icon VALUES ('fa-legal');
INSERT INTO public.menu_icon VALUES ('fa-lemon');
INSERT INTO public.menu_icon VALUES ('fa-level');
INSERT INTO public.menu_icon VALUES ('fa-level');
INSERT INTO public.menu_icon VALUES ('fa-life');
INSERT INTO public.menu_icon VALUES ('fa-life');
INSERT INTO public.menu_icon VALUES ('fa-life');
INSERT INTO public.menu_icon VALUES ('fa-life');
INSERT INTO public.menu_icon VALUES ('fa-lightbulb');
INSERT INTO public.menu_icon VALUES ('fa-line');
INSERT INTO public.menu_icon VALUES ('fa-link');
INSERT INTO public.menu_icon VALUES ('fa-linkedin');
INSERT INTO public.menu_icon VALUES ('fa-linkedin');
INSERT INTO public.menu_icon VALUES ('fa-linux');
INSERT INTO public.menu_icon VALUES ('fa-list');
INSERT INTO public.menu_icon VALUES ('fa-list');
INSERT INTO public.menu_icon VALUES ('fa-list');
INSERT INTO public.menu_icon VALUES ('fa-list');
INSERT INTO public.menu_icon VALUES ('fa-location');
INSERT INTO public.menu_icon VALUES ('fa-lock');
INSERT INTO public.menu_icon VALUES ('fa-long');
INSERT INTO public.menu_icon VALUES ('fa-long');
INSERT INTO public.menu_icon VALUES ('fa-long');
INSERT INTO public.menu_icon VALUES ('fa-long');
INSERT INTO public.menu_icon VALUES ('fa-low');
INSERT INTO public.menu_icon VALUES ('fa-magic');
INSERT INTO public.menu_icon VALUES ('fa-magnet');
INSERT INTO public.menu_icon VALUES ('fa-mail');
INSERT INTO public.menu_icon VALUES ('fa-mail');
INSERT INTO public.menu_icon VALUES ('fa-mail');
INSERT INTO public.menu_icon VALUES ('fa-male');
INSERT INTO public.menu_icon VALUES ('fa-map');
INSERT INTO public.menu_icon VALUES ('fa-map');
INSERT INTO public.menu_icon VALUES ('fa-map');
INSERT INTO public.menu_icon VALUES ('fa-map');
INSERT INTO public.menu_icon VALUES ('fa-map');
INSERT INTO public.menu_icon VALUES ('fa-mars');
INSERT INTO public.menu_icon VALUES ('fa-mars');
INSERT INTO public.menu_icon VALUES ('fa-mars');
INSERT INTO public.menu_icon VALUES ('fa-mars');
INSERT INTO public.menu_icon VALUES ('fa-mars');
INSERT INTO public.menu_icon VALUES ('fa-maxcdn');
INSERT INTO public.menu_icon VALUES ('fa-meanpath');
INSERT INTO public.menu_icon VALUES ('fa-medium');
INSERT INTO public.menu_icon VALUES ('fa-medkit');
INSERT INTO public.menu_icon VALUES ('fa-meh');
INSERT INTO public.menu_icon VALUES ('fa-mercury');
INSERT INTO public.menu_icon VALUES ('fa-microphone');
INSERT INTO public.menu_icon VALUES ('fa-microphone');
INSERT INTO public.menu_icon VALUES ('fa-minus');
INSERT INTO public.menu_icon VALUES ('fa-minus');
INSERT INTO public.menu_icon VALUES ('fa-minus');
INSERT INTO public.menu_icon VALUES ('fa-minus');
INSERT INTO public.menu_icon VALUES ('fa-mixcloud');
INSERT INTO public.menu_icon VALUES ('fa-mobile');
INSERT INTO public.menu_icon VALUES ('fa-mobile');
INSERT INTO public.menu_icon VALUES ('fa-modx');
INSERT INTO public.menu_icon VALUES ('fa-money');
INSERT INTO public.menu_icon VALUES ('fa-moon');
INSERT INTO public.menu_icon VALUES ('fa-mortar');
INSERT INTO public.menu_icon VALUES ('fa-motorcycle');
INSERT INTO public.menu_icon VALUES ('fa-mouse');
INSERT INTO public.menu_icon VALUES ('fa-music');
INSERT INTO public.menu_icon VALUES ('fa-navicon');
INSERT INTO public.menu_icon VALUES ('fa-neuter');
INSERT INTO public.menu_icon VALUES ('fa-newspaper');
INSERT INTO public.menu_icon VALUES ('fa-object');
INSERT INTO public.menu_icon VALUES ('fa-object');
INSERT INTO public.menu_icon VALUES ('fa-odnoklassniki');
INSERT INTO public.menu_icon VALUES ('fa-odnoklassniki');
INSERT INTO public.menu_icon VALUES ('fa-opencart');
INSERT INTO public.menu_icon VALUES ('fa-openid');
INSERT INTO public.menu_icon VALUES ('fa-opera');
INSERT INTO public.menu_icon VALUES ('fa-optin');
INSERT INTO public.menu_icon VALUES ('fa-outdent');
INSERT INTO public.menu_icon VALUES ('fa-pagelines');
INSERT INTO public.menu_icon VALUES ('fa-paint');
INSERT INTO public.menu_icon VALUES ('fa-paper');
INSERT INTO public.menu_icon VALUES ('fa-paper');
INSERT INTO public.menu_icon VALUES ('fa-paperclip');
INSERT INTO public.menu_icon VALUES ('fa-paragraph');
INSERT INTO public.menu_icon VALUES ('fa-paste');
INSERT INTO public.menu_icon VALUES ('fa-pause');
INSERT INTO public.menu_icon VALUES ('fa-pause');
INSERT INTO public.menu_icon VALUES ('fa-pause');
INSERT INTO public.menu_icon VALUES ('fa-paw');
INSERT INTO public.menu_icon VALUES ('fa-paypal');
INSERT INTO public.menu_icon VALUES ('fa-pencil');
INSERT INTO public.menu_icon VALUES ('fa-pencil');
INSERT INTO public.menu_icon VALUES ('fa-pencil');
INSERT INTO public.menu_icon VALUES ('fa-percent');
INSERT INTO public.menu_icon VALUES ('fa-phone');
INSERT INTO public.menu_icon VALUES ('fa-phone');
INSERT INTO public.menu_icon VALUES ('fa-photo');
INSERT INTO public.menu_icon VALUES ('fa-picture');
INSERT INTO public.menu_icon VALUES ('fa-pie');
INSERT INTO public.menu_icon VALUES ('fa-pied');
INSERT INTO public.menu_icon VALUES ('fa-pied');
INSERT INTO public.menu_icon VALUES ('fa-pied');
INSERT INTO public.menu_icon VALUES ('fa-pinterest');
INSERT INTO public.menu_icon VALUES ('fa-pinterest');
INSERT INTO public.menu_icon VALUES ('fa-pinterest');
INSERT INTO public.menu_icon VALUES ('fa-plane');
INSERT INTO public.menu_icon VALUES ('fa-play');
INSERT INTO public.menu_icon VALUES ('fa-play');
INSERT INTO public.menu_icon VALUES ('fa-play');
INSERT INTO public.menu_icon VALUES ('fa-plug');
INSERT INTO public.menu_icon VALUES ('fa-plus');
INSERT INTO public.menu_icon VALUES ('fa-plus');
INSERT INTO public.menu_icon VALUES ('fa-plus');
INSERT INTO public.menu_icon VALUES ('fa-plus');
INSERT INTO public.menu_icon VALUES ('fa-power');
INSERT INTO public.menu_icon VALUES ('fa-print');
INSERT INTO public.menu_icon VALUES ('fa-product');
INSERT INTO public.menu_icon VALUES ('fa-puzzle');
INSERT INTO public.menu_icon VALUES ('fa-qq');
INSERT INTO public.menu_icon VALUES ('fa-qrcode');
INSERT INTO public.menu_icon VALUES ('fa-question');
INSERT INTO public.menu_icon VALUES ('fa-question');
INSERT INTO public.menu_icon VALUES ('fa-question');
INSERT INTO public.menu_icon VALUES ('fa-quote');
INSERT INTO public.menu_icon VALUES ('fa-quote');
INSERT INTO public.menu_icon VALUES ('fa-ra');
INSERT INTO public.menu_icon VALUES ('fa-random');
INSERT INTO public.menu_icon VALUES ('fa-rebel');
INSERT INTO public.menu_icon VALUES ('fa-recycle');
INSERT INTO public.menu_icon VALUES ('fa-reddit');
INSERT INTO public.menu_icon VALUES ('fa-reddit');
INSERT INTO public.menu_icon VALUES ('fa-reddit');
INSERT INTO public.menu_icon VALUES ('fa-refresh');
INSERT INTO public.menu_icon VALUES ('fa-registered');
INSERT INTO public.menu_icon VALUES ('fa-remove');
INSERT INTO public.menu_icon VALUES ('fa-renren');
INSERT INTO public.menu_icon VALUES ('fa-reorder');
INSERT INTO public.menu_icon VALUES ('fa-repeat');
INSERT INTO public.menu_icon VALUES ('fa-reply');
INSERT INTO public.menu_icon VALUES ('fa-reply');
INSERT INTO public.menu_icon VALUES ('fa-resistance');
INSERT INTO public.menu_icon VALUES ('fa-retweet');
INSERT INTO public.menu_icon VALUES ('fa-rmb');
INSERT INTO public.menu_icon VALUES ('fa-road');
INSERT INTO public.menu_icon VALUES ('fa-rocket');
INSERT INTO public.menu_icon VALUES ('fa-rotate');
INSERT INTO public.menu_icon VALUES ('fa-rotate');
INSERT INTO public.menu_icon VALUES ('fa-rouble');
INSERT INTO public.menu_icon VALUES ('fa-rss');
INSERT INTO public.menu_icon VALUES ('fa-rss');
INSERT INTO public.menu_icon VALUES ('fa-rub');
INSERT INTO public.menu_icon VALUES ('fa-ruble');
INSERT INTO public.menu_icon VALUES ('fa-rupee');
INSERT INTO public.menu_icon VALUES ('fa-safari');
INSERT INTO public.menu_icon VALUES ('fa-save');
INSERT INTO public.menu_icon VALUES ('fa-scissors');
INSERT INTO public.menu_icon VALUES ('fa-scribd');
INSERT INTO public.menu_icon VALUES ('fa-search');
INSERT INTO public.menu_icon VALUES ('fa-search');
INSERT INTO public.menu_icon VALUES ('fa-search');
INSERT INTO public.menu_icon VALUES ('fa-sellsy');
INSERT INTO public.menu_icon VALUES ('fa-send');
INSERT INTO public.menu_icon VALUES ('fa-send');
INSERT INTO public.menu_icon VALUES ('fa-server');
INSERT INTO public.menu_icon VALUES ('fa-share');
INSERT INTO public.menu_icon VALUES ('fa-share');
INSERT INTO public.menu_icon VALUES ('fa-share');
INSERT INTO public.menu_icon VALUES ('fa-share');
INSERT INTO public.menu_icon VALUES ('fa-share');
INSERT INTO public.menu_icon VALUES ('fa-shekel');
INSERT INTO public.menu_icon VALUES ('fa-sheqel');
INSERT INTO public.menu_icon VALUES ('fa-shield');
INSERT INTO public.menu_icon VALUES ('fa-ship');
INSERT INTO public.menu_icon VALUES ('fa-shirtsinbulk');
INSERT INTO public.menu_icon VALUES ('fa-shopping');
INSERT INTO public.menu_icon VALUES ('fa-shopping');
INSERT INTO public.menu_icon VALUES ('fa-shopping');
INSERT INTO public.menu_icon VALUES ('fa-sign');
INSERT INTO public.menu_icon VALUES ('fa-sign');
INSERT INTO public.menu_icon VALUES ('fa-sign');
INSERT INTO public.menu_icon VALUES ('fa-signal');
INSERT INTO public.menu_icon VALUES ('fa-signing');
INSERT INTO public.menu_icon VALUES ('fa-simplybuilt');
INSERT INTO public.menu_icon VALUES ('fa-sitemap');
INSERT INTO public.menu_icon VALUES ('fa-skyatlas');
INSERT INTO public.menu_icon VALUES ('fa-skype');
INSERT INTO public.menu_icon VALUES ('fa-slack');
INSERT INTO public.menu_icon VALUES ('fa-sliders');
INSERT INTO public.menu_icon VALUES ('fa-slideshare');
INSERT INTO public.menu_icon VALUES ('fa-smile');
INSERT INTO public.menu_icon VALUES ('fa-snapchat');
INSERT INTO public.menu_icon VALUES ('fa-snapchat');
INSERT INTO public.menu_icon VALUES ('fa-snapchat');
INSERT INTO public.menu_icon VALUES ('fa-soccer');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-soundcloud');
INSERT INTO public.menu_icon VALUES ('fa-space');
INSERT INTO public.menu_icon VALUES ('fa-spinner');
INSERT INTO public.menu_icon VALUES ('fa-spoon');
INSERT INTO public.menu_icon VALUES ('fa-spotify');
INSERT INTO public.menu_icon VALUES ('fa-square');
INSERT INTO public.menu_icon VALUES ('fa-square');
INSERT INTO public.menu_icon VALUES ('fa-stack');
INSERT INTO public.menu_icon VALUES ('fa-stack');
INSERT INTO public.menu_icon VALUES ('fa-star');
INSERT INTO public.menu_icon VALUES ('fa-star');
INSERT INTO public.menu_icon VALUES ('fa-star');
INSERT INTO public.menu_icon VALUES ('fa-star');
INSERT INTO public.menu_icon VALUES ('fa-star');
INSERT INTO public.menu_icon VALUES ('fa-star');
INSERT INTO public.menu_icon VALUES ('fa-steam');
INSERT INTO public.menu_icon VALUES ('fa-steam');
INSERT INTO public.menu_icon VALUES ('fa-step');
INSERT INTO public.menu_icon VALUES ('fa-step');
INSERT INTO public.menu_icon VALUES ('fa-stethoscope');
INSERT INTO public.menu_icon VALUES ('fa-sticky');
INSERT INTO public.menu_icon VALUES ('fa-sticky');
INSERT INTO public.menu_icon VALUES ('fa-stop');
INSERT INTO public.menu_icon VALUES ('fa-stop');
INSERT INTO public.menu_icon VALUES ('fa-stop');
INSERT INTO public.menu_icon VALUES ('fa-street');
INSERT INTO public.menu_icon VALUES ('fa-strikethrough');
INSERT INTO public.menu_icon VALUES ('fa-stumbleupon');
INSERT INTO public.menu_icon VALUES ('fa-stumbleupon');
INSERT INTO public.menu_icon VALUES ('fa-subscript');
INSERT INTO public.menu_icon VALUES ('fa-subway');
INSERT INTO public.menu_icon VALUES ('fa-suitcase');
INSERT INTO public.menu_icon VALUES ('fa-sun');
INSERT INTO public.menu_icon VALUES ('fa-superscript');
INSERT INTO public.menu_icon VALUES ('fa-support');
INSERT INTO public.menu_icon VALUES ('fa-table');
INSERT INTO public.menu_icon VALUES ('fa-tablet');
INSERT INTO public.menu_icon VALUES ('fa-tachometer');
INSERT INTO public.menu_icon VALUES ('fa-tag');
INSERT INTO public.menu_icon VALUES ('fa-tags');
INSERT INTO public.menu_icon VALUES ('fa-tasks');
INSERT INTO public.menu_icon VALUES ('fa-taxi');
INSERT INTO public.menu_icon VALUES ('fa-television');
INSERT INTO public.menu_icon VALUES ('fa-tencent');
INSERT INTO public.menu_icon VALUES ('fa-terminal');
INSERT INTO public.menu_icon VALUES ('fa-text');
INSERT INTO public.menu_icon VALUES ('fa-text');
INSERT INTO public.menu_icon VALUES ('fa-th');
INSERT INTO public.menu_icon VALUES ('fa-th');
INSERT INTO public.menu_icon VALUES ('fa-th');
INSERT INTO public.menu_icon VALUES ('fa-themeisle');
INSERT INTO public.menu_icon VALUES ('fa-thumb');
INSERT INTO public.menu_icon VALUES ('fa-thumbs');
INSERT INTO public.menu_icon VALUES ('fa-thumbs');
INSERT INTO public.menu_icon VALUES ('fa-thumbs');
INSERT INTO public.menu_icon VALUES ('fa-thumbs');
INSERT INTO public.menu_icon VALUES ('fa-ticket');
INSERT INTO public.menu_icon VALUES ('fa-times');
INSERT INTO public.menu_icon VALUES ('fa-times');
INSERT INTO public.menu_icon VALUES ('fa-times');
INSERT INTO public.menu_icon VALUES ('fa-tint');
INSERT INTO public.menu_icon VALUES ('fa-toggle');
INSERT INTO public.menu_icon VALUES ('fa-toggle');
INSERT INTO public.menu_icon VALUES ('fa-toggle');
INSERT INTO public.menu_icon VALUES ('fa-toggle');
INSERT INTO public.menu_icon VALUES ('fa-toggle');
INSERT INTO public.menu_icon VALUES ('fa-toggle');
INSERT INTO public.menu_icon VALUES ('fa-trademark');
INSERT INTO public.menu_icon VALUES ('fa-train');
INSERT INTO public.menu_icon VALUES ('fa-transgender');
INSERT INTO public.menu_icon VALUES ('fa-transgender');
INSERT INTO public.menu_icon VALUES ('fa-trash');
INSERT INTO public.menu_icon VALUES ('fa-trash');
INSERT INTO public.menu_icon VALUES ('fa-tree');
INSERT INTO public.menu_icon VALUES ('fa-trello');
INSERT INTO public.menu_icon VALUES ('fa-tripadvisor');
INSERT INTO public.menu_icon VALUES ('fa-trophy');
INSERT INTO public.menu_icon VALUES ('fa-truck');
INSERT INTO public.menu_icon VALUES ('fa-try');
INSERT INTO public.menu_icon VALUES ('fa-tty');
INSERT INTO public.menu_icon VALUES ('fa-tumblr');
INSERT INTO public.menu_icon VALUES ('fa-tumblr');
INSERT INTO public.menu_icon VALUES ('fa-turkish');
INSERT INTO public.menu_icon VALUES ('fa-tv');
INSERT INTO public.menu_icon VALUES ('fa-twitch');
INSERT INTO public.menu_icon VALUES ('fa-twitter');
INSERT INTO public.menu_icon VALUES ('fa-twitter');
INSERT INTO public.menu_icon VALUES ('fa-umbrella');
INSERT INTO public.menu_icon VALUES ('fa-underline');
INSERT INTO public.menu_icon VALUES ('fa-undo');
INSERT INTO public.menu_icon VALUES ('fa-universal');
INSERT INTO public.menu_icon VALUES ('fa-university');
INSERT INTO public.menu_icon VALUES ('fa-unlink');
INSERT INTO public.menu_icon VALUES ('fa-unlock');
INSERT INTO public.menu_icon VALUES ('fa-unlock');
INSERT INTO public.menu_icon VALUES ('fa-unsorted');
INSERT INTO public.menu_icon VALUES ('fa-upload');
INSERT INTO public.menu_icon VALUES ('fa-usb');
INSERT INTO public.menu_icon VALUES ('fa-usd');
INSERT INTO public.menu_icon VALUES ('fa-user');
INSERT INTO public.menu_icon VALUES ('fa-user');
INSERT INTO public.menu_icon VALUES ('fa-user');
INSERT INTO public.menu_icon VALUES ('fa-user');
INSERT INTO public.menu_icon VALUES ('fa-user');
INSERT INTO public.menu_icon VALUES ('fa-users');
INSERT INTO public.menu_icon VALUES ('fa-venus');
INSERT INTO public.menu_icon VALUES ('fa-venus');
INSERT INTO public.menu_icon VALUES ('fa-venus');
INSERT INTO public.menu_icon VALUES ('fa-viacoin');
INSERT INTO public.menu_icon VALUES ('fa-viadeo');
INSERT INTO public.menu_icon VALUES ('fa-viadeo');
INSERT INTO public.menu_icon VALUES ('fa-video');
INSERT INTO public.menu_icon VALUES ('fa-vimeo');
INSERT INTO public.menu_icon VALUES ('fa-vimeo');
INSERT INTO public.menu_icon VALUES ('fa-vine');
INSERT INTO public.menu_icon VALUES ('fa-vk');
INSERT INTO public.menu_icon VALUES ('fa-volume');
INSERT INTO public.menu_icon VALUES ('fa-volume');
INSERT INTO public.menu_icon VALUES ('fa-volume');
INSERT INTO public.menu_icon VALUES ('fa-volume');
INSERT INTO public.menu_icon VALUES ('fa-warning');
INSERT INTO public.menu_icon VALUES ('fa-wechat');
INSERT INTO public.menu_icon VALUES ('fa-weibo');
INSERT INTO public.menu_icon VALUES ('fa-weixin');
INSERT INTO public.menu_icon VALUES ('fa-whatsapp');
INSERT INTO public.menu_icon VALUES ('fa-wheelchair');
INSERT INTO public.menu_icon VALUES ('fa-wheelchair');
INSERT INTO public.menu_icon VALUES ('fa-wifi');
INSERT INTO public.menu_icon VALUES ('fa-wikipedia');
INSERT INTO public.menu_icon VALUES ('fa-windows');
INSERT INTO public.menu_icon VALUES ('fa-won');
INSERT INTO public.menu_icon VALUES ('fa-wordpress');
INSERT INTO public.menu_icon VALUES ('fa-wpbeginner');
INSERT INTO public.menu_icon VALUES ('fa-wpforms');
INSERT INTO public.menu_icon VALUES ('fa-wrench');
INSERT INTO public.menu_icon VALUES ('fa-xing');
INSERT INTO public.menu_icon VALUES ('fa-xing');
INSERT INTO public.menu_icon VALUES ('fa-y');
INSERT INTO public.menu_icon VALUES ('fa-y');
INSERT INTO public.menu_icon VALUES ('fa-yahoo');
INSERT INTO public.menu_icon VALUES ('fa-yc');
INSERT INTO public.menu_icon VALUES ('fa-yc');
INSERT INTO public.menu_icon VALUES ('fa-yelp');
INSERT INTO public.menu_icon VALUES ('fa-yen');
INSERT INTO public.menu_icon VALUES ('fa-yoast');
INSERT INTO public.menu_icon VALUES ('fa-youtube');
INSERT INTO public.menu_icon VALUES ('fa-youtube');
INSERT INTO public.menu_icon VALUES ('fa-youtube');
INSERT INTO public.menu_icon VALUES ('fa-500px');
INSERT INTO public.menu_icon VALUES ('fa-adjust');
INSERT INTO public.menu_icon VALUES ('fa-adn');
INSERT INTO public.menu_icon VALUES ('fa-align');
INSERT INTO public.menu_icon VALUES ('fa-align');
INSERT INTO public.menu_icon VALUES ('fa-align');
INSERT INTO public.menu_icon VALUES ('fa-align');
INSERT INTO public.menu_icon VALUES ('fa-amazon');
INSERT INTO public.menu_icon VALUES ('fa-ambulance');
INSERT INTO public.menu_icon VALUES ('fa-american');
INSERT INTO public.menu_icon VALUES ('fa-anchor');
INSERT INTO public.menu_icon VALUES ('fa-android');
INSERT INTO public.menu_icon VALUES ('fa-angellist');
INSERT INTO public.menu_icon VALUES ('fa-angle');
INSERT INTO public.menu_icon VALUES ('fa-angle');
INSERT INTO public.menu_icon VALUES ('fa-angle');
INSERT INTO public.menu_icon VALUES ('fa-angle');
INSERT INTO public.menu_icon VALUES ('fa-angle');
INSERT INTO public.menu_icon VALUES ('fa-angle');
INSERT INTO public.menu_icon VALUES ('fa-angle');
INSERT INTO public.menu_icon VALUES ('fa-angle');
INSERT INTO public.menu_icon VALUES ('fa-apple');
INSERT INTO public.menu_icon VALUES ('fa-archive');
INSERT INTO public.menu_icon VALUES ('fa-area');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrow');
INSERT INTO public.menu_icon VALUES ('fa-arrows');
INSERT INTO public.menu_icon VALUES ('fa-arrows');
INSERT INTO public.menu_icon VALUES ('fa-arrows');
INSERT INTO public.menu_icon VALUES ('fa-arrows');
INSERT INTO public.menu_icon VALUES ('fa-asl');
INSERT INTO public.menu_icon VALUES ('fa-assistive');
INSERT INTO public.menu_icon VALUES ('fa-asterisk');
INSERT INTO public.menu_icon VALUES ('fa-at');
INSERT INTO public.menu_icon VALUES ('fa-audio');
INSERT INTO public.menu_icon VALUES ('fa-automobile');
INSERT INTO public.menu_icon VALUES ('fa-backward');
INSERT INTO public.menu_icon VALUES ('fa-balance');
INSERT INTO public.menu_icon VALUES ('fa-ban');
INSERT INTO public.menu_icon VALUES ('fa-bank');
INSERT INTO public.menu_icon VALUES ('fa-bar');
INSERT INTO public.menu_icon VALUES ('fa-bar');
INSERT INTO public.menu_icon VALUES ('fa-barcode');
INSERT INTO public.menu_icon VALUES ('fa-bars');
INSERT INTO public.menu_icon VALUES ('fa-battery');
INSERT INTO public.menu_icon VALUES ('fa-battery');
INSERT INTO public.menu_icon VALUES ('fa-battery');
INSERT INTO public.menu_icon VALUES ('fa-battery');
INSERT INTO public.menu_icon VALUES ('fa-battery');
INSERT INTO public.menu_icon VALUES ('fa-battery');
INSERT INTO public.menu_icon VALUES ('fa-battery');
INSERT INTO public.menu_icon VALUES ('fa-battery');
INSERT INTO public.menu_icon VALUES ('fa-battery');
INSERT INTO public.menu_icon VALUES ('fa-battery');
INSERT INTO public.menu_icon VALUES ('fa-bed');
INSERT INTO public.menu_icon VALUES ('fa-beer');
INSERT INTO public.menu_icon VALUES ('fa-behance');
INSERT INTO public.menu_icon VALUES ('fa-behance');
INSERT INTO public.menu_icon VALUES ('fa-bell');
INSERT INTO public.menu_icon VALUES ('fa-bell');
INSERT INTO public.menu_icon VALUES ('fa-bell');
INSERT INTO public.menu_icon VALUES ('fa-bell');
INSERT INTO public.menu_icon VALUES ('fa-bicycle');
INSERT INTO public.menu_icon VALUES ('fa-binoculars');
INSERT INTO public.menu_icon VALUES ('fa-birthday');
INSERT INTO public.menu_icon VALUES ('fa-bitbucket');
INSERT INTO public.menu_icon VALUES ('fa-bitbucket');
INSERT INTO public.menu_icon VALUES ('fa-bitcoin');
INSERT INTO public.menu_icon VALUES ('fa-black');
INSERT INTO public.menu_icon VALUES ('fa-blind');
INSERT INTO public.menu_icon VALUES ('fa-bluetooth');
INSERT INTO public.menu_icon VALUES ('fa-bluetooth');
INSERT INTO public.menu_icon VALUES ('fa-bold');
INSERT INTO public.menu_icon VALUES ('fa-bolt');
INSERT INTO public.menu_icon VALUES ('fa-bomb');
INSERT INTO public.menu_icon VALUES ('fa-book');
INSERT INTO public.menu_icon VALUES ('fa-bookmark');
INSERT INTO public.menu_icon VALUES ('fa-bookmark');
INSERT INTO public.menu_icon VALUES ('fa-braille');
INSERT INTO public.menu_icon VALUES ('fa-briefcase');
INSERT INTO public.menu_icon VALUES ('fa-btc');
INSERT INTO public.menu_icon VALUES ('fa-bug');
INSERT INTO public.menu_icon VALUES ('fa-building');
INSERT INTO public.menu_icon VALUES ('fa-building');
INSERT INTO public.menu_icon VALUES ('fa-bullhorn');
INSERT INTO public.menu_icon VALUES ('fa-bullseye');
INSERT INTO public.menu_icon VALUES ('fa-bus');
INSERT INTO public.menu_icon VALUES ('fa-buysellads');
INSERT INTO public.menu_icon VALUES ('fa-cab');
INSERT INTO public.menu_icon VALUES ('fa-calculator');
INSERT INTO public.menu_icon VALUES ('fa-calendar');
INSERT INTO public.menu_icon VALUES ('fa-calendar');
INSERT INTO public.menu_icon VALUES ('fa-calendar');
INSERT INTO public.menu_icon VALUES ('fa-calendar');
INSERT INTO public.menu_icon VALUES ('fa-calendar');
INSERT INTO public.menu_icon VALUES ('fa-calendar');
INSERT INTO public.menu_icon VALUES ('fa-camera');
INSERT INTO public.menu_icon VALUES ('fa-camera');
INSERT INTO public.menu_icon VALUES ('fa-car');
INSERT INTO public.menu_icon VALUES ('fa-caret');
INSERT INTO public.menu_icon VALUES ('fa-caret');
INSERT INTO public.menu_icon VALUES ('fa-caret');
INSERT INTO public.menu_icon VALUES ('fa-caret');
INSERT INTO public.menu_icon VALUES ('fa-caret');
INSERT INTO public.menu_icon VALUES ('fa-caret');
INSERT INTO public.menu_icon VALUES ('fa-caret');
INSERT INTO public.menu_icon VALUES ('fa-caret');
INSERT INTO public.menu_icon VALUES ('fa-cart');
INSERT INTO public.menu_icon VALUES ('fa-cart');
INSERT INTO public.menu_icon VALUES ('fa-cc');
INSERT INTO public.menu_icon VALUES ('fa-cc');
INSERT INTO public.menu_icon VALUES ('fa-cc');
INSERT INTO public.menu_icon VALUES ('fa-cc');
INSERT INTO public.menu_icon VALUES ('fa-cc');
INSERT INTO public.menu_icon VALUES ('fa-cc');
INSERT INTO public.menu_icon VALUES ('fa-cc');
INSERT INTO public.menu_icon VALUES ('fa-cc');
INSERT INTO public.menu_icon VALUES ('fa-cc');
INSERT INTO public.menu_icon VALUES ('fa-certificate');
INSERT INTO public.menu_icon VALUES ('fa-chain');
INSERT INTO public.menu_icon VALUES ('fa-chain');
INSERT INTO public.menu_icon VALUES ('fa-check');
INSERT INTO public.menu_icon VALUES ('fa-check');
INSERT INTO public.menu_icon VALUES ('fa-check');
INSERT INTO public.menu_icon VALUES ('fa-check');
INSERT INTO public.menu_icon VALUES ('fa-check');
INSERT INTO public.menu_icon VALUES ('fa-chevron');
INSERT INTO public.menu_icon VALUES ('fa-chevron');
INSERT INTO public.menu_icon VALUES ('fa-chevron');
INSERT INTO public.menu_icon VALUES ('fa-chevron');
INSERT INTO public.menu_icon VALUES ('fa-chevron');
INSERT INTO public.menu_icon VALUES ('fa-chevron');
INSERT INTO public.menu_icon VALUES ('fa-chevron');
INSERT INTO public.menu_icon VALUES ('fa-chevron');
INSERT INTO public.menu_icon VALUES ('fa-child');
INSERT INTO public.menu_icon VALUES ('fa-chrome');
INSERT INTO public.menu_icon VALUES ('fa-circle');
INSERT INTO public.menu_icon VALUES ('fa-circle');
INSERT INTO public.menu_icon VALUES ('fa-circle');
INSERT INTO public.menu_icon VALUES ('fa-circle');
INSERT INTO public.menu_icon VALUES ('fa-clipboard');
INSERT INTO public.menu_icon VALUES ('fa-clock');
INSERT INTO public.menu_icon VALUES ('fa-clone');
INSERT INTO public.menu_icon VALUES ('fa-close');
INSERT INTO public.menu_icon VALUES ('fa-cloud');
INSERT INTO public.menu_icon VALUES ('fa-cloud');
INSERT INTO public.menu_icon VALUES ('fa-cloud');
INSERT INTO public.menu_icon VALUES ('fa-cny');
INSERT INTO public.menu_icon VALUES ('fa-code');
INSERT INTO public.menu_icon VALUES ('fa-code');
INSERT INTO public.menu_icon VALUES ('fa-codepen');
INSERT INTO public.menu_icon VALUES ('fa-codiepie');
INSERT INTO public.menu_icon VALUES ('fa-coffee');
INSERT INTO public.menu_icon VALUES ('fa-cog');
INSERT INTO public.menu_icon VALUES ('fa-cogs');
INSERT INTO public.menu_icon VALUES ('fa-columns');
INSERT INTO public.menu_icon VALUES ('fa-comment');
INSERT INTO public.menu_icon VALUES ('fa-comment');
INSERT INTO public.menu_icon VALUES ('fa-commenting');
INSERT INTO public.menu_icon VALUES ('fa-commenting');
INSERT INTO public.menu_icon VALUES ('fa-comments');
INSERT INTO public.menu_icon VALUES ('fa-comments');
INSERT INTO public.menu_icon VALUES ('fa-compass');
INSERT INTO public.menu_icon VALUES ('fa-compress');
INSERT INTO public.menu_icon VALUES ('fa-connectdevelop');
INSERT INTO public.menu_icon VALUES ('fa-contao');
INSERT INTO public.menu_icon VALUES ('fa-copy');
INSERT INTO public.menu_icon VALUES ('fa-copyright');
INSERT INTO public.menu_icon VALUES ('fa-creative');
INSERT INTO public.menu_icon VALUES ('fa-credit');
INSERT INTO public.menu_icon VALUES ('fa-credit');
INSERT INTO public.menu_icon VALUES ('fa-crop');
INSERT INTO public.menu_icon VALUES ('fa-crosshairs');
INSERT INTO public.menu_icon VALUES ('fa-css3');
INSERT INTO public.menu_icon VALUES ('fa-cube');
INSERT INTO public.menu_icon VALUES ('fa-cubes');
INSERT INTO public.menu_icon VALUES ('fa-cut');
INSERT INTO public.menu_icon VALUES ('fa-cutlery');
INSERT INTO public.menu_icon VALUES ('fa-dashboard');
INSERT INTO public.menu_icon VALUES ('fa-dashcube');
INSERT INTO public.menu_icon VALUES ('fa-database');
INSERT INTO public.menu_icon VALUES ('fa-deaf');
INSERT INTO public.menu_icon VALUES ('fa-deafness');
INSERT INTO public.menu_icon VALUES ('fa-dedent');
INSERT INTO public.menu_icon VALUES ('fa-delicious');
INSERT INTO public.menu_icon VALUES ('fa-desktop');
INSERT INTO public.menu_icon VALUES ('fa-deviantart');
INSERT INTO public.menu_icon VALUES ('fa-diamond');
INSERT INTO public.menu_icon VALUES ('fa-digg');
INSERT INTO public.menu_icon VALUES ('fa-dollar');
INSERT INTO public.menu_icon VALUES ('fa-dot');
INSERT INTO public.menu_icon VALUES ('fa-download');
INSERT INTO public.menu_icon VALUES ('fa-dribbble');
INSERT INTO public.menu_icon VALUES ('fa-dropbox');
INSERT INTO public.menu_icon VALUES ('fa-drupal');
INSERT INTO public.menu_icon VALUES ('fa-edge');
INSERT INTO public.menu_icon VALUES ('fa-edit');
INSERT INTO public.menu_icon VALUES ('fa-eject');
INSERT INTO public.menu_icon VALUES ('fa-ellipsis');
INSERT INTO public.menu_icon VALUES ('fa-ellipsis');
INSERT INTO public.menu_icon VALUES ('fa-empire');
INSERT INTO public.menu_icon VALUES ('fa-envelope');
INSERT INTO public.menu_icon VALUES ('fa-envelope');
INSERT INTO public.menu_icon VALUES ('fa-envelope');
INSERT INTO public.menu_icon VALUES ('fa-envira');
INSERT INTO public.menu_icon VALUES ('fa-eraser');
INSERT INTO public.menu_icon VALUES ('fa-eur');
INSERT INTO public.menu_icon VALUES ('fa-euro');
INSERT INTO public.menu_icon VALUES ('fa-exchange');
INSERT INTO public.menu_icon VALUES ('fa-exclamation');
INSERT INTO public.menu_icon VALUES ('fa-exclamation');
INSERT INTO public.menu_icon VALUES ('fa-exclamation');
INSERT INTO public.menu_icon VALUES ('fa-expand');
INSERT INTO public.menu_icon VALUES ('fa-expeditedssl');
INSERT INTO public.menu_icon VALUES ('fa-external');
INSERT INTO public.menu_icon VALUES ('fa-external');
INSERT INTO public.menu_icon VALUES ('fa-eye');
INSERT INTO public.menu_icon VALUES ('fa-eye');
INSERT INTO public.menu_icon VALUES ('fa-eyedropper');
INSERT INTO public.menu_icon VALUES ('fa-fa');
INSERT INTO public.menu_icon VALUES ('fa-facebook');
INSERT INTO public.menu_icon VALUES ('fa-facebook');
INSERT INTO public.menu_icon VALUES ('fa-facebook');
INSERT INTO public.menu_icon VALUES ('fa-facebook');
INSERT INTO public.menu_icon VALUES ('fa-fast');
INSERT INTO public.menu_icon VALUES ('fa-fast');
INSERT INTO public.menu_icon VALUES ('fa-fax');
INSERT INTO public.menu_icon VALUES ('fa-feed');
INSERT INTO public.menu_icon VALUES ('fa-female');
INSERT INTO public.menu_icon VALUES ('fa-fighter');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-file');
INSERT INTO public.menu_icon VALUES ('fa-files');
INSERT INTO public.menu_icon VALUES ('fa-film');
INSERT INTO public.menu_icon VALUES ('fa-filter');
INSERT INTO public.menu_icon VALUES ('fa-fire');
INSERT INTO public.menu_icon VALUES ('fa-fire');
INSERT INTO public.menu_icon VALUES ('fa-firefox');
INSERT INTO public.menu_icon VALUES ('fa-first');
INSERT INTO public.menu_icon VALUES ('fa-flag');
INSERT INTO public.menu_icon VALUES ('fa-flag');
INSERT INTO public.menu_icon VALUES ('fa-flag');
INSERT INTO public.menu_icon VALUES ('fa-flash');
INSERT INTO public.menu_icon VALUES ('fa-flask');
INSERT INTO public.menu_icon VALUES ('fa-flickr');
INSERT INTO public.menu_icon VALUES ('fa-floppy');
INSERT INTO public.menu_icon VALUES ('fa-folder');
INSERT INTO public.menu_icon VALUES ('fa-folder');
INSERT INTO public.menu_icon VALUES ('fa-folder');
INSERT INTO public.menu_icon VALUES ('fa-folder');
INSERT INTO public.menu_icon VALUES ('fa-font');
INSERT INTO public.menu_icon VALUES ('fa-font');
INSERT INTO public.menu_icon VALUES ('fa-fonticons');
INSERT INTO public.menu_icon VALUES ('fa-fort');
INSERT INTO public.menu_icon VALUES ('fa-forumbee');
INSERT INTO public.menu_icon VALUES ('fa-forward');
INSERT INTO public.menu_icon VALUES ('fa-foursquare');
INSERT INTO public.menu_icon VALUES ('fa-frown');
INSERT INTO public.menu_icon VALUES ('fa-futbol');
INSERT INTO public.menu_icon VALUES ('fa-gamepad');
INSERT INTO public.menu_icon VALUES ('fa-gavel');
INSERT INTO public.menu_icon VALUES ('fa-gbp');
INSERT INTO public.menu_icon VALUES ('fa-ge');
INSERT INTO public.menu_icon VALUES ('fa-gear');
INSERT INTO public.menu_icon VALUES ('fa-gears');
INSERT INTO public.menu_icon VALUES ('fa-genderless');
INSERT INTO public.menu_icon VALUES ('fa-get');
INSERT INTO public.menu_icon VALUES ('fa-gg');
INSERT INTO public.menu_icon VALUES ('fa-gg');
INSERT INTO public.menu_icon VALUES ('fa-gift');
INSERT INTO public.menu_icon VALUES ('fa-git');
INSERT INTO public.menu_icon VALUES ('fa-git');
INSERT INTO public.menu_icon VALUES ('fa-github');
INSERT INTO public.menu_icon VALUES ('fa-github');
INSERT INTO public.menu_icon VALUES ('fa-github');
INSERT INTO public.menu_icon VALUES ('fa-gitlab');
INSERT INTO public.menu_icon VALUES ('fa-gittip');
INSERT INTO public.menu_icon VALUES ('fa-glass');
INSERT INTO public.menu_icon VALUES ('fa-glide');
INSERT INTO public.menu_icon VALUES ('fa-glide');
INSERT INTO public.menu_icon VALUES ('fa-globe');
INSERT INTO public.menu_icon VALUES ('fa-google');
INSERT INTO public.menu_icon VALUES ('fa-google');
INSERT INTO public.menu_icon VALUES ('fa-google');
INSERT INTO public.menu_icon VALUES ('fa-google');
INSERT INTO public.menu_icon VALUES ('fa-google');
INSERT INTO public.menu_icon VALUES ('fa-google');
INSERT INTO public.menu_icon VALUES ('fa-graduation');
INSERT INTO public.menu_icon VALUES ('fa-gratipay');
INSERT INTO public.menu_icon VALUES ('fa-group');
INSERT INTO public.menu_icon VALUES ('fa-h');
INSERT INTO public.menu_icon VALUES ('fa-hacker');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hand');
INSERT INTO public.menu_icon VALUES ('fa-hard');
INSERT INTO public.menu_icon VALUES ('fa-hashtag');
INSERT INTO public.menu_icon VALUES ('fa-hdd');
INSERT INTO public.menu_icon VALUES ('fa-header');
INSERT INTO public.menu_icon VALUES ('fa-headphones');
INSERT INTO public.menu_icon VALUES ('fa-heart');
INSERT INTO public.menu_icon VALUES ('fa-heart');
INSERT INTO public.menu_icon VALUES ('fa-heartbeat');
INSERT INTO public.menu_icon VALUES ('fa-history');
INSERT INTO public.menu_icon VALUES ('fa-home');
INSERT INTO public.menu_icon VALUES ('fa-hospital');
INSERT INTO public.menu_icon VALUES ('fa-hotel');
INSERT INTO public.menu_icon VALUES ('fa-hourglass');
INSERT INTO public.menu_icon VALUES ('fa-hourglass');
INSERT INTO public.menu_icon VALUES ('fa-hourglass');
INSERT INTO public.menu_icon VALUES ('fa-hourglass');
INSERT INTO public.menu_icon VALUES ('fa-hourglass');
INSERT INTO public.menu_icon VALUES ('fa-hourglass');
INSERT INTO public.menu_icon VALUES ('fa-hourglass');
INSERT INTO public.menu_icon VALUES ('fa-hourglass');
INSERT INTO public.menu_icon VALUES ('fa-houzz');
INSERT INTO public.menu_icon VALUES ('fa-html5');
INSERT INTO public.menu_icon VALUES ('fa-i');
INSERT INTO public.menu_icon VALUES ('fa-ils');
INSERT INTO public.menu_icon VALUES ('fa-image');
INSERT INTO public.menu_icon VALUES ('fa-inbox');
INSERT INTO public.menu_icon VALUES ('fa-indent');
INSERT INTO public.menu_icon VALUES ('fa-industry');
INSERT INTO public.menu_icon VALUES ('fa-info');
INSERT INTO public.menu_icon VALUES ('fa-info');
INSERT INTO public.menu_icon VALUES ('fa-inr');
INSERT INTO public.menu_icon VALUES ('fa-instagram');
INSERT INTO public.menu_icon VALUES ('fa-institution');
INSERT INTO public.menu_icon VALUES ('fa-internet');
INSERT INTO public.menu_icon VALUES ('fa-intersex');
INSERT INTO public.menu_icon VALUES ('fa-ioxhost');
INSERT INTO public.menu_icon VALUES ('fa-italic');
INSERT INTO public.menu_icon VALUES ('fa-joomla');
INSERT INTO public.menu_icon VALUES ('fa-jpy');
INSERT INTO public.menu_icon VALUES ('fa-jsfiddle');
INSERT INTO public.menu_icon VALUES ('fa-key');
INSERT INTO public.menu_icon VALUES ('fa-keyboard');
INSERT INTO public.menu_icon VALUES ('fa-krw');
INSERT INTO public.menu_icon VALUES ('fa-language');
INSERT INTO public.menu_icon VALUES ('fa-laptop');
INSERT INTO public.menu_icon VALUES ('fa-lastfm');
INSERT INTO public.menu_icon VALUES ('fa-lastfm');
INSERT INTO public.menu_icon VALUES ('fa-leaf');
INSERT INTO public.menu_icon VALUES ('fa-leanpub');
INSERT INTO public.menu_icon VALUES ('fa-legal');
INSERT INTO public.menu_icon VALUES ('fa-lemon');
INSERT INTO public.menu_icon VALUES ('fa-level');
INSERT INTO public.menu_icon VALUES ('fa-level');
INSERT INTO public.menu_icon VALUES ('fa-life');
INSERT INTO public.menu_icon VALUES ('fa-life');
INSERT INTO public.menu_icon VALUES ('fa-life');
INSERT INTO public.menu_icon VALUES ('fa-life');
INSERT INTO public.menu_icon VALUES ('fa-lightbulb');
INSERT INTO public.menu_icon VALUES ('fa-line');
INSERT INTO public.menu_icon VALUES ('fa-link');
INSERT INTO public.menu_icon VALUES ('fa-linkedin');
INSERT INTO public.menu_icon VALUES ('fa-linkedin');
INSERT INTO public.menu_icon VALUES ('fa-linux');
INSERT INTO public.menu_icon VALUES ('fa-list');
INSERT INTO public.menu_icon VALUES ('fa-list');
INSERT INTO public.menu_icon VALUES ('fa-list');
INSERT INTO public.menu_icon VALUES ('fa-list');
INSERT INTO public.menu_icon VALUES ('fa-location');
INSERT INTO public.menu_icon VALUES ('fa-lock');
INSERT INTO public.menu_icon VALUES ('fa-long');
INSERT INTO public.menu_icon VALUES ('fa-long');
INSERT INTO public.menu_icon VALUES ('fa-long');
INSERT INTO public.menu_icon VALUES ('fa-long');
INSERT INTO public.menu_icon VALUES ('fa-low');
INSERT INTO public.menu_icon VALUES ('fa-magic');
INSERT INTO public.menu_icon VALUES ('fa-magnet');
INSERT INTO public.menu_icon VALUES ('fa-mail');
INSERT INTO public.menu_icon VALUES ('fa-mail');
INSERT INTO public.menu_icon VALUES ('fa-mail');
INSERT INTO public.menu_icon VALUES ('fa-male');
INSERT INTO public.menu_icon VALUES ('fa-map');
INSERT INTO public.menu_icon VALUES ('fa-map');
INSERT INTO public.menu_icon VALUES ('fa-map');
INSERT INTO public.menu_icon VALUES ('fa-map');
INSERT INTO public.menu_icon VALUES ('fa-map');
INSERT INTO public.menu_icon VALUES ('fa-mars');
INSERT INTO public.menu_icon VALUES ('fa-mars');
INSERT INTO public.menu_icon VALUES ('fa-mars');
INSERT INTO public.menu_icon VALUES ('fa-mars');
INSERT INTO public.menu_icon VALUES ('fa-mars');
INSERT INTO public.menu_icon VALUES ('fa-maxcdn');
INSERT INTO public.menu_icon VALUES ('fa-meanpath');
INSERT INTO public.menu_icon VALUES ('fa-medium');
INSERT INTO public.menu_icon VALUES ('fa-medkit');
INSERT INTO public.menu_icon VALUES ('fa-meh');
INSERT INTO public.menu_icon VALUES ('fa-mercury');
INSERT INTO public.menu_icon VALUES ('fa-microphone');
INSERT INTO public.menu_icon VALUES ('fa-microphone');
INSERT INTO public.menu_icon VALUES ('fa-minus');
INSERT INTO public.menu_icon VALUES ('fa-minus');
INSERT INTO public.menu_icon VALUES ('fa-minus');
INSERT INTO public.menu_icon VALUES ('fa-minus');
INSERT INTO public.menu_icon VALUES ('fa-mixcloud');
INSERT INTO public.menu_icon VALUES ('fa-mobile');
INSERT INTO public.menu_icon VALUES ('fa-mobile');
INSERT INTO public.menu_icon VALUES ('fa-modx');
INSERT INTO public.menu_icon VALUES ('fa-money');
INSERT INTO public.menu_icon VALUES ('fa-moon');
INSERT INTO public.menu_icon VALUES ('fa-mortar');
INSERT INTO public.menu_icon VALUES ('fa-motorcycle');
INSERT INTO public.menu_icon VALUES ('fa-mouse');
INSERT INTO public.menu_icon VALUES ('fa-music');
INSERT INTO public.menu_icon VALUES ('fa-navicon');
INSERT INTO public.menu_icon VALUES ('fa-neuter');
INSERT INTO public.menu_icon VALUES ('fa-newspaper');
INSERT INTO public.menu_icon VALUES ('fa-object');
INSERT INTO public.menu_icon VALUES ('fa-object');
INSERT INTO public.menu_icon VALUES ('fa-odnoklassniki');
INSERT INTO public.menu_icon VALUES ('fa-odnoklassniki');
INSERT INTO public.menu_icon VALUES ('fa-opencart');
INSERT INTO public.menu_icon VALUES ('fa-openid');
INSERT INTO public.menu_icon VALUES ('fa-opera');
INSERT INTO public.menu_icon VALUES ('fa-optin');
INSERT INTO public.menu_icon VALUES ('fa-outdent');
INSERT INTO public.menu_icon VALUES ('fa-pagelines');
INSERT INTO public.menu_icon VALUES ('fa-paint');
INSERT INTO public.menu_icon VALUES ('fa-paper');
INSERT INTO public.menu_icon VALUES ('fa-paper');
INSERT INTO public.menu_icon VALUES ('fa-paperclip');
INSERT INTO public.menu_icon VALUES ('fa-paragraph');
INSERT INTO public.menu_icon VALUES ('fa-paste');
INSERT INTO public.menu_icon VALUES ('fa-pause');
INSERT INTO public.menu_icon VALUES ('fa-pause');
INSERT INTO public.menu_icon VALUES ('fa-pause');
INSERT INTO public.menu_icon VALUES ('fa-paw');
INSERT INTO public.menu_icon VALUES ('fa-paypal');
INSERT INTO public.menu_icon VALUES ('fa-pencil');
INSERT INTO public.menu_icon VALUES ('fa-pencil');
INSERT INTO public.menu_icon VALUES ('fa-pencil');
INSERT INTO public.menu_icon VALUES ('fa-percent');
INSERT INTO public.menu_icon VALUES ('fa-phone');
INSERT INTO public.menu_icon VALUES ('fa-phone');
INSERT INTO public.menu_icon VALUES ('fa-photo');
INSERT INTO public.menu_icon VALUES ('fa-picture');
INSERT INTO public.menu_icon VALUES ('fa-pie');
INSERT INTO public.menu_icon VALUES ('fa-pied');
INSERT INTO public.menu_icon VALUES ('fa-pied');
INSERT INTO public.menu_icon VALUES ('fa-pied');
INSERT INTO public.menu_icon VALUES ('fa-pinterest');
INSERT INTO public.menu_icon VALUES ('fa-pinterest');
INSERT INTO public.menu_icon VALUES ('fa-pinterest');
INSERT INTO public.menu_icon VALUES ('fa-plane');
INSERT INTO public.menu_icon VALUES ('fa-play');
INSERT INTO public.menu_icon VALUES ('fa-play');
INSERT INTO public.menu_icon VALUES ('fa-play');
INSERT INTO public.menu_icon VALUES ('fa-plug');
INSERT INTO public.menu_icon VALUES ('fa-plus');
INSERT INTO public.menu_icon VALUES ('fa-plus');
INSERT INTO public.menu_icon VALUES ('fa-plus');
INSERT INTO public.menu_icon VALUES ('fa-plus');
INSERT INTO public.menu_icon VALUES ('fa-power');
INSERT INTO public.menu_icon VALUES ('fa-print');
INSERT INTO public.menu_icon VALUES ('fa-product');
INSERT INTO public.menu_icon VALUES ('fa-puzzle');
INSERT INTO public.menu_icon VALUES ('fa-qq');
INSERT INTO public.menu_icon VALUES ('fa-qrcode');
INSERT INTO public.menu_icon VALUES ('fa-question');
INSERT INTO public.menu_icon VALUES ('fa-question');
INSERT INTO public.menu_icon VALUES ('fa-question');
INSERT INTO public.menu_icon VALUES ('fa-quote');
INSERT INTO public.menu_icon VALUES ('fa-quote');
INSERT INTO public.menu_icon VALUES ('fa-ra');
INSERT INTO public.menu_icon VALUES ('fa-random');
INSERT INTO public.menu_icon VALUES ('fa-rebel');
INSERT INTO public.menu_icon VALUES ('fa-recycle');
INSERT INTO public.menu_icon VALUES ('fa-reddit');
INSERT INTO public.menu_icon VALUES ('fa-reddit');
INSERT INTO public.menu_icon VALUES ('fa-reddit');
INSERT INTO public.menu_icon VALUES ('fa-refresh');
INSERT INTO public.menu_icon VALUES ('fa-registered');
INSERT INTO public.menu_icon VALUES ('fa-remove');
INSERT INTO public.menu_icon VALUES ('fa-renren');
INSERT INTO public.menu_icon VALUES ('fa-reorder');
INSERT INTO public.menu_icon VALUES ('fa-repeat');
INSERT INTO public.menu_icon VALUES ('fa-reply');
INSERT INTO public.menu_icon VALUES ('fa-reply');
INSERT INTO public.menu_icon VALUES ('fa-resistance');
INSERT INTO public.menu_icon VALUES ('fa-retweet');
INSERT INTO public.menu_icon VALUES ('fa-rmb');
INSERT INTO public.menu_icon VALUES ('fa-road');
INSERT INTO public.menu_icon VALUES ('fa-rocket');
INSERT INTO public.menu_icon VALUES ('fa-rotate');
INSERT INTO public.menu_icon VALUES ('fa-rotate');
INSERT INTO public.menu_icon VALUES ('fa-rouble');
INSERT INTO public.menu_icon VALUES ('fa-rss');
INSERT INTO public.menu_icon VALUES ('fa-rss');
INSERT INTO public.menu_icon VALUES ('fa-rub');
INSERT INTO public.menu_icon VALUES ('fa-ruble');
INSERT INTO public.menu_icon VALUES ('fa-rupee');
INSERT INTO public.menu_icon VALUES ('fa-safari');
INSERT INTO public.menu_icon VALUES ('fa-save');
INSERT INTO public.menu_icon VALUES ('fa-scissors');
INSERT INTO public.menu_icon VALUES ('fa-scribd');
INSERT INTO public.menu_icon VALUES ('fa-search');
INSERT INTO public.menu_icon VALUES ('fa-search');
INSERT INTO public.menu_icon VALUES ('fa-search');
INSERT INTO public.menu_icon VALUES ('fa-sellsy');
INSERT INTO public.menu_icon VALUES ('fa-send');
INSERT INTO public.menu_icon VALUES ('fa-send');
INSERT INTO public.menu_icon VALUES ('fa-server');
INSERT INTO public.menu_icon VALUES ('fa-share');
INSERT INTO public.menu_icon VALUES ('fa-share');
INSERT INTO public.menu_icon VALUES ('fa-share');
INSERT INTO public.menu_icon VALUES ('fa-share');
INSERT INTO public.menu_icon VALUES ('fa-share');
INSERT INTO public.menu_icon VALUES ('fa-shekel');
INSERT INTO public.menu_icon VALUES ('fa-sheqel');
INSERT INTO public.menu_icon VALUES ('fa-shield');
INSERT INTO public.menu_icon VALUES ('fa-ship');
INSERT INTO public.menu_icon VALUES ('fa-shirtsinbulk');
INSERT INTO public.menu_icon VALUES ('fa-shopping');
INSERT INTO public.menu_icon VALUES ('fa-shopping');
INSERT INTO public.menu_icon VALUES ('fa-shopping');
INSERT INTO public.menu_icon VALUES ('fa-sign');
INSERT INTO public.menu_icon VALUES ('fa-sign');
INSERT INTO public.menu_icon VALUES ('fa-sign');
INSERT INTO public.menu_icon VALUES ('fa-signal');
INSERT INTO public.menu_icon VALUES ('fa-signing');
INSERT INTO public.menu_icon VALUES ('fa-simplybuilt');
INSERT INTO public.menu_icon VALUES ('fa-sitemap');
INSERT INTO public.menu_icon VALUES ('fa-skyatlas');
INSERT INTO public.menu_icon VALUES ('fa-skype');
INSERT INTO public.menu_icon VALUES ('fa-slack');
INSERT INTO public.menu_icon VALUES ('fa-sliders');
INSERT INTO public.menu_icon VALUES ('fa-slideshare');
INSERT INTO public.menu_icon VALUES ('fa-smile');
INSERT INTO public.menu_icon VALUES ('fa-snapchat');
INSERT INTO public.menu_icon VALUES ('fa-snapchat');
INSERT INTO public.menu_icon VALUES ('fa-snapchat');
INSERT INTO public.menu_icon VALUES ('fa-soccer');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-sort');
INSERT INTO public.menu_icon VALUES ('fa-soundcloud');
INSERT INTO public.menu_icon VALUES ('fa-space');
INSERT INTO public.menu_icon VALUES ('fa-spinner');
INSERT INTO public.menu_icon VALUES ('fa-spoon');
INSERT INTO public.menu_icon VALUES ('fa-spotify');
INSERT INTO public.menu_icon VALUES ('fa-square');
INSERT INTO public.menu_icon VALUES ('fa-square');
INSERT INTO public.menu_icon VALUES ('fa-stack');
INSERT INTO public.menu_icon VALUES ('fa-stack');
INSERT INTO public.menu_icon VALUES ('fa-star');
INSERT INTO public.menu_icon VALUES ('fa-star');
INSERT INTO public.menu_icon VALUES ('fa-star');
INSERT INTO public.menu_icon VALUES ('fa-star');
INSERT INTO public.menu_icon VALUES ('fa-star');
INSERT INTO public.menu_icon VALUES ('fa-star');
INSERT INTO public.menu_icon VALUES ('fa-steam');
INSERT INTO public.menu_icon VALUES ('fa-steam');
INSERT INTO public.menu_icon VALUES ('fa-step');
INSERT INTO public.menu_icon VALUES ('fa-step');
INSERT INTO public.menu_icon VALUES ('fa-stethoscope');
INSERT INTO public.menu_icon VALUES ('fa-sticky');
INSERT INTO public.menu_icon VALUES ('fa-sticky');
INSERT INTO public.menu_icon VALUES ('fa-stop');
INSERT INTO public.menu_icon VALUES ('fa-stop');
INSERT INTO public.menu_icon VALUES ('fa-stop');
INSERT INTO public.menu_icon VALUES ('fa-street');
INSERT INTO public.menu_icon VALUES ('fa-strikethrough');
INSERT INTO public.menu_icon VALUES ('fa-stumbleupon');
INSERT INTO public.menu_icon VALUES ('fa-stumbleupon');
INSERT INTO public.menu_icon VALUES ('fa-subscript');
INSERT INTO public.menu_icon VALUES ('fa-subway');
INSERT INTO public.menu_icon VALUES ('fa-suitcase');
INSERT INTO public.menu_icon VALUES ('fa-sun');
INSERT INTO public.menu_icon VALUES ('fa-superscript');
INSERT INTO public.menu_icon VALUES ('fa-support');
INSERT INTO public.menu_icon VALUES ('fa-table');
INSERT INTO public.menu_icon VALUES ('fa-tablet');
INSERT INTO public.menu_icon VALUES ('fa-tachometer');
INSERT INTO public.menu_icon VALUES ('fa-tag');
INSERT INTO public.menu_icon VALUES ('fa-tags');
INSERT INTO public.menu_icon VALUES ('fa-tasks');
INSERT INTO public.menu_icon VALUES ('fa-taxi');
INSERT INTO public.menu_icon VALUES ('fa-television');
INSERT INTO public.menu_icon VALUES ('fa-tencent');
INSERT INTO public.menu_icon VALUES ('fa-terminal');
INSERT INTO public.menu_icon VALUES ('fa-text');
INSERT INTO public.menu_icon VALUES ('fa-text');
INSERT INTO public.menu_icon VALUES ('fa-th');
INSERT INTO public.menu_icon VALUES ('fa-th');
INSERT INTO public.menu_icon VALUES ('fa-th');
INSERT INTO public.menu_icon VALUES ('fa-themeisle');
INSERT INTO public.menu_icon VALUES ('fa-thumb');
INSERT INTO public.menu_icon VALUES ('fa-thumbs');
INSERT INTO public.menu_icon VALUES ('fa-thumbs');
INSERT INTO public.menu_icon VALUES ('fa-thumbs');
INSERT INTO public.menu_icon VALUES ('fa-thumbs');
INSERT INTO public.menu_icon VALUES ('fa-ticket');
INSERT INTO public.menu_icon VALUES ('fa-times');
INSERT INTO public.menu_icon VALUES ('fa-times');
INSERT INTO public.menu_icon VALUES ('fa-times');
INSERT INTO public.menu_icon VALUES ('fa-tint');
INSERT INTO public.menu_icon VALUES ('fa-toggle');
INSERT INTO public.menu_icon VALUES ('fa-toggle');
INSERT INTO public.menu_icon VALUES ('fa-toggle');
INSERT INTO public.menu_icon VALUES ('fa-toggle');
INSERT INTO public.menu_icon VALUES ('fa-toggle');
INSERT INTO public.menu_icon VALUES ('fa-toggle');
INSERT INTO public.menu_icon VALUES ('fa-trademark');
INSERT INTO public.menu_icon VALUES ('fa-train');
INSERT INTO public.menu_icon VALUES ('fa-transgender');
INSERT INTO public.menu_icon VALUES ('fa-transgender');
INSERT INTO public.menu_icon VALUES ('fa-trash');
INSERT INTO public.menu_icon VALUES ('fa-trash');
INSERT INTO public.menu_icon VALUES ('fa-tree');
INSERT INTO public.menu_icon VALUES ('fa-trello');
INSERT INTO public.menu_icon VALUES ('fa-tripadvisor');
INSERT INTO public.menu_icon VALUES ('fa-trophy');
INSERT INTO public.menu_icon VALUES ('fa-truck');
INSERT INTO public.menu_icon VALUES ('fa-try');
INSERT INTO public.menu_icon VALUES ('fa-tty');
INSERT INTO public.menu_icon VALUES ('fa-tumblr');
INSERT INTO public.menu_icon VALUES ('fa-tumblr');
INSERT INTO public.menu_icon VALUES ('fa-turkish');
INSERT INTO public.menu_icon VALUES ('fa-tv');
INSERT INTO public.menu_icon VALUES ('fa-twitch');
INSERT INTO public.menu_icon VALUES ('fa-twitter');
INSERT INTO public.menu_icon VALUES ('fa-twitter');
INSERT INTO public.menu_icon VALUES ('fa-umbrella');
INSERT INTO public.menu_icon VALUES ('fa-underline');
INSERT INTO public.menu_icon VALUES ('fa-undo');
INSERT INTO public.menu_icon VALUES ('fa-universal');
INSERT INTO public.menu_icon VALUES ('fa-university');
INSERT INTO public.menu_icon VALUES ('fa-unlink');
INSERT INTO public.menu_icon VALUES ('fa-unlock');
INSERT INTO public.menu_icon VALUES ('fa-unlock');
INSERT INTO public.menu_icon VALUES ('fa-unsorted');
INSERT INTO public.menu_icon VALUES ('fa-upload');
INSERT INTO public.menu_icon VALUES ('fa-usb');
INSERT INTO public.menu_icon VALUES ('fa-usd');
INSERT INTO public.menu_icon VALUES ('fa-user');
INSERT INTO public.menu_icon VALUES ('fa-user');
INSERT INTO public.menu_icon VALUES ('fa-user');
INSERT INTO public.menu_icon VALUES ('fa-user');
INSERT INTO public.menu_icon VALUES ('fa-user');
INSERT INTO public.menu_icon VALUES ('fa-users');
INSERT INTO public.menu_icon VALUES ('fa-venus');
INSERT INTO public.menu_icon VALUES ('fa-venus');
INSERT INTO public.menu_icon VALUES ('fa-venus');
INSERT INTO public.menu_icon VALUES ('fa-viacoin');
INSERT INTO public.menu_icon VALUES ('fa-viadeo');
INSERT INTO public.menu_icon VALUES ('fa-viadeo');
INSERT INTO public.menu_icon VALUES ('fa-video');
INSERT INTO public.menu_icon VALUES ('fa-vimeo');
INSERT INTO public.menu_icon VALUES ('fa-vimeo');
INSERT INTO public.menu_icon VALUES ('fa-vine');
INSERT INTO public.menu_icon VALUES ('fa-vk');
INSERT INTO public.menu_icon VALUES ('fa-volume');
INSERT INTO public.menu_icon VALUES ('fa-volume');
INSERT INTO public.menu_icon VALUES ('fa-volume');
INSERT INTO public.menu_icon VALUES ('fa-volume');
INSERT INTO public.menu_icon VALUES ('fa-warning');
INSERT INTO public.menu_icon VALUES ('fa-wechat');
INSERT INTO public.menu_icon VALUES ('fa-weibo');
INSERT INTO public.menu_icon VALUES ('fa-weixin');
INSERT INTO public.menu_icon VALUES ('fa-whatsapp');
INSERT INTO public.menu_icon VALUES ('fa-wheelchair');
INSERT INTO public.menu_icon VALUES ('fa-wheelchair');
INSERT INTO public.menu_icon VALUES ('fa-wifi');
INSERT INTO public.menu_icon VALUES ('fa-wikipedia');
INSERT INTO public.menu_icon VALUES ('fa-windows');
INSERT INTO public.menu_icon VALUES ('fa-won');
INSERT INTO public.menu_icon VALUES ('fa-wordpress');
INSERT INTO public.menu_icon VALUES ('fa-wpbeginner');
INSERT INTO public.menu_icon VALUES ('fa-wpforms');
INSERT INTO public.menu_icon VALUES ('fa-wrench');
INSERT INTO public.menu_icon VALUES ('fa-xing');
INSERT INTO public.menu_icon VALUES ('fa-xing');
INSERT INTO public.menu_icon VALUES ('fa-y');
INSERT INTO public.menu_icon VALUES ('fa-y');
INSERT INTO public.menu_icon VALUES ('fa-yahoo');
INSERT INTO public.menu_icon VALUES ('fa-yc');
INSERT INTO public.menu_icon VALUES ('fa-yc');
INSERT INTO public.menu_icon VALUES ('fa-yelp');
INSERT INTO public.menu_icon VALUES ('fa-yen');
INSERT INTO public.menu_icon VALUES ('fa-yoast');
INSERT INTO public.menu_icon VALUES ('fa-youtube');
INSERT INTO public.menu_icon VALUES ('fa-youtube');
INSERT INTO public.menu_icon VALUES ('fa-youtube');
INSERT INTO public.menu_icon VALUES ('fa-balance-scale');
INSERT INTO public.menu_icon VALUES ('fa-battery-0');
INSERT INTO public.menu_icon VALUES ('fa-battery-1');
INSERT INTO public.menu_icon VALUES ('fa-battery-2');
INSERT INTO public.menu_icon VALUES ('fa-battery-3');
INSERT INTO public.menu_icon VALUES ('fa-battery-4');
INSERT INTO public.menu_icon VALUES ('fa-battery-empty');
INSERT INTO public.menu_icon VALUES ('fa-battery-full');
INSERT INTO public.menu_icon VALUES ('fa-battery-half');
INSERT INTO public.menu_icon VALUES ('fa-battery-quarter');
INSERT INTO public.menu_icon VALUES ('fa-battery-three');
INSERT INTO public.menu_icon VALUES ('fa-black-tie');
INSERT INTO public.menu_icon VALUES ('fa-calendar-check');
INSERT INTO public.menu_icon VALUES ('fa-calendar-minus');
INSERT INTO public.menu_icon VALUES ('fa-calendar-plus');
INSERT INTO public.menu_icon VALUES ('fa-calendar-times');
INSERT INTO public.menu_icon VALUES ('fa-cc-diners');
INSERT INTO public.menu_icon VALUES ('fa-cc-jcb');
INSERT INTO public.menu_icon VALUES ('fa-commenting-o');
INSERT INTO public.menu_icon VALUES ('fa-creative-commons');
INSERT INTO public.menu_icon VALUES ('fa-get-pocket');
INSERT INTO public.menu_icon VALUES ('fa-gg-circle');
INSERT INTO public.menu_icon VALUES ('fa-hand-grab');
INSERT INTO public.menu_icon VALUES ('fa-hand-lizard');
INSERT INTO public.menu_icon VALUES ('fa-hand-paper');
INSERT INTO public.menu_icon VALUES ('fa-hand-peace');
INSERT INTO public.menu_icon VALUES ('fa-hand-pointer');
INSERT INTO public.menu_icon VALUES ('fa-hand-rock');
INSERT INTO public.menu_icon VALUES ('fa-hand-scissors');
INSERT INTO public.menu_icon VALUES ('fa-hand-spock');
INSERT INTO public.menu_icon VALUES ('fa-hand-stop');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-1');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-2');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-3');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-end');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-half');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-o');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-start');
INSERT INTO public.menu_icon VALUES ('fa-i-cursor');
INSERT INTO public.menu_icon VALUES ('fa-internet-explorer');
INSERT INTO public.menu_icon VALUES ('fa-map-o');
INSERT INTO public.menu_icon VALUES ('fa-map-pin');
INSERT INTO public.menu_icon VALUES ('fa-map-signs');
INSERT INTO public.menu_icon VALUES ('fa-mouse-pointer');
INSERT INTO public.menu_icon VALUES ('fa-object-group');
INSERT INTO public.menu_icon VALUES ('fa-object-ungroup');
INSERT INTO public.menu_icon VALUES ('fa-odnoklassniki-square');
INSERT INTO public.menu_icon VALUES ('fa-optin-monster');
INSERT INTO public.menu_icon VALUES ('fa-sticky-note');
INSERT INTO public.menu_icon VALUES ('fa-sticky-note');
INSERT INTO public.menu_icon VALUES ('fa-wikipedia-w');
INSERT INTO public.menu_icon VALUES ('fa-y-combinator');
INSERT INTO public.menu_icon VALUES ('fa-area-chart');
INSERT INTO public.menu_icon VALUES ('fa-arrows-h');
INSERT INTO public.menu_icon VALUES ('fa-arrows-v');
INSERT INTO public.menu_icon VALUES ('fa-balance-scale');
INSERT INTO public.menu_icon VALUES ('fa-bar-chart');
INSERT INTO public.menu_icon VALUES ('fa-bar-chart');
INSERT INTO public.menu_icon VALUES ('fa-battery-0');
INSERT INTO public.menu_icon VALUES ('fa-battery-1');
INSERT INTO public.menu_icon VALUES ('fa-battery-2');
INSERT INTO public.menu_icon VALUES ('fa-battery-3');
INSERT INTO public.menu_icon VALUES ('fa-battery-4');
INSERT INTO public.menu_icon VALUES ('fa-battery-empty');
INSERT INTO public.menu_icon VALUES ('fa-battery-full');
INSERT INTO public.menu_icon VALUES ('fa-battery-half');
INSERT INTO public.menu_icon VALUES ('fa-battery-quarter');
INSERT INTO public.menu_icon VALUES ('fa-battery-three');
INSERT INTO public.menu_icon VALUES ('fa-bell-o');
INSERT INTO public.menu_icon VALUES ('fa-bell-slash');
INSERT INTO public.menu_icon VALUES ('fa-bell-slash');
INSERT INTO public.menu_icon VALUES ('fa-birthday-cake');
INSERT INTO public.menu_icon VALUES ('fa-bookmark-o');
INSERT INTO public.menu_icon VALUES ('fa-building-o');
INSERT INTO public.menu_icon VALUES ('fa-calendar-check');
INSERT INTO public.menu_icon VALUES ('fa-calendar-minus');
INSERT INTO public.menu_icon VALUES ('fa-calendar-o');
INSERT INTO public.menu_icon VALUES ('fa-calendar-plus');
INSERT INTO public.menu_icon VALUES ('fa-calendar-times');
INSERT INTO public.menu_icon VALUES ('fa-camera-retro');
INSERT INTO public.menu_icon VALUES ('fa-caret-square');
INSERT INTO public.menu_icon VALUES ('fa-caret-square');
INSERT INTO public.menu_icon VALUES ('fa-caret-square');
INSERT INTO public.menu_icon VALUES ('fa-caret-square');
INSERT INTO public.menu_icon VALUES ('fa-cart-arrow');
INSERT INTO public.menu_icon VALUES ('fa-cart-plus');
INSERT INTO public.menu_icon VALUES ('fa-check-circle');
INSERT INTO public.menu_icon VALUES ('fa-check-circle');
INSERT INTO public.menu_icon VALUES ('fa-check-square');
INSERT INTO public.menu_icon VALUES ('fa-check-square');
INSERT INTO public.menu_icon VALUES ('fa-circle-o');
INSERT INTO public.menu_icon VALUES ('fa-circle-o');
INSERT INTO public.menu_icon VALUES ('fa-circle-thin');
INSERT INTO public.menu_icon VALUES ('fa-clock-o');
INSERT INTO public.menu_icon VALUES ('fa-cloud-download');
INSERT INTO public.menu_icon VALUES ('fa-cloud-upload');
INSERT INTO public.menu_icon VALUES ('fa-code-fork');
INSERT INTO public.menu_icon VALUES ('fa-comment-o');
INSERT INTO public.menu_icon VALUES ('fa-commenting-o');
INSERT INTO public.menu_icon VALUES ('fa-comments-o');
INSERT INTO public.menu_icon VALUES ('fa-creative-commons');
INSERT INTO public.menu_icon VALUES ('fa-credit-card');
INSERT INTO public.menu_icon VALUES ('fa-dot-circle');
INSERT INTO public.menu_icon VALUES ('fa-ellipsis-h');
INSERT INTO public.menu_icon VALUES ('fa-ellipsis-v');
INSERT INTO public.menu_icon VALUES ('fa-envelope-o');
INSERT INTO public.menu_icon VALUES ('fa-envelope-square');
INSERT INTO public.menu_icon VALUES ('fa-exclamation-circle');
INSERT INTO public.menu_icon VALUES ('fa-exclamation-triangle');
INSERT INTO public.menu_icon VALUES ('fa-external-link');
INSERT INTO public.menu_icon VALUES ('fa-external-link');
INSERT INTO public.menu_icon VALUES ('fa-eye-slash');
INSERT INTO public.menu_icon VALUES ('fa-fighter-jet');
INSERT INTO public.menu_icon VALUES ('fa-file-archive');
INSERT INTO public.menu_icon VALUES ('fa-file-audio');
INSERT INTO public.menu_icon VALUES ('fa-file-code');
INSERT INTO public.menu_icon VALUES ('fa-file-excel');
INSERT INTO public.menu_icon VALUES ('fa-file-image');
INSERT INTO public.menu_icon VALUES ('fa-file-movie');
INSERT INTO public.menu_icon VALUES ('fa-file-pdf');
INSERT INTO public.menu_icon VALUES ('fa-file-photo');
INSERT INTO public.menu_icon VALUES ('fa-file-picture');
INSERT INTO public.menu_icon VALUES ('fa-file-powerpoint');
INSERT INTO public.menu_icon VALUES ('fa-file-sound');
INSERT INTO public.menu_icon VALUES ('fa-file-video');
INSERT INTO public.menu_icon VALUES ('fa-file-word');
INSERT INTO public.menu_icon VALUES ('fa-file-zip');
INSERT INTO public.menu_icon VALUES ('fa-fire-extinguisher');
INSERT INTO public.menu_icon VALUES ('fa-flag-checkered');
INSERT INTO public.menu_icon VALUES ('fa-flag-o');
INSERT INTO public.menu_icon VALUES ('fa-folder-o');
INSERT INTO public.menu_icon VALUES ('fa-folder-open');
INSERT INTO public.menu_icon VALUES ('fa-folder-open');
INSERT INTO public.menu_icon VALUES ('fa-frown-o');
INSERT INTO public.menu_icon VALUES ('fa-futbol-o');
INSERT INTO public.menu_icon VALUES ('fa-graduation-cap');
INSERT INTO public.menu_icon VALUES ('fa-hand-grab');
INSERT INTO public.menu_icon VALUES ('fa-hand-lizard');
INSERT INTO public.menu_icon VALUES ('fa-hand-paper');
INSERT INTO public.menu_icon VALUES ('fa-hand-peace');
INSERT INTO public.menu_icon VALUES ('fa-hand-pointer');
INSERT INTO public.menu_icon VALUES ('fa-hand-rock');
INSERT INTO public.menu_icon VALUES ('fa-hand-scissors');
INSERT INTO public.menu_icon VALUES ('fa-hand-spock');
INSERT INTO public.menu_icon VALUES ('fa-hand-stop');
INSERT INTO public.menu_icon VALUES ('fa-hdd-o');
INSERT INTO public.menu_icon VALUES ('fa-heart-o');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-1');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-2');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-3');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-end');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-half');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-o');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-start');
INSERT INTO public.menu_icon VALUES ('fa-i-cursor');
INSERT INTO public.menu_icon VALUES ('fa-info-circle');
INSERT INTO public.menu_icon VALUES ('fa-keyboard-o');
INSERT INTO public.menu_icon VALUES ('fa-lemon-o');
INSERT INTO public.menu_icon VALUES ('fa-level-down');
INSERT INTO public.menu_icon VALUES ('fa-level-up');
INSERT INTO public.menu_icon VALUES ('fa-life-bouy');
INSERT INTO public.menu_icon VALUES ('fa-life-buoy');
INSERT INTO public.menu_icon VALUES ('fa-life-ring');
INSERT INTO public.menu_icon VALUES ('fa-life-saver');
INSERT INTO public.menu_icon VALUES ('fa-lightbulb-o');
INSERT INTO public.menu_icon VALUES ('fa-line-chart');
INSERT INTO public.menu_icon VALUES ('fa-location-arrow');
INSERT INTO public.menu_icon VALUES ('fa-mail-forward');
INSERT INTO public.menu_icon VALUES ('fa-mail-reply');
INSERT INTO public.menu_icon VALUES ('fa-mail-reply');
INSERT INTO public.menu_icon VALUES ('fa-map-marker');
INSERT INTO public.menu_icon VALUES ('fa-map-o');
INSERT INTO public.menu_icon VALUES ('fa-map-pin');
INSERT INTO public.menu_icon VALUES ('fa-map-signs');
INSERT INTO public.menu_icon VALUES ('fa-meh-o');
INSERT INTO public.menu_icon VALUES ('fa-microphone-slash');
INSERT INTO public.menu_icon VALUES ('fa-minus-circle');
INSERT INTO public.menu_icon VALUES ('fa-minus-square');
INSERT INTO public.menu_icon VALUES ('fa-minus-square');
INSERT INTO public.menu_icon VALUES ('fa-mobile-phone');
INSERT INTO public.menu_icon VALUES ('fa-moon-o');
INSERT INTO public.menu_icon VALUES ('fa-mortar-board');
INSERT INTO public.menu_icon VALUES ('fa-mouse-pointer');
INSERT INTO public.menu_icon VALUES ('fa-newspaper-o');
INSERT INTO public.menu_icon VALUES ('fa-object-group');
INSERT INTO public.menu_icon VALUES ('fa-object-ungroup');
INSERT INTO public.menu_icon VALUES ('fa-paint-brush');
INSERT INTO public.menu_icon VALUES ('fa-paper-plane');
INSERT INTO public.menu_icon VALUES ('fa-paper-plane');
INSERT INTO public.menu_icon VALUES ('fa-pencil-square');
INSERT INTO public.menu_icon VALUES ('fa-pencil-square');
INSERT INTO public.menu_icon VALUES ('fa-phone-square');
INSERT INTO public.menu_icon VALUES ('fa-picture-o');
INSERT INTO public.menu_icon VALUES ('fa-pie-chart');
INSERT INTO public.menu_icon VALUES ('fa-plus-circle');
INSERT INTO public.menu_icon VALUES ('fa-plus-square');
INSERT INTO public.menu_icon VALUES ('fa-plus-square');
INSERT INTO public.menu_icon VALUES ('fa-power-off');
INSERT INTO public.menu_icon VALUES ('fa-puzzle-piece');
INSERT INTO public.menu_icon VALUES ('fa-question-circle');
INSERT INTO public.menu_icon VALUES ('fa-quote-left');
INSERT INTO public.menu_icon VALUES ('fa-quote-right');
INSERT INTO public.menu_icon VALUES ('fa-reply-all');
INSERT INTO public.menu_icon VALUES ('fa-rss-square');
INSERT INTO public.menu_icon VALUES ('fa-search-minus');
INSERT INTO public.menu_icon VALUES ('fa-search-plus');
INSERT INTO public.menu_icon VALUES ('fa-send-o');
INSERT INTO public.menu_icon VALUES ('fa-share-alt');
INSERT INTO public.menu_icon VALUES ('fa-share-alt');
INSERT INTO public.menu_icon VALUES ('fa-share-square');
INSERT INTO public.menu_icon VALUES ('fa-share-square');
INSERT INTO public.menu_icon VALUES ('fa-shopping-cart');
INSERT INTO public.menu_icon VALUES ('fa-sign-in');
INSERT INTO public.menu_icon VALUES ('fa-sign-out');
INSERT INTO public.menu_icon VALUES ('fa-smile-o');
INSERT INTO public.menu_icon VALUES ('fa-soccer-ball');
INSERT INTO public.menu_icon VALUES ('fa-sort-alpha');
INSERT INTO public.menu_icon VALUES ('fa-sort-alpha');
INSERT INTO public.menu_icon VALUES ('fa-sort-amount');
INSERT INTO public.menu_icon VALUES ('fa-sort-amount');
INSERT INTO public.menu_icon VALUES ('fa-sort-asc');
INSERT INTO public.menu_icon VALUES ('fa-sort-desc');
INSERT INTO public.menu_icon VALUES ('fa-sort-down');
INSERT INTO public.menu_icon VALUES ('fa-sort-numeric');
INSERT INTO public.menu_icon VALUES ('fa-sort-numeric');
INSERT INTO public.menu_icon VALUES ('fa-sort-up');
INSERT INTO public.menu_icon VALUES ('fa-space-shuttle');
INSERT INTO public.menu_icon VALUES ('fa-square-o');
INSERT INTO public.menu_icon VALUES ('fa-star-half');
INSERT INTO public.menu_icon VALUES ('fa-star-half');
INSERT INTO public.menu_icon VALUES ('fa-star-half');
INSERT INTO public.menu_icon VALUES ('fa-star-half');
INSERT INTO public.menu_icon VALUES ('fa-star-o');
INSERT INTO public.menu_icon VALUES ('fa-sticky-note');
INSERT INTO public.menu_icon VALUES ('fa-sticky-note');
INSERT INTO public.menu_icon VALUES ('fa-street-view');
INSERT INTO public.menu_icon VALUES ('fa-sun-o');
INSERT INTO public.menu_icon VALUES ('fa-thumb-tack');
INSERT INTO public.menu_icon VALUES ('fa-thumbs-down');
INSERT INTO public.menu_icon VALUES ('fa-thumbs-o');
INSERT INTO public.menu_icon VALUES ('fa-thumbs-o');
INSERT INTO public.menu_icon VALUES ('fa-thumbs-up');
INSERT INTO public.menu_icon VALUES ('fa-times-circle');
INSERT INTO public.menu_icon VALUES ('fa-times-circle');
INSERT INTO public.menu_icon VALUES ('fa-toggle-down');
INSERT INTO public.menu_icon VALUES ('fa-toggle-left');
INSERT INTO public.menu_icon VALUES ('fa-toggle-off');
INSERT INTO public.menu_icon VALUES ('fa-toggle-on');
INSERT INTO public.menu_icon VALUES ('fa-toggle-right');
INSERT INTO public.menu_icon VALUES ('fa-toggle-up');
INSERT INTO public.menu_icon VALUES ('fa-trash-o');
INSERT INTO public.menu_icon VALUES ('fa-unlock-alt');
INSERT INTO public.menu_icon VALUES ('fa-user-plus');
INSERT INTO public.menu_icon VALUES ('fa-user-secret');
INSERT INTO public.menu_icon VALUES ('fa-user-times');
INSERT INTO public.menu_icon VALUES ('fa-video-camera');
INSERT INTO public.menu_icon VALUES ('fa-volume-down');
INSERT INTO public.menu_icon VALUES ('fa-volume-off');
INSERT INTO public.menu_icon VALUES ('fa-volume-up');
INSERT INTO public.menu_icon VALUES ('fa-hand-grab');
INSERT INTO public.menu_icon VALUES ('fa-hand-lizard');
INSERT INTO public.menu_icon VALUES ('fa-hand-o');
INSERT INTO public.menu_icon VALUES ('fa-hand-o');
INSERT INTO public.menu_icon VALUES ('fa-hand-o');
INSERT INTO public.menu_icon VALUES ('fa-hand-o');
INSERT INTO public.menu_icon VALUES ('fa-hand-paper');
INSERT INTO public.menu_icon VALUES ('fa-hand-peace');
INSERT INTO public.menu_icon VALUES ('fa-hand-pointer');
INSERT INTO public.menu_icon VALUES ('fa-hand-rock');
INSERT INTO public.menu_icon VALUES ('fa-hand-scissors');
INSERT INTO public.menu_icon VALUES ('fa-hand-spock');
INSERT INTO public.menu_icon VALUES ('fa-hand-stop');
INSERT INTO public.menu_icon VALUES ('fa-thumbs-down');
INSERT INTO public.menu_icon VALUES ('fa-thumbs-o');
INSERT INTO public.menu_icon VALUES ('fa-thumbs-o');
INSERT INTO public.menu_icon VALUES ('fa-thumbs-up');
INSERT INTO public.menu_icon VALUES ('fa-fighter-jet');
INSERT INTO public.menu_icon VALUES ('fa-space-shuttle');
INSERT INTO public.menu_icon VALUES ('fa-mars-double');
INSERT INTO public.menu_icon VALUES ('fa-mars-stroke');
INSERT INTO public.menu_icon VALUES ('fa-mars-stroke');
INSERT INTO public.menu_icon VALUES ('fa-mars-stroke');
INSERT INTO public.menu_icon VALUES ('fa-transgender-alt');
INSERT INTO public.menu_icon VALUES ('fa-venus-double');
INSERT INTO public.menu_icon VALUES ('fa-venus-mars');
INSERT INTO public.menu_icon VALUES ('fa-file-archive');
INSERT INTO public.menu_icon VALUES ('fa-file-audio');
INSERT INTO public.menu_icon VALUES ('fa-file-code');
INSERT INTO public.menu_icon VALUES ('fa-file-excel');
INSERT INTO public.menu_icon VALUES ('fa-file-image');
INSERT INTO public.menu_icon VALUES ('fa-file-movie');
INSERT INTO public.menu_icon VALUES ('fa-file-o');
INSERT INTO public.menu_icon VALUES ('fa-file-pdf');
INSERT INTO public.menu_icon VALUES ('fa-file-photo');
INSERT INTO public.menu_icon VALUES ('fa-file-picture');
INSERT INTO public.menu_icon VALUES ('fa-file-powerpoint');
INSERT INTO public.menu_icon VALUES ('fa-file-sound');
INSERT INTO public.menu_icon VALUES ('fa-file-text');
INSERT INTO public.menu_icon VALUES ('fa-file-text');
INSERT INTO public.menu_icon VALUES ('fa-file-video');
INSERT INTO public.menu_icon VALUES ('fa-file-word');
INSERT INTO public.menu_icon VALUES ('fa-file-zip');
INSERT INTO public.menu_icon VALUES ('fa-circle-o');
INSERT INTO public.menu_icon VALUES ('fa-check-square');
INSERT INTO public.menu_icon VALUES ('fa-check-square');
INSERT INTO public.menu_icon VALUES ('fa-circle-o');
INSERT INTO public.menu_icon VALUES ('fa-dot-circle');
INSERT INTO public.menu_icon VALUES ('fa-minus-square');
INSERT INTO public.menu_icon VALUES ('fa-minus-square');
INSERT INTO public.menu_icon VALUES ('fa-plus-square');
INSERT INTO public.menu_icon VALUES ('fa-plus-square');
INSERT INTO public.menu_icon VALUES ('fa-square-o');
INSERT INTO public.menu_icon VALUES ('fa-cc-amex');
INSERT INTO public.menu_icon VALUES ('fa-cc-diners');
INSERT INTO public.menu_icon VALUES ('fa-cc-discover');
INSERT INTO public.menu_icon VALUES ('fa-cc-jcb');
INSERT INTO public.menu_icon VALUES ('fa-cc-mastercard');
INSERT INTO public.menu_icon VALUES ('fa-cc-paypal');
INSERT INTO public.menu_icon VALUES ('fa-cc-stripe');
INSERT INTO public.menu_icon VALUES ('fa-cc-visa');
INSERT INTO public.menu_icon VALUES ('fa-credit-card');
INSERT INTO public.menu_icon VALUES ('fa-google-wallet');
INSERT INTO public.menu_icon VALUES ('fa-area-chart');
INSERT INTO public.menu_icon VALUES ('fa-bar-chart');
INSERT INTO public.menu_icon VALUES ('fa-bar-chart');
INSERT INTO public.menu_icon VALUES ('fa-line-chart');
INSERT INTO public.menu_icon VALUES ('fa-pie-chart');
INSERT INTO public.menu_icon VALUES ('fa-gg-circle');
INSERT INTO public.menu_icon VALUES ('fa-turkish-lira');
INSERT INTO public.menu_icon VALUES ('fa-align-center');
INSERT INTO public.menu_icon VALUES ('fa-align-justify');
INSERT INTO public.menu_icon VALUES ('fa-align-left');
INSERT INTO public.menu_icon VALUES ('fa-align-right');
INSERT INTO public.menu_icon VALUES ('fa-chain-broken');
INSERT INTO public.menu_icon VALUES ('fa-file-o');
INSERT INTO public.menu_icon VALUES ('fa-file-text');
INSERT INTO public.menu_icon VALUES ('fa-file-text');
INSERT INTO public.menu_icon VALUES ('fa-files-o');
INSERT INTO public.menu_icon VALUES ('fa-floppy-o');
INSERT INTO public.menu_icon VALUES ('fa-list-alt');
INSERT INTO public.menu_icon VALUES ('fa-list-ol');
INSERT INTO public.menu_icon VALUES ('fa-list-ul');
INSERT INTO public.menu_icon VALUES ('fa-rotate-left');
INSERT INTO public.menu_icon VALUES ('fa-rotate-right');
INSERT INTO public.menu_icon VALUES ('fa-text-height');
INSERT INTO public.menu_icon VALUES ('fa-text-width');
INSERT INTO public.menu_icon VALUES ('fa-th-large');
INSERT INTO public.menu_icon VALUES ('fa-th-list');
INSERT INTO public.menu_icon VALUES ('fa-angle-double');
INSERT INTO public.menu_icon VALUES ('fa-angle-double');
INSERT INTO public.menu_icon VALUES ('fa-angle-double');
INSERT INTO public.menu_icon VALUES ('fa-angle-double');
INSERT INTO public.menu_icon VALUES ('fa-angle-down');
INSERT INTO public.menu_icon VALUES ('fa-angle-left');
INSERT INTO public.menu_icon VALUES ('fa-angle-right');
INSERT INTO public.menu_icon VALUES ('fa-angle-up');
INSERT INTO public.menu_icon VALUES ('fa-arrow-circle');
INSERT INTO public.menu_icon VALUES ('fa-arrow-circle');
INSERT INTO public.menu_icon VALUES ('fa-arrow-circle');
INSERT INTO public.menu_icon VALUES ('fa-arrow-circle');
INSERT INTO public.menu_icon VALUES ('fa-arrow-circle');
INSERT INTO public.menu_icon VALUES ('fa-arrow-circle');
INSERT INTO public.menu_icon VALUES ('fa-arrow-circle');
INSERT INTO public.menu_icon VALUES ('fa-arrow-circle');
INSERT INTO public.menu_icon VALUES ('fa-arrow-down');
INSERT INTO public.menu_icon VALUES ('fa-arrow-left');
INSERT INTO public.menu_icon VALUES ('fa-arrow-right');
INSERT INTO public.menu_icon VALUES ('fa-arrow-up');
INSERT INTO public.menu_icon VALUES ('fa-arrows-alt');
INSERT INTO public.menu_icon VALUES ('fa-arrows-h');
INSERT INTO public.menu_icon VALUES ('fa-arrows-v');
INSERT INTO public.menu_icon VALUES ('fa-caret-down');
INSERT INTO public.menu_icon VALUES ('fa-caret-left');
INSERT INTO public.menu_icon VALUES ('fa-caret-right');
INSERT INTO public.menu_icon VALUES ('fa-caret-square');
INSERT INTO public.menu_icon VALUES ('fa-caret-square');
INSERT INTO public.menu_icon VALUES ('fa-caret-square');
INSERT INTO public.menu_icon VALUES ('fa-caret-square');
INSERT INTO public.menu_icon VALUES ('fa-caret-up');
INSERT INTO public.menu_icon VALUES ('fa-chevron-circle');
INSERT INTO public.menu_icon VALUES ('fa-chevron-circle');
INSERT INTO public.menu_icon VALUES ('fa-chevron-circle');
INSERT INTO public.menu_icon VALUES ('fa-chevron-circle');
INSERT INTO public.menu_icon VALUES ('fa-chevron-down');
INSERT INTO public.menu_icon VALUES ('fa-chevron-left');
INSERT INTO public.menu_icon VALUES ('fa-chevron-right');
INSERT INTO public.menu_icon VALUES ('fa-chevron-up');
INSERT INTO public.menu_icon VALUES ('fa-hand-o');
INSERT INTO public.menu_icon VALUES ('fa-hand-o');
INSERT INTO public.menu_icon VALUES ('fa-hand-o');
INSERT INTO public.menu_icon VALUES ('fa-hand-o');
INSERT INTO public.menu_icon VALUES ('fa-long-arrow');
INSERT INTO public.menu_icon VALUES ('fa-long-arrow');
INSERT INTO public.menu_icon VALUES ('fa-long-arrow');
INSERT INTO public.menu_icon VALUES ('fa-long-arrow');
INSERT INTO public.menu_icon VALUES ('fa-toggle-down');
INSERT INTO public.menu_icon VALUES ('fa-toggle-left');
INSERT INTO public.menu_icon VALUES ('fa-toggle-right');
INSERT INTO public.menu_icon VALUES ('fa-toggle-up');
INSERT INTO public.menu_icon VALUES ('fa-arrows-alt');
INSERT INTO public.menu_icon VALUES ('fa-fast-backward');
INSERT INTO public.menu_icon VALUES ('fa-fast-forward');
INSERT INTO public.menu_icon VALUES ('fa-play-circle');
INSERT INTO public.menu_icon VALUES ('fa-play-circle');
INSERT INTO public.menu_icon VALUES ('fa-step-backward');
INSERT INTO public.menu_icon VALUES ('fa-step-forward');
INSERT INTO public.menu_icon VALUES ('fa-youtube-play');
INSERT INTO public.menu_icon VALUES ('fa-behance-square');
INSERT INTO public.menu_icon VALUES ('fa-bitbucket-square');
INSERT INTO public.menu_icon VALUES ('fa-black-tie');
INSERT INTO public.menu_icon VALUES ('fa-cc-amex');
INSERT INTO public.menu_icon VALUES ('fa-cc-diners');
INSERT INTO public.menu_icon VALUES ('fa-cc-discover');
INSERT INTO public.menu_icon VALUES ('fa-cc-jcb');
INSERT INTO public.menu_icon VALUES ('fa-cc-mastercard');
INSERT INTO public.menu_icon VALUES ('fa-cc-paypal');
INSERT INTO public.menu_icon VALUES ('fa-cc-stripe');
INSERT INTO public.menu_icon VALUES ('fa-cc-visa');
INSERT INTO public.menu_icon VALUES ('fa-facebook-f');
INSERT INTO public.menu_icon VALUES ('fa-facebook-official');
INSERT INTO public.menu_icon VALUES ('fa-facebook-square');
INSERT INTO public.menu_icon VALUES ('fa-get-pocket');
INSERT INTO public.menu_icon VALUES ('fa-gg-circle');
INSERT INTO public.menu_icon VALUES ('fa-git-square');
INSERT INTO public.menu_icon VALUES ('fa-github-alt');
INSERT INTO public.menu_icon VALUES ('fa-github-square');
INSERT INTO public.menu_icon VALUES ('fa-google-plus');
INSERT INTO public.menu_icon VALUES ('fa-google-plus');
INSERT INTO public.menu_icon VALUES ('fa-google-wallet');
INSERT INTO public.menu_icon VALUES ('fa-hacker-news');
INSERT INTO public.menu_icon VALUES ('fa-internet-explorer');
INSERT INTO public.menu_icon VALUES ('fa-lastfm-square');
INSERT INTO public.menu_icon VALUES ('fa-linkedin-square');
INSERT INTO public.menu_icon VALUES ('fa-odnoklassniki-square');
INSERT INTO public.menu_icon VALUES ('fa-optin-monster');
INSERT INTO public.menu_icon VALUES ('fa-pied-piper');
INSERT INTO public.menu_icon VALUES ('fa-pied-piper');
INSERT INTO public.menu_icon VALUES ('fa-pinterest-p');
INSERT INTO public.menu_icon VALUES ('fa-pinterest-square');
INSERT INTO public.menu_icon VALUES ('fa-reddit-square');
INSERT INTO public.menu_icon VALUES ('fa-share-alt');
INSERT INTO public.menu_icon VALUES ('fa-share-alt');
INSERT INTO public.menu_icon VALUES ('fa-stack-exchange');
INSERT INTO public.menu_icon VALUES ('fa-stack-overflow');
INSERT INTO public.menu_icon VALUES ('fa-steam-square');
INSERT INTO public.menu_icon VALUES ('fa-stumbleupon-circle');
INSERT INTO public.menu_icon VALUES ('fa-tencent-weibo');
INSERT INTO public.menu_icon VALUES ('fa-tumblr-square');
INSERT INTO public.menu_icon VALUES ('fa-twitter-square');
INSERT INTO public.menu_icon VALUES ('fa-vimeo-square');
INSERT INTO public.menu_icon VALUES ('fa-wikipedia-w');
INSERT INTO public.menu_icon VALUES ('fa-xing-square');
INSERT INTO public.menu_icon VALUES ('fa-y-combinator');
INSERT INTO public.menu_icon VALUES ('fa-y-combinator');
INSERT INTO public.menu_icon VALUES ('fa-yc-square');
INSERT INTO public.menu_icon VALUES ('fa-youtube-play');
INSERT INTO public.menu_icon VALUES ('fa-youtube-square');
INSERT INTO public.menu_icon VALUES ('fa-h-square');
INSERT INTO public.menu_icon VALUES ('fa-heart-o');
INSERT INTO public.menu_icon VALUES ('fa-hospital-o');
INSERT INTO public.menu_icon VALUES ('fa-plus-square');
INSERT INTO public.menu_icon VALUES ('fa-user-md');
INSERT INTO public.menu_icon VALUES ('fa-balance-scale');
INSERT INTO public.menu_icon VALUES ('fa-battery-0');
INSERT INTO public.menu_icon VALUES ('fa-battery-1');
INSERT INTO public.menu_icon VALUES ('fa-battery-2');
INSERT INTO public.menu_icon VALUES ('fa-battery-3');
INSERT INTO public.menu_icon VALUES ('fa-battery-4');
INSERT INTO public.menu_icon VALUES ('fa-battery-empty');
INSERT INTO public.menu_icon VALUES ('fa-battery-full');
INSERT INTO public.menu_icon VALUES ('fa-battery-half');
INSERT INTO public.menu_icon VALUES ('fa-battery-quarter');
INSERT INTO public.menu_icon VALUES ('fa-battery-three');
INSERT INTO public.menu_icon VALUES ('fa-black-tie');
INSERT INTO public.menu_icon VALUES ('fa-calendar-check');
INSERT INTO public.menu_icon VALUES ('fa-calendar-minus');
INSERT INTO public.menu_icon VALUES ('fa-calendar-plus');
INSERT INTO public.menu_icon VALUES ('fa-calendar-times');
INSERT INTO public.menu_icon VALUES ('fa-cc-diners');
INSERT INTO public.menu_icon VALUES ('fa-cc-jcb');
INSERT INTO public.menu_icon VALUES ('fa-commenting-o');
INSERT INTO public.menu_icon VALUES ('fa-creative-commons');
INSERT INTO public.menu_icon VALUES ('fa-get-pocket');
INSERT INTO public.menu_icon VALUES ('fa-gg-circle');
INSERT INTO public.menu_icon VALUES ('fa-hand-grab');
INSERT INTO public.menu_icon VALUES ('fa-hand-lizard');
INSERT INTO public.menu_icon VALUES ('fa-hand-paper');
INSERT INTO public.menu_icon VALUES ('fa-hand-peace');
INSERT INTO public.menu_icon VALUES ('fa-hand-pointer');
INSERT INTO public.menu_icon VALUES ('fa-hand-rock');
INSERT INTO public.menu_icon VALUES ('fa-hand-scissors');
INSERT INTO public.menu_icon VALUES ('fa-hand-spock');
INSERT INTO public.menu_icon VALUES ('fa-hand-stop');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-1');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-2');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-3');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-end');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-half');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-o');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-start');
INSERT INTO public.menu_icon VALUES ('fa-i-cursor');
INSERT INTO public.menu_icon VALUES ('fa-internet-explorer');
INSERT INTO public.menu_icon VALUES ('fa-map-o');
INSERT INTO public.menu_icon VALUES ('fa-map-pin');
INSERT INTO public.menu_icon VALUES ('fa-map-signs');
INSERT INTO public.menu_icon VALUES ('fa-mouse-pointer');
INSERT INTO public.menu_icon VALUES ('fa-object-group');
INSERT INTO public.menu_icon VALUES ('fa-object-ungroup');
INSERT INTO public.menu_icon VALUES ('fa-odnoklassniki-square');
INSERT INTO public.menu_icon VALUES ('fa-optin-monster');
INSERT INTO public.menu_icon VALUES ('fa-sticky-note');
INSERT INTO public.menu_icon VALUES ('fa-sticky-note');
INSERT INTO public.menu_icon VALUES ('fa-wikipedia-w');
INSERT INTO public.menu_icon VALUES ('fa-y-combinator');
INSERT INTO public.menu_icon VALUES ('fa-area-chart');
INSERT INTO public.menu_icon VALUES ('fa-arrows-h');
INSERT INTO public.menu_icon VALUES ('fa-arrows-v');
INSERT INTO public.menu_icon VALUES ('fa-balance-scale');
INSERT INTO public.menu_icon VALUES ('fa-bar-chart');
INSERT INTO public.menu_icon VALUES ('fa-bar-chart');
INSERT INTO public.menu_icon VALUES ('fa-battery-0');
INSERT INTO public.menu_icon VALUES ('fa-battery-1');
INSERT INTO public.menu_icon VALUES ('fa-battery-2');
INSERT INTO public.menu_icon VALUES ('fa-battery-3');
INSERT INTO public.menu_icon VALUES ('fa-battery-4');
INSERT INTO public.menu_icon VALUES ('fa-battery-empty');
INSERT INTO public.menu_icon VALUES ('fa-battery-full');
INSERT INTO public.menu_icon VALUES ('fa-battery-half');
INSERT INTO public.menu_icon VALUES ('fa-battery-quarter');
INSERT INTO public.menu_icon VALUES ('fa-battery-three');
INSERT INTO public.menu_icon VALUES ('fa-bell-o');
INSERT INTO public.menu_icon VALUES ('fa-bell-slash');
INSERT INTO public.menu_icon VALUES ('fa-bell-slash');
INSERT INTO public.menu_icon VALUES ('fa-birthday-cake');
INSERT INTO public.menu_icon VALUES ('fa-bookmark-o');
INSERT INTO public.menu_icon VALUES ('fa-building-o');
INSERT INTO public.menu_icon VALUES ('fa-calendar-check');
INSERT INTO public.menu_icon VALUES ('fa-calendar-minus');
INSERT INTO public.menu_icon VALUES ('fa-calendar-o');
INSERT INTO public.menu_icon VALUES ('fa-calendar-plus');
INSERT INTO public.menu_icon VALUES ('fa-calendar-times');
INSERT INTO public.menu_icon VALUES ('fa-camera-retro');
INSERT INTO public.menu_icon VALUES ('fa-caret-square');
INSERT INTO public.menu_icon VALUES ('fa-caret-square');
INSERT INTO public.menu_icon VALUES ('fa-caret-square');
INSERT INTO public.menu_icon VALUES ('fa-caret-square');
INSERT INTO public.menu_icon VALUES ('fa-cart-arrow');
INSERT INTO public.menu_icon VALUES ('fa-cart-plus');
INSERT INTO public.menu_icon VALUES ('fa-check-circle');
INSERT INTO public.menu_icon VALUES ('fa-check-circle');
INSERT INTO public.menu_icon VALUES ('fa-check-square');
INSERT INTO public.menu_icon VALUES ('fa-check-square');
INSERT INTO public.menu_icon VALUES ('fa-circle-o');
INSERT INTO public.menu_icon VALUES ('fa-circle-o');
INSERT INTO public.menu_icon VALUES ('fa-circle-thin');
INSERT INTO public.menu_icon VALUES ('fa-clock-o');
INSERT INTO public.menu_icon VALUES ('fa-cloud-download');
INSERT INTO public.menu_icon VALUES ('fa-cloud-upload');
INSERT INTO public.menu_icon VALUES ('fa-code-fork');
INSERT INTO public.menu_icon VALUES ('fa-comment-o');
INSERT INTO public.menu_icon VALUES ('fa-commenting-o');
INSERT INTO public.menu_icon VALUES ('fa-comments-o');
INSERT INTO public.menu_icon VALUES ('fa-creative-commons');
INSERT INTO public.menu_icon VALUES ('fa-credit-card');
INSERT INTO public.menu_icon VALUES ('fa-dot-circle');
INSERT INTO public.menu_icon VALUES ('fa-ellipsis-h');
INSERT INTO public.menu_icon VALUES ('fa-ellipsis-v');
INSERT INTO public.menu_icon VALUES ('fa-envelope-o');
INSERT INTO public.menu_icon VALUES ('fa-envelope-square');
INSERT INTO public.menu_icon VALUES ('fa-exclamation-circle');
INSERT INTO public.menu_icon VALUES ('fa-exclamation-triangle');
INSERT INTO public.menu_icon VALUES ('fa-external-link');
INSERT INTO public.menu_icon VALUES ('fa-external-link');
INSERT INTO public.menu_icon VALUES ('fa-eye-slash');
INSERT INTO public.menu_icon VALUES ('fa-fighter-jet');
INSERT INTO public.menu_icon VALUES ('fa-file-archive');
INSERT INTO public.menu_icon VALUES ('fa-file-audio');
INSERT INTO public.menu_icon VALUES ('fa-file-code');
INSERT INTO public.menu_icon VALUES ('fa-file-excel');
INSERT INTO public.menu_icon VALUES ('fa-file-image');
INSERT INTO public.menu_icon VALUES ('fa-file-movie');
INSERT INTO public.menu_icon VALUES ('fa-file-pdf');
INSERT INTO public.menu_icon VALUES ('fa-file-photo');
INSERT INTO public.menu_icon VALUES ('fa-file-picture');
INSERT INTO public.menu_icon VALUES ('fa-file-powerpoint');
INSERT INTO public.menu_icon VALUES ('fa-file-sound');
INSERT INTO public.menu_icon VALUES ('fa-file-video');
INSERT INTO public.menu_icon VALUES ('fa-file-word');
INSERT INTO public.menu_icon VALUES ('fa-file-zip');
INSERT INTO public.menu_icon VALUES ('fa-fire-extinguisher');
INSERT INTO public.menu_icon VALUES ('fa-flag-checkered');
INSERT INTO public.menu_icon VALUES ('fa-flag-o');
INSERT INTO public.menu_icon VALUES ('fa-folder-o');
INSERT INTO public.menu_icon VALUES ('fa-folder-open');
INSERT INTO public.menu_icon VALUES ('fa-folder-open');
INSERT INTO public.menu_icon VALUES ('fa-frown-o');
INSERT INTO public.menu_icon VALUES ('fa-futbol-o');
INSERT INTO public.menu_icon VALUES ('fa-graduation-cap');
INSERT INTO public.menu_icon VALUES ('fa-hand-grab');
INSERT INTO public.menu_icon VALUES ('fa-hand-lizard');
INSERT INTO public.menu_icon VALUES ('fa-hand-paper');
INSERT INTO public.menu_icon VALUES ('fa-hand-peace');
INSERT INTO public.menu_icon VALUES ('fa-hand-pointer');
INSERT INTO public.menu_icon VALUES ('fa-hand-rock');
INSERT INTO public.menu_icon VALUES ('fa-hand-scissors');
INSERT INTO public.menu_icon VALUES ('fa-hand-spock');
INSERT INTO public.menu_icon VALUES ('fa-hand-stop');
INSERT INTO public.menu_icon VALUES ('fa-hdd-o');
INSERT INTO public.menu_icon VALUES ('fa-heart-o');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-1');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-2');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-3');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-end');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-half');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-o');
INSERT INTO public.menu_icon VALUES ('fa-hourglass-start');
INSERT INTO public.menu_icon VALUES ('fa-i-cursor');
INSERT INTO public.menu_icon VALUES ('fa-info-circle');
INSERT INTO public.menu_icon VALUES ('fa-keyboard-o');
INSERT INTO public.menu_icon VALUES ('fa-lemon-o');
INSERT INTO public.menu_icon VALUES ('fa-level-down');
INSERT INTO public.menu_icon VALUES ('fa-level-up');
INSERT INTO public.menu_icon VALUES ('fa-life-bouy');
INSERT INTO public.menu_icon VALUES ('fa-life-buoy');
INSERT INTO public.menu_icon VALUES ('fa-life-ring');
INSERT INTO public.menu_icon VALUES ('fa-life-saver');
INSERT INTO public.menu_icon VALUES ('fa-lightbulb-o');
INSERT INTO public.menu_icon VALUES ('fa-line-chart');
INSERT INTO public.menu_icon VALUES ('fa-location-arrow');
INSERT INTO public.menu_icon VALUES ('fa-mail-forward');
INSERT INTO public.menu_icon VALUES ('fa-mail-reply');
INSERT INTO public.menu_icon VALUES ('fa-mail-reply');
INSERT INTO public.menu_icon VALUES ('fa-map-marker');
INSERT INTO public.menu_icon VALUES ('fa-map-o');
INSERT INTO public.menu_icon VALUES ('fa-map-pin');
INSERT INTO public.menu_icon VALUES ('fa-map-signs');
INSERT INTO public.menu_icon VALUES ('fa-meh-o');
INSERT INTO public.menu_icon VALUES ('fa-microphone-slash');
INSERT INTO public.menu_icon VALUES ('fa-minus-circle');
INSERT INTO public.menu_icon VALUES ('fa-minus-square');
INSERT INTO public.menu_icon VALUES ('fa-minus-square');
INSERT INTO public.menu_icon VALUES ('fa-mobile-phone');
INSERT INTO public.menu_icon VALUES ('fa-moon-o');
INSERT INTO public.menu_icon VALUES ('fa-mortar-board');
INSERT INTO public.menu_icon VALUES ('fa-mouse-pointer');
INSERT INTO public.menu_icon VALUES ('fa-newspaper-o');
INSERT INTO public.menu_icon VALUES ('fa-object-group');
INSERT INTO public.menu_icon VALUES ('fa-object-ungroup');
INSERT INTO public.menu_icon VALUES ('fa-paint-brush');
INSERT INTO public.menu_icon VALUES ('fa-paper-plane');
INSERT INTO public.menu_icon VALUES ('fa-paper-plane');
INSERT INTO public.menu_icon VALUES ('fa-pencil-square');
INSERT INTO public.menu_icon VALUES ('fa-pencil-square');
INSERT INTO public.menu_icon VALUES ('fa-phone-square');
INSERT INTO public.menu_icon VALUES ('fa-picture-o');
INSERT INTO public.menu_icon VALUES ('fa-pie-chart');
INSERT INTO public.menu_icon VALUES ('fa-plus-circle');
INSERT INTO public.menu_icon VALUES ('fa-plus-square');
INSERT INTO public.menu_icon VALUES ('fa-plus-square');
INSERT INTO public.menu_icon VALUES ('fa-power-off');
INSERT INTO public.menu_icon VALUES ('fa-puzzle-piece');
INSERT INTO public.menu_icon VALUES ('fa-question-circle');
INSERT INTO public.menu_icon VALUES ('fa-quote-left');
INSERT INTO public.menu_icon VALUES ('fa-quote-right');
INSERT INTO public.menu_icon VALUES ('fa-reply-all');
INSERT INTO public.menu_icon VALUES ('fa-rss-square');
INSERT INTO public.menu_icon VALUES ('fa-search-minus');
INSERT INTO public.menu_icon VALUES ('fa-search-plus');
INSERT INTO public.menu_icon VALUES ('fa-send-o');
INSERT INTO public.menu_icon VALUES ('fa-share-alt');
INSERT INTO public.menu_icon VALUES ('fa-share-alt');
INSERT INTO public.menu_icon VALUES ('fa-share-square');
INSERT INTO public.menu_icon VALUES ('fa-share-square');
INSERT INTO public.menu_icon VALUES ('fa-shopping-cart');
INSERT INTO public.menu_icon VALUES ('fa-sign-in');
INSERT INTO public.menu_icon VALUES ('fa-sign-out');
INSERT INTO public.menu_icon VALUES ('fa-smile-o');
INSERT INTO public.menu_icon VALUES ('fa-soccer-ball');
INSERT INTO public.menu_icon VALUES ('fa-sort-alpha');
INSERT INTO public.menu_icon VALUES ('fa-sort-alpha');
INSERT INTO public.menu_icon VALUES ('fa-sort-amount');
INSERT INTO public.menu_icon VALUES ('fa-sort-amount');
INSERT INTO public.menu_icon VALUES ('fa-sort-asc');
INSERT INTO public.menu_icon VALUES ('fa-sort-desc');
INSERT INTO public.menu_icon VALUES ('fa-sort-down');
INSERT INTO public.menu_icon VALUES ('fa-sort-numeric');
INSERT INTO public.menu_icon VALUES ('fa-sort-numeric');
INSERT INTO public.menu_icon VALUES ('fa-sort-up');
INSERT INTO public.menu_icon VALUES ('fa-space-shuttle');
INSERT INTO public.menu_icon VALUES ('fa-square-o');
INSERT INTO public.menu_icon VALUES ('fa-star-half');
INSERT INTO public.menu_icon VALUES ('fa-star-half');
INSERT INTO public.menu_icon VALUES ('fa-star-half');
INSERT INTO public.menu_icon VALUES ('fa-star-half');
INSERT INTO public.menu_icon VALUES ('fa-star-o');
INSERT INTO public.menu_icon VALUES ('fa-sticky-note');
INSERT INTO public.menu_icon VALUES ('fa-sticky-note');
INSERT INTO public.menu_icon VALUES ('fa-street-view');
INSERT INTO public.menu_icon VALUES ('fa-sun-o');
INSERT INTO public.menu_icon VALUES ('fa-thumb-tack');
INSERT INTO public.menu_icon VALUES ('fa-thumbs-down');
INSERT INTO public.menu_icon VALUES ('fa-thumbs-o');
INSERT INTO public.menu_icon VALUES ('fa-thumbs-o');
INSERT INTO public.menu_icon VALUES ('fa-thumbs-up');
INSERT INTO public.menu_icon VALUES ('fa-times-circle');
INSERT INTO public.menu_icon VALUES ('fa-times-circle');
INSERT INTO public.menu_icon VALUES ('fa-toggle-down');
INSERT INTO public.menu_icon VALUES ('fa-toggle-left');
INSERT INTO public.menu_icon VALUES ('fa-toggle-off');
INSERT INTO public.menu_icon VALUES ('fa-toggle-on');
INSERT INTO public.menu_icon VALUES ('fa-toggle-right');
INSERT INTO public.menu_icon VALUES ('fa-toggle-up');
INSERT INTO public.menu_icon VALUES ('fa-trash-o');
INSERT INTO public.menu_icon VALUES ('fa-unlock-alt');
INSERT INTO public.menu_icon VALUES ('fa-user-plus');
INSERT INTO public.menu_icon VALUES ('fa-user-secret');
INSERT INTO public.menu_icon VALUES ('fa-user-times');
INSERT INTO public.menu_icon VALUES ('fa-video-camera');
INSERT INTO public.menu_icon VALUES ('fa-volume-down');
INSERT INTO public.menu_icon VALUES ('fa-volume-off');
INSERT INTO public.menu_icon VALUES ('fa-volume-up');
INSERT INTO public.menu_icon VALUES ('fa-hand-grab');
INSERT INTO public.menu_icon VALUES ('fa-hand-lizard');
INSERT INTO public.menu_icon VALUES ('fa-hand-o');
INSERT INTO public.menu_icon VALUES ('fa-hand-o');
INSERT INTO public.menu_icon VALUES ('fa-hand-o');
INSERT INTO public.menu_icon VALUES ('fa-hand-o');
INSERT INTO public.menu_icon VALUES ('fa-hand-paper');
INSERT INTO public.menu_icon VALUES ('fa-hand-peace');
INSERT INTO public.menu_icon VALUES ('fa-hand-pointer');
INSERT INTO public.menu_icon VALUES ('fa-hand-rock');
INSERT INTO public.menu_icon VALUES ('fa-hand-scissors');
INSERT INTO public.menu_icon VALUES ('fa-hand-spock');
INSERT INTO public.menu_icon VALUES ('fa-hand-stop');
INSERT INTO public.menu_icon VALUES ('fa-thumbs-down');
INSERT INTO public.menu_icon VALUES ('fa-thumbs-o');
INSERT INTO public.menu_icon VALUES ('fa-thumbs-o');
INSERT INTO public.menu_icon VALUES ('fa-thumbs-up');
INSERT INTO public.menu_icon VALUES ('fa-fighter-jet');
INSERT INTO public.menu_icon VALUES ('fa-space-shuttle');
INSERT INTO public.menu_icon VALUES ('fa-mars-double');
INSERT INTO public.menu_icon VALUES ('fa-mars-stroke');
INSERT INTO public.menu_icon VALUES ('fa-mars-stroke');
INSERT INTO public.menu_icon VALUES ('fa-mars-stroke');
INSERT INTO public.menu_icon VALUES ('fa-transgender-alt');
INSERT INTO public.menu_icon VALUES ('fa-venus-double');
INSERT INTO public.menu_icon VALUES ('fa-venus-mars');
INSERT INTO public.menu_icon VALUES ('fa-file-archive');
INSERT INTO public.menu_icon VALUES ('fa-file-audio');
INSERT INTO public.menu_icon VALUES ('fa-file-code');
INSERT INTO public.menu_icon VALUES ('fa-file-excel');
INSERT INTO public.menu_icon VALUES ('fa-file-image');
INSERT INTO public.menu_icon VALUES ('fa-file-movie');
INSERT INTO public.menu_icon VALUES ('fa-file-o');
INSERT INTO public.menu_icon VALUES ('fa-file-pdf');
INSERT INTO public.menu_icon VALUES ('fa-file-photo');
INSERT INTO public.menu_icon VALUES ('fa-file-picture');
INSERT INTO public.menu_icon VALUES ('fa-file-powerpoint');
INSERT INTO public.menu_icon VALUES ('fa-file-sound');
INSERT INTO public.menu_icon VALUES ('fa-file-text');
INSERT INTO public.menu_icon VALUES ('fa-file-text');
INSERT INTO public.menu_icon VALUES ('fa-file-video');
INSERT INTO public.menu_icon VALUES ('fa-file-word');
INSERT INTO public.menu_icon VALUES ('fa-file-zip');
INSERT INTO public.menu_icon VALUES ('fa-circle-o');
INSERT INTO public.menu_icon VALUES ('fa-check-square');
INSERT INTO public.menu_icon VALUES ('fa-check-square');
INSERT INTO public.menu_icon VALUES ('fa-circle-o');
INSERT INTO public.menu_icon VALUES ('fa-dot-circle');
INSERT INTO public.menu_icon VALUES ('fa-minus-square');
INSERT INTO public.menu_icon VALUES ('fa-minus-square');
INSERT INTO public.menu_icon VALUES ('fa-plus-square');
INSERT INTO public.menu_icon VALUES ('fa-plus-square');
INSERT INTO public.menu_icon VALUES ('fa-square-o');
INSERT INTO public.menu_icon VALUES ('fa-cc-amex');
INSERT INTO public.menu_icon VALUES ('fa-cc-diners');
INSERT INTO public.menu_icon VALUES ('fa-cc-discover');
INSERT INTO public.menu_icon VALUES ('fa-cc-jcb');
INSERT INTO public.menu_icon VALUES ('fa-cc-mastercard');
INSERT INTO public.menu_icon VALUES ('fa-cc-paypal');
INSERT INTO public.menu_icon VALUES ('fa-cc-stripe');
INSERT INTO public.menu_icon VALUES ('fa-cc-visa');
INSERT INTO public.menu_icon VALUES ('fa-credit-card');
INSERT INTO public.menu_icon VALUES ('fa-google-wallet');
INSERT INTO public.menu_icon VALUES ('fa-area-chart');
INSERT INTO public.menu_icon VALUES ('fa-bar-chart');
INSERT INTO public.menu_icon VALUES ('fa-bar-chart');
INSERT INTO public.menu_icon VALUES ('fa-line-chart');
INSERT INTO public.menu_icon VALUES ('fa-pie-chart');
INSERT INTO public.menu_icon VALUES ('fa-gg-circle');
INSERT INTO public.menu_icon VALUES ('fa-turkish-lira');
INSERT INTO public.menu_icon VALUES ('fa-align-center');
INSERT INTO public.menu_icon VALUES ('fa-align-justify');
INSERT INTO public.menu_icon VALUES ('fa-align-left');
INSERT INTO public.menu_icon VALUES ('fa-align-right');
INSERT INTO public.menu_icon VALUES ('fa-chain-broken');
INSERT INTO public.menu_icon VALUES ('fa-file-o');
INSERT INTO public.menu_icon VALUES ('fa-file-text');
INSERT INTO public.menu_icon VALUES ('fa-file-text');
INSERT INTO public.menu_icon VALUES ('fa-files-o');
INSERT INTO public.menu_icon VALUES ('fa-floppy-o');
INSERT INTO public.menu_icon VALUES ('fa-list-alt');
INSERT INTO public.menu_icon VALUES ('fa-list-ol');
INSERT INTO public.menu_icon VALUES ('fa-list-ul');
INSERT INTO public.menu_icon VALUES ('fa-rotate-left');
INSERT INTO public.menu_icon VALUES ('fa-rotate-right');
INSERT INTO public.menu_icon VALUES ('fa-text-height');
INSERT INTO public.menu_icon VALUES ('fa-text-width');
INSERT INTO public.menu_icon VALUES ('fa-th-large');
INSERT INTO public.menu_icon VALUES ('fa-th-list');
INSERT INTO public.menu_icon VALUES ('fa-angle-double');
INSERT INTO public.menu_icon VALUES ('fa-angle-double');
INSERT INTO public.menu_icon VALUES ('fa-angle-double');
INSERT INTO public.menu_icon VALUES ('fa-angle-double');
INSERT INTO public.menu_icon VALUES ('fa-angle-down');
INSERT INTO public.menu_icon VALUES ('fa-angle-left');
INSERT INTO public.menu_icon VALUES ('fa-angle-right');
INSERT INTO public.menu_icon VALUES ('fa-angle-up');
INSERT INTO public.menu_icon VALUES ('fa-arrow-circle');
INSERT INTO public.menu_icon VALUES ('fa-arrow-circle');
INSERT INTO public.menu_icon VALUES ('fa-arrow-circle');
INSERT INTO public.menu_icon VALUES ('fa-arrow-circle');
INSERT INTO public.menu_icon VALUES ('fa-arrow-circle');
INSERT INTO public.menu_icon VALUES ('fa-arrow-circle');
INSERT INTO public.menu_icon VALUES ('fa-arrow-circle');
INSERT INTO public.menu_icon VALUES ('fa-arrow-circle');
INSERT INTO public.menu_icon VALUES ('fa-arrow-down');
INSERT INTO public.menu_icon VALUES ('fa-arrow-left');
INSERT INTO public.menu_icon VALUES ('fa-arrow-right');
INSERT INTO public.menu_icon VALUES ('fa-arrow-up');
INSERT INTO public.menu_icon VALUES ('fa-arrows-alt');
INSERT INTO public.menu_icon VALUES ('fa-arrows-h');
INSERT INTO public.menu_icon VALUES ('fa-arrows-v');
INSERT INTO public.menu_icon VALUES ('fa-caret-down');
INSERT INTO public.menu_icon VALUES ('fa-caret-left');
INSERT INTO public.menu_icon VALUES ('fa-caret-right');
INSERT INTO public.menu_icon VALUES ('fa-caret-square');
INSERT INTO public.menu_icon VALUES ('fa-caret-square');
INSERT INTO public.menu_icon VALUES ('fa-caret-square');
INSERT INTO public.menu_icon VALUES ('fa-caret-square');
INSERT INTO public.menu_icon VALUES ('fa-caret-up');
INSERT INTO public.menu_icon VALUES ('fa-chevron-circle');
INSERT INTO public.menu_icon VALUES ('fa-chevron-circle');
INSERT INTO public.menu_icon VALUES ('fa-chevron-circle');
INSERT INTO public.menu_icon VALUES ('fa-chevron-circle');
INSERT INTO public.menu_icon VALUES ('fa-chevron-down');
INSERT INTO public.menu_icon VALUES ('fa-chevron-left');
INSERT INTO public.menu_icon VALUES ('fa-chevron-right');
INSERT INTO public.menu_icon VALUES ('fa-chevron-up');
INSERT INTO public.menu_icon VALUES ('fa-hand-o');
INSERT INTO public.menu_icon VALUES ('fa-hand-o');
INSERT INTO public.menu_icon VALUES ('fa-hand-o');
INSERT INTO public.menu_icon VALUES ('fa-hand-o');
INSERT INTO public.menu_icon VALUES ('fa-long-arrow');
INSERT INTO public.menu_icon VALUES ('fa-long-arrow');
INSERT INTO public.menu_icon VALUES ('fa-long-arrow');
INSERT INTO public.menu_icon VALUES ('fa-long-arrow');
INSERT INTO public.menu_icon VALUES ('fa-toggle-down');
INSERT INTO public.menu_icon VALUES ('fa-toggle-left');
INSERT INTO public.menu_icon VALUES ('fa-toggle-right');
INSERT INTO public.menu_icon VALUES ('fa-toggle-up');
INSERT INTO public.menu_icon VALUES ('fa-arrows-alt');
INSERT INTO public.menu_icon VALUES ('fa-fast-backward');
INSERT INTO public.menu_icon VALUES ('fa-fast-forward');
INSERT INTO public.menu_icon VALUES ('fa-play-circle');
INSERT INTO public.menu_icon VALUES ('fa-play-circle');
INSERT INTO public.menu_icon VALUES ('fa-step-backward');
INSERT INTO public.menu_icon VALUES ('fa-step-forward');
INSERT INTO public.menu_icon VALUES ('fa-youtube-play');
INSERT INTO public.menu_icon VALUES ('fa-behance-square');
INSERT INTO public.menu_icon VALUES ('fa-bitbucket-square');
INSERT INTO public.menu_icon VALUES ('fa-black-tie');
INSERT INTO public.menu_icon VALUES ('fa-cc-amex');
INSERT INTO public.menu_icon VALUES ('fa-cc-diners');
INSERT INTO public.menu_icon VALUES ('fa-cc-discover');
INSERT INTO public.menu_icon VALUES ('fa-cc-jcb');
INSERT INTO public.menu_icon VALUES ('fa-cc-mastercard');
INSERT INTO public.menu_icon VALUES ('fa-cc-paypal');
INSERT INTO public.menu_icon VALUES ('fa-cc-stripe');
INSERT INTO public.menu_icon VALUES ('fa-cc-visa');
INSERT INTO public.menu_icon VALUES ('fa-facebook-f');
INSERT INTO public.menu_icon VALUES ('fa-facebook-official');
INSERT INTO public.menu_icon VALUES ('fa-facebook-square');
INSERT INTO public.menu_icon VALUES ('fa-get-pocket');
INSERT INTO public.menu_icon VALUES ('fa-gg-circle');
INSERT INTO public.menu_icon VALUES ('fa-git-square');
INSERT INTO public.menu_icon VALUES ('fa-github-alt');
INSERT INTO public.menu_icon VALUES ('fa-github-square');
INSERT INTO public.menu_icon VALUES ('fa-google-plus');
INSERT INTO public.menu_icon VALUES ('fa-google-plus');
INSERT INTO public.menu_icon VALUES ('fa-google-wallet');
INSERT INTO public.menu_icon VALUES ('fa-hacker-news');
INSERT INTO public.menu_icon VALUES ('fa-internet-explorer');
INSERT INTO public.menu_icon VALUES ('fa-lastfm-square');
INSERT INTO public.menu_icon VALUES ('fa-linkedin-square');
INSERT INTO public.menu_icon VALUES ('fa-odnoklassniki-square');
INSERT INTO public.menu_icon VALUES ('fa-optin-monster');
INSERT INTO public.menu_icon VALUES ('fa-pied-piper');
INSERT INTO public.menu_icon VALUES ('fa-pied-piper');
INSERT INTO public.menu_icon VALUES ('fa-pinterest-p');
INSERT INTO public.menu_icon VALUES ('fa-pinterest-square');
INSERT INTO public.menu_icon VALUES ('fa-reddit-square');
INSERT INTO public.menu_icon VALUES ('fa-share-alt');
INSERT INTO public.menu_icon VALUES ('fa-share-alt');
INSERT INTO public.menu_icon VALUES ('fa-stack-exchange');
INSERT INTO public.menu_icon VALUES ('fa-stack-overflow');
INSERT INTO public.menu_icon VALUES ('fa-steam-square');
INSERT INTO public.menu_icon VALUES ('fa-stumbleupon-circle');
INSERT INTO public.menu_icon VALUES ('fa-tencent-weibo');
INSERT INTO public.menu_icon VALUES ('fa-tumblr-square');
INSERT INTO public.menu_icon VALUES ('fa-twitter-square');
INSERT INTO public.menu_icon VALUES ('fa-vimeo-square');
INSERT INTO public.menu_icon VALUES ('fa-wikipedia-w');
INSERT INTO public.menu_icon VALUES ('fa-xing-square');
INSERT INTO public.menu_icon VALUES ('fa-y-combinator');
INSERT INTO public.menu_icon VALUES ('fa-y-combinator');
INSERT INTO public.menu_icon VALUES ('fa-yc-square');
INSERT INTO public.menu_icon VALUES ('fa-youtube-play');
INSERT INTO public.menu_icon VALUES ('fa-youtube-square');
INSERT INTO public.menu_icon VALUES ('fa-h-square');
INSERT INTO public.menu_icon VALUES ('fa-heart-o');
INSERT INTO public.menu_icon VALUES ('fa-hospital-o');
INSERT INTO public.menu_icon VALUES ('fa-plus-square');
INSERT INTO public.menu_icon VALUES ('fa-user-md');


--
-- TOC entry 3867 (class 0 OID 93719)
-- Dependencies: 290
-- Data for Name: menu_type; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.menu_type VALUES (1, 'side menu', NULL);
INSERT INTO public.menu_type VALUES (2, 'top menu', NULL);


--
-- TOC entry 3868 (class 0 OID 93728)
-- Dependencies: 291
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.migrations VALUES (1);


--
-- TOC entry 3870 (class 0 OID 93732)
-- Dependencies: 293
-- Data for Name: mutasi; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3872 (class 0 OID 93743)
-- Dependencies: 295
-- Data for Name: page; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.page VALUES (1, 'home', 'frontend', '<cc-element cc-id=\"style\">\n    <link data-src=\"stylesheet-bootstrap\" href=\"http://localhost:80/pinjam/cc-content/page-element/portofolio\\/package/vendor/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">\n    <link data-src=\"stylesheet-freelancer\" href=\"http://localhost:80/pinjam/cc-content/page-element/portofolio\\/package/css/freelancer.min.css\" rel=\"stylesheet\">\n    <link data-src=\"stylesheet-font-awesome\" href=\"http://localhost:80/pinjam/cc-content/page-element/portofolio\\/package/vendor/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\">\n    <link data-src=\"stylesheet-bootstrap\" href=\"https://fonts.googleapis.com/css?family=Montserrat:400,700\" rel=\"stylesheet\" type=\"text/css\">\n    <link data-src=\"stylesheet-bootstrap\" href=\"https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic\" rel=\"stylesheet\" type=\"text/css\">\n</cc-element>\n\n<cc-element cc-id=\"content\">\n    <header class=\"free-header\" style=\"\">\n        </header></cc-element>', '\n                                    \n                                    \n                                    \n                                    \n                                    \n                                    \n                                    \n                                                                                                                                                      <li class=\"block-item ui-draggable ui-draggable-handle block-item-loaded\" data-src=\"portofolio\\/header.php\" data-block-name=\"portofolio\\\" style=\"width: 200px; right: auto; height: 107px; bottom: auto; display: list-item;\">\n				                <div class=\"nav-content-wrapper noselect ui-sortable\">\n				                  <i class=\"fa fa-gear\"></i>\n				                  <div class=\"tool-nav delete ui-sortable\">\n				                    <i class=\"fa fa-trash\"></i> <span class=\"info-nav\">Delete</span>\n				                  </div>\n				                  <div class=\"tool-nav source ui-sortable\">\n				                    <i class=\"fa fa-code\"></i> <span class=\"info-nav\">Source</span>\n				                  </div>\n				                  <div class=\"tool-nav copy ui-sortable\">\n				                    <i class=\"fa fa-copy\"></i> <span class=\"info-nav\">Copy</span>\n				                  </div>\n				                  <div class=\"tool-nav handle ui-sortable ui-sortable-handle\">\n				                    <i class=\"fa fa-arrows\"></i> <span class=\"info-nav\">Move</span>\n				                  </div>\n				                </div>\n				              \n				              <div class=\"block-content editable ui-sortable\"><cc-element cc-id=\"style\">\n    <link data-src=\"stylesheet-bootstrap\" href=\"http://localhost:80/pinjam/cc-content/page-element/portofolio\\/package/vendor/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">\n    <link data-src=\"stylesheet-freelancer\" href=\"http://localhost:80/pinjam/cc-content/page-element/portofolio\\/package/css/freelancer.min.css\" rel=\"stylesheet\">\n    <link data-src=\"stylesheet-font-awesome\" href=\"http://localhost:80/pinjam/cc-content/page-element/portofolio\\/package/vendor/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\">\n    <link data-src=\"stylesheet-bootstrap\" href=\"https://fonts.googleapis.com/css?family=Montserrat:400,700\" rel=\"stylesheet\" type=\"text/css\">\n    <link data-src=\"stylesheet-bootstrap\" href=\"https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic\" rel=\"stylesheet\" type=\"text/css\">\n</cc-element>\n\n<cc-element cc-id=\"content\">\n    <header class=\"free-header\" style=\"\">\n        </header></cc-element></div></li>                                                                                                                                                 ', '', '', 'home', 'default', '2019-01-05 01:08:34+07');


--
-- TOC entry 3874 (class 0 OID 93755)
-- Dependencies: 297
-- Data for Name: page_block_element; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3876 (class 0 OID 93764)
-- Dependencies: 299
-- Data for Name: penempatan; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3878 (class 0 OID 93775)
-- Dependencies: 301
-- Data for Name: pengadaan; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3880 (class 0 OID 93786)
-- Dependencies: 303
-- Data for Name: pengajuan; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3882 (class 0 OID 93799)
-- Dependencies: 305
-- Data for Name: pengembalian; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3884 (class 0 OID 93811)
-- Dependencies: 307
-- Data for Name: rest; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3886 (class 0 OID 93822)
-- Dependencies: 309
-- Data for Name: rest_field; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3888 (class 0 OID 93833)
-- Dependencies: 311
-- Data for Name: rest_field_validation; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3890 (class 0 OID 93842)
-- Dependencies: 313
-- Data for Name: rest_input_type; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.rest_input_type VALUES (1, 'input', '0', 'input');
INSERT INTO public.rest_input_type VALUES (2, 'timestamp', '0', 'timestamp');
INSERT INTO public.rest_input_type VALUES (3, 'file', '0', 'file');


--
-- TOC entry 3892 (class 0 OID 93849)
-- Dependencies: 315
-- Data for Name: retur; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3894 (class 0 OID 93861)
-- Dependencies: 317
-- Data for Name: ruangan; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3896 (class 0 OID 93870)
-- Dependencies: 319
-- Data for Name: supplier; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3952 (class 0 OID 0)
-- Dependencies: 214
-- Name: aauth_groups_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.aauth_groups_id_seq', 1, false);


--
-- TOC entry 3953 (class 0 OID 0)
-- Dependencies: 217
-- Name: aauth_login_attempts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.aauth_login_attempts_id_seq', 1, false);


--
-- TOC entry 3954 (class 0 OID 0)
-- Dependencies: 219
-- Name: aauth_perms_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.aauth_perms_id_seq', 1, false);


--
-- TOC entry 3955 (class 0 OID 0)
-- Dependencies: 223
-- Name: aauth_pms_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.aauth_pms_id_seq', 1, false);


--
-- TOC entry 3956 (class 0 OID 0)
-- Dependencies: 225
-- Name: aauth_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.aauth_user_id_seq', 1, false);


--
-- TOC entry 3957 (class 0 OID 0)
-- Dependencies: 230
-- Name: aauth_user_variables_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.aauth_user_variables_id_seq', 1, false);


--
-- TOC entry 3958 (class 0 OID 0)
-- Dependencies: 227
-- Name: aauth_users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.aauth_users_id_seq', 1, false);


--
-- TOC entry 3959 (class 0 OID 0)
-- Dependencies: 232
-- Name: agama_id_agama_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.agama_id_agama_seq', 1, false);


--
-- TOC entry 3960 (class 0 OID 0)
-- Dependencies: 234
-- Name: barang_id_barang_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.barang_id_barang_seq', 1, false);


--
-- TOC entry 3961 (class 0 OID 0)
-- Dependencies: 238
-- Name: blog_category_category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.blog_category_category_id_seq', 1, false);


--
-- TOC entry 3962 (class 0 OID 0)
-- Dependencies: 236
-- Name: blog_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.blog_id_seq', 1, false);


--
-- TOC entry 3963 (class 0 OID 0)
-- Dependencies: 240
-- Name: captcha_captcha_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.captcha_captcha_id_seq', 1, false);


--
-- TOC entry 3964 (class 0 OID 0)
-- Dependencies: 242
-- Name: cc_options_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cc_options_id_seq', 1, false);


--
-- TOC entry 3965 (class 0 OID 0)
-- Dependencies: 244
-- Name: cc_session_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cc_session_id_seq', 1, false);


--
-- TOC entry 3966 (class 0 OID 0)
-- Dependencies: 248
-- Name: crud_custom_option_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.crud_custom_option_id_seq', 1, false);


--
-- TOC entry 3967 (class 0 OID 0)
-- Dependencies: 250
-- Name: crud_field_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.crud_field_id_seq', 1, false);


--
-- TOC entry 3968 (class 0 OID 0)
-- Dependencies: 252
-- Name: crud_field_validation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.crud_field_validation_id_seq', 1, false);


--
-- TOC entry 3969 (class 0 OID 0)
-- Dependencies: 246
-- Name: crud_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.crud_id_seq', 1, false);


--
-- TOC entry 3970 (class 0 OID 0)
-- Dependencies: 254
-- Name: crud_input_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.crud_input_type_id_seq', 1, false);


--
-- TOC entry 3971 (class 0 OID 0)
-- Dependencies: 256
-- Name: crud_input_validation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.crud_input_validation_id_seq', 1, false);


--
-- TOC entry 3972 (class 0 OID 0)
-- Dependencies: 258
-- Name: departemen_id_dep_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.departemen_id_dep_seq', 1, false);


--
-- TOC entry 3973 (class 0 OID 0)
-- Dependencies: 260
-- Name: disposal_id_disposal_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.disposal_id_disposal_seq', 1, false);


--
-- TOC entry 3974 (class 0 OID 0)
-- Dependencies: 264
-- Name: form_custom_attribute_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.form_custom_attribute_id_seq', 1, false);


--
-- TOC entry 3975 (class 0 OID 0)
-- Dependencies: 266
-- Name: form_custom_option_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.form_custom_option_id_seq', 1, false);


--
-- TOC entry 3976 (class 0 OID 0)
-- Dependencies: 268
-- Name: form_field_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.form_field_id_seq', 1, false);


--
-- TOC entry 3977 (class 0 OID 0)
-- Dependencies: 270
-- Name: form_field_validation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.form_field_validation_id_seq', 1, false);


--
-- TOC entry 3978 (class 0 OID 0)
-- Dependencies: 262
-- Name: form_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.form_id_seq', 1, false);


--
-- TOC entry 3979 (class 0 OID 0)
-- Dependencies: 272
-- Name: form_pengajuan_pinjam_barang_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.form_pengajuan_pinjam_barang_id_seq', 1, false);


--
-- TOC entry 3980 (class 0 OID 0)
-- Dependencies: 274
-- Name: jabatan_id_jabatan_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jabatan_id_jabatan_seq', 1, false);


--
-- TOC entry 3981 (class 0 OID 0)
-- Dependencies: 276
-- Name: jenis_pengadaan_id_jenis_pendagaan_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jenis_pengadaan_id_jenis_pendagaan_seq', 1, false);


--
-- TOC entry 3982 (class 0 OID 0)
-- Dependencies: 278
-- Name: karyawan_id_karyawan_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.karyawan_id_karyawan_seq', 1, false);


--
-- TOC entry 3983 (class 0 OID 0)
-- Dependencies: 280
-- Name: kategori_id_kategori_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kategori_id_kategori_seq', 1, false);


--
-- TOC entry 3984 (class 0 OID 0)
-- Dependencies: 282
-- Name: keys_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.keys_id_seq', 1, false);


--
-- TOC entry 3985 (class 0 OID 0)
-- Dependencies: 284
-- Name: lokasi_id_lok_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lokasi_id_lok_seq', 1, false);


--
-- TOC entry 3986 (class 0 OID 0)
-- Dependencies: 286
-- Name: menu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.menu_id_seq', 1, false);


--
-- TOC entry 3987 (class 0 OID 0)
-- Dependencies: 289
-- Name: menu_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.menu_type_id_seq', 1, false);


--
-- TOC entry 3988 (class 0 OID 0)
-- Dependencies: 292
-- Name: mutasi_id_mutasi_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.mutasi_id_mutasi_seq', 1, false);


--
-- TOC entry 3989 (class 0 OID 0)
-- Dependencies: 296
-- Name: page_block_element_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.page_block_element_id_seq', 1, false);


--
-- TOC entry 3990 (class 0 OID 0)
-- Dependencies: 294
-- Name: page_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.page_id_seq', 1, false);


--
-- TOC entry 3991 (class 0 OID 0)
-- Dependencies: 298
-- Name: penempatan_id_penempatan_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.penempatan_id_penempatan_seq', 1, false);


--
-- TOC entry 3992 (class 0 OID 0)
-- Dependencies: 300
-- Name: pengadaan_id_pengadaan_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pengadaan_id_pengadaan_seq', 1, false);


--
-- TOC entry 3993 (class 0 OID 0)
-- Dependencies: 302
-- Name: pengajuan_id_pengajuan_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pengajuan_id_pengajuan_seq', 1, false);


--
-- TOC entry 3994 (class 0 OID 0)
-- Dependencies: 304
-- Name: pengembalian_id_kembali_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pengembalian_id_kembali_seq', 1, false);


--
-- TOC entry 3995 (class 0 OID 0)
-- Dependencies: 308
-- Name: rest_field_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.rest_field_id_seq', 1, false);


--
-- TOC entry 3996 (class 0 OID 0)
-- Dependencies: 310
-- Name: rest_field_validation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.rest_field_validation_id_seq', 1, false);


--
-- TOC entry 3997 (class 0 OID 0)
-- Dependencies: 306
-- Name: rest_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.rest_id_seq', 1, false);


--
-- TOC entry 3998 (class 0 OID 0)
-- Dependencies: 312
-- Name: rest_input_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.rest_input_type_id_seq', 1, false);


--
-- TOC entry 3999 (class 0 OID 0)
-- Dependencies: 314
-- Name: retur_id_retur_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.retur_id_retur_seq', 1, false);


--
-- TOC entry 4000 (class 0 OID 0)
-- Dependencies: 316
-- Name: ruangan_id_ruangan_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ruangan_id_ruangan_seq', 1, false);


--
-- TOC entry 4001 (class 0 OID 0)
-- Dependencies: 318
-- Name: supplier_id_sup_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.supplier_id_sup_seq', 1, false);


--
-- TOC entry 3539 (class 2606 OID 93379)
-- Name: aauth_group_to_group aauth_group_to_group_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aauth_group_to_group
    ADD CONSTRAINT aauth_group_to_group_pkey PRIMARY KEY (group_id, subgroup_id);


--
-- TOC entry 3537 (class 2606 OID 93374)
-- Name: aauth_groups aauth_groups_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aauth_groups
    ADD CONSTRAINT aauth_groups_pkey PRIMARY KEY (id);


--
-- TOC entry 3541 (class 2606 OID 93387)
-- Name: aauth_login_attempts aauth_login_attempts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aauth_login_attempts
    ADD CONSTRAINT aauth_login_attempts_pkey PRIMARY KEY (id);


--
-- TOC entry 3545 (class 2606 OID 93404)
-- Name: aauth_perm_to_user aauth_perm_to_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aauth_perm_to_user
    ADD CONSTRAINT aauth_perm_to_user_pkey PRIMARY KEY (user_id, perm_id);


--
-- TOC entry 3543 (class 2606 OID 93396)
-- Name: aauth_perms aauth_perms_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aauth_perms
    ADD CONSTRAINT aauth_perms_pkey PRIMARY KEY (id);


--
-- TOC entry 3547 (class 2606 OID 93413)
-- Name: aauth_pms aauth_pms_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aauth_pms
    ADD CONSTRAINT aauth_pms_pkey PRIMARY KEY (id);


--
-- TOC entry 3549 (class 2606 OID 93423)
-- Name: aauth_user aauth_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aauth_user
    ADD CONSTRAINT aauth_user_pkey PRIMARY KEY (id);


--
-- TOC entry 3553 (class 2606 OID 93439)
-- Name: aauth_user_to_group aauth_user_to_group_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aauth_user_to_group
    ADD CONSTRAINT aauth_user_to_group_pkey PRIMARY KEY (user_id, group_id);


--
-- TOC entry 3555 (class 2606 OID 93448)
-- Name: aauth_user_variables aauth_user_variables_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aauth_user_variables
    ADD CONSTRAINT aauth_user_variables_pkey PRIMARY KEY (id);


--
-- TOC entry 3551 (class 2606 OID 93434)
-- Name: aauth_users aauth_users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aauth_users
    ADD CONSTRAINT aauth_users_pkey PRIMARY KEY (id);


--
-- TOC entry 3557 (class 2606 OID 93455)
-- Name: agama agama_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agama
    ADD CONSTRAINT agama_pkey PRIMARY KEY (id_agama);


--
-- TOC entry 3559 (class 2606 OID 93464)
-- Name: barang barang_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.barang
    ADD CONSTRAINT barang_pkey PRIMARY KEY (id_barang);


--
-- TOC entry 3563 (class 2606 OID 93483)
-- Name: blog_category blog_category_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.blog_category
    ADD CONSTRAINT blog_category_pkey PRIMARY KEY (category_id);


--
-- TOC entry 3561 (class 2606 OID 93474)
-- Name: blog blog_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.blog
    ADD CONSTRAINT blog_pkey PRIMARY KEY (id);


--
-- TOC entry 3565 (class 2606 OID 93490)
-- Name: captcha captcha_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.captcha
    ADD CONSTRAINT captcha_pkey PRIMARY KEY (captcha_id);


--
-- TOC entry 3567 (class 2606 OID 93499)
-- Name: cc_options cc_options_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cc_options
    ADD CONSTRAINT cc_options_pkey PRIMARY KEY (id);


--
-- TOC entry 3569 (class 2606 OID 93508)
-- Name: cc_session cc_session_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cc_session
    ADD CONSTRAINT cc_session_pkey PRIMARY KEY (id);


--
-- TOC entry 3573 (class 2606 OID 93530)
-- Name: crud_custom_option crud_custom_option_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.crud_custom_option
    ADD CONSTRAINT crud_custom_option_pkey PRIMARY KEY (id);


--
-- TOC entry 3575 (class 2606 OID 93546)
-- Name: crud_field crud_field_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.crud_field
    ADD CONSTRAINT crud_field_pkey PRIMARY KEY (id);


--
-- TOC entry 3577 (class 2606 OID 93555)
-- Name: crud_field_validation crud_field_validation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.crud_field_validation
    ADD CONSTRAINT crud_field_validation_pkey PRIMARY KEY (id);


--
-- TOC entry 3579 (class 2606 OID 93562)
-- Name: crud_input_type crud_input_type_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.crud_input_type
    ADD CONSTRAINT crud_input_type_pkey PRIMARY KEY (id);


--
-- TOC entry 3581 (class 2606 OID 93571)
-- Name: crud_input_validation crud_input_validation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.crud_input_validation
    ADD CONSTRAINT crud_input_validation_pkey PRIMARY KEY (id);


--
-- TOC entry 3571 (class 2606 OID 93521)
-- Name: crud crud_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.crud
    ADD CONSTRAINT crud_pkey PRIMARY KEY (id);


--
-- TOC entry 3583 (class 2606 OID 93580)
-- Name: departemen departemen_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.departemen
    ADD CONSTRAINT departemen_pkey PRIMARY KEY (id_dep);


--
-- TOC entry 3585 (class 2606 OID 93589)
-- Name: disposal disposal_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.disposal
    ADD CONSTRAINT disposal_pkey PRIMARY KEY (id_disposal);


--
-- TOC entry 3589 (class 2606 OID 93609)
-- Name: form_custom_attribute form_custom_attribute_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.form_custom_attribute
    ADD CONSTRAINT form_custom_attribute_pkey PRIMARY KEY (id);


--
-- TOC entry 3591 (class 2606 OID 93618)
-- Name: form_custom_option form_custom_option_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.form_custom_option
    ADD CONSTRAINT form_custom_option_pkey PRIMARY KEY (id);


--
-- TOC entry 3593 (class 2606 OID 93632)
-- Name: form_field form_field_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.form_field
    ADD CONSTRAINT form_field_pkey PRIMARY KEY (id);


--
-- TOC entry 3595 (class 2606 OID 93641)
-- Name: form_field_validation form_field_validation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.form_field_validation
    ADD CONSTRAINT form_field_validation_pkey PRIMARY KEY (id);


--
-- TOC entry 3597 (class 2606 OID 93650)
-- Name: form_pengajuan_pinjam_barang form_pengajuan_pinjam_barang_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.form_pengajuan_pinjam_barang
    ADD CONSTRAINT form_pengajuan_pinjam_barang_pkey PRIMARY KEY (id);


--
-- TOC entry 3587 (class 2606 OID 93600)
-- Name: form form_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.form
    ADD CONSTRAINT form_pkey PRIMARY KEY (id);


--
-- TOC entry 3599 (class 2606 OID 93657)
-- Name: jabatan jabatan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jabatan
    ADD CONSTRAINT jabatan_pkey PRIMARY KEY (id_jabatan);


--
-- TOC entry 3601 (class 2606 OID 93666)
-- Name: jenis_pengadaan jenis_pengadaan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jenis_pengadaan
    ADD CONSTRAINT jenis_pengadaan_pkey PRIMARY KEY (id_jenis_pendagaan);


--
-- TOC entry 3603 (class 2606 OID 93673)
-- Name: karyawan karyawan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.karyawan
    ADD CONSTRAINT karyawan_pkey PRIMARY KEY (id_karyawan);


--
-- TOC entry 3605 (class 2606 OID 93682)
-- Name: kategori kategori_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kategori
    ADD CONSTRAINT kategori_pkey PRIMARY KEY (id_kategori);


--
-- TOC entry 3607 (class 2606 OID 93692)
-- Name: keys keys_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.keys
    ADD CONSTRAINT keys_pkey PRIMARY KEY (id);


--
-- TOC entry 3609 (class 2606 OID 93699)
-- Name: lokasi lokasi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lokasi
    ADD CONSTRAINT lokasi_pkey PRIMARY KEY (id_lok);


--
-- TOC entry 3611 (class 2606 OID 93714)
-- Name: menu menu_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menu
    ADD CONSTRAINT menu_pkey PRIMARY KEY (id);


--
-- TOC entry 3613 (class 2606 OID 93726)
-- Name: menu_type menu_type_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menu_type
    ADD CONSTRAINT menu_type_pkey PRIMARY KEY (id);


--
-- TOC entry 3615 (class 2606 OID 93739)
-- Name: mutasi mutasi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mutasi
    ADD CONSTRAINT mutasi_pkey PRIMARY KEY (id_mutasi);


--
-- TOC entry 3619 (class 2606 OID 93762)
-- Name: page_block_element page_block_element_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.page_block_element
    ADD CONSTRAINT page_block_element_pkey PRIMARY KEY (id);


--
-- TOC entry 3617 (class 2606 OID 93753)
-- Name: page page_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.page
    ADD CONSTRAINT page_pkey PRIMARY KEY (id);


--
-- TOC entry 3621 (class 2606 OID 93771)
-- Name: penempatan penempatan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.penempatan
    ADD CONSTRAINT penempatan_pkey PRIMARY KEY (id_penempatan);


--
-- TOC entry 3623 (class 2606 OID 93782)
-- Name: pengadaan pengadaan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengadaan
    ADD CONSTRAINT pengadaan_pkey PRIMARY KEY (id_pengadaan);


--
-- TOC entry 3625 (class 2606 OID 93794)
-- Name: pengajuan pengajuan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengajuan
    ADD CONSTRAINT pengajuan_pkey PRIMARY KEY (id_pengajuan);


--
-- TOC entry 3627 (class 2606 OID 93807)
-- Name: pengembalian pengembalian_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengembalian
    ADD CONSTRAINT pengembalian_pkey PRIMARY KEY (id_kembali);


--
-- TOC entry 3631 (class 2606 OID 93831)
-- Name: rest_field rest_field_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rest_field
    ADD CONSTRAINT rest_field_pkey PRIMARY KEY (id);


--
-- TOC entry 3633 (class 2606 OID 93840)
-- Name: rest_field_validation rest_field_validation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rest_field_validation
    ADD CONSTRAINT rest_field_validation_pkey PRIMARY KEY (id);


--
-- TOC entry 3635 (class 2606 OID 93847)
-- Name: rest_input_type rest_input_type_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rest_input_type
    ADD CONSTRAINT rest_input_type_pkey PRIMARY KEY (id);


--
-- TOC entry 3629 (class 2606 OID 93820)
-- Name: rest rest_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rest
    ADD CONSTRAINT rest_pkey PRIMARY KEY (id);


--
-- TOC entry 3637 (class 2606 OID 93856)
-- Name: retur retur_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.retur
    ADD CONSTRAINT retur_pkey PRIMARY KEY (id_retur);


--
-- TOC entry 3639 (class 2606 OID 93868)
-- Name: ruangan ruangan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ruangan
    ADD CONSTRAINT ruangan_pkey PRIMARY KEY (id_ruangan);


--
-- TOC entry 3641 (class 2606 OID 93877)
-- Name: supplier supplier_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.supplier
    ADD CONSTRAINT supplier_pkey PRIMARY KEY (id_sup);


--
-- TOC entry 3642 (class 2620 OID 93591)
-- Name: disposal disposal_barang; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER disposal_barang AFTER INSERT ON public.disposal FOR EACH ROW EXECUTE FUNCTION public.update_barang_after_disposal();


--
-- TOC entry 3643 (class 2620 OID 93741)
-- Name: mutasi keterangan_mutasi; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER keterangan_mutasi AFTER INSERT ON public.mutasi FOR EACH ROW EXECUTE FUNCTION public.keterangan_mutasi_func();


--
-- TOC entry 3644 (class 2620 OID 93773)
-- Name: penempatan penempatan_barang; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER penempatan_barang AFTER INSERT ON public.penempatan FOR EACH ROW EXECUTE FUNCTION public.penempatan_barang();


--
-- TOC entry 3645 (class 2620 OID 93784)
-- Name: pengadaan pengadaan_barang; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER pengadaan_barang AFTER INSERT ON public.pengadaan FOR EACH ROW EXECUTE FUNCTION public.pengadaan_barang();


--
-- TOC entry 3646 (class 2620 OID 93796)
-- Name: pengajuan pengajuan_pinjam; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER pengajuan_pinjam AFTER INSERT ON public.pengajuan FOR EACH ROW EXECUTE FUNCTION public.pengajuan_pinjam();


--
-- TOC entry 3647 (class 2620 OID 93809)
-- Name: pengembalian pengembalian_barang; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER pengembalian_barang AFTER INSERT ON public.pengembalian FOR EACH ROW EXECUTE FUNCTION public.pengembalian_barang();


--
-- TOC entry 3648 (class 2620 OID 93858)
-- Name: retur retur_barang; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER retur_barang AFTER INSERT ON public.retur FOR EACH ROW EXECUTE FUNCTION public.update_barang_after_retur();


-- Completed on 2024-12-17 10:44:15

--
-- PostgreSQL database dump complete
--

