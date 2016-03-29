<?php

namespace iPresso\Service;

class Response
{
    /**
     * Content of demanded document (most often returned header in web communication)
     */
    const STATUS_OK = 200;

    /**
     * Created – sent document was saved on server
     */
    const STATUS_CREATED = 201;

    /**
     * Bad request – the request was invalid or cannot be otherwise served
     */
    const STATUS_BAD_REQUEST = 400;

    /**
     * Forbidden – The request is understood, but access is not allowed.
     */
    const STATUS_FORBIDDEN = 403;

    /**
     * Not found – the URL requested is invalid or the resource requested, such as a user, does not exists
     */
    const STATUS_NOT_FOUND = 404;

    /**
     * Too Many Requests – the user has sent too many requests in a given amount of time.
     */
    const STATUS_TOO_MANY_REQUESTS = 429;

    /**
     * Internal Server Error – server encountered unexpected difficulties, which make execution of the request impossible
     */
    const STATUS_INTERNAL_SEVER_ERROR = 500;

    /**
     * Not implemented – server does not dispose of functionality required in the request; the server received unknown type of request
     */
    const STATUS_NOT_IMPLEMENTED = 501;


    public
        $code,
        $data,
        $error,
        $message;

    /**
     * Response constructor.
     * @param $response
     */
    public function __construct($response)
    {
        return $this->getResponse($response);
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $response
     * @return Response
     */
    public function getResponse($response)
    {
        if (isset($response->code))
            $this->code = $response->code;

        if (isset($response->data))
            $this->data = $response->data;

        if (isset($response->errorCode))
            $this->error = $response->errorCode;

        if (isset($response->message))
            $this->message = $response->message;

        return $this;
    }

}