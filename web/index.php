<?php

require '../vendor/autoload.php';

use App\Clips;
use App\Clips\Filter;
use App\Config\Settings;


$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

try {
  // Get clips object
  // TODO: Find better way to allow settings to be available to clips
  $data = new Clips(Settings::$CSV_FILE, Settings::$CLIP_RULES);
  $data->getData();
} catch (Exception $e) {
    // Create a detailed record of the failure in the log
    $app['monolog']->addDebug("Error: " . $e->getMessage());
    $results = array(
                'response'=> array(
                    'status'=> 500,
                    'message'=> 'There was a problem with your request.'
                )
            ); //TODO: Add better response
}

$results = $data->getResults();

//TODO: DRY refactor
$app->get('/valid', function(Silex\Application $app) use ($results) {
  // This is a bit brute but wanted to get this out tonight
  // Can refactor later.
  $fileName = 'valid.csv';

  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header('Content-Description: File Transfer');
  header("Content-type: text/csv");
  header("Content-Disposition: attachment; filename={$fileName}");
  header("Expires: 0");
  header("Pragma: public");

  return json_encode($results['valid']);
});

//TODO: DRY refactor
$app->get('/invalid', function(Silex\Application $app) use ($results) {
  // This is a bit brute but wanted to get this out tonight
  // Can refactor later.
  $fileName = 'invalid.csv';

  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header('Content-Description: File Transfer');
  header("Content-type: text/csv");
  header("Content-Disposition: attachment; filename={$fileName}");
  header("Expires: 0");
  header("Pragma: public");

  return json_encode($results['invalid']);
});

$app->run();
