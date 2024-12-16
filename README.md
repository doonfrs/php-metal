
# Metal - A Native PHP Template Engine

**Metal** is a lightweight, pure PHP template engine inspired by Flutter's declarative UI principles. 
It allows developers to build dynamic HTML structures in PHP with a clean and intuitive syntax.

## Key Features

- **Flutter-Inspired Design**: Create HTML using a declarative, widget-like approach.
- **Pure PHP Implementation**: No additional templating languages, just native PHP.
- **Declarative Syntax**: Simplifies the creation of nested and complex HTML structures.
- **Chained Rendering**: Combine and render multiple HTML elements efficiently.
- **Lightweight and Fast**: Built for performance and simplicity.
- **Plugin Support** : Extend functionality by integrating custom plugins for advanced use cases.


## Installation

Install Metal via Composer:

```bash
composer require trinavo/php-metal
```

## Usage

### Basic Example

Render a simple HTML page:

```php
require 'vendor/autoload.php';

use Metal\Html\htmlPage;
use Metal\Html\div;
use Metal\Html\head;
use Metal\Metal;

$html = Metal::render(htmlPage(
    head: head(title: 'My Web Page'),
    body: div('Hello, World!')
));

echo $html;
// Output:
// <!DOCTYPE html><html><head><title>My Web Page</title></head><div>Hello, World!</div></html>
```

### Advanced Example

Build a more complex HTML structure:

```php
use function Metal\Html ;
use function Metal\Html\div;
use function Metal\Html\head;
use function Metal\Html\hr;
use function Metal\Html\htmlPage;
use function Metal\Html\span;

$html = Metal::render(htmlPage(
    head: head(title: 'Advanced Example'),
    body: div(
        [
            a(href: '#', content: span('Click Me!')),
            hr(),
            div('Some additional content.'),
        ]
    )
));

echo $html;
// Output:
// <!DOCTYPE html><html><head><title>Advanced Example</title></head><div><a href="#"><span>Click Me!</span></a><hr><div>Some additional content.</div></div></html>
```

## Directory Structure

- `src/`: Contains the core library files.
- `Base/`: Includes foundational classes for HTML element creation.
- `Html/`: Provides helpers and utilities for building HTML.
- `tests/`: Unit tests for validating functionality.

## Requirements

- PHP 7.4 or higher

## Contributing

Contributions are welcome! Please fork the repository, make your changes, and submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).

## Authors

- **Your Name** - *Creator and Maintainer*
