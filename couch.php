<?PHP
require_once 'php-couchdb/lib/couch.php';
require_once 'php-couchdb/lib/couchClient.php';
require_once 'php-couchdb/lib/couchDocument.php';

// set a new connector to the CouchDB server
$client = new couchClient ('http://localhost:5984','rest');

// document fetching by ID
$doc = $client->getDoc('some_doc_id');
// updating document
$doc->newproperty = array("hello !","world");
try {
   $client->storeDoc($doc);
} catch (Exception $e) {
   echo "Document storage failed : ".$e->getMessage()."<BR>\n";
}

/*// view fetching, using the view option limit
try {
   $view = $client->limit(100)->getView('orders','by-date');
} catch (Exception $e) {
   echo "something weird happened: ".$e->getMessage()."<BR>\n";
}*/

//using couch_document class :

$new_doc = new stdClass();
$new_doc->title = "Some content";
for ($i=0; $i<1000000; $i++){
$new_doc->name = "test-$i";
$client->storeDoc($new_doc);
}
//echo $doc->name ; // should echo "Smith"
$doc->name = "Brown"; // set document property "name" to "Brown" and store the updated document in the database
