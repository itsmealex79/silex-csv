<?php
namespace App;

use App\Filter;
use App\File\CsvFile;
use App\Config\Settings;

/**
 * This class will be utilized to get the new CSV file as well as implement filterIteration.
 */
class Clips {

  public $iterator;
  public $filters;
  public $results;
  protected $file;
  /**
   *  Creates Csv file object and utilizes the reusable Filter Object
   *  @param string $fileLocation Location of the CSV file.
   *  @param array  Array of rules
   */
  public function __construct ($fileLocation, $filters) {
      // Get file, aggregate and return formated
      $this->file = new CsvFile($fileLocation);

      $this->filters = $filters;
  }

  public function getData() {
      $filters = $this->filters;
      $this->iterator = new Filter($this->file, function ($current, $key, $iterator) use (&$filters) {
              // The clip title must be under 30 characters
              if(strlen($current['title']) >= $filters['title']['max_length']) {
                  $flag = false;
              }

              // The clip must be public (privacy == anybody)
              if($current['privacy'] == $filters['privacy']) {
                  $flag = false;
              }

              // The clip must have over 10 likes
              if($current['total_likes'] <= $filters['popularity']['likes']) {
                  $flag = false;
              }

              // The clip must have over 200 plays
              if($current['total_plays'] <= $filters['popularity']['plays']) {
                  $flag = false;
              }

              // Store values in appropriate array element for use later
              if (is_null($current['id']) || $flag === false){
                  $this->results['invalid'][] = $current['id'];
              } else {
                  $this->results['valid'][] = $current['id'];
              }

              return $flag;
          }
      );

      return iterator_to_array($this->iterator);
  }

  public function getResults() {
      return $this->results;
  }
}
