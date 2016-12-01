<?php

namespace Freshbrewedweb;

function dd( $var ){
  print_r($var); die();
}

class ColoredWords {

  protected $word;
  protected $converted;
  protected $matches;

  protected $cssColorNames = [
      "black" => ["name" => "black", "hex" => "000000", "cssLevel" => 1, "words" => []],
     	"silver" => ["name" => "silver", "hex" => "c0c0c0", "cssLevel" => 1, "words" => []],
     	"gray" => ["name" => "gray", "hex" => "808080", "cssLevel" => 1, "words" => []],
     	"white" => ["name" => "white", "hex" => "ffffff", "cssLevel" => 1, "words" => []],
     	"maroon" => ["name" => "maroon", "hex" => "800000", "cssLevel" => 1, "words" => []],
     	"red" => ["name" => "red", "hex" => "ff0000", "cssLevel" => 1, "words" => []],
     	"purple" => ["name" => "purple", "hex" => "800080", "cssLevel" => 1, "words" => []],
     	"fuchsia" => ["name" => "fuchsia", "hex" => "ff00ff", "cssLevel" => 1, "words" => []],
     	"green" => ["name" => "green", "hex" => "008000", "cssLevel" => 1, "words" => []],
     	"lime" => ["name" => "lime", "hex" => "00ff00", "cssLevel" => 1, "words" => []],
     	"olive" => ["name" => "olive", "hex" => "808000", "cssLevel" => 1, "words" => []],
     	"yellow" => ["name" => "yellow", "hex" => "ffff00", "cssLevel" => 1, "words" => []],
     	"navy" => ["name" => "navy", "hex" => "000080", "cssLevel" => 1, "words" => []],
     	"blue" => ["name" => "blue", "hex" => "0000ff", "cssLevel" => 1, "words" => []],
     	"teal" => ["name" => "teal", "hex" => "008080", "cssLevel" => 1, "words" => []],
     	"aqua" => ["name" => "aqua", "hex" => "00ffff", "cssLevel" => 1, "words" => []],
      "orange" => ["name" => "orange", "hex" => "ffa500", "cssLevel" => 2, "words" => []],
      "aliceblue" => ["name" => "aliceblue", "hex" => "f0f8ff", "cssLevel" => 3, "words" => ["alice", "blue"]],
     	"antiquewhite" => ["name" => "antiquewhite", "hex" => "faebd7", "cssLevel" => 3, "words" => ["antique", "white"]],
     	"aquamarine" => ["name" => "aquamarine", "hex" => "7fffd4", "cssLevel" => 3, "words" => ["aqua", "marine"]],
     	"azure" => ["name" => "azure", "hex" => "f0ffff", "cssLevel" => 3, "words" => []],
     	"beige" => ["name" => "beige", "hex" => "f5f5dc", "cssLevel" => 3, "words" => []],
     	"bisque" => ["name" => "bisque", "hex" => "ffe4c4", "cssLevel" => 3, "words" => []],
     	"blanchedalmond" => ["name" => "blanchedalmond", "hex" => "ffebcd", "cssLevel" => 3, "words" => ["blanched", "almond"]],
     	"blueviolet" => ["name" => "blueviolet", "hex" => "8a2be2", "cssLevel" => 3, "words" => ["blue", "violet"]],
     	"brown" => ["name" => "brown", "hex" => "a52a2a", "cssLevel" => 3, "words" => []],
     	"burlywood" => ["name" => "burlywood", "hex" => "deb887", "cssLevel" => 3, "words" => ["burly", "wood"]],
     	"cadetblue" => ["name" => "cadetblue", "hex" => "5f9ea0", "cssLevel" => 3, "words" => ["cadet", "blue"]],
     	"chartreuse" => ["name" => "chartreuse", "hex" => "7fff00", "cssLevel" => 3, "words" => []],
     	"chocolate" => ["name" => "chocolate", "hex" => "d2691e", "cssLevel" => 3, "words" => []],
     	"coral" => ["name" => "coral", "hex" => "ff7f50", "cssLevel" => 3, "words" => []],
     	"cornflowerblue" => ["name" => "cornflowerblue", "hex" => "6495ed", "cssLevel" => 3, "words" => ["cornflower", "blue"]],
     	"cornsilk" => ["name" => "cornsilk", "hex" => "fff8dc", "cssLevel" => 3, "words" => []],
     	"crimson" => ["name" => "crimson", "hex" => "dc143c", "cssLevel" => 3, "words" => []],
     	"darkblue" => ["name" => "darkblue", "hex" => "00008b", "cssLevel" => 3, "words" => ["dark", "blue"]],
     	"darkcyan" => ["name" => "darkcyan", "hex" => "008b8b", "cssLevel" => 3, "words" => ["dark", "cyan"]],
     	"darkgoldenrod" => ["name" => "darkgoldenrod", "hex" => "b8860b", "cssLevel" => 3, "words" => ["dark", "golden", "rod"]],
     	"darkgray" => ["name" => "darkgray", "hex" => "a9a9a9", "cssLevel" => 3, "words" => ["dark", "gray"]],
     	"darkgreen" => ["name" => "darkgreen", "hex" => "006400", "cssLevel" => 3, "words" => ["dark", "green"]],
     	"darkgrey" => ["name" => "darkgrey", "hex" => "a9a9a9", "cssLevel" => 3, "words" => ["dark", "grey"]],
     	"darkkhaki" => ["name" => "darkkhaki", "hex" => "bdb76b", "cssLevel" => 3, "words" => ["dark", "khaki"]],
     	"darkmagenta" => ["name" => "darkmagenta", "hex" => "8b008b", "cssLevel" => 3, "words" => ["dark", "magenta"]],
     	"darkolivegreen" => ["name" => "darkolivegreen", "hex" => "556b2f", "cssLevel" => 3, "words" => ["dark", "olive", "green"]],
     	"darkorange" => ["name" => "darkorange", "hex" => "ff8c00", "cssLevel" => 3, "words" => ["dark", "orange"]],
     	"darkorchid" => ["name" => "darkorchid", "hex" => "9932cc", "cssLevel" => 3, "words" => ["dark", "orchid"]],
     	"darkred" => ["name" => "darkred", "hex" => "8b0000", "cssLevel" => 3, "words" => ["dark", "red"]],
     	"darksalmon" => ["name" => "darksalmon", "hex" => "e9967a", "cssLevel" => 3, "words" => ["dark", "salmon"]],
     	"darkseagreen" => ["name" => "darkseagreen", "hex" => "8fbc8f", "cssLevel" => 3, "words" => ["dark", "sea", "green"]],
     	"darkslateblue" => ["name" => "darkslateblue", "hex" => "483d8b", "cssLevel" => 3, "words" => ["dark", "slate", "blue"]],
     	"darkslategray" => ["name" => "darkslategray", "hex" => "2f4f4f", "cssLevel" => 3, "words" => ["dark", "slate", "gray"]],
     	"darkslategrey" => ["name" => "darkslategrey", "hex" => "2f4f4f", "cssLevel" => 3, "words" => ["dark", "slate", "grey"]],
     	"darkturquoise" => ["name" => "darkturquoise", "hex" => "00ced1", "cssLevel" => 3, "words" => ["dark", "turquoise"]],
     	"darkviolet" => ["name" => "darkviolet", "hex" => "9400d3", "cssLevel" => 3, "words" => ["dark", "violet"]],
     	"deeppink" => ["name" => "deeppink", "hex" => "ff1493", "cssLevel" => 3, "words" => ["deep", "pink"]],
     	"deepskyblue" => ["name" => "deepskyblue", "hex" => "00bfff", "cssLevel" => 3, "words" => ["deep", "sky", "blue"]],
     	"dimgray" => ["name" => "dimgray", "hex" => "696969", "cssLevel" => 3, "words" => ["dim", "gray"]],
     	"dimgrey" => ["name" => "dimgrey", "hex" => "696969", "cssLevel" => 3, "words" => ["dim", "grey"]],
     	"dodgerblue" => ["name" => "dodgerblue", "hex" => "1e90ff", "cssLevel" => 3, "words" => ["dodger", "blue"]],
     	"firebrick" => ["name" => "firebrick", "hex" => "b22222", "cssLevel" => 3, "words" => ["fire", "brick"]],
     	"floralwhite" => ["name" => "floralwhite", "hex" => "fffaf0", "cssLevel" => 3, "words" => ["floral", "white"]],
     	"forestgreen" => ["name" => "forestgreen", "hex" => "228b22", "cssLevel" => 3, "words" => ["forest", "green"]],
     	"gainsboro" => ["name" => "gainsboro", "hex" => "dcdcdc", "cssLevel" => 3, "words" => []],
     	"ghostwhite" => ["name" => "ghostwhite", "hex" => "f8f8ff", "cssLevel" => 3, "words" => ["ghost", "white"]],
     	"gold" => ["name" => "gold", "hex" => "ffd700", "cssLevel" => 3, "words" => []],
     	"goldenrod" => ["name" => "goldenrod", "hex" => "daa520", "cssLevel" => 3, "words" => ["golden", "rod"]],
     	"greenyellow" => ["name" => "greenyellow", "hex" => "adff2f", "cssLevel" => 3, "words" => ["green", "yellow"]],
     	"grey" => ["name" => "grey", "hex" => "808080", "cssLevel" => 3, "words" => []],
     	"honeydew" => ["name" => "honeydew", "hex" => "f0fff0", "cssLevel" => 3, "words" => ["honey", "dew"]],
     	"hotpink" => ["name" => "hotpink", "hex" => "ff69b4", "cssLevel" => 3, "words" => ["hot", "pink"]],
     	"indianred" => ["name" => "indianred", "hex" => "cd5c5c", "cssLevel" => 3, "words" => ["indian", "red"]],
     	"indigo" => ["name" => "indigo", "hex" => "4b0082", "cssLevel" => 3, "words" => []],
     	"ivory" => ["name" => "ivory", "hex" => "fffff0", "cssLevel" => 3, "words" => []],
     	"khaki" => ["name" => "khaki", "hex" => "f0e68c", "cssLevel" => 3, "words" => []],
     	"lavender" => ["name" => "lavender", "hex" => "e6e6fa", "cssLevel" => 3, "words" => []],
     	"lavenderblush" => ["name" => "lavenderblush", "hex" => "fff0f5", "cssLevel" => 3, "words" => ["lavender", "blush"]],
     	"lawngreen" => ["name" => "lawngreen", "hex" => "7cfc00", "cssLevel" => 3, "words" => ["lawn", "green"]],
     	"lemonchiffon" => ["name" => "lemonchiffon", "hex" => "fffacd", "cssLevel" => 3, "words" => ["lemon", "chiffon"]],
     	"lightblue" => ["name" => "lightblue", "hex" => "add8e6", "cssLevel" => 3, "words" => ["light", "blue"]],
     	"lightcoral" => ["name" => "lightcoral", "hex" => "f08080", "cssLevel" => 3, "words" => ["light", "coral"]],
     	"lightcyan" => ["name" => "lightcyan", "hex" => "e0ffff", "cssLevel" => 3, "words" => ["light", "cyan"]],
     	"lightgoldenrodyellow" => ["name" => "lightgoldenrodyellow", "hex" => "fafad2", "cssLevel" => 3, "words" => ["light", "golden", "rod", "yellow"]],
     	"lightgray" => ["name" => "lightgray", "hex" => "d3d3d3", "cssLevel" => 3, "words" => ["light", "gray"]],
     	"lightgreen" => ["name" => "lightgreen", "hex" => "90ee90", "cssLevel" => 3, "words" => ["light", "green"]],
     	"lightgrey" => ["name" => "lightgrey", "hex" => "d3d3d3", "cssLevel" => 3, "words" => ["light", "grey"]],
     	"lightpink" => ["name" => "lightpink", "hex" => "ffb6c1", "cssLevel" => 3, "words" => ["light", "pink"]],
     	"lightsalmon" => ["name" => "lightsalmon", "hex" => "ffa07a", "cssLevel" => 3, "words" => ["light", "salmon"]],
     	"lightseagreen" => ["name" => "lightseagreen", "hex" => "20b2aa", "cssLevel" => 3, "words" => ["light", "sea", "green"]],
     	"lightskyblue" => ["name" => "lightskyblue", "hex" => "87cefa", "cssLevel" => 3, "words" => ["light", "sky", "blue"]],
     	"lightslategray" => ["name" => "lightslategray", "hex" => "778899", "cssLevel" => 3, "words" => ["light", "slate", "gray"]],
     	"lightslategrey" => ["name" => "lightslategrey", "hex" => "778899", "cssLevel" => 3, "words" => ["light", "slate", "grey"]],
     	"lightsteelblue" => ["name" => "lightsteelblue", "hex" => "b0c4de", "cssLevel" => 3, "words" => ["light", "steel", "blue"]],
     	"lightyellow" => ["name" => "lightyellow", "hex" => "ffffe0", "cssLevel" => 3, "words" => ["light", "yellow"]],
     	"limegreen" => ["name" => "limegreen", "hex" => "32cd32", "cssLevel" => 3, "words" => ["lime", "green"]],
     	"linen" => ["name" => "linen", "hex" => "faf0e6", "cssLevel" => 3, "words" => ["linen"]],
     	"mediumaquamarine" => ["name" => "mediumaquamarine", "hex" => "66cdaa", "cssLevel" => 3, "words" => ["medium", "aqua", "marine"]],
     	"mediumblue" => ["name" => "mediumblue", "hex" => "0000cd", "cssLevel" => 3, "words" => ["medium", "blue"]],
     	"mediumorchid" => ["name" => "mediumorchid", "hex" => "ba55d3", "cssLevel" => 3, "words" => ["medium", "orchid"]],
     	"mediumpurple" => ["name" => "mediumpurple", "hex" => "9370db", "cssLevel" => 3, "words" => ["medium", "purple"]],
     	"mediumseagreen" => ["name" => "mediumseagreen", "hex" => "3cb371", "cssLevel" => 3, "words" => ["medium", "sea", "green"]],
     	"mediumslateblue" => ["name" => "mediumslateblue", "hex" => "7b68ee", "cssLevel" => 3, "words" => ["medium", "slate", "blue"]],
     	"mediumspringgreen" => ["name" => "mediumspringgreen", "hex" => "00fa9a", "cssLevel" => 3, "words" => ["medium", "spring", "green"]],
     	"mediumturquoise" => ["name" => "mediumturquoise", "hex" => "48d1cc", "cssLevel" => 3, "words" => ["medium", "turquoise"]],
     	"mediumvioletred" => ["name" => "mediumvioletred", "hex" => "c71585", "cssLevel" => 3, "words" => ["medium", "violetred"]],
     	"midnightblue" => ["name" => "midnightblue", "hex" => "191970", "cssLevel" => 3, "words" => ["midnight", "blue"]],
     	"mintcream" => ["name" => "mintcream", "hex" => "f5fffa", "cssLevel" => 3, "words" => ["mint", "cream"]],
     	"mistyrose" => ["name" => "mistyrose", "hex" => "ffe4e1", "cssLevel" => 3, "words" => ["misty", "rose"]],
     	"moccasin" => ["name" => "moccasin", "hex" => "ffe4b5", "cssLevel" => 3, "words" => []],
     	"navajowhite" => ["name" => "navajowhite", "hex" => "ffdead", "cssLevel" => 3, "words" => ["navajo", "white"]],
     	"oldlace" => ["name" => "oldlace", "hex" => "fdf5e6", "cssLevel" => 3, "words" => ["old", "lace"]],
     	"olivedrab" => ["name" => "olivedrab", "hex" => "6b8e23", "cssLevel" => 3, "words" => ["olive", "drab"]],
     	"orangered" => ["name" => "orangered", "hex" => "ff4500", "cssLevel" => 3, "words" => ["orange", "red"]],
     	"orchid" => ["name" => "orchid", "hex" => "da70d6", "cssLevel" => 3, "words" => ["orchid"]],
     	"palegoldenrod" => ["name" => "palegoldenrod", "hex" => "eee8aa", "cssLevel" => 3, "words" => ["pale", "golden", "rod"]],
     	"palegreen" => ["name" => "palegreen", "hex" => "98fb98", "cssLevel" => 3, "words" => ["pale", "green"]],
     	"paleturquoise" => ["name" => "paleturquoise", "hex" => "afeeee", "cssLevel" => 3, "words" => ["pale", "turquoise"]],
     	"palevioletred" => ["name" => "palevioletred", "hex" => "db7093", "cssLevel" => 3, "words" => ["pale", "violet", "red"]],
     	"papayawhip" => ["name" => "papayawhip", "hex" => "ffefd5", "cssLevel" => 3, "words" => ["papaya", "whip"]],
     	"peachpuff" => ["name" => "peachpuff", "hex" => "ffdab9", "cssLevel" => 3, "words" => ["peach", "puff"]],
     	"peru" => ["name" => "peru", "hex" => "cd853f", "cssLevel" => 3, "words" => []],
     	"pink" => ["name" => "pink", "hex" => "ffc0cb", "cssLevel" => 3, "words" => []],
     	"plum" => ["name" => "plum", "hex" => "dda0dd", "cssLevel" => 3, "words" => []],
     	"powderblue" => ["name" => "powderblue", "hex" => "b0e0e6", "cssLevel" => 3, "words" => ["powder", "blue"]],
     	"rosybrown" => ["name" => "rosybrown", "hex" => "bc8f8f", "cssLevel" => 3, "words" => ["rosy", "brown"]],
     	"royalblue" => ["name" => "royalblue", "hex" => "4169e1", "cssLevel" => 3, "words" => ["royal", "blue"]],
     	"saddlebrown" => ["name" => "saddlebrown", "hex" => "8b4513", "cssLevel" => 3, "words" => ["saddle", "brown"]],
     	"salmon" => ["name" => "salmon", "hex" => "fa8072", "cssLevel" => 3, "words" => []],
     	"sandybrown" => ["name" => "sandybrown", "hex" => "f4a460", "cssLevel" => 3, "words" => ["sandy", "brown"]],
     	"seagreen" => ["name" => "seagreen", "hex" => "2e8b57", "cssLevel" => 3, "words" => ["sea", "green"]],
     	"seashell" => ["name" => "seashell", "hex" => "fff5ee", "cssLevel" => 3, "words" => ["sea", "shell"]],
     	"sienna" => ["name" => "sienna", "hex" => "a0522d", "cssLevel" => 3, "words" => []],
     	"skyblue" => ["name" => "skyblue", "hex" => "87ceeb", "cssLevel" => 3, "words" => ["sky", "blue"]],
     	"slateblue" => ["name" => "slateblue", "hex" => "6a5acd", "cssLevel" => 3, "words" => ["slate", "blue"]],
     	"slategray" => ["name" => "slategray", "hex" => "708090", "cssLevel" => 3, "words" => ["slate", "gray"]],
     	"slategrey" => ["name" => "slategrey", "hex" => "708090", "cssLevel" => 3, "words" => ["slate", "grey"]],
     	"snow" => ["name" => "snow", "hex" => "fffafa", "cssLevel" => 3, "words" => []],
     	"springgreen" => ["name" => "springgreen", "hex" => "00ff7f", "cssLevel" => 3, "words" => ["spring", "green"]],
     	"steelblue" => ["name" => "steelblue", "hex" => "4682b4", "cssLevel" => 3, "words" => ["steel", "blue"]],
     	"tan" => ["name" => "tan", "hex" => "d2b48c", "cssLevel" => 3, "words" => []],
     	"thistle" => ["name" => "thistle", "hex" => "d8bfd8", "cssLevel" => 3, "words" => []],
     	"tomato" => ["name" => "tomato", "hex" => "ff6347", "cssLevel" => 3, "words" => []],
     	"turquoise" => ["name" => "turquoise", "hex" => "40e0d0", "cssLevel" => 3, "words" => []],
     	"violet" => ["name" => "violet", "hex" => "ee82ee", "cssLevel" => 3, "words" => []],
     	"wheat" => ["name" => "wheat", "hex" => "f5deb3", "cssLevel" => 3, "words" => []],
     	"whitesmoke" => ["name" => "whitesmoke", "hex" => "f5f5f5", "cssLevel" => 3, "words" => ["white", "smoke"]],
     	"yellowgreen" => ["name" => "yellowgreen", "hex" => "9acd32", "cssLevel" => 3, "words" => ["yellow", "green"]],
      "rebeccapurple" => ["name" => "rebeccapurple", "hex" => "663399", "cssLevel" => 4, "words" => ["rebecca", "purple"]],
  ];

  public function __construct( $word )
  {
      $this->word = $this->sanitize($word);
  }

  private function sanitize($str)
  {
    return str_replace(' ', '', strtolower($str));
  }

  public function exactMatch()
  {

    $this->matches = array_filter($this->cssColorNames, function( $color ){
      return $color["name"] == $this->word;
    });

    return $this;
  }

  public function match()
  {
    $this->matches = array_filter($this->cssColorNames, function( $color ){
        if(strrpos($this->word, $color["name"]) !== false) {
          //Search by name
          return true;
        } else {
          //Search by words
          foreach( $color["words"] as $word ) {
            if(strrpos($this->word, $word) !== false) {
              return true;
            }
          }
        }
    });

    return $this;
  }

  public function sortByRelevance()
  {
    //Calculate scores
    foreach( $this->matches as $key => $color ) {
      similar_text($color['name'], $this->word, $percent);
      $this->matches[$color['name']]['score'] = round($percent);
    }
    //Sort by scores
    usort($this->matches, function ($item1, $item2) {
        return $item2['score'] <=> $item1['score'];
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
    $this->converted = $this->matches[0];
    return $this;
  }

  public function name( $camel = False )
  {
    if( $camel && !empty($this->converted['words']) )
      return $this->camelCase($this->converted['words']);

    return $this->converted['name'];
  }

  private function camelCase( $arr )
  {
      $str = array_shift($arr);
      foreach( $arr as $key => $val ) {
        $str .= ucwords($val);
      }

      return $str;
  }

  public function hex()
  {
    return "#" . $this->converted['hex'];
  }

}
