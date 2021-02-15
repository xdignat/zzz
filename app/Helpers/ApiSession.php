<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Illuminate\Contracts\Session\Session;
use App\Exceptions\ApiSessionException;

class ApiSession
{
    public $sid;
    /** @var SessionManager */
    protected $manager;
    /** @var Session */
    public $session;
    /** @var Request */
    public $request;
    /** @var string */
    public $token;
    public $expires;
    public $user_id;
    public $app_id;
    /** @var int */
    public $lifetime = 0;

    public function __construct(SessionManager $manager)
    {
        app()->singleton(static::class);
        $this->manager = $manager;
        $this->request = request();
        $this->token = $this->request->token;
        $this->load($this->token);
    }

    /**
     * Возвращает глобальный объект
     * @return ApiSession
     */
    public static function self()
    {
        return app(self::class);
    }

    /**
     * Инициализирует сесию
     * @return ApiSession
     */
    public static function open()
    {
        return static::self();
    }

    public static function close()
    {
        $self = static::self();
        if ($session = $self->session) {
            $session->getHandler()->destroy($session->getId());
            $self->session = null;
        }
    }

    /**
     * Создаёт токен
     * @param $user_id
     * @param $app_id
     * @return ApiSession
     */
    public static function new($user_id, $app_id)
    {
        $self = static::self();

        return $self->create(['user_id' => $user_id, 'app_id' => $app_id]);
    }

    /**
     * Заполняет массив данными сесcии: токен и конечное время жизни сессии
     * @param $data
     * @return ApiSession
     */
    public static function response(&$data)
    {
        $self = static::self();
        if ($session = $self->session) {
            $session->save();
            if ($self->token) {
                $data['token'] = $self->token;
                $data['expires'] = time() + $self->lifetime;
            }
        }

        return $self;
    }

    /**
     * Проверяет валидность сессии
     * @throws ApiSessionException
     */
    public static function check()
    {
        $self = static::self();
        $expires = $self->expires;
        if (!$expires || ($expires < time())) {
            throw new ApiSessionException('Expired or invalid token');
        }
    }

    public static function responseCheck()
    {
        $self = static::self();
        $expires = $self->expires;
        if (!$expires || ($expires < time())) {
            return static::responseError('Expired or invalid token');
        }
    }

    /**
     * Возвращает http-ответ ошибки сессии
     * @param string $message
     * @return \Illuminate\Http\Response
     */
    public static function responseError(string $message)
    {
        return ApiResponse::error('session', $message);
    }

    private function load(string $token = null)
    {
        $config = $this->manager->getSessionConfig();
        if ($config['driver']) {
            $this->lifetime = ($config['lifetime'] ?? 10) * 60;

            /** @var Session $session */
            $session = $this->session = $this->manager->driver();
            $session->setId($token);
            $session->getHandler()->gc($this->lifetime);
            $this->request->setLaravelSession($session);

//            $self = $this;
//            $this->request->macro('apiSession', function () use ($self) {
//                return $self;
//            });

            //$session->setRequestOnHandler($this->request);


            if ($token) {
                $session->start();
                $this->token = $token; //$session->getId();
                $this->expires = $session->get('expires');
                $this->user_id = $session->get('user_id');
                $this->app_id = $session->get('app_id');
            }

        }

        return $this;
    }

    private function create($params)
    {
        $session = $this->session;
        $session->setId('');
        $this->token = $session->getId();
        $session->start();

        $this->user_id = $params['user_id'];
        $this->app_id = $params['app_id'];

        foreach ($params as $name => $value) {
            $session->put($name, $value);
        }
        $this->expires = time() + $this->lifetime;
        $session->put('expires', $this->expires);

        return $this;
    }

}
