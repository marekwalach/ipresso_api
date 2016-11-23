<?php

namespace iPresso\Service;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Itav\Component\Serializer\Serializer;

/**
 * Class Service
 * @package iPresso\Service
 */
class Service
{
    const API_VER = 2;
    const REQUEST_METHOD_GET = 'GET';
    const REQUEST_METHOD_POST = 'POST';
    const REQUEST_METHOD_PUT = 'PUT';
    const REQUEST_METHOD_DELETE = 'DELETE';

    /**
     * @var string
     */
    private $customerKey;

    /**
     * @var array
     */
    private $customHeaders = [];

    /**
     * @var bool
     */
    private $debug = false;

    /**
     * @var Client
     */
    private $guzzle;

    /**
     * @var array
     */
    private $headers;

    /**
     * @var int
     */
    private $iteration = 0;

    /**
     * @var string
     */
    private $login;

    /**
     * @var array
     */
    private $options = [];

    /**
     * @var string
     */
    private $password;

    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $method = self::REQUEST_METHOD_GET;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var string
     */
    private $token;

    /**
     * @var callable
     */
    private $tokenCallBack;

    /**
     * @var string
     */
    private $url;

    /**
     * @var integer
     */
    private $version = self::API_VER;

    /**
     * Service constructor.
     */
    public function __construct()
    {
        $this->serializer = new Serializer();
        $this->guzzle = new Client(['http_errors' => false]);
    }

    /**
     * @param mixed $login
     * @return Service
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @param mixed $password
     * @return Service
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param mixed $token
     * @return Service
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @param mixed $url
     * @return Service
     */
    public function setUrl($url)
    {
        $this->url = $url . '/api/' . $this->version . '/';
        return $this;
    }

    /**
     * @param mixed $customerKey
     * @return Service
     */
    public function setCustomerKey($customerKey)
    {
        $this->customerKey = $customerKey;
        return $this;
    }

    /**
     * @param mixed $method
     * @return Service
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @param mixed $path
     * @return Service
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param array $data
     * @return Service
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return Service
     */
    public function debug()
    {
        $this->debug = true;
        return $this;
    }

    /**
     * @param int $version
     * @return Service
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @param string $customHeader
     * @return Service
     */
    public function addCustomHeader($customHeader)
    {
        $this->customHeaders[] = $customHeader;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTokenCallBack()
    {
        return $this->tokenCallBack;
    }

    /**
     * @param mixed $tokenCallBack
     * @return $this
     */
    public function setTokenCallBack($tokenCallBack)
    {
        $this->tokenCallBack = $tokenCallBack;
        return $this;
    }

    /**
     * @param bool $getToken
     * @throws \Exception
     */
    private function validator($getToken = false)
    {
        if (!$this->token && !$getToken)
            throw new \Exception('Set token first.');

        if (!$this->login)
            throw new \Exception('Set login first.');

        if (!$this->password)
            throw new \Exception('Set password first.');

        if (!$this->url)
            throw new \Exception('Set url first.');

        if (!$this->customerKey)
            throw new \Exception('Set customerKey first.');
    }


    /**
     * @return Response
     */
    public function request()
    {
        $this->validator();
        $this->headers();
        $this->options();

        $response = $this->execute($this->url . $this->path);
        switch ($response->getCode()) {
            case Response::STATUS_FORBIDDEN:
                if (!$response->getErrorCode() && $this->iteration < 5 && $this->getToken()) {
                    $this->iteration++;
                    return $this->request();
                }
            default:
                return $response;
                break;
        }
    }

    /**
     * Use to get session token
     * @param bool $fullResponse
     * @return false|string|Response
     * @throws \Exception
     */
    public function getToken($fullResponse = false)
    {
        $this->validator(true);
        $this->headers(true);
        $this->options(true);

        $response = $this->execute($this->url . 'auth/' . $this->customerKey);

        if ($fullResponse)
            return $response;

        if (Response::STATUS_OK == $response->getCode()) {
            $this->token = $response->getData();

            if (!empty($this->tokenCallBack))
                call_user_func($this->tokenCallBack, $this->token);

            return $this->token;
        }
        return false;
    }

    /**
     * @param bool $authorization
     */
    private function options($authorization = false)
    {
        $this->options[RequestOptions::HEADERS] = array_merge($this->headers, $this->customHeaders);
        $this->options['config']['curl'] = [
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_COOKIE => 'XDEBUG_SESSION=1'
        ];

        if ($authorization)
            $this->options[RequestOptions::AUTH] = [$this->login, $this->password];

        if ($this->data)
            $this->options[RequestOptions::FORM_PARAMS] = $this->data;
    }

    /**
     * @param string $url
     * @return Response
     */
    private function execute($url)
    {
        $response = $this->guzzle->request($this->method, $url, $this->options);

        if ($this->debug)
            print_r($response->getBody()->getContents());

        return $this->serializer->denormalize(json_decode($response->getBody()->getContents(), true), Response::class);
    }

    /**
     * @param bool $authorization
     */
    private function headers($authorization = false)
    {
        $this->headers['ACCEPT'] = 'text/json';
        $this->headers['USER_AGENT'] = 'iPresso';
        if (!$authorization)
            $this->headers['IPRESSO_TOKEN'] = $this->token;
    }

    /**
     * @param bool $die
     * @param mixed $variable
     * @param bool $desc
     * @param bool $noHtml
     */
    public static function dump($die, $variable, $desc = false, $noHtml = false)
    {
        if (is_string($variable)) {
            $variable = str_replace("<_new_line_>", "<BR>", $variable);
        }

        if ($noHtml) {
            echo "\n";
        } else {
            echo "<pre>";
        }

        if ($desc) {
            echo $desc . ": ";
        }

        print_r($variable);

        if ($noHtml) {
            echo "";
        } else {
            echo "</pre>";
        }

        if ($die) {
            die();
        }
    }
}