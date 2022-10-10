PGDMP         -                z            medicfarmedition    14.2    14.2 E    >           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            ?           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            @           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            A           1262    41138    medicfarmedition    DATABASE     l   CREATE DATABASE medicfarmedition WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Spanish_Spain.1252';
     DROP DATABASE medicfarmedition;
                postgres    false            �            1259    41139    cliente    TABLE     �  CREATE TABLE public.cliente (
    id_cliente integer NOT NULL,
    nombre_cliente character varying(50) NOT NULL,
    apellido_cliente character varying(50) NOT NULL,
    dui_cliente character varying(10) NOT NULL,
    correo_cliente character varying(100) NOT NULL,
    clave_cliente character varying(100) NOT NULL,
    estado_cliente boolean NOT NULL,
    fecha_cliente date NOT NULL
);
    DROP TABLE public.cliente;
       public         heap    postgres    false            �            1259    41142    cliente_idcliente_seq    SEQUENCE     �   CREATE SEQUENCE public.cliente_idcliente_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.cliente_idcliente_seq;
       public          postgres    false    209            B           0    0    cliente_idcliente_seq    SEQUENCE OWNED BY     P   ALTER SEQUENCE public.cliente_idcliente_seq OWNED BY public.cliente.id_cliente;
          public          postgres    false    210            �            1259    41143    detalle_pedido    TABLE     �   CREATE TABLE public.detalle_pedido (
    iddetalle integer NOT NULL,
    idproducto integer NOT NULL,
    cantidad_producto integer NOT NULL,
    precio_producto numeric(5,2) NOT NULL,
    id_pedido integer NOT NULL
);
 "   DROP TABLE public.detalle_pedido;
       public         heap    postgres    false            �            1259    41146    detalle_pedido_iddetalle_seq    SEQUENCE     �   CREATE SEQUENCE public.detalle_pedido_iddetalle_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.detalle_pedido_iddetalle_seq;
       public          postgres    false    211            C           0    0    detalle_pedido_iddetalle_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.detalle_pedido_iddetalle_seq OWNED BY public.detalle_pedido.iddetalle;
          public          postgres    false    212            �            1259    41147    pedidos    TABLE     �   CREATE TABLE public.pedidos (
    id_pedido integer NOT NULL,
    id_cliente integer NOT NULL,
    estado_pedido integer NOT NULL,
    fecha_pedido date NOT NULL
);
    DROP TABLE public.pedidos;
       public         heap    postgres    false            �            1259    41150    pedidos_idpedidos_seq    SEQUENCE     �   CREATE SEQUENCE public.pedidos_idpedidos_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.pedidos_idpedidos_seq;
       public          postgres    false    213            D           0    0    pedidos_idpedidos_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.pedidos_idpedidos_seq OWNED BY public.pedidos.id_pedido;
          public          postgres    false    214            �            1259    41151    producto    TABLE     �  CREATE TABLE public.producto (
    idproducto integer NOT NULL,
    img_producto character varying(100) NOT NULL,
    nombre_producto character varying(50) NOT NULL,
    descripcion_producto character varying(250) NOT NULL,
    precio_produc numeric(5,2) NOT NULL,
    estado_producto boolean NOT NULL,
    idusuario integer NOT NULL,
    idtip integer NOT NULL,
    cantidad_producto numeric(4,2) NOT NULL
);
    DROP TABLE public.producto;
       public         heap    postgres    false            �            1259    41154    producto_idproducto_seq    SEQUENCE     �   CREATE SEQUENCE public.producto_idproducto_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.producto_idproducto_seq;
       public          postgres    false    215            E           0    0    producto_idproducto_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.producto_idproducto_seq OWNED BY public.producto.idproducto;
          public          postgres    false    216            �            1259    41155    receta    TABLE     �   CREATE TABLE public.receta (
    idreceta integer NOT NULL,
    imgres character varying(100) NOT NULL,
    descripcion character varying(250) NOT NULL,
    idcliente integer NOT NULL
);
    DROP TABLE public.receta;
       public         heap    postgres    false            �            1259    41158    receta_idreceta_seq    SEQUENCE     �   CREATE SEQUENCE public.receta_idreceta_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.receta_idreceta_seq;
       public          postgres    false    217            F           0    0    receta_idreceta_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.receta_idreceta_seq OWNED BY public.receta.idreceta;
          public          postgres    false    218            �            1259    41159    tipo_produc    TABLE     �   CREATE TABLE public.tipo_produc (
    idtip integer NOT NULL,
    tipo_nombre character varying(50) NOT NULL,
    descripcion_tipo character varying(250) NOT NULL,
    imagen_categoria character varying(250) NOT NULL
);
    DROP TABLE public.tipo_produc;
       public         heap    postgres    false            �            1259    41164    tipo_produc_idtip_seq    SEQUENCE     �   CREATE SEQUENCE public.tipo_produc_idtip_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.tipo_produc_idtip_seq;
       public          postgres    false    219            G           0    0    tipo_produc_idtip_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.tipo_produc_idtip_seq OWNED BY public.tipo_produc.idtip;
          public          postgres    false    220            �            1259    41165    usuario    TABLE       CREATE TABLE public.usuario (
    id_usuario integer NOT NULL,
    nombre_usuario character varying(50) NOT NULL,
    apellido_usuario character varying(50) NOT NULL,
    correo_usuario character varying(100) NOT NULL,
    clave_usuario character varying(100) NOT NULL
);
    DROP TABLE public.usuario;
       public         heap    postgres    false            �            1259    41168    usario_idusuario_seq    SEQUENCE     �   CREATE SEQUENCE public.usario_idusuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.usario_idusuario_seq;
       public          postgres    false    221            H           0    0    usario_idusuario_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.usario_idusuario_seq OWNED BY public.usuario.id_usuario;
          public          postgres    false    222            �            1259    41169 
   valoracion    TABLE       CREATE TABLE public.valoracion (
    idvaloracion integer NOT NULL,
    iddetalle integer NOT NULL,
    calificacion integer,
    comentario character varying(250),
    fecha_valoracion date,
    estado_valoracion boolean,
    id_cliente integer NOT NULL
);
    DROP TABLE public.valoracion;
       public         heap    postgres    false            �            1259    41172    valoracion _idvaloracion_seq    SEQUENCE     �   CREATE SEQUENCE public."valoracion _idvaloracion_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public."valoracion _idvaloracion_seq";
       public          postgres    false    223            I           0    0    valoracion _idvaloracion_seq    SEQUENCE OWNED BY     ^   ALTER SEQUENCE public."valoracion _idvaloracion_seq" OWNED BY public.valoracion.idvaloracion;
          public          postgres    false    224                       2604    41173    cliente id_cliente    DEFAULT     w   ALTER TABLE ONLY public.cliente ALTER COLUMN id_cliente SET DEFAULT nextval('public.cliente_idcliente_seq'::regclass);
 A   ALTER TABLE public.cliente ALTER COLUMN id_cliente DROP DEFAULT;
       public          postgres    false    210    209            �           2604    41174    detalle_pedido iddetalle    DEFAULT     �   ALTER TABLE ONLY public.detalle_pedido ALTER COLUMN iddetalle SET DEFAULT nextval('public.detalle_pedido_iddetalle_seq'::regclass);
 G   ALTER TABLE public.detalle_pedido ALTER COLUMN iddetalle DROP DEFAULT;
       public          postgres    false    212    211            �           2604    41175    pedidos id_pedido    DEFAULT     v   ALTER TABLE ONLY public.pedidos ALTER COLUMN id_pedido SET DEFAULT nextval('public.pedidos_idpedidos_seq'::regclass);
 @   ALTER TABLE public.pedidos ALTER COLUMN id_pedido DROP DEFAULT;
       public          postgres    false    214    213            �           2604    41176    producto idproducto    DEFAULT     z   ALTER TABLE ONLY public.producto ALTER COLUMN idproducto SET DEFAULT nextval('public.producto_idproducto_seq'::regclass);
 B   ALTER TABLE public.producto ALTER COLUMN idproducto DROP DEFAULT;
       public          postgres    false    216    215            �           2604    41177    receta idreceta    DEFAULT     r   ALTER TABLE ONLY public.receta ALTER COLUMN idreceta SET DEFAULT nextval('public.receta_idreceta_seq'::regclass);
 >   ALTER TABLE public.receta ALTER COLUMN idreceta DROP DEFAULT;
       public          postgres    false    218    217            �           2604    41178    tipo_produc idtip    DEFAULT     v   ALTER TABLE ONLY public.tipo_produc ALTER COLUMN idtip SET DEFAULT nextval('public.tipo_produc_idtip_seq'::regclass);
 @   ALTER TABLE public.tipo_produc ALTER COLUMN idtip DROP DEFAULT;
       public          postgres    false    220    219            �           2604    41179    usuario id_usuario    DEFAULT     v   ALTER TABLE ONLY public.usuario ALTER COLUMN id_usuario SET DEFAULT nextval('public.usario_idusuario_seq'::regclass);
 A   ALTER TABLE public.usuario ALTER COLUMN id_usuario DROP DEFAULT;
       public          postgres    false    222    221            �           2604    41180    valoracion idvaloracion    DEFAULT     �   ALTER TABLE ONLY public.valoracion ALTER COLUMN idvaloracion SET DEFAULT nextval('public."valoracion _idvaloracion_seq"'::regclass);
 F   ALTER TABLE public.valoracion ALTER COLUMN idvaloracion DROP DEFAULT;
       public          postgres    false    224    223            ,          0    41139    cliente 
   TABLE DATA           �   COPY public.cliente (id_cliente, nombre_cliente, apellido_cliente, dui_cliente, correo_cliente, clave_cliente, estado_cliente, fecha_cliente) FROM stdin;
    public          postgres    false    209   ,S       .          0    41143    detalle_pedido 
   TABLE DATA           n   COPY public.detalle_pedido (iddetalle, idproducto, cantidad_producto, precio_producto, id_pedido) FROM stdin;
    public          postgres    false    211   IS       0          0    41147    pedidos 
   TABLE DATA           U   COPY public.pedidos (id_pedido, id_cliente, estado_pedido, fecha_pedido) FROM stdin;
    public          postgres    false    213   �S       2          0    41151    producto 
   TABLE DATA           �   COPY public.producto (idproducto, img_producto, nombre_producto, descripcion_producto, precio_produc, estado_producto, idusuario, idtip, cantidad_producto) FROM stdin;
    public          postgres    false    215   �S       4          0    41155    receta 
   TABLE DATA           J   COPY public.receta (idreceta, imgres, descripcion, idcliente) FROM stdin;
    public          postgres    false    217   V       6          0    41159    tipo_produc 
   TABLE DATA           ]   COPY public.tipo_produc (idtip, tipo_nombre, descripcion_tipo, imagen_categoria) FROM stdin;
    public          postgres    false    219   -V       8          0    41165    usuario 
   TABLE DATA           n   COPY public.usuario (id_usuario, nombre_usuario, apellido_usuario, correo_usuario, clave_usuario) FROM stdin;
    public          postgres    false    221   �W       :          0    41169 
   valoracion 
   TABLE DATA           �   COPY public.valoracion (idvaloracion, iddetalle, calificacion, comentario, fecha_valoracion, estado_valoracion, id_cliente) FROM stdin;
    public          postgres    false    223   �W       J           0    0    cliente_idcliente_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.cliente_idcliente_seq', 1, false);
          public          postgres    false    210            K           0    0    detalle_pedido_iddetalle_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('public.detalle_pedido_iddetalle_seq', 9, true);
          public          postgres    false    212            L           0    0    pedidos_idpedidos_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.pedidos_idpedidos_seq', 15, true);
          public          postgres    false    214            M           0    0    producto_idproducto_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.producto_idproducto_seq', 5, true);
          public          postgres    false    216            N           0    0    receta_idreceta_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.receta_idreceta_seq', 1, false);
          public          postgres    false    218            O           0    0    tipo_produc_idtip_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.tipo_produc_idtip_seq', 17, true);
          public          postgres    false    220            P           0    0    usario_idusuario_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.usario_idusuario_seq', 1, false);
          public          postgres    false    222            Q           0    0    valoracion _idvaloracion_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public."valoracion _idvaloracion_seq"', 1, true);
          public          postgres    false    224            �           2606    41182    cliente CLIENT 
   CONSTRAINT     U   ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT "CLIENT" UNIQUE (correo_cliente);
 :   ALTER TABLE ONLY public.cliente DROP CONSTRAINT "CLIENT";
       public            postgres    false    209            �           2606    41184    cliente cliente_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT cliente_pkey PRIMARY KEY (id_cliente);
 >   ALTER TABLE ONLY public.cliente DROP CONSTRAINT cliente_pkey;
       public            postgres    false    209            �           2606    41186 "   detalle_pedido detalle_pedido_pkey 
   CONSTRAINT     g   ALTER TABLE ONLY public.detalle_pedido
    ADD CONSTRAINT detalle_pedido_pkey PRIMARY KEY (iddetalle);
 L   ALTER TABLE ONLY public.detalle_pedido DROP CONSTRAINT detalle_pedido_pkey;
       public            postgres    false    211            �           2606    41188    pedidos pedidos_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.pedidos
    ADD CONSTRAINT pedidos_pkey PRIMARY KEY (id_pedido);
 >   ALTER TABLE ONLY public.pedidos DROP CONSTRAINT pedidos_pkey;
       public            postgres    false    213            �           2606    41190    producto producto_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.producto
    ADD CONSTRAINT producto_pkey PRIMARY KEY (idproducto);
 @   ALTER TABLE ONLY public.producto DROP CONSTRAINT producto_pkey;
       public            postgres    false    215            �           2606    41192    receta receta_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.receta
    ADD CONSTRAINT receta_pkey PRIMARY KEY (idreceta);
 <   ALTER TABLE ONLY public.receta DROP CONSTRAINT receta_pkey;
       public            postgres    false    217            �           2606    41194    tipo_produc tipo_produc_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.tipo_produc
    ADD CONSTRAINT tipo_produc_pkey PRIMARY KEY (idtip);
 F   ALTER TABLE ONLY public.tipo_produc DROP CONSTRAINT tipo_produc_pkey;
       public            postgres    false    219            �           2606    41196    usuario usario_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usario_pkey PRIMARY KEY (id_usuario);
 =   ALTER TABLE ONLY public.usuario DROP CONSTRAINT usario_pkey;
       public            postgres    false    221            �           2606    41198    valoracion valoracion _pkey 
   CONSTRAINT     e   ALTER TABLE ONLY public.valoracion
    ADD CONSTRAINT "valoracion _pkey" PRIMARY KEY (idvaloracion);
 G   ALTER TABLE ONLY public.valoracion DROP CONSTRAINT "valoracion _pkey";
       public            postgres    false    223            �           2606    41516    valoracion cliente_    FK CONSTRAINT     �   ALTER TABLE ONLY public.valoracion
    ADD CONSTRAINT cliente_ FOREIGN KEY (id_cliente) REFERENCES public.cliente(id_cliente) NOT VALID;
 =   ALTER TABLE ONLY public.valoracion DROP CONSTRAINT cliente_;
       public          postgres    false    209    223    3210            �           2606    41521    pedidos clientpe    FK CONSTRAINT     �   ALTER TABLE ONLY public.pedidos
    ADD CONSTRAINT clientpe FOREIGN KEY (id_cliente) REFERENCES public.cliente(id_cliente) NOT VALID;
 :   ALTER TABLE ONLY public.pedidos DROP CONSTRAINT clientpe;
       public          postgres    false    213    209    3210            �           2606    41209    detalle_pedido detape    FK CONSTRAINT     �   ALTER TABLE ONLY public.detalle_pedido
    ADD CONSTRAINT detape FOREIGN KEY (idproducto) REFERENCES public.producto(idproducto);
 ?   ALTER TABLE ONLY public.detalle_pedido DROP CONSTRAINT detape;
       public          postgres    false    215    3216    211            �           2606    41214    detalle_pedido detapedido    FK CONSTRAINT     �   ALTER TABLE ONLY public.detalle_pedido
    ADD CONSTRAINT detapedido FOREIGN KEY (id_pedido) REFERENCES public.pedidos(id_pedido) NOT VALID;
 C   ALTER TABLE ONLY public.detalle_pedido DROP CONSTRAINT detapedido;
       public          postgres    false    213    211    3214            �           2606    41219    producto protip    FK CONSTRAINT        ALTER TABLE ONLY public.producto
    ADD CONSTRAINT protip FOREIGN KEY (idtip) REFERENCES public.tipo_produc(idtip) NOT VALID;
 9   ALTER TABLE ONLY public.producto DROP CONSTRAINT protip;
       public          postgres    false    3220    215    219            �           2606    41224    receta reste    FK CONSTRAINT     w   ALTER TABLE ONLY public.receta
    ADD CONSTRAINT reste FOREIGN KEY (idcliente) REFERENCES public.cliente(id_cliente);
 6   ALTER TABLE ONLY public.receta DROP CONSTRAINT reste;
       public          postgres    false    217    209    3210            �           2606    41229    producto usuariopor    FK CONSTRAINT     ~   ALTER TABLE ONLY public.producto
    ADD CONSTRAINT usuariopor FOREIGN KEY (idusuario) REFERENCES public.usuario(id_usuario);
 =   ALTER TABLE ONLY public.producto DROP CONSTRAINT usuariopor;
       public          postgres    false    215    221    3222            �           2606    41234    valoracion valodet    FK CONSTRAINT     �   ALTER TABLE ONLY public.valoracion
    ADD CONSTRAINT valodet FOREIGN KEY (iddetalle) REFERENCES public.detalle_pedido(iddetalle);
 <   ALTER TABLE ONLY public.valoracion DROP CONSTRAINT valodet;
       public          postgres    false    3212    211    223            ,      x������ � �      .   =   x�Mɱ !��.�χ��� �� $2z���2�<�~�Uq<�sb_�h�+H~6L}      0   *   x�34�4B###]3]Cc.CcS$s�H� �:       2   0  x�}S=��0��_��!��k�c8�שc�����M��qH�u�鶮�c��8�,��"E����P���
{w C1j,��0�G�#z0d}� �{k9�JU#���C�'�;�ئ�������D�|9w9}04V�^�,��a �r#xI^��s2$u}����5��DJ��q�Lc��V�Z�-rD��빊j�+���|>[
��H���w�(��6WH�$8�N�F2.O�~��Ir�Fj娃֧�${4��ё`)D��_YX�F��E/�'�\e^%:��m�%��{���3+������h� b���QmB�j]���L�Vf\���������==��+o�?B�����6���F�.�Dw}�AH�p7`Om�]����[���-�J����mCb��B���z����Wt��:��4>+U�1~LN���l*�Kn3���� ��l����[�$j!��e�Y�Z-�	��̺�a�L]���=�xP�4֋J3lS3A��]���ވu.�Tr��x�:��2kq��_�`����� _��jB�*k���l�`{_      4      x������ � �      6   H  x�UQA��0<����*�׽��uXJ�n�"��8�i����i�.Q<v&3�n�`,r-B���P�A�3Y#vB8�'�0`��L$9��a�QH��XeS��p���0Zu�1��|E�#,���g�
N�B�_�yJL��1�`�)$S�~���n?��������I����Q".��L�zKN�V���o��ϳ)CCW������Z���RR���h����d��:�o��-:�y��x��h�����{N��NW���ʣf�竛�`����/%{`�b>���6=mx��n��VC��      8   .   x�3���/JO�,��I�K·��s3s���s9��ML�b���� <u�      :   I   x�3�4���-�TH*M�S((�O)M.��4202�5��50�,�4�2�4*+(MMJ4B�3�)������� �2     