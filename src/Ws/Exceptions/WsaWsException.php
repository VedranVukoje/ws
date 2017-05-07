<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Wsa\Ws\Exceptions;

use Exception;
/**
 * Description of WsaWsException
 *
 * @author vedran
 */
class WsaWsException extends Exception
{
    public function errorHandler($err_severity, $err_msg, $err_file, $err_line, array $err_context)
    {
        // error was suppressed with the @-operator
        if (0 === error_reporting()) {
            return false;
        }
        switch ($err_severity) {
            case E_ERROR: throw new \ErrorException($err_msg, 0, $err_severity, $err_file, $err_line);
            case E_WARNING: throw new \Wsa\Ws\Exceptions\Debug\WarningException($err_msg, 0, $err_severity, $err_file, $err_line);
            case E_PARSE: throw new \Wsa\Ws\Exceptions\Debug\ParseException($err_msg, 0, $err_severity, $err_file, $err_line);
            case E_NOTICE: throw new \Wsa\Ws\Exceptions\Debug\NoticeException($err_msg, 0, $err_severity, $err_file, $err_line);
            case E_CORE_ERROR: throw new \Wsa\Ws\Exceptions\Debug\CoreErrorException($err_msg, 0, $err_severity, $err_file, $err_line);
            case E_CORE_WARNING: throw new \Wsa\Ws\Exceptions\Debug\CoreWarningException($err_msg, 0, $err_severity, $err_file, $err_line);
            case E_COMPILE_ERROR: throw new \Wsa\Ws\Exceptions\Debug\CompileErrorException($err_msg, 0, $err_severity, $err_file, $err_line);
            case E_COMPILE_WARNING: throw new \Wsa\Ws\Exceptions\Debug\CoreWarningException($err_msg, 0, $err_severity, $err_file, $err_line);
            case E_USER_ERROR: throw new \Wsa\Ws\Exceptions\Debug\UserErrorException($err_msg, 0, $err_severity, $err_file, $err_line);
            case E_USER_WARNING: throw new \Wsa\Ws\Exceptions\Debug\UserWarningException($err_msg, 0, $err_severity, $err_file, $err_line);
            case E_USER_NOTICE: throw new \Wsa\Ws\Exceptions\Debug\UserNoticeException($err_msg, 0, $err_severity, $err_file, $err_line);
            case E_STRICT: throw new \Wsa\Ws\Exceptions\Debug\StrictException($err_msg, 0, $err_severity, $err_file, $err_line);
            case E_RECOVERABLE_ERROR: throw new \Wsa\Ws\Exceptions\Debug\RecoverableErrorException($err_msg, 0, $err_severity, $err_file, $err_line);
            case E_DEPRECATED: throw new \Wsa\Ws\Exceptions\Debug\DeprecatedException($err_msg, 0, $err_severity, $err_file, $err_line);
            case E_USER_DEPRECATED: throw new \Wsa\Ws\Exceptions\Debug\UserDeprecatedException($err_msg, 0, $err_severity, $err_file, $err_line);
        }
    }
}
