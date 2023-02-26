<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response as IlluminateResponse;
/**
 * Base API Controller.
 */
class ApiController extends Controller
{
    // default format
    protected $dataResponse = [
        'data' => null,
        'meta' => null,
        'message' => null
    ];

    /**
     * default status code.
     *
     * @var int
     */
    protected $responseCode = 200;
    protected $message = 'Successfully load.';
    protected $meta = null;
    protected $noreff = '';
    protected $typelog = '';

    /**
     * get the status code.
     *
     * @return responseCode
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /**
     * get the status code.
     *
     * @return responseCode
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * get the rc.
     *
     * @return message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * get the rc.
     *
     * @return message
     */
    public function getTypeLog()
    {
        return $this->typelog;
    }

    /**
     * set the status code.
     *
     * @param [type] $responseCode [description]
     *
     * @return responseCode
     */
    public function responseCode($responseCode)
    {
        $this->responseCode = $responseCode;

        return $this;
    }

    /**
     * set the status code.
     *
     * @param [type] $responseCode [description]
     *
     * @return responseCode
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * set the status code.
     *
     * @param [type] $responseCode [description]
     *
     * @return responseCode
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;

        return $this;
    }

    /**
     * set the status code.
     *
     * @param [type] $responseCode [description]
     *
     * @return responseCode
     */
    public function setNoReff($noreff)
    {
        $this->noreff = $noreff;

        return $this;
    }

    /**
     * set the status code.
     *
     * @param [type] $responseCode [description]
     *
     * @return responseCode
     */
    public function setTypeLog($typelog)
    {
        $this->typelog = $typelog;

        return $this;
    }

    /**
     * Respond.
     *
     * @param array $data
     * @param array $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data, $message, $headers = [])
    {
        $this->dataResponse['responsecode'] = $this->getResponseCode();
        $this->dataResponse['data'] = $data;
        $this->dataResponse['message'] = $message ?? $this->getMessage();
        $this->dataResponse['meta'] = $this->getMeta();

        return response()->json($this->dataResponse, $this->getResponseCode(), $headers);
    }

    /**
     * Respond Created.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondCreated($data)
    {
        return $this->responseCode(201)->respond([
            'data' => $data,
        ]);
    }

    /**
     * Respond Created with data.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondCreatedWithData($data)
    {
        return $this->responseCode(201)->respond($data);
    }

    /**
     * responsd not found.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondNotFound($message = 'Not Found')
    {
        return $this->responseCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
    }

    /**
     * Respond with error.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondInternalError($message = 'Internal Error')
    {
        return $this->responseCode(500)->respondWithError($message);
    }

    /**
     * Respond with unauthorized.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondUnauthorized($message = 'Unauthorized')
    {
        return $this->responseCode(401)->respondWithError($message);
    }

    /**
     * Respond with forbidden.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondForbidden($message = 'Forbidden')
    {
        return $this->responseCode(403)->respondWithError($message);
    }

    /**
     * Respond with no content.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithNoContent()
    {
        return $this->responseCode(204)->respond(null);
    }

    /**Note this function is same as the below function but instead of responding with error below function returns error json
     * Throw Validation.
     *
     * @param string $message
     *
     * @return mix
     */
    public function throwValidation($message)
    {
        return $this->responseCode(422)
            ->respondWithError($message);
    }
}
