<?php
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->exchange_declare('notifications', 'fanout', false, false, false);

$message = new AMQPMessage('New Notification: Hello World!');
$channel->basic_publish($message, 'notifications');

echo " [x] Sent 'New Notification: Hello World!'\n";

$channel->close();
$connection->close();
