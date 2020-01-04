<?php

namespace Spatie\CommonMarkHighlighter\Tests;

use League\CommonMark\Block\Element\FencedCode;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;
use PHPUnit\Framework\TestCase;
use Spatie\CommonMarkHighlighter\CodeBlockHighlighterExtension;
use Spatie\CommonMarkHighlighter\FencedCodeRenderer;
use Spatie\Snapshots\MatchesSnapshots;

class FencedCodeRendererTest extends TestCase
{
    use MatchesSnapshots;

    /** @test */
    public function it_highlights_code_blocks_with_a_specified_language()
    {
        $markdown = <<<'MARKDOWN'
Which looks like this in use:

```html
<generic-form
    :showBackButton="true"
    @back="goBack"
></generic-form>
```

Something feels wrong here.
MARKDOWN;

        $extensionEnvironment = Environment::createCommonMarkEnvironment();
        $extensionEnvironment->addExtension(new CodeBlockHighlighterExtension());
        $inlineEnvironment = Environment::createCommonMarkEnvironment();
        $inlineEnvironment->addBlockRenderer(FencedCode::class, new FencedCodeRenderer(['html']));

        $inlineParser = new DocParser($inlineEnvironment);
        $inlineHtmlRenderer = new HtmlRenderer($inlineEnvironment);
        $extensionParser = new DocParser($extensionEnvironment);
        $extensionHtmlRenderer = new HtmlRenderer($extensionEnvironment);

        $inlineHtml = $inlineHtmlRenderer->renderBlock($inlineParser->parse($markdown));
        $extensionHtml = $extensionHtmlRenderer->renderBlock($extensionParser->parse($markdown));

        $this->assertMatchesXmlSnapshot('<div>'.$inlineHtml.'</div>');
        $this->assertMatchesXmlSnapshot('<div>'.$extensionHtml.'</div>');
    }

    /** @test */
    public function it_highlights_code_blocks_with_a_specified_language_and_single_line()
    {
        $markdown = <<<'MARKDOWN'
Which looks like this in use:

```html{5}
<generic-form
    :showBackButton="true"
    @back="goBack"
>
    <input type="text" name="send-to">
    <input type="number" name="amount" />
</generic-form>
```

Something feels wrong here.
MARKDOWN;

        $extensionEnvironment = Environment::createCommonMarkEnvironment();
        $extensionEnvironment->addExtension(new CodeBlockHighlighterExtension());
        $inlineEnvironment = Environment::createCommonMarkEnvironment();
        $inlineEnvironment->addBlockRenderer(FencedCode::class, new FencedCodeRenderer(['html']));

        $inlineParser = new DocParser($inlineEnvironment);
        $inlineHtmlRenderer = new HtmlRenderer($inlineEnvironment);
        $extensionParser = new DocParser($extensionEnvironment);
        $extensionHtmlRenderer = new HtmlRenderer($extensionEnvironment);

        $inlineHtml = $inlineHtmlRenderer->renderBlock($inlineParser->parse($markdown));
        $extensionHtml = $extensionHtmlRenderer->renderBlock($extensionParser->parse($markdown));

        $this->assertMatchesXmlSnapshot('<div>'.$inlineHtml.'</div>');
        $this->assertMatchesXmlSnapshot('<div>'.$extensionHtml.'</div>');
    }

    /** @test */
    public function it_highlights_code_blocks_with_a_specified_language_and_line_range()
    {
        $markdown = <<<'MARKDOWN'
Which looks like this in use:

```html{2-3}
<generic-form
    :showBackButton="true"
    @back="goBack"
>
    <input type="text" name="send-to">
    <input type="number" name="amount" />
</generic-form>
```

Something feels wrong here.
MARKDOWN;

        $extensionEnvironment = Environment::createCommonMarkEnvironment();
        $extensionEnvironment->addExtension(new CodeBlockHighlighterExtension());
        $inlineEnvironment = Environment::createCommonMarkEnvironment();
        $inlineEnvironment->addBlockRenderer(FencedCode::class, new FencedCodeRenderer(['html']));

        $inlineParser = new DocParser($inlineEnvironment);
        $inlineHtmlRenderer = new HtmlRenderer($inlineEnvironment);
        $extensionParser = new DocParser($extensionEnvironment);
        $extensionHtmlRenderer = new HtmlRenderer($extensionEnvironment);

        $inlineHtml = $inlineHtmlRenderer->renderBlock($inlineParser->parse($markdown));
        $extensionHtml = $extensionHtmlRenderer->renderBlock($extensionParser->parse($markdown));

        $this->assertMatchesXmlSnapshot('<div>'.$inlineHtml.'</div>');
        $this->assertMatchesXmlSnapshot('<div>'.$extensionHtml.'</div>');
    }

    /** @test */
    public function it_highlights_code_blocks_with_a_specified_language_and_multiple_line_range()
    {
        $markdown = <<<'MARKDOWN'
Which looks like this in use:

```html{2-3,5-6}
<generic-form
    :showBackButton="true"
    @back="goBack"
>
    <input type="text" name="send-to">
    <input type="number" name="amount" />
</generic-form>
```

Something feels wrong here.
MARKDOWN;

        $extensionEnvironment = Environment::createCommonMarkEnvironment();
        $extensionEnvironment->addExtension(new CodeBlockHighlighterExtension());
        $inlineEnvironment = Environment::createCommonMarkEnvironment();
        $inlineEnvironment->addBlockRenderer(FencedCode::class, new FencedCodeRenderer(['html']));

        $inlineParser = new DocParser($inlineEnvironment);
        $inlineHtmlRenderer = new HtmlRenderer($inlineEnvironment);
        $extensionParser = new DocParser($extensionEnvironment);
        $extensionHtmlRenderer = new HtmlRenderer($extensionEnvironment);

        $inlineHtml = $inlineHtmlRenderer->renderBlock($inlineParser->parse($markdown));
        $extensionHtml = $extensionHtmlRenderer->renderBlock($extensionParser->parse($markdown));

        $this->assertMatchesXmlSnapshot('<div>'.$inlineHtml.'</div>');
        $this->assertMatchesXmlSnapshot('<div>'.$extensionHtml.'</div>');
    }

    /** @test */
    public function it_highlights_code_blocks_with_a_specified_language_and_multiple_separate_lines()
    {
        $markdown = <<<'MARKDOWN'
Which looks like this in use:

```html{1,7}
<generic-form
    :showBackButton="true"
    @back="goBack"
>
    <input type="text" name="send-to">
    <input type="number" name="amount" />
</generic-form>
```

Something feels wrong here.
MARKDOWN;

        $extensionEnvironment = Environment::createCommonMarkEnvironment();
        $extensionEnvironment->addExtension(new CodeBlockHighlighterExtension());
        $inlineEnvironment = Environment::createCommonMarkEnvironment();
        $inlineEnvironment->addBlockRenderer(FencedCode::class, new FencedCodeRenderer(['html']));

        $inlineParser = new DocParser($inlineEnvironment);
        $inlineHtmlRenderer = new HtmlRenderer($inlineEnvironment);
        $extensionParser = new DocParser($extensionEnvironment);
        $extensionHtmlRenderer = new HtmlRenderer($extensionEnvironment);

        $inlineHtml = $inlineHtmlRenderer->renderBlock($inlineParser->parse($markdown));
        $extensionHtml = $extensionHtmlRenderer->renderBlock($extensionParser->parse($markdown));

        $this->assertMatchesXmlSnapshot('<div>'.$inlineHtml.'</div>');
        $this->assertMatchesXmlSnapshot('<div>'.$extensionHtml.'</div>');
    }

    /** @test */
    public function it_highlights_code_blocks_with_a_specified_language_and_mix_ranges_specific_lines()
    {
        $markdown = <<<'MARKDOWN'
Which looks like this in use:

```html{1,2-3,5,7}
<generic-form
    :showBackButton="true"
    @back="goBack"
>
    <input type="text" name="send-to">
    <input type="number" name="amount" />
</generic-form>
```

Something feels wrong here.
MARKDOWN;

        $extensionEnvironment = Environment::createCommonMarkEnvironment();
        $extensionEnvironment->addExtension(new CodeBlockHighlighterExtension());
        $inlineEnvironment = Environment::createCommonMarkEnvironment();
        $inlineEnvironment->addBlockRenderer(FencedCode::class, new FencedCodeRenderer(['html']));

        $inlineParser = new DocParser($inlineEnvironment);
        $inlineHtmlRenderer = new HtmlRenderer($inlineEnvironment);
        $extensionParser = new DocParser($extensionEnvironment);
        $extensionHtmlRenderer = new HtmlRenderer($extensionEnvironment);

        $inlineHtml = $inlineHtmlRenderer->renderBlock($inlineParser->parse($markdown));
        $extensionHtml = $extensionHtmlRenderer->renderBlock($extensionParser->parse($markdown));

        $this->assertMatchesXmlSnapshot('<div>'.$inlineHtml.'</div>');
        $this->assertMatchesXmlSnapshot('<div>'.$extensionHtml.'</div>');
    }

    /** @test */
    public function it_highlights_code_blocks_with_a_specified_language_and_lines_out_of_order()
    {
        $markdown = <<<'MARKDOWN'
Which looks like this in use:

```html{7,1,3,2}
<generic-form
    :showBackButton="true"
    @back="goBack"
>
    <input type="text" name="send-to">
    <input type="number" name="amount" />
</generic-form>
```

Something feels wrong here.
MARKDOWN;

        $extensionEnvironment = Environment::createCommonMarkEnvironment();
        $extensionEnvironment->addExtension(new CodeBlockHighlighterExtension());
        $inlineEnvironment = Environment::createCommonMarkEnvironment();
        $inlineEnvironment->addBlockRenderer(FencedCode::class, new FencedCodeRenderer(['html']));

        $inlineParser = new DocParser($inlineEnvironment);
        $inlineHtmlRenderer = new HtmlRenderer($inlineEnvironment);
        $extensionParser = new DocParser($extensionEnvironment);
        $extensionHtmlRenderer = new HtmlRenderer($extensionEnvironment);

        $inlineHtml = $inlineHtmlRenderer->renderBlock($inlineParser->parse($markdown));
        $extensionHtml = $extensionHtmlRenderer->renderBlock($extensionParser->parse($markdown));

        $this->assertMatchesXmlSnapshot('<div>'.$inlineHtml.'</div>');
        $this->assertMatchesXmlSnapshot('<div>'.$extensionHtml.'</div>');
    }

    /** @test */
    public function it_highlights_code_blocks_with_an_autodetected_language()
    {
        $markdown = <<<'MARKDOWN'
Which looks like this in use:

```
<generic-form
    :showBackButton="true"
    @back="goBack"
></generic-form>
```

Something feels wrong here.
MARKDOWN;

        $extensionEnvironment = Environment::createCommonMarkEnvironment();
        $extensionEnvironment->addExtension(new CodeBlockHighlighterExtension());
        $inlineEnvironment = Environment::createCommonMarkEnvironment();
        $inlineEnvironment->addBlockRenderer(FencedCode::class, new FencedCodeRenderer(['html']));

        $inlineParser = new DocParser($inlineEnvironment);
        $inlineHtmlRenderer = new HtmlRenderer($inlineEnvironment);
        $extensionParser = new DocParser($extensionEnvironment);
        $extensionHtmlRenderer = new HtmlRenderer($extensionEnvironment);

        $inlineHtml = $inlineHtmlRenderer->renderBlock($inlineParser->parse($markdown));
        $extensionHtml = $extensionHtmlRenderer->renderBlock($extensionParser->parse($markdown));

        $this->assertMatchesXmlSnapshot('<div>'.$inlineHtml.'</div>');
        $this->assertMatchesXmlSnapshot('<div>'.$extensionHtml.'</div>');
    }
}
