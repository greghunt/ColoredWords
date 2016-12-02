<?php

namespace Freshbrewedweb;

function dd( $var ){
  dump($var);
  die();
}
function dump( $var ) {
  echo '<pre style="border: 2px solid black; background: rgba(0,0,0,0.8); padding: 1em; color:#70f038">';
  var_dump($var);
  echo '</pre>';
}
class ColoredWords {

  protected $word = [];
  protected $converted;
  protected $matches;
  protected $cssColorNames;

  protected $synonyms = [
      ['light', 'pale', 'pastel'],
      ['dark', 'deep'],
  ];

  public function __construct( $word )
  {
      $this->setUpWord($word);
      $this->setUpColors();
  }

  /**
   * Private Methods
   */

  private function setUpWord( $word )
  {
    $this->word['name'] = $this->sanitize($word);
    $words = preg_split( '/(\s|&|-)/', $word );
    $this->word['words'] = array_map('strtolower', $words);
    $this->applySynonyms();
  }

  private function setUpColors()
  {
    $colors = json_decode(file_get_contents("cssColorNames.json"));

    $this->cssColorNames = array_map(function( $color ) {
      if( empty($color->words) ) {
        $color->words[] = $color->name;
      }

      $color->wordOccurences = 0;
      $color->synonymOccurences = 0;

      //Occurences
      foreach( $color->words as $word ) {
        //Check for occurence in main name
        if(strrpos($this->word['name'], $word) !== false) {
          $color->wordOccurences++;
        }
        // Check for occurence in word parts
        // Apply presence of synonmys before checking
        $allWords = array_unique(array_merge($this->word['words'], $this->word['synonyms']));
        if( in_array($word, $allWords) ) {
          $color->wordOccurences++;
        }
        //Check for occurences in synonyms
        if( in_array($word, $this->word['synonyms']) ) {
          $color->synonymOccurences++;
        }
      }

      //Text Similarity
      similar_text($color->name, $this->word['name'], $percent);
      $color->similarity = round($percent) / 100;

      //Calculate scores
      $color->score = ($color->wordOccurences * 2) + $color->synonymOccurences + $color->similarity;

      return $color;

    }, $colors);

    $this->cssColorNames = $colors;
  }

  private function sanitize($str)
  {
    return str_replace(' ', '', strtolower($str));
  }

  private function applySynonyms()
  {
    $this->word['synonyms'] = [];
    foreach( $this->synonyms as $index => $synGroup ) {
      foreach( $synGroup as $syn ) {
        if( strpos($this->word['name'], $syn) !== false ) {
          $this->word['synonyms'] = array_merge($this->word['synonyms'], $synGroup);
        }
      }
    }
  }

  private function camelCase( $arr )
  {
    $str = array_shift($arr);
    foreach( $arr as $key => $val ) {
      $str .= ucwords($val);
    }

    return $str;
  }

  public function exactMatch()
  {

    $this->matches = array_filter($this->cssColorNames, function( $color ){
      return $color->name == $this->word['name'];
    });

    return $this;
  }

  private function matchWords( $color )
  {
    foreach( $color->words as $word ) {
      if(strrpos($this->word['name'], $word) !== false) {
        return true;
      }
    }

    return null;
  }

  private function matchSynonyms( $color )
  {
    foreach( $this->word['synonyms'] as $syn ) {
      if(strrpos($color->name, $syn) !== false) {
        return true;
      }
    }
    return null;
  }

  private function matchName( $color )
  {
    if(strrpos($color->name, $this->word['name']) !== false) {
      //Search by name
      return true;
    }

    return null;
  }

  /**
   * Public API
   */

  public function match()
  {
    $this->matches = array_filter($this->cssColorNames, function( $color ){
        if(
          // $this->matchWords($color) ||
          $this->matchSynonyms($color)
          // $this->matchName($color)
        ) {
          return true;
        }
    });

    return $this;
  }


  public function getWord()
  {
    return $this->word;
  }

  public function sortByRelevance()
  {
    //Sort by scores
    usort($this->matches, function ($prev, $next) {
        return $next->score <=> $prev->score;
    });

    return $this;
  }

  public function get()
  {
      return $this->matches;
  }

  public function convert()
  {
    $this->match()->sortByRelevance();

    if(empty($this->matches)) {
      throw new \Exception('Could not find match.');
    }

    $this->converted = $this->matches[0];
    return $this;
  }

  public function name( $camel = False )
  {
    if( $camel && !empty($this->converted->words) )
      return $this->camelCase($this->converted->words);

    return $this->converted->name;
  }

  public function hex()
  {
    return "#" . $this->converted->hex;
  }

}
