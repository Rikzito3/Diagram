<?php
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->exchange_declare('events', 'fanout', false, false, false);

$message = new AMQPMessage('New Event: Something happened!');
$channel->basic_publish($message, 'events');

echo " [x] Sent 'New Event: Something happened!'\n";

$channel->close();
$connection->close();
