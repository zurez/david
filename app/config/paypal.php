<?php
return array(
    // set your paypal credential
    'client_id' => 'Af9NApXRP2LNEcdSLzREszFLXVtAlq4LfLYVskU1nMQp2mKwq0Eij8vdWmkGRj18I9PC50ioSB8shhTe',
    'secret' => 'EMC6ZJV3FdlXNM9goo1eEj8QlyN2vtlHfXFiJJlcyxvosEITFi4cHClwgn0qHpBc5XLlsVM9GWHvnsz2',

    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 120,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);