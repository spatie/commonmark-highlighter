# Highlight your markdown code blocks with league/commonmark

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/commonmark-highlighter.svg?style=flat-square)](https://packagist.org/packages/spatie/commonmark-highlighter)
[![Build Status](https://img.shields.io/travis/spatie/commonmark-highlighter/master.svg?style=flat-square)](https://travis-ci.org/spatie/commonmark-highlighter)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/commonmark-highlighter.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/commonmark-highlighter)
[![StyleCI](https://github.styleci.io/repos/159513310/shield?branch=master)]
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/commonmark-highlighter.svg?style=flat-square)](https://packagist.org/packages/spatie/commonmark-highlighter)

A block renderer for  [league/commonmark](https://github.com/thephpleague/commonmark) to highlight code blocks using [scrivo/highlight.php](https://github.com/scrivo/highlight.php).

> highlight.php is a server side code highlighter written in PHP that currently supports 185 languages. It's a port of highlight.js by Ivan Sagalaev that makes full use of the language and style definitions of the original JavaScript project.

The output html is compatible with highlight.js themes, which you can explore on [highlightjs.org](https://highlightjs.org/static/demo/). 

What are the benefits of using this package over highlight.js?

- Less JavaScript, which means faster page loads
- No more flash of unstyled code blocks

 This project was inspired by [sixlive/parsedown-highlight](https://github.com/sixlive/parsedown-highlight).

## Installation

You can install the package via composer:

```bash
composer require spatie/commonmark-highlighter
```

## Usage

Create a custom CommonMark environment, and register the `FencedCodeRenderer` and `IndentedCodeRender` as described in the [league/commonmark documentation](https://commonmark.thephpleague.com/customization/block-rendering/).

```php
use League\CommonMark\Block\Element\FencedCode;
use League\CommonMark\Block\Element\IndentedCode;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use Spatie\CommonMarkHighlighter\FencedCodeRenderer;
use Spatie\CommonMarkHighlighter\IndentedCodeRenderer;

$environment = Environment::createCommonMarkEnvironment();
$environment->addBlockRenderer(FencedCode::class, new FencedCodeRenderer());
$environment->addBlockRenderer(IndentedCode::class, new IndentedCodeRenderer());

$commonMarkConverter = new CommonMarkConverter([], $environment);

echo $commonMarkConverter->convertToHtml($markdown);
```

The underlying highlight library recommends specifying a subset of languages for the auto-detection. You can pass an array of languages to any of the renderers.

```php
new FencedCodeRenderer(['html', 'php', 'js']);

new IndentedCodeCodeRenderer(['html', 'php', 'js']);
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Postcardware

You're free to use this package, but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Samberstraat 69D, 2060 Antwerp, Belgium.

We publish all received postcards [on our company website](https://spatie.be/en/opensource/postcards).

## Credits

- [Sebastian De Deyne](https://github.com/sebastiandedeyne)
- [All Contributors](../../contributors)

## Support us

Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

Does your business depend on our contributions? Reach out and support us on [Patreon](https://www.patreon.com/spatie). 
All pledges will be dedicated to allocating workforce on maintenance and new awesome stuff.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
