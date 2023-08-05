PGDMP                         x            EBR    13.1    13.1 *               0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            	           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            
           1262    16394    EBR    DATABASE     f   CREATE DATABASE "EBR" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Vietnamese_Vietnam.1252';
    DROP DATABASE "EBR";
                postgres    false                        3079    24576 	   adminpack 	   EXTENSION     A   CREATE EXTENSION IF NOT EXISTS adminpack WITH SCHEMA pg_catalog;
    DROP EXTENSION adminpack;
                   false                       0    0    EXTENSION adminpack    COMMENT     M   COMMENT ON EXTENSION adminpack IS 'administrative functions for PostgreSQL';
                        false    3                        3079    16395 	   uuid-ossp 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS "uuid-ossp" WITH SCHEMA public;
    DROP EXTENSION "uuid-ossp";
                   false                       0    0    EXTENSION "uuid-ossp"    COMMENT     W   COMMENT ON EXTENSION "uuid-ossp" IS 'generate universally unique identifiers (UUIDs)';
                        false    2            �            1255    25287    bike_dock_change()    FUNCTION     �  CREATE FUNCTION public.bike_dock_change() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF OLD.dock_id IS NOT NULL AND NEW.dock_id IS NULL THEN
        UPDATE public.dock
        SET taken_slot = taken_slot - 1
        WHERE id = OLD.dock_id;
    END IF;

    IF OLD.dock_id IS NULL AND NEW.dock_id IS NOT NULL THEN
        UPDATE public.dock
        SET taken_slot = taken_slot + 1
        WHERE id = NEW.dock_id;
    END IF;
    RETURN NEW;
END;
$$;
 )   DROP FUNCTION public.bike_dock_change();
       public          postgres    false            �            1255    25289    insert_new_bike()    FUNCTION       CREATE FUNCTION public.insert_new_bike() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF NEW.dock_id IS NOT NULL THEN
        UPDATE public.dock
        SET taken_slot = taken_slot + 1
        WHERE id = NEW.dock_id;
    END IF;

    RETURN NEW;
END;
$$;
 (   DROP FUNCTION public.insert_new_bike();
       public          postgres    false            �            1259    25706    bike    TABLE     �  CREATE TABLE public.bike (
    id uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    type integer DEFAULT 1 NOT NULL,
    barcode integer NOT NULL,
    saddle_num integer DEFAULT 1 NOT NULL,
    pedal_num integer DEFAULT 1 NOT NULL,
    rear_seat_num integer DEFAULT 1 NOT NULL,
    value integer NOT NULL,
    rental_fees integer NOT NULL,
    image_url text DEFAULT ''::text,
    created_at timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    description text,
    dock_id uuid
);
    DROP TABLE public.bike;
       public         heap    postgres    false    2            �            1259    25719    card    TABLE       CREATE TABLE public.card (
    id uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    card_num text NOT NULL,
    card_owner text NOT NULL,
    security_code text NOT NULL,
    exp_date text NOT NULL,
    created_at timestamp with time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.card;
       public         heap    postgres    false    2            �            1259    25729    dock    TABLE     ;  CREATE TABLE public.dock (
    id uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    name text NOT NULL,
    location text NOT NULL,
    taken_slot integer DEFAULT 0 NOT NULL,
    capacity integer NOT NULL,
    image_url text DEFAULT ''::text,
    created_at timestamp with time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.dock;
       public         heap    postgres    false    2            �            1259    25739    e_bike    TABLE     �   CREATE TABLE public.e_bike (
    bike_id uuid NOT NULL,
    battery numeric(3,1) NOT NULL,
    time_remain integer NOT NULL,
    created_at timestamp with time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.e_bike;
       public         heap    postgres    false            �            1259    25743    invoice    TABLE     �   CREATE TABLE public.invoice (
    id uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    session_id uuid NOT NULL,
    total_charge numeric,
    created_at timestamp with time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.invoice;
       public         heap    postgres    false    2            �            1259    25751    payment_transaction    TABLE     *  CREATE TABLE public.payment_transaction (
    id uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    card_id uuid NOT NULL,
    type text NOT NULL,
    amount numeric NOT NULL,
    method text,
    transaction_id text NOT NULL,
    created_at timestamp with time zone DEFAULT CURRENT_TIMESTAMP
);
 '   DROP TABLE public.payment_transaction;
       public         heap    postgres    false    2            �            1259    25759    session    TABLE     �  CREATE TABLE public.session (
    id uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    card_id uuid NOT NULL,
    bike_id uuid NOT NULL,
    rent_transactionid uuid NOT NULL,
    return_transactionid uuid,
    last_rent_time_before_lock integer DEFAULT 0,
    active boolean DEFAULT true,
    start_time text,
    last_resume_time text,
    end_time text,
    created_at timestamp with time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.session;
       public         heap    postgres    false    2            �          0    25706    bike 
   TABLE DATA           �   COPY public.bike (id, type, barcode, saddle_num, pedal_num, rear_seat_num, value, rental_fees, image_url, created_at, description, dock_id) FROM stdin;
    public          postgres    false    202   �5       �          0    25719    card 
   TABLE DATA           ]   COPY public.card (id, card_num, card_owner, security_code, exp_date, created_at) FROM stdin;
    public          postgres    false    203    =                  0    25729    dock 
   TABLE DATA           _   COPY public.dock (id, name, location, taken_slot, capacity, image_url, created_at) FROM stdin;
    public          postgres    false    204   ==                 0    25739    e_bike 
   TABLE DATA           K   COPY public.e_bike (bike_id, battery, time_remain, created_at) FROM stdin;
    public          postgres    false    205   3?                 0    25743    invoice 
   TABLE DATA           K   COPY public.invoice (id, session_id, total_charge, created_at) FROM stdin;
    public          postgres    false    206   6@                 0    25751    payment_transaction 
   TABLE DATA           l   COPY public.payment_transaction (id, card_id, type, amount, method, transaction_id, created_at) FROM stdin;
    public          postgres    false    207   S@                 0    25759    session 
   TABLE DATA           �   COPY public.session (id, card_id, bike_id, rent_transactionid, return_transactionid, last_rent_time_before_lock, active, start_time, last_resume_time, end_time, created_at) FROM stdin;
    public          postgres    false    208   p@       c           2606    25772    bike bike_pk 
   CONSTRAINT     J   ALTER TABLE ONLY public.bike
    ADD CONSTRAINT bike_pk PRIMARY KEY (id);
 6   ALTER TABLE ONLY public.bike DROP CONSTRAINT bike_pk;
       public            postgres    false    202            e           2606    25728    card card_card_num_key 
   CONSTRAINT     U   ALTER TABLE ONLY public.card
    ADD CONSTRAINT card_card_num_key UNIQUE (card_num);
 @   ALTER TABLE ONLY public.card DROP CONSTRAINT card_card_num_key;
       public            postgres    false    203            g           2606    25774    card card_pk 
   CONSTRAINT     J   ALTER TABLE ONLY public.card
    ADD CONSTRAINT card_pk PRIMARY KEY (id);
 6   ALTER TABLE ONLY public.card DROP CONSTRAINT card_pk;
       public            postgres    false    203            i           2606    25776    dock dock_pk 
   CONSTRAINT     J   ALTER TABLE ONLY public.dock
    ADD CONSTRAINT dock_pk PRIMARY KEY (id);
 6   ALTER TABLE ONLY public.dock DROP CONSTRAINT dock_pk;
       public            postgres    false    204            k           2606    25778    e_bike e_bike_pk 
   CONSTRAINT     S   ALTER TABLE ONLY public.e_bike
    ADD CONSTRAINT e_bike_pk PRIMARY KEY (bike_id);
 :   ALTER TABLE ONLY public.e_bike DROP CONSTRAINT e_bike_pk;
       public            postgres    false    205            m           2606    25780    invoice invoice_pk 
   CONSTRAINT     P   ALTER TABLE ONLY public.invoice
    ADD CONSTRAINT invoice_pk PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.invoice DROP CONSTRAINT invoice_pk;
       public            postgres    false    206            o           2606    25782 *   payment_transaction payment_transaction_pk 
   CONSTRAINT     h   ALTER TABLE ONLY public.payment_transaction
    ADD CONSTRAINT payment_transaction_pk PRIMARY KEY (id);
 T   ALTER TABLE ONLY public.payment_transaction DROP CONSTRAINT payment_transaction_pk;
       public            postgres    false    207            q           2606    25789    session session_pk 
   CONSTRAINT     P   ALTER TABLE ONLY public.session
    ADD CONSTRAINT session_pk PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.session DROP CONSTRAINT session_pk;
       public            postgres    false    208            {           2620    25770    bike bike_insert    TRIGGER     o   CREATE TRIGGER bike_insert AFTER INSERT ON public.bike FOR EACH ROW EXECUTE FUNCTION public.insert_new_bike();
 )   DROP TRIGGER bike_insert ON public.bike;
       public          postgres    false    202    220            z           2620    25769    bike dock_changes    TRIGGER     q   CREATE TRIGGER dock_changes AFTER UPDATE ON public.bike FOR EACH ROW EXECUTE FUNCTION public.bike_dock_change();
 *   DROP TRIGGER dock_changes ON public.bike;
       public          postgres    false    219    202            r           2606    25790    bike bike_fk    FK CONSTRAINT     |   ALTER TABLE ONLY public.bike
    ADD CONSTRAINT bike_fk FOREIGN KEY (dock_id) REFERENCES public.dock(id) ON DELETE CASCADE;
 6   ALTER TABLE ONLY public.bike DROP CONSTRAINT bike_fk;
       public          postgres    false    202    2921    204            s           2606    25795    e_bike e_bike_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.e_bike
    ADD CONSTRAINT e_bike_fk FOREIGN KEY (bike_id) REFERENCES public.bike(id) ON DELETE CASCADE;
 :   ALTER TABLE ONLY public.e_bike DROP CONSTRAINT e_bike_fk;
       public          postgres    false    2915    202    205            t           2606    25800    invoice invoice_fk    FK CONSTRAINT     v   ALTER TABLE ONLY public.invoice
    ADD CONSTRAINT invoice_fk FOREIGN KEY (session_id) REFERENCES public.session(id);
 <   ALTER TABLE ONLY public.invoice DROP CONSTRAINT invoice_fk;
       public          postgres    false    208    2929    206            u           2606    25783 *   payment_transaction payment_transaction_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.payment_transaction
    ADD CONSTRAINT payment_transaction_fk FOREIGN KEY (card_id) REFERENCES public.card(id) ON DELETE CASCADE;
 T   ALTER TABLE ONLY public.payment_transaction DROP CONSTRAINT payment_transaction_fk;
       public          postgres    false    2919    203    207            v           2606    25805    session session_fk1    FK CONSTRAINT     q   ALTER TABLE ONLY public.session
    ADD CONSTRAINT session_fk1 FOREIGN KEY (card_id) REFERENCES public.card(id);
 =   ALTER TABLE ONLY public.session DROP CONSTRAINT session_fk1;
       public          postgres    false    2919    203    208            w           2606    25810    session session_fk2    FK CONSTRAINT     q   ALTER TABLE ONLY public.session
    ADD CONSTRAINT session_fk2 FOREIGN KEY (bike_id) REFERENCES public.bike(id);
 =   ALTER TABLE ONLY public.session DROP CONSTRAINT session_fk2;
       public          postgres    false    202    2915    208            x           2606    25815    session session_fk3    FK CONSTRAINT     �   ALTER TABLE ONLY public.session
    ADD CONSTRAINT session_fk3 FOREIGN KEY (rent_transactionid) REFERENCES public.payment_transaction(id);
 =   ALTER TABLE ONLY public.session DROP CONSTRAINT session_fk3;
       public          postgres    false    2927    207    208            y           2606    25820    session session_fk4    FK CONSTRAINT     �   ALTER TABLE ONLY public.session
    ADD CONSTRAINT session_fk4 FOREIGN KEY (return_transactionid) REFERENCES public.payment_transaction(id);
 =   ALTER TABLE ONLY public.session DROP CONSTRAINT session_fk4;
       public          postgres    false    208    207    2927            �   1  x��YM�[�<���wc�������Kr�e>!�X��SC�>��}z�v���W���zͫ(kH�rH��Pz�x����}\蒲qQ|������~�?�O߽{��������_��?>���>��o����#�@���tW�K�qb��s�˻�_"q�&����IC�q�A8�ITZ�R�^�C�ـ�W��te��']��tI��"�']��W��������?����߾���d73��?Q5^:,��zH�5x�d����\��Фڵ�j
����X^^��� �<	��,���[fJfO�i�g4&��
�����f�ݤ�U9���Nxm@eζ�k�[r�ń�o�����|�����[ta�ך�'M��R���<�R��A̞%���+�rQvz�2���<����ʂ�i�5��Ҧ�)ǜ��E,��I-�E�M�BX��.*��}�`-6�&��	j��dz�����a��-�����G�`VH�B5�&��!�����s�|T֛B�����[Uǥ� �\��hM��/�:�(�fp*7.�Dޢک���8̼,��Am��t �%4BHrw���A��E��[w��kh����f
%%�o
�W_��ӟ!�*Ü�A�f������%fk����>s	+�I˩��)Ǯ���d�m��3��vE��}@�x�	����a-*)�֐WV+)4��Z] ��[��էz��;C�9��aҐ<���b�an�֞���� ��Y�}�mę2^iRq����k�P)�T��F}��˦�#4���,���-�H3��H9�߆� 4�����$9ʫ��^|n��=a4uB��y�2��U�1K�Ż	#Wt(%�#���64{����s��.PA�����1��@�at�:��zq�e�������t�Qq
����5�R�/n���]IeX�w��d�8�7����>;���CP{B��v�u<	�eT�Xt������3�G�xan�W{����e`�	I1k��x��	=k�5���Z+qۑ�[��FS����?�L���q�F�fLp[���0(<��fh:����|vo�bE[�K�-�<C�P���l`�/n���q�Di��=m) �Y&���!葜����n���q�K�\R�R���;:&�b��Z[%�W4�S��;����`'����Fi!�0�r�?}6#�Z�������}�{3
���JI�xO��A��Y��X�S�*J��YQ��ƶ����8^7��cƲ����<���ܔ>�泃XK�4�='���� ~��EF�����T���FK�����pp��<}������s}��L$&b�'�BuB%�w8
W�����,I�u����x��&�j�k�s�j�ɲ�zH`�=�g�"K3�7}tܔQ(��;ꣷW}q{�ώ�u�q��P6�D���u���h�l>�3�|��b��$��?����{hq�P�C�2��3�|���m�T��׾��U��փ��\�I|< ���|�r����hee,XA�ayn{�����)n-k�<�¥������L0ː���q&r��b�~}dc+KƆ���C�&]L���T��˃}!�1���=��'9گX�*�~��D��J�4�\,8��{{)��P����3�'�� ^u���N�6[(B�͕s�1��3��L�Q������~�0Pa��VsD-�^��ƪ�u��#kD�k.!�"S`2e �鳃XJc�*��.9 ٔ�F�ѼO�zzq{����(^� �k<�x��>0��fq�=�gG�Y����<b> _C]�=�}�7��lOnO��A��n���Ld�b      �      x������ � �          �  x���;k[A��_�>���>T:N$���>�E�
��?�"l%6���6;�sf�2w�j��C����t�=Y�2}��}}3���Gzگe�v(�4�S&B�&FF �5��x+n�1"�'�+M�[��A�:��z�ܰ/�]Dh�Q��ōZ@�E�s�" ���AN��!�C�b�"|���""�q�hn��Q�y�=&P�Bs�+�z��G��C�Ϗ�������|<=��4�6N�xl������vm�u��s}}�������ݚq�n��	���RKma.(h��E!|�>VO�@���Ko��;H|�!r2��P3�d�Aυ�a��hz�|�Y��w��O�-Yf��$����F�#���H��']-{�+$r&����҉�j�&�5P�'\*h�c��Jz��^��A��y�%5��**��d)$��s���5K�l�y-�LZ��kG�(#��0�䰦�B|e�\,Y��Y���j����\\         �   x��лm1�XW����wkq�o�%xבq��������&�=$���s@�y�)zBKf��##ћڥt!WK����R�9�"���WBN�ѳ��n�bq���B�N���w��066���Sm�f��nE�D���b?�0l;bӠ�nw-EM�~�J<G�c�6A�v�)0���X�q�E1���?o����*.��I�kE43۰���:�1}yx�cE�ʽ�>���*��c}����&�cI            x������ � �            x������ � �            x������ � �     