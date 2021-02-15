<?php

namespace App\Helpers;

use \Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use App\Helpers\ApiSession;

/**
 * Задача класса формировать json или xml ответы.
 * Class ApiResponse
 * @package App\Helpers
 */
class ApiResponse
{
    public static $acceptXml;
    /**
     * Вернуть http ответ
     * @param mix $value
     * @param int $status
     * @return Response
     */
    public static function success($value = null, $status = 200)
    {
        $data = [
            'success' => true,
        ];

        if (isset($value)) {
            $data['result'] = $value;
        }

        return static::format($data, $status);
    }

    /**
     * Вернуть http ответ на ошибку
     * @param string $error
     * @param string|array $message
     * @param int $status
     * @return Response
     */
    public static function error($error, $message = null, $status = 400)
    {
        $data = [
            'success' => false,
            'error' => $error,
        ];
        if (is_string($message)) {
            $data['message'] = $message;
        }
        if (is_array($message)) {
            $data = array_merge($data, $message);
        }
        return static::format($data, $status);
    }

    /**
     * Вернуть http ответ на исключение
     * @param Exception $exception
     * @param int $status
     * @return Response
     */
    public static function except($exception, $status = 400)
    {
        if ($exception instanceof ValidationException) {
            return static::validateExcept($exception, $status);
        };

        $data = [
            'success' => false,
            'error' => 'exception',
            'message' => $exception->getMessage(),
        ];
        if ($code = $exception->getCode()) {
            $data['code'] = $code;
        }

        return static::format($data, $status);
    }

    /**
     * Форматирует ответ в формате json или xml и добавляет в них дополнительную информацию
     * @param array $data
     * @param int $status
     * @param array $headers
     * @return Response
     */
    private static function format($data, $status = 200, array $headers = [])
    {
        $data['ver'] = '1.0';
        $data['time'] = microtime(true) ^ 0;
        $data['speed'] = (microtime(true) - LARAVEL_START) * 1000 ^ 0;

        ApiSession::response($data);

        if (static::acceptXml()) {
            $config = [
                'template' => '<root></root>',
                'rowName' => 'name'
            ];
            return response()->xml($data, $status, $config);
        }

        return response()->json($data, $status, $headers);
    }

    /**
     * true, если клиент запрашивает XML
     * @return bool
     */
    private static function acceptXml()
    {
        if (!isset(self::$acceptXml)) {
            $request = request();
            self::$acceptXml = ($request->input('format') == 'xml')
                || (!$request->accepts('application/json') && $request->accepts('application/xml'));
        }
        return self::$acceptXml;
    }
}
