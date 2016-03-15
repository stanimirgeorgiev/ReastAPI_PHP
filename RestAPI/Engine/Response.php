<?php

/*
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */
namespace RestAPI\Engine;
/**
 * Description of HeadeCreator
 *
 * @author Stanimir Georgiev
 */
class Response implements \RestAPI\Interfaces\ResponseInterface {

    /**
     * @var \RestAPI\Interfaces\OutputWriterInterface
     */
    private $writer;

    /**
     * HTTP response code constant
     */
    const
            OK = 200,
            CREATED = 201,
            ACCEPTED = 202,
            NONAUTHORATIVEINFORMATION = 203,
            NOCONTENT = 204,
            RESETCONTENT = 205,
            PARTIALCONTENT = 206,
            MULTIPLECHOICES = 300,
            MOVEDPERMANENTLY = 301,
            FOUND = 302,
            SEEOTHER = 303,
            NOTMODIFIED = 304,
            USEPROXY = 305,
            TEMPORARYREDIRECT = 307,
            BADREQUEST = 400,
            UNAUTHORIZED = 401,
            PAYMENTREQUIRED = 402,
            FORBIDDEN = 403,
            NOTFOUND = 404,
            METHODNOTALLOWED = 405,
            NOTACCEPTABLE = 406,
            PROXYAUTHENTICATIONREQUIRED = 407,
            REQUESTTIMEOUT = 408,
            CONFLICT = 409,
            GONE = 410,
            LENGTHREQUIRED = 411,
            PRECONDITIONFAILED = 412,
            REQUESTENTITYTOOLARGE = 413,
            REQUESTURITOOLONG = 414,
            UNSUPPORTEDMEDIATYPE = 415,
            REQUESTEDRANGENOTSATISFIABLE = 416,
            EXPECTATIONFAILED = 417,
            IMATEAPOT = 418,
            INTERNALSERVERERROR = 500,
            NOTIMPLEMENTED = 501,
            BADGATEWAY = 502,
            SERVICEUNAVAILABLE = 503,
            GATEWAYTIMEOUT = 504,
            HTTPVERSIONNOTSUPPORTED = 505;

    public function __construct(\RestAPI\Interfaces\OutputWriterInterface $writer) {

//Specify criptografic public jey
        header("Public-Key-Pins: pin-sha256='<sha256>'; pin-sha256='<sha256>'; max-age=15768000; includeSubDomains");

//Only HTTPS
        header("Strict-Transport-Security: max-age=16070400; includeSubDomains");

//Clickjacking protection 
        header("X-Frame-Options: deny");

//XSS filter enabled
        header("X-XSS-Protection: 1; mode=block");

//MIME sniffing disabled
        header("X-Content-Type-Options: nosniff ");

//Prevents basic XSS attacks
        header("Content-Security-Policy: default-src 'self'");

        $this->writer = $writer;
    }

    public function ОК($data,$message) {
        header($_SERVER["SERVER_PROTOCOL"] . " " . OK . " OK");

        $this->writer->createOutput($data);
    }

    public function Created($data,$message) {
        header($_SERVER["SERVER_PROTOCOL"] . " " . CREATED . " Created");

        $this->writer->createOutput($data,$message);
    }

    public function NotFound($data,$message) {
        header($_SERVER["SERVER_PROTOCOL"] . " " . NOTFOUND . " Notfound");

        $this->writer->createOutput($data);
    }

    public function Unauthorized($data,$message) {
        header($_SERVER["SERVER_PROTOCOL"] . " " . UNAUTHORIZED . " Unauthorized");

        $this->writer->createOutput($data);
    }

}
