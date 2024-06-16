//this code is for firebase auth & realtimedb
<?php
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

$serviceAccountPath = __DIR__ . '/yourfirebasejsonfile.json';

$factory = (new Factory)
    ->withServiceAccount($serviceAccountPath)
    ->withDatabaseUri('type your firebase db url');

$auth = $factory->createAuth();
$database = $factory->createDatabase();


return ['auth' => $auth, 'database' => $database];
?>