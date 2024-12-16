
# Metal - A Native PHP Template Engine

**Metal** is a lightweight, pure PHP template engine inspired by Flutter's declarative UI principles. 
It allows developers to build dynamic HTML structures in PHP with a clean and intuitive syntax.

## 🌟 Please Star the Repo!
If you find this package helpful, please consider starring the repository ⭐! Your support helps others discover it and motivates further improvements.

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

## Requirements

- PHP 8.1 or higher


### Support me

If you’d like to support further development or show appreciation, donations are welcome! You can make a one-time donation through PayPal:

[Donate via PayPal](https://www.paypal.com/donate/?hosted_button_id=R8SL63KKCGL82)

## Contributing

Contributions are welcome! Please fork the repository, make your changes, and submit a pull request.

## MIT License

Copyright (c) 2024 Feras Abdalrahman

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

## Authors

- **Feras Abdalrahman** - *Creator and Maintainer*
