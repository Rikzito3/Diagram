<?php
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('order_queue', false, true, false, false);

$message = new AMQPMessage('New Order: Blue Shirt');
$channel->basic_publish($message, '', 'order_queue');

echo " [x] Sent 'New Order: Blue Shirt'\n";

$channel->close();
$connection->close();
