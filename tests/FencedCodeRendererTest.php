<?php

namespace Spatie\CommonMarkHighlighter\Tests;

use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Parser\MarkdownParser;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Renderer\HtmlRenderer;
use PHPUnit\Framework\TestCase;
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

        $environment = new Environment();
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addRenderer(FencedCode::class, new FencedCodeRenderer(['html']));

        $parser = new MarkdownParser($environment);
        $htmlRenderer = new HtmlRenderer($environment);

        $document = $parser->parse($markdown);

        $html = $htmlRenderer->renderDocument($document);

        $this->assertMatchesXmlSnapshot('<div>'.$html.'</div>');
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

        $environment = new Environment();
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addRenderer(FencedCode::class, new FencedCodeRenderer(['html']));

        $parser = new MarkdownParser($environment);
        $htmlRenderer = new HtmlRenderer($environment);

        $document = $parser->parse($markdown);

        $html = $htmlRenderer->renderDocument($document);

        $this->assertMatchesXmlSnapshot('<div>'.$html.'</div>');
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

        $environment = new Environment();
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addRenderer(FencedCode::class, new FencedCodeRenderer(['html']));

        $parser = new MarkdownParser($environment);
        $htmlRenderer = new HtmlRenderer($environment);

        $document = $parser->parse($markdown);

        $html = $htmlRenderer->renderDocument($document);

        $this->assertMatchesXmlSnapshot('<div>'.$html.'</div>');
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

        $environment = new Environment();
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addRenderer(FencedCode::class, new FencedCodeRenderer(['html']));

        $parser = new MarkdownParser($environment);
        $htmlRenderer = new HtmlRenderer($environment);

        $document = $parser->parse($markdown);

        $html = $htmlRenderer->renderDocument($document);

        $this->assertMatchesXmlSnapshot('<div>'.$html.'</div>');
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

        $environment = new Environment();
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addRenderer(FencedCode::class, new FencedCodeRenderer(['html']));

        $parser = new MarkdownParser($environment);
        $htmlRenderer = new HtmlRenderer($environment);

        $document = $parser->parse($markdown);

        $html = $htmlRenderer->renderDocument($document);

        $this->assertMatchesXmlSnapshot('<div>'.$html.'</div>');
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

        $environment = new Environment();
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addRenderer(FencedCode::class, new FencedCodeRenderer(['html']));

        $parser = new MarkdownParser($environment);
        $htmlRenderer = new HtmlRenderer($environment);

        $document = $parser->parse($markdown);

        $html = $htmlRenderer->renderDocument($document);

        $this->assertMatchesXmlSnapshot('<div>'.$html.'</div>');
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

        $environment = new Environment();
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addRenderer(FencedCode::class, new FencedCodeRenderer(['html']));

        $parser = new MarkdownParser($environment);
        $htmlRenderer = new HtmlRenderer($environment);

        $document = $parser->parse($markdown);

        $html = $htmlRenderer->renderDocument($document);

        $this->assertMatchesXmlSnapshot('<div>'.$html.'</div>');
    }

    /** @test */
    public function it_highlights_code_blocks_with_a_specified_language_and_line_range_with_emojis()
    {
        $markdown = <<<'MARKDOWN'
Which looks like this in use:

```php{2}
// ✅ ...
$isUserPending = $user->isStatus("pending");
```

Something feels wrong here.
MARKDOWN;

        $environment = new Environment();
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addRenderer(FencedCode::class, new FencedCodeRenderer(['html']));

        $parser = new MarkdownParser($environment);
        $htmlRenderer = new HtmlRenderer($environment);

        $document = $parser->parse($markdown);

        $html = $htmlRenderer->renderDocument($document);

        $this->assertMatchesXmlSnapshot('<div>'.$html.'</div>');
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

        $environment = new Environment();
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addRenderer(FencedCode::class, new FencedCodeRenderer(['html']));

        $parser = new MarkdownParser($environment);
        $htmlRenderer = new HtmlRenderer($environment);

        $document = $parser->parse($markdown);

        $html = $htmlRenderer->renderDocument($document);

        $this->assertMatchesXmlSnapshot('<div>'.$html.'</div>');
    }
}
