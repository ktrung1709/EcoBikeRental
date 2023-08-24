-- DROP SCHEMA public;

CREATE SCHEMA public AUTHORIZATION postgres;

-- DROP SEQUENCE public.bike_id_seq;

CREATE SEQUENCE public.bike_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.card_id_seq;

CREATE SEQUENCE public.card_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.dock_id_seq;

CREATE SEQUENCE public.dock_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.invoice_id_seq;

CREATE SEQUENCE public.invoice_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.payment_transaction_id_seq;

CREATE SEQUENCE public.payment_transaction_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.session_id_seq;

CREATE SEQUENCE public.session_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;-- public.card definition

-- Drop table

-- DROP TABLE public.card;

CREATE TABLE public.card (
	id serial4 NOT NULL,
	card_num text NOT NULL,
	card_owner text NOT NULL,
	security_code text NOT NULL,
	exp_date text NOT NULL,
	created_at timestamptz NULL DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT card_card_num_key UNIQUE (card_num),
	CONSTRAINT card_pk PRIMARY KEY (id)
);


-- public.dock definition

-- Drop table

-- DROP TABLE public.dock;

CREATE TABLE public.dock (
	id serial4 NOT NULL,
	"name" text NOT NULL,
	"location" text NOT NULL,
	taken_slot int4 NOT NULL DEFAULT 0,
	capacity int4 NOT NULL,
	image_url text NULL DEFAULT ''::text,
	created_at timestamptz NULL DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT dock_pk PRIMARY KEY (id)
);


-- public.bike definition

-- Drop table

-- DROP TABLE public.bike;

CREATE TABLE public.bike (
	id serial4 NOT NULL,
	"type" int4 NOT NULL DEFAULT 1,
	barcode varchar(255) NOT NULL,
	saddle_num int4 NOT NULL DEFAULT 1,
	pedal_num int4 NOT NULL DEFAULT 1,
	rear_seat_num int4 NOT NULL DEFAULT 1,
	value int4 NOT NULL,
	rental_fees int4 NOT NULL,
	image_url text NULL DEFAULT ''::text,
	created_at timestamptz NULL DEFAULT CURRENT_TIMESTAMP,
	description text NULL,
	dock_id int4 NULL,
	CONSTRAINT bike_pk PRIMARY KEY (id),
	CONSTRAINT bike_fk FOREIGN KEY (dock_id) REFERENCES public.dock(id) ON DELETE CASCADE
);

-- Table Triggers

create trigger dock_changes after
update
    on
    public.bike for each row execute function bike_dock_change();
create trigger bike_insert after
insert
    on
    public.bike for each row execute function insert_new_bike();


-- public.e_bike definition

-- Drop table

-- DROP TABLE public.e_bike;

CREATE TABLE public.e_bike (
	bike_id int4 NOT NULL,
	battery numeric(3, 1) NOT NULL,
	time_remain int4 NOT NULL,
	created_at timestamptz NULL DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT e_bike_pk PRIMARY KEY (bike_id),
	CONSTRAINT e_bike_fk FOREIGN KEY (bike_id) REFERENCES public.bike(id) ON DELETE CASCADE
);


-- public.payment_transaction definition

-- Drop table

-- DROP TABLE public.payment_transaction;

CREATE TABLE public.payment_transaction (
	id serial4 NOT NULL,
	card_id int4 NOT NULL,
	"type" text NOT NULL,
	amount numeric NOT NULL,
	"method" text NULL,
	created_at timestamptz NULL DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT payment_transaction_pk PRIMARY KEY (id),
	CONSTRAINT payment_transaction_fk FOREIGN KEY (card_id) REFERENCES public.card(id) ON DELETE CASCADE
);


-- public."session" definition

-- Drop table

-- DROP TABLE public."session";

CREATE TABLE public."session" (
	id serial4 NOT NULL,
	card_id int4 NOT NULL,
	bike_id int4 NOT NULL,
	rent_transactionid int4 NOT NULL,
	return_transactionid int4 NULL,
	last_rent_time_before_lock int4 NULL DEFAULT 0,
	active bool NULL DEFAULT true,
	start_time text NULL,
	last_resume_time text NULL,
	end_time text NULL,
	created_at timestamptz NULL DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT session_pk PRIMARY KEY (id),
	CONSTRAINT session_fk1 FOREIGN KEY (card_id) REFERENCES public.card(id),
	CONSTRAINT session_fk2 FOREIGN KEY (bike_id) REFERENCES public.bike(id),
	CONSTRAINT session_fk3 FOREIGN KEY (rent_transactionid) REFERENCES public.payment_transaction(id),
	CONSTRAINT session_fk4 FOREIGN KEY (return_transactionid) REFERENCES public.payment_transaction(id)
);


-- public.invoice definition

-- Drop table

-- DROP TABLE public.invoice;

CREATE TABLE public.invoice (
	id serial4 NOT NULL,
	session_id int4 NOT NULL,
	total_charge numeric NULL,
	created_at timestamptz NULL DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT invoice_pk PRIMARY KEY (id),
	CONSTRAINT invoice_fk FOREIGN KEY (session_id) REFERENCES public."session"(id)
);



CREATE OR REPLACE FUNCTION public.bike_dock_change()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
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
$function$
;

CREATE OR REPLACE FUNCTION public.insert_new_bike()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
BEGIN
    IF NEW.dock_id IS NOT NULL THEN
        UPDATE public.dock
        SET taken_slot = taken_slot + 1
        WHERE id = NEW.dock_id;
    END IF;

    RETURN NEW;
END;
$function$
;