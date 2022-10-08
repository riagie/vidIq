<?php

// use Curl\Curl;

class Vidiq 
{
    public $curl;
    const USER_AGENT = 'PostmanRuntime/7.29.2';
    public $_headers = array();
    public $response_headers = array();
    public $response = null;
    public $curl_error_code = 0;
    public $curl_error_message = null;
    public $curl_error = false;
    public $http_status_code = 0;
    public $http_error = false;
    public $error = false;
    public $error_code = 0;
    public $request_headers = null;
    public $http_error_message = null;
    public $error_message = null;
    public $options;

    public function __construct() 
    {
		require('lib/Json.php');
        $this->API = 'https://api.vidiq.com/v0/hottersearch?';
	}

    public function init($tag) 
    {
        $header = array(
            "Host" => "api.vidiq.com",
            "Authorization" => "Bearer ".CHANNEL_TOKEN,
        );
        $data = array (
            "q"   => $tag,
            "im"    => "4.5",
            "group" => "V5",
            "src"   => ""
        );

        $this->curl = curl_init();
        // $this->setUserAgent(self::USER_AGENT);
        $this->setHeader($header);
        $this->setOpt(CURLOPT_URL, $this->API . http_build_query($data));
        $this->setOpt(CURLOPT_RETURNTRANSFER, true);
        $this->setOpt(CURLOPT_ENCODING , '');
        $this->setOpt(CURLOPT_MAXREDIRS, 10);
        $this->setOpt(CURLOPT_TIMEOUT, MAX_TIMEOUT);
        $this->setOpt(CURLOPT_FOLLOWLOCATION, true);
        $this->setOpt(CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        $this->setOpt(CURLOPT_SSL_VERIFYPEER, false);
        $this->setOpt(CURLOPT_SSL_VERIFYHOST, false);
        // $this->setOpt(CURLOPT_AUTOREFERER, true);
        // $this->setOpt(CURLOPT_VERBOSE, true);
        $this->setOpt(CURLOPT_CUSTOMREQUEST, "GET");
        $this->exec();
        $this->close();
        
        return $this;
    }

    public function setUserAgent($useragent) 
    {
        $this->setOpt(CURLOPT_USERAGENT, $useragent);   

        return $this;
    }

    public function setHeader($header = false) 
    {
        if ($header) 
        {
            foreach ($header as $key => $value) 
            {
                $key = trim($key);
                $value = trim($value);
                $this->_headers[$key] = $key . ': ' . $value;
            }
            $this->setOpt(CURLOPT_HTTPHEADER, array_values($this->_headers));
        }

        return $this;
    }

    public function setOpt($option, $value) 
    {
        $this->options[$option] = $value;

        return $this;
    }

    public function exec() 
    {
        curl_setopt_array($this->curl, $this->options);

        $this->response_headers = array();
        $this->response = curl_exec($this->curl);
        $this->curl_error_code = curl_errno($this->curl);
        $this->curl_error_message = curl_error($this->curl);
        $this->curl_error = !($this->getErrorCode() === 0);
        $this->http_status_code = intval(curl_getinfo($this->curl, CURLINFO_HTTP_CODE));
        $this->http_error = $this->isError();
        $this->error = $this->curl_error || $this->http_error;
        $this->error_code = $this->error ? ($this->curl_error ? $this->getErrorCode() : $this->getHttpStatus()) : 0;
        $this->request_headers = preg_split('/\r\n/', curl_getinfo($this->curl, CURLINFO_HEADER_OUT), -1, PREG_SPLIT_NO_EMPTY);
        $this->http_error_message = $this->error ? (isset($this->response_headers['0']) ? $this->response_headers['0'] : '') : '';
        $this->error_message = $this->curl_error ? $this->getErrorMessage() : $this->http_error_message;

        return $this;
    }

    public function getErrorCode() 
    {
        return $this->curl_error_code;
    }

    public function isError()
    {
        return $this->getHttpStatus() >= 400 && $this->getHttpStatus() < 600;
    }

    public function getHttpStatus()
    {
        return $this->http_status_code;
    }

    public function getErrorMessage()
    {
        return $this->curl_error_message;
    }

    public function close() 
    {
        if (is_resource($this->curl)) {
            curl_close($this->curl);
        }

        return $this;
    }

    public function Json($convert, $string, $bool = false, $json = false)
    {
        if (function_exists('json_encode')) {
            $services = 'json_' . $convert;
            if ($bool) {
                $json = $services($string, $bool);
            } else {
                $json = $services($string);
            }
        }

        if (empty($json)) {
            $services = new Services_JSON(SERVICES_JSON_SUPPRESS_ERRORS);
            $json = $services->$convert($string);
        }

        return $json;
    }

    public function DEBUG($string, $autodump = false, $err = false) 
    {
        if ($err) error_log('[' . date("D M j H:i:s Y", time()) . '][ERROR] ' . $string . "\n", ERROR, LOGS_ERROR);
        if (DEBUG == 1) {
            error_log('[' . date("D M j H:i:s Y", time()) . '][INFO] ' . $string . "\n", INFO, LOGS_INFO);
            
            if ($autodump || (empty($string) && $string !== 0 && $string !== '0') || $string === true) 
            {
                print_r(PHP_EOL); var_dump($string); print_r(PHP_EOL);
            } else 
            {
                print_r(PHP_EOL); print_r($string); print_r(PHP_EOL); 
            }
        }
    }
}