<?php
require 'php-cassandra/php-cassandra.php';
$nodes = [
     '127.0.0.4'        // simple way, hostname only
/*    '192.168.0.2:9042', // simple way, hostname with port
    [               // advanced way, array including username, password and socket options
        'host'      => '10.205.48.70',
        'port'      => 9042, //default 9042
        'username'  => 'admin',
        'password'  => 'pass',
        'socket'    => [SO_RCVTIMEO => ["sec" => 10, "usec" => 0], //socket transport only
        ],
    ],
    [               // advanced way, using Connection\Stream, persistent connection
        'host'      => '10.205.48.70',
        'port'      => 9042,
        'username'  => 'admin',
        'password'  => 'pass',
        'class'     => 'Cassandra\Connection\Stream',//use stream instead of socket, default socket. Stream may not work in some environment
        'connectTimeout' => 10, // connection timeout, default 5,  stream transport only
        'timeout'   => 30, // write/recv timeout, default 30, stream transport only
        'persistent'    => true, // use persistent PHP connection, default false,  stream transport only
    ],
    [               // advanced way, using SSL
        'class'     => 'Cassandra\Connection\Stream', // "class" must be defined as "Cassandra\Connection\Stream" for ssl or tls
        'host'      => 'ssl://10.205.48.70',// or 'tls://10.205.48.70'
        'port'      => 9042,
        'username'  => 'admin',
        'password'  => 'pass',
    ],*/
];

// Create a connection.
$connection = new Cassandra\Connection($nodes, 'test');

//Connect
try
{
    $connection->connect();
}
catch (Cassandra\Exception $e)
{
    echo 'Caught exception: ',  $e->getMessage(), "\n";
    exit;//if connect failed it may be good idea not to continue
}
$begin = time();
echo $begin;
try
{
  for ($i=0; $i < 10000000;$i++) {
    $statement = $connection->querySync(
    "INSERT INTO users (twitter_id,  followers) VALUES ('john-$i', {'john-$i': 'smith-$i'})");
  }

}
catch (Cassandra\Exception $e)
{
  echo 'Caught exception: ',  $e->getMessage(), "\n";
  exit;//if connect failed it may be good idea not to continue
}
//$statement = $connection->querySync('drop table  IF EXISTS  mykeyspace.users');
$statement = $connection->queryAsync('select count(*) from users');
$response = $statement->getResponse();
$rows = $response->fetchAll();
print_r($rows);
echo time() - $begin;
