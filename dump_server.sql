PGDMP  $    	                 |         
   lancelivre    16.1    16.1 )               0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                        0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            !           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            "           1262    16397 
   lancelivre    DATABASE     �   CREATE DATABASE lancelivre WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Portuguese_Brazil.1252';
    DROP DATABASE lancelivre;
                postgres    false            �            1259    16491 	   avaliacao    TABLE     �   CREATE TABLE public.avaliacao (
    id bigint NOT NULL,
    id_usuario bigint NOT NULL,
    id_servico bigint NOT NULL,
    nota numeric NOT NULL,
    data date NOT NULL,
    comentario character varying
);
    DROP TABLE public.avaliacao;
       public         heap    postgres    false            �            1259    16490    avaliacao_id_seq    SEQUENCE     �   ALTER TABLE public.avaliacao ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.avaliacao_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    225            �            1259    16441    canal    TABLE     z   CREATE TABLE public.canal (
    id_colaborador bigint NOT NULL,
    id_usuario bigint NOT NULL,
    id bigint NOT NULL
);
    DROP TABLE public.canal;
       public         heap    postgres    false            �            1259    16480    canal_id_seq    SEQUENCE     �   ALTER TABLE public.canal ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.canal_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    221            �            1259    16411    colaborador    TABLE     �   CREATE TABLE public.colaborador (
    id integer NOT NULL,
    nome character varying(50) NOT NULL,
    email character varying(100) NOT NULL,
    data_cad date NOT NULL
);
    DROP TABLE public.colaborador;
       public         heap    postgres    false            �            1259    16410    colaborador_id_seq    SEQUENCE     �   CREATE SEQUENCE public.colaborador_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.colaborador_id_seq;
       public          postgres    false    218            #           0    0    colaborador_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.colaborador_id_seq OWNED BY public.colaborador.id;
          public          postgres    false    217            �            1259    16398    conta    TABLE     �   CREATE TABLE public.conta (
    id integer NOT NULL,
    nome character varying(20) NOT NULL,
    senha character varying(15) NOT NULL,
    email character varying(30) NOT NULL,
    tipo integer NOT NULL
);
    DROP TABLE public.conta;
       public         heap    postgres    false            �            1259    16434    mensagem    TABLE     �   CREATE TABLE public.mensagem (
    id_canal smallint NOT NULL,
    id bigint NOT NULL,
    data_envio date NOT NULL,
    texto character varying,
    enviado_por character varying
);
    DROP TABLE public.mensagem;
       public         heap    postgres    false            �            1259    16472    mensagem_id_seq    SEQUENCE     �   ALTER TABLE public.mensagem ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.mensagem_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    220            �            1259    16521    pergunta    TABLE       CREATE TABLE public.pergunta (
    id bigint NOT NULL,
    id_usuario bigint NOT NULL,
    id_servico bigint NOT NULL,
    pergunta character varying NOT NULL,
    data date NOT NULL,
    titulo character varying NOT NULL,
    resposta character varying
);
    DROP TABLE public.pergunta;
       public         heap    postgres    false            �            1259    16520    pergunta_id_seq    SEQUENCE     �   ALTER TABLE public.pergunta ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.pergunta_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    227            �            1259    16403    servico    TABLE     S  CREATE TABLE public.servico (
    nome character varying(30) NOT NULL,
    preco money NOT NULL,
    colaborador_id smallint,
    id bigint NOT NULL,
    avaliacao smallint DEFAULT 0 NOT NULL,
    categoria character varying(255) DEFAULT 0 NOT NULL,
    descricao character varying(3000) DEFAULT 'descricao'::character varying NOT NULL
);
    DROP TABLE public.servico;
       public         heap    postgres    false            �            1259    16417    servico_id_seq    SEQUENCE     �   ALTER TABLE public.servico ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.servico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    216            p           2604    16414    colaborador id    DEFAULT     p   ALTER TABLE ONLY public.colaborador ALTER COLUMN id SET DEFAULT nextval('public.colaborador_id_seq'::regclass);
 =   ALTER TABLE public.colaborador ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    217    218    218                      0    16491 	   avaliacao 
   TABLE DATA           W   COPY public.avaliacao (id, id_usuario, id_servico, nota, data, comentario) FROM stdin;
    public          postgres    false    225   .                 0    16441    canal 
   TABLE DATA           ?   COPY public.canal (id_colaborador, id_usuario, id) FROM stdin;
    public          postgres    false    221   p.                 0    16411    colaborador 
   TABLE DATA           @   COPY public.colaborador (id, nome, email, data_cad) FROM stdin;
    public          postgres    false    218   �.                 0    16398    conta 
   TABLE DATA           =   COPY public.conta (id, nome, senha, email, tipo) FROM stdin;
    public          postgres    false    215   �.                 0    16434    mensagem 
   TABLE DATA           P   COPY public.mensagem (id_canal, id, data_envio, texto, enviado_por) FROM stdin;
    public          postgres    false    220   >/                 0    16521    pergunta 
   TABLE DATA           `   COPY public.pergunta (id, id_usuario, id_servico, pergunta, data, titulo, resposta) FROM stdin;
    public          postgres    false    227   �/                 0    16403    servico 
   TABLE DATA           c   COPY public.servico (nome, preco, colaborador_id, id, avaliacao, categoria, descricao) FROM stdin;
    public          postgres    false    216   I0       $           0    0    avaliacao_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.avaliacao_id_seq', 4, true);
          public          postgres    false    224            %           0    0    canal_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.canal_id_seq', 1, true);
          public          postgres    false    223            &           0    0    colaborador_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.colaborador_id_seq', 1, false);
          public          postgres    false    217            '           0    0    mensagem_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.mensagem_id_seq', 5, true);
          public          postgres    false    222            (           0    0    pergunta_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.pergunta_id_seq', 3, true);
          public          postgres    false    226            )           0    0    servico_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.servico_id_seq', 9, true);
          public          postgres    false    219            |           2606    16497    avaliacao avaliacao_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.avaliacao
    ADD CONSTRAINT avaliacao_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.avaliacao DROP CONSTRAINT avaliacao_pkey;
       public            postgres    false    225            z           2606    16475    canal canal_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.canal
    ADD CONSTRAINT canal_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.canal DROP CONSTRAINT canal_pkey;
       public            postgres    false    221            v           2606    16416    colaborador colaborador_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.colaborador
    ADD CONSTRAINT colaborador_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.colaborador DROP CONSTRAINT colaborador_pkey;
       public            postgres    false    218            r           2606    16402    conta conta_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.conta
    ADD CONSTRAINT conta_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.conta DROP CONSTRAINT conta_pkey;
       public            postgres    false    215            x           2606    16465    mensagem mensagem_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.mensagem
    ADD CONSTRAINT mensagem_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.mensagem DROP CONSTRAINT mensagem_pkey;
       public            postgres    false    220            ~           2606    16525    pergunta pergunta_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.pergunta
    ADD CONSTRAINT pergunta_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.pergunta DROP CONSTRAINT pergunta_pkey;
       public            postgres    false    227            t           2606    16422    servico servico_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.servico
    ADD CONSTRAINT servico_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.servico DROP CONSTRAINT servico_pkey;
       public            postgres    false    216                       2606    16539    pergunta id_servico_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.pergunta
    ADD CONSTRAINT id_servico_fkey FOREIGN KEY (id_servico) REFERENCES public.servico(id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 B   ALTER TABLE ONLY public.pergunta DROP CONSTRAINT id_servico_fkey;
       public          postgres    false    4724    216    227            �           2606    16534    pergunta id_usuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.pergunta
    ADD CONSTRAINT id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.conta(id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 B   ALTER TABLE ONLY public.pergunta DROP CONSTRAINT id_usuario_fkey;
       public          postgres    false    215    227    4722               G   x�3�4�4B##]C]#3���̒|���\.��)���)�tbJ~Qj&�!PΘE&%571��+F��� �H            x�3�4�4�2�4�4����� 
         ,   x�3��)�,��鹉�9z����FFƺ�F�Ɔ\1z\\\ �*	�         Y   x�3��JM��4426��s3s���s9M�9}J3��2s2R!jr�Hj��L9K�K�2�9�S�2���"���9�P�b���� u�"         k   x�3�4�4202�50�5����9��3Əˀ�Y89?7_!����B{��1���T��	�hb1�Oif��[fNfA*�!�)����BIiJ�BRj�=giqibQf>W� ��%y         �   x�m�;�0D��S��bA�((iV�U0�����S��v���x�0��w?��0�����m�R�Haat�:�j��Z�%0�b�zُo H���Ob�2oF��kͺ0�7��V����J� �D� ��3�           x��MN�0F��)��U��s��5�u�QRg�t@sd.FRӁ�fE��%�'���<tآ��s�4�1���RkU��C{���QlgT����>1��Q�О�d)�jbg���[�[v4$�Wj��f�:[�G���P�4l���پY�GM`3�݌ ����<U��#�b�^��8tA��XA��@=Y���!�܌r�@ �>�%9Ӊb�{�.���e�i7�s�u��c6�|�SB�b�(���p�Z��S����8#�     