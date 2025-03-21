<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

class UseRedisMiddleware implements FilterInterface
{
    /**
     * Redis instance.
     *
     * @var \Redis
     */
    protected $redis;

    public function __construct()
    {
        // Inisialisasi Redis
        $redis_url = getenv('app.redisUrl');
        $redis_port = getenv('app.redisPort');
        $this->redis = new \Redis();
        $this->redis->connect($redis_url, $redis_port); // Sesuaikan dengan host dan port Redis Anda
    }

    /**
     * Method yang dijalankan sebelum request diproses oleh controller.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Contoh: Simpan atau periksa data di Redis
        $uri = $request->getUri()->getPath(); // Mendapatkan URI dari request
        $method = $request->getMethod();      // Mendapatkan metode HTTP (GET, POST, dll.)

        // Simpan informasi request ke Redis
        $this->redis->set("request:{$uri}", json_encode([
            'uri' => $uri,
            'method' => $method,
            'timestamp' => time(),
        ]));
    }

    /**
     * Method yang dijalankan setelah request diproses oleh controller.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Contoh: Tambahkan header kustom ke response
        $response->setHeader('X-Redis-Status', 'Active');
    }
}