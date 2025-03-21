<?php

// namespace App\Commands;

// use CodeIgniter\CLI\BaseCommand;
// use CodeIgniter\CLI\CLI;
// use CodeIgniter\Log\Logger;
// use CodeIgniter\CLI\CommandRunner;
// use PhpAmqpLib\Connection\AMQPStreamConnection;
// use PhpAmqpLib\Message\AMQPMessage;
// use Config\RabbitMQ;

// class GPSDataWorker extends BaseCommand
// {
//     /**
//      * The Command's Group
//      *
//      * @var string
//      */
//     protected $group = 'worker';

//     /**
//      * The Command's Name
//      *
//      * @var string
//      */
//     protected $name = 'gps:worker';

//     /**
//      * The Command's Description
//      *
//      * @var string
//      */
//     protected $description = 'Process GPS data from RabbitMQ';

//     /**
//      * The Command's Usage
//      *
//      * @var string
//      */
//     protected $usage = 'gps:worker [arguments] [options]';

//     /**
//      * The Command's Arguments
//      *
//      * @var array
//      */
//     protected $arguments = [];

//     /**
//      * The Command's Options
//      *
//      * @var array
//      */
//     protected $options = [];

//     /**
//      * Actually execute a command.
//      *
//      * @param array $params
//      */
 
//     public function run(array $params)
//     {
//         $this->initializeRabbitMQ();
//     }

//     private function initializeRabbitMQ()
//     {
//         CLI::write('Worker GPS dimulai...', 'green');

//         log_message('info', 'GPS Worker dimulai...');

//         $rabbitMQConfig = config(RabbitMQ::class);

//         $connection = new AMQPStreamConnection(
//             $rabbitMQConfig->default['host'],
//             $rabbitMQConfig->default['port'],
//             $rabbitMQConfig->default['user'],
//             $rabbitMQConfig->default['password'],
//             $rabbitMQConfig->default['vhost']
//         );

//         $channel = $connection->channel();

//         $channel->queue_declare('gps_data_queue', false, true, false, false);

//         $callback = function ($msg) use ($connection) {
//             $data = json_decode($msg->body, true);

//             // Inisialisasi CodeIgniter 4 untuk akses ke database
//             helper('app'); // Pastikan helper yang diperlukan di-load
//             $db = \Config\Database::connect();

//             try {
//                 $db->transStart();
//                 $db->table('data_hooks')->insert([
//                     'data' => $data['gps_data'],
//                     'created_at' => $data['created_at']
//                 ]);
//                 $db->transComplete();
//                 log_message('info', 'GPS Data diterima: ' . json_encode($data));

//                 if ($db->transStatus() === false) {
//                     log_message('error', 'Error di GPS Worker: ' . $e->getMessage());
//                     throw new \Exception('Database transaction failed');
//                 }

//                 $msg->ack();
//             } catch (\Exception $e) {
//                 log_message('error', 'Error di GPS Worker: ' . $e->getMessage());
//                 CLI::error("Error: " . $e->getMessage());
//                 $msg->nack(false, true);
//             }
//         };

//         $channel->basic_consume('gps_data_queue', '', false, false, false, false, $callback);

//         while ($channel->is_consuming()) {
//             $channel->wait();
//         }

//         $channel->close();
//         $connection->close();
//     }
// }
