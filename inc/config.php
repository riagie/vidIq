<?php

/**
 * Kumpulan Konstan
 * @package Platform
 * @access public
 * @author 
 * @copyright (c) 2022
 * 
*/

define('VERSION', '1.0.0');

// define('MEMORY_LIMIT', '512M');
// define('MAX_EXECUTION_TIME', '43200');

/**
 * API PATH CONFIGURATION
*/
define('ROOT', dirname(dirname(__FILE__)). '/' );

/**
 * API CONFIG CONFIGURATION
*/
define('CHANNEL_TOKEN', 'UKP!d07231c9-b382-48c1-90c2-34cd09f4d791!ceb8c049-846d-4f59-b452-08ea0421f507');
define('FOLDER_EXCEL', 'src/');
define('FILE_EXCEL', 'vidiq');

/**
 * API GLOBAL CONFIGURATION
 */
// define('MAX_EXECUTION', 30);
define('MAX_TIMEOUT', 30);
define('SLEEP', 3);
define('MAX_SLEEP', 20);

define('ERROR', 3); // fatal
define('INFO', 3); // result
define('WARNING', 3); // notif
define('STAT', 3); // time excute
define('TRACE', 3); // role progress excute
define('SPECIAL', 1); // notif to email

define('LOGS_ERROR', 'logs/' . date('Ymd') . '-error.log');
define('LOGS_INFO', 'logs/' . date('Ymd') . '-info.log');
define('LOGS_WARNING', 'logs/' . date('Ymd') . '-warning.log');
define('LOGS_STAT', 'logs/' . date('Ymd') . '-stat.log');
define('LOGS_TRACE', 'logs/' . date('Ymd') . '-trace.log');

define('LOG_LEVEL', ERROR | INFO | WARNING | STAT | TRACE);