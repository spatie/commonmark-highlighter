# Highlight your markdown code blocks with league/commonmark

[![Latest Version](https://img.shields.io/github/release/spatie/commonmark-highlighter.svg?style=flat-square)](https://github.com/spatie/commonmark-highlighter/releases)
[![Build Status](https://img.shields.io/github/workflow/status/spatie/commonmark-highlighter/Tests.svg?style=flat-square)](https://github.com/spatie/commonmark-highlighter/actions)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/commonmark-highlighter.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/commonmark-highlighter)
[![StyleCI](https://styleci.io/repos/159513310/shield)](https://styleci.io/repos/159513310)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/commonmark-highlighter.svg?style=flat-square)](https://packagist.org/packages/spatie/commonmark-highlighter)

A block renderer for  [league/commonmark](https://github.com/thephpleague/commonmark) to highlight code blocks using [scrivo/highlight.php](https://github.com/scrivo/highlight.php).

> highlight.php is a server side code highlighter written in PHP that currently supports 185 languages. It's a port of highlight.js by Ivan Sagalaev that makes full use of the language and style definitions of the original JavaScript project.

The output html is compatible with highlight.js themes, which you can explore on [highlightjs.org](https://highlightjs.org/static/demo/). 

What are the benefits of using this package over highlight.js?

- Less JavaScript, which means faster page loads
- No more flash of unstyled code blocks

 This project was inspired by [sixlive/parsedown-highlight](https://github.com/sixlive/parsedown-highlight).

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/commonmark-highlighter.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/commonmark-highlighter)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

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

### Highlighting specific lines

Line numbers start at 1.

\`\`\`php - Don't highlight any lines  
\`\`\`php{4} - Highlight just line 4  
\`\`\`php{4-6} - Highlight the range of lines from 4 to 6 (inclusive)  
\`\`\`php{1,5} - Highlight just lines 1 and 5 on their own  
\`\`\`php{1-3,5} - Highlight 1 through 3 and then 5 on its own  
\`\`\`php{5,7,2-3} - The order of lines don't matter  
However, specifying 3-2 will not work.  

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

Our address is: Spatie, Kruikstraat 22, 2018 Antwerp, Belgium.

We publish all received postcards [on our company website](https://spatie.be/en/opensource/postcards).

## Credits

- [Sebastian De Deyne](https://github.com/sebastiandedeyne)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
