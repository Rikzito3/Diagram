<?php
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->exchange_declare('realtime_data', 'fanout', false, false, false);

$message = new AMQPMessage('New Data: 123, 456, 789');
$channel->basic_publish($message, 'realtime_data');

echo " [x] Sent 'New Data: 123, 456, 789'\n";

$channel->close();
$connection->close();
