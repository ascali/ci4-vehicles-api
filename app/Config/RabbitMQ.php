<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class RabbitMQ extends BaseConfig
{
    public array $default;

    /**
     * Constructor to load environment variables
     */
    public function __construct()
    {
        parent::__construct();

        // Load values from .env
        $this->default = [
            'host' => env('HOST_MQ', '127.0.0.1'),    // Host RabbitMQ (default: 127.0.0.1)
            'port' => env('PORT_MQ', 5672),           // Port RabbitMQ (default: 5672)
            'user' => env('USER_MQ', 'user'),         // Username (default: user)
            'password' => env('PASS_MQ', 'password'), // Password (default: password)
            'vhost' => env('VHOST_MQ', '/'),          // Virtual Host (default: /)
            'persistent' => true,                     // Pesan tahan (durable)
        ];
    }
}