<?php

class Configs
{
    // api constants
    public const GET_BALANCE_URL = "https://ecopark-system-api.herokuapp.com/api/card/balance/118609_group1_2020";
    public const GET_VEHICLECODE_URL = "https://ecopark-system-api.herokuapp.com/api/get-vehicle-code/1rjdfasdfas";
    public const PROCESS_TRANSACTION_URL = "https://ecopark-system-api.herokuapp.com/api/card/processTransaction";
    public const RESET_URL = "https://ecopark-system-api.herokuapp.com/api/card/reset";

    // database Configs
    public const DB_NAME = "ebr";
    public const DB_USERNAME = "postgres";
    public const DB_PASSWORD = "Ktrung1709";
    public const DB_URL = "pgsql:host=kellphones.cvbrhp7nqvtj.ap-southeast-1.rds.amazonaws.com;port=5432;dbname=ebr";

    public const CURRENCY = "VND";
    public const PERCENT_VAT = 10;
}
