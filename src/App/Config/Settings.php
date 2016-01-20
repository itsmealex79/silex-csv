<?php
namespace App\Config;

class Settings {
  static $CSV_FILE = '../data/clips.csv';
  static $CLIP_RULES = array (
      'privacy' => array('anybody'),
      'popularity' => array (
          'likes' => 10,
          'plays' => 200
      ),
      'title' => array (
          'max_length' => 30
      )
  );
}
