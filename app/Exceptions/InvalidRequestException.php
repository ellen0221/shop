<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Exception;

class InvalidRequestException extends Exception
{
    // 用户异常
    public function __construct(string $message = "", int $code = 400)
    {
        parent::__construct($message, $code);
    }

    public function render(Request $request)
    {
        if ($request->expectsJson()) {
            // json() 方法的第二个参数就是 Http 的返回码
            return response()->json(['msg' => $this->message], $this->code);
        }

        return view('pages.error', ['msg' => $this->message]);
    }
}
