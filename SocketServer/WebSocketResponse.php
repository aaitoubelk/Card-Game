<?php

class WebSocketResponse
{
    public $statusCode;
    public $data;
    public $responseType;

    private function __construct($responseType, $statusCode, $data)
    {
        $this->statusCode = $statusCode;
        $this->responseType = $responseType;

        $this->data = $data;
    }


    public static function OK($responseType, $data)
    {
        return new WebSocketResponse($responseType, "200", $data);
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }

    public function toArray()
    {
        return [
            'statusCode' => $this->statusCode,
            'responseType' => $this->responseType,
            'data' => $this->data
        ];
    }
}
