<?php


use iPresso\Activity;
use iPresso\Campaign;
use iPresso\Contact;
use iPresso\Response;

class iPresso
{
    const API_VER = 2;
    const REQUEST_METHOD_GET = 'GET';
    const REQUEST_METHOD_POST = 'POST';
    const REQUEST_METHOD_PUT = 'PUT';
    const REQUEST_METHOD_DELETE = 'DELETE';

    private $curlHandler;
    private $customerKey;
    private $debug = false;
    private $headers;
    private $iteration = 0;
    private $login;
    private $password;
    private $post_data = '';
    private $request_path;
    private $request_type = self::REQUEST_METHOD_GET;
    private $token;
    private $url;
    private $version = self::API_VER;

    public function __construct()
    {
        $this->_curlInit();
    }

    /**
     * @param mixed $login
     * @return iPresso
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @param mixed $password
     * @return iPresso
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param mixed $token
     * @return iPresso
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @param mixed $url
     * @return iPresso
     */
    public function setUrl($url)
    {
        $this->url = $url . '/api/' . $this->version . '/';
        return $this;
    }

    /**
     * @param mixed $customerKey
     * @return iPresso
     */
    public function setCustomerKey($customerKey)
    {
        $this->customerKey = $customerKey;
        return $this;
    }

    /**
     * @param mixed $request_type
     * @return iPresso
     */
    public function setRequestType($request_type)
    {
        $this->request_type = $request_type;
        return $this;
    }

    /**
     * @param mixed $request_path
     * @return iPresso
     */
    public function setRequestPath($request_path)
    {
        $this->request_path = $request_path;
        return $this;
    }

    /**
     * @param array $post_data
     * @return iPresso
     */
    public function setPostData($post_data)
    {
        $this->post_data = http_build_query($post_data);
        return $this;
    }

    /**
     * @return iPresso
     */
    public function debug()
    {
        $this->debug = true;
        return $this;
    }

    /**
     * @param int $version
     * @return iPresso
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }


    /**
     * Use to make GET|POST|PUT request
     */
    public function request()
    {
        $this->_type();
        $this->_requestHeaders();
        $ret = $this->_exec($this->url . $this->request_path);
        if (isset($ret->code)) {
            switch ($ret->code) {
                case 403:
                    if (!isset($ret->errorCode) && $this->iteration < 5 && $this->getToken()) {
                        $this->iteration++;
                        return $this->request();
                    }
                default:
                    return $ret;
                    break;
            }
        }
        return false;
    }

    private function _type()
    {
        switch ($this->request_type) {
            case self::REQUEST_METHOD_DELETE:
                curl_setopt($this->curlHandler, CURLOPT_CUSTOMREQUEST, self::REQUEST_METHOD_DELETE);
                break;
            case self::REQUEST_METHOD_POST:
                curl_setopt($this->curlHandler, CURLOPT_POST, true);
                curl_setopt($this->curlHandler, CURLOPT_POSTFIELDS, $this->post_data);
                break;
            case self::REQUEST_METHOD_PUT:
                $fh = fopen('php://temp', 'rw');
                fwrite($fh, $this->post_data);
                rewind($fh);
                curl_setopt($this->curlHandler, CURLOPT_INFILE, $fh);
                curl_setopt($this->curlHandler, CURLOPT_INFILESIZE, strlen($this->post_data));
                curl_setopt($this->curlHandler, CURLOPT_PUT, true);
                break;
            case self::REQUEST_METHOD_GET:
            default:
                break;
        }
    }

    /**
     * Use to get session token
     */
    public function getToken()
    {
        $this->_headers();
        $this->_auth();
        $ret = $this->_exec($this->url . 'auth/' . $this->customerKey);
        if (isset($ret->code) && 200 == $ret->code) {
            $this->token = $ret->data;
            return true;
        }
        return false;
    }

    private function _exec($url)
    {
        curl_setopt($this->curlHandler, CURLOPT_URL, $url);
        curl_setopt($this->curlHandler, CURLOPT_HTTPHEADER, $this->headers);
        $jSON = curl_exec($this->curlHandler);

        if ($this->debug) {
            print_r($jSON);
        }

        return json_decode($jSON);
    }

    private function _headers()
    {
        $this->headers = array();
        $this->headers[] = 'ACCEPT: text/json';
        $this->headers[] = 'USER_AGENT: iPresso';
    }

    private function _auth()
    {
        curl_setopt($this->curlHandler, CURLOPT_USERPWD, $this->login . ':' . $this->password);
    }

    private function _requestHeaders()
    {
        $this->_headers();
        $this->headers[] = 'IPRESSO_TOKEN: ' . $this->token;
    }

    private function _curlInit()
    {
        $this->curlHandler = curl_init();
        curl_setopt($this->curlHandler, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($this->curlHandler, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curlHandler, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->curlHandler, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->curlHandler, CURLOPT_COOKIE, 'XDEBUG_SESSION=1');
    }

    /**
     * Get available attributes
     * @return bool|mixed
     */
    public function getAvailableAttributes()
    {
        return $this
            ->setRequestPath('attribute')
            ->setRequestType(iPresso::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Send intentable direct marketing campaign
     * @param $idCampaign
     * @param Campaign $campaign
     * @return bool|mixed
     */
    public function sendCampaign($idCampaign, Campaign $campaign)
    {
        return $this
            ->setRequestPath('campaign/' . $idCampaign . '/send')
            ->setRequestType(iPresso::REQUEST_METHOD_POST)
            ->setPostData($campaign->getCampaign())
            ->request();
    }

    /**
     * Add new activity
     * @param Activity $activity
     * @return bool|mixed
     * @throws Exception
     */
    public function addActivity(Activity $activity)
    {
        return $this
            ->setRequestPath('activity')
            ->setRequestType(iPresso::REQUEST_METHOD_POST)
            ->setPostData($activity->getActivity())
            ->request();
    }

    /**
     * Adding tags to contacts with a given ID
     * @param $idContact
     * @param $tagString
     * @return bool|mixed
     */
    public function addTagToContact($idContact, $tagString)
    {
        $data['tag'] = [$tagString];
        return $this
            ->setRequestPath('contact/' . $idContact . '/tag')
            ->setRequestType(iPresso::REQUEST_METHOD_POST)
            ->setPostData($data)
            ->request();
    }

}
