<?php 
// namespace App\Modules\Api\Controllers;

// use App\Core\BaseController;
// use CodeIgniter\HTTP\ResponseInterface;
// use PhpAmqpLib\Connection\AMQPStreamConnection;
// use PhpAmqpLib\Message\AMQPMessage;
// use Config\RabbitMQ;

// class Webhook extends BaseController
// {
//     protected $db;
//     protected $redis;
//     protected $rabbitMQConfig;

//     public function __construct()
//     {
//         $this->db = \Config\Database::connect();
//         $this->rabbitMQConfig = config(RabbitMQ::class);
//     }

//     public function index(): ResponseInterface
//     {
//         return $this->response->setJSON([
//             'status_code' => 200,
//             'error' => false,
//             'message' => "Welcome to webhook api",
//             'data' => []
//         ]);
//     }

//     public function webhook_data()
//     {
//         $postData = $this->request->getJSON(true);
//         $data = [
//             'gps_data' => json_encode($postData),
//             'created_at' => date('Y-m-d H:i:s')
//         ];

//         $rabbitMQConfig = config(RabbitMQ::class);

//         $connection = new AMQPStreamConnection(
//             $rabbitMQConfig->default['host'],
//             $rabbitMQConfig->default['port'],
//             $rabbitMQConfig->default['user'],
//             $rabbitMQConfig->default['password'],
//             $rabbitMQConfig->default['vhost']
//         );


//         $channel = $connection->channel();

//         // Deklarasikan exchange dan queue
//         $channel->exchange_declare('gps_data_exchange', 'direct', false, true, false);
//         $channel->queue_declare('gps_data_queue', false, true, false, false);
//         $channel->queue_bind('gps_data_queue', 'gps_data_exchange');

//         // Buat pesan
//         $message = new AMQPMessage(
//             json_encode($data),
//             [
//                 'delivery_mode' => 2 // Pesan tahan (durable)
//             ]
//         );

//         // Publish ke exchange
//         $channel->basic_publish($message, 'gps_data_exchange');

//         // Tutup koneksi
//         $channel->close();
//         $connection->close();

//         return $this->response->setJSON([
//             'status_code' => 200,
//             'error' => false,
//             'message' => "Data queued successfully"
//         ]);
//     }

// }