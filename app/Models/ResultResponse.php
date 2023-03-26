<?php

namespace App\Models;

class ResultResponse
{
    const SUCCESS = array("code"=>200, "message"=>"Success");
    const ERROR = array("code"=>300, "message"=>"Error");
    const NOT_FOUND = array("code"=>404, "message"=>"Element not found");

    const UNPROCESSABLE_CONTENT = array("code"=>422, "message"=>"Unprocessable Content");

    public $data;
    public $code;
    public $message;

    private function fullfilledConstructor($data, $status): void
    {
        $this->data = $data;
        $this->code = $status['code'];
        $this->message = $status['message'];
    }

    private function emptyConstructor(): void
    {
        $this->data = '';
        $this->code = self::ERROR['code'];
        $this->message = self::ERROR['message'];
    }

    public function __construct()
    {
        $params = func_get_args();
        $num_params = func_num_args();

        if ($num_params == 0) {
            call_user_func_array(array($this,'emptyConstructor'),$params);
        }
        else {
            call_user_func_array(array($this,'fullfilledConstructor'),$params);
        }
    }

    public function setData($data): void
    {
        $this->data = $data;
    }

    public function setStatus($status): void
    {
        $this->code = $status['code'];
        $this->message = $status['message'];
    }
}
