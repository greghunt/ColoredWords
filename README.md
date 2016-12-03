# ColoredWords
PHP utility to convert colors to their closest CSS color name.

## Usage

```php
$word = "Blue-pastel";
$color = new ColoredWords( $word );

echo $color->convert()->name();
```

**Results** in `lightblue`

## [Demo](https://freshbrewedweb.com/demos/ColoredWords/tests/index.php?word=Blue-pastel)
[View the demo](https://freshbrewedweb.com/demos/ColoredWords/tests/index.php?word=Blue-pastel)

## API
- `get` gets the resulting matches.
- `exactMatch` matches exact names.
- `match` loosely matches names.
- `sortByRelevance` adds a score to matches and sorts the array.
- `convert` sets the best match by relevance.
- `name` gets the converted name;
- `hex` gets the hex code of the converted name.
