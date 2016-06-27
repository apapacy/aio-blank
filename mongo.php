<?php

// connect
$m = new MongoDB\Client('mongodb://localhost');

// select a database
$db = $m->comedy;

// select a collection (analogous to a relational database's table)
$collection = $db->cartoons;

// add a record
$document = array( "title" => "Calvin and Hobbes", "author" => "Bill Watterson" );
$collection->insert($document);

for ($i = 0; $i < 10000000; $i++)
$collection->insert(['name'=> "Joe-$i"]);

// add another record, with a different "shape"
$document = array( "title" => "XKCD", "online" => true );
$collection->insert($document);

// find everything in the collection
$cursor = $collection->find();

// iterate through the results
foreach ($cursor as $document) {
    echo $document["name"] . "\n";
}