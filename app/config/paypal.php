<?php
return array(
    // set your paypal credential
    'client_id' =>'ASMRfp1nNbu5VlxCCdKpbtdi424wzIHDtWonp8nCRWfpZ7yRE61WYts6E2QWwZFPd7d3n6sTokIzGIMP',
    'secret' => 'EN9egZxTsFa1DFslsRLDIuiBF-fw3XlgRoehs01nSGgCRfkU8xWyFHhJP7GXCrdDjy8oZwmuh3j6WvTj',

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