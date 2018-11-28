<?php

namespace Spatie\CommonMarkHighlighter\Tests;

use League\CommonMark\Block\Element\FencedCode;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;
use PHPUnit\Framework\TestCase;
use Spatie\CommonMarkHighlighter\FencedCodeRenderer;
use Spatie\Snapshots\MatchesSnapshots;

class FencedCodeRendererTest extends TestCase
{
    use MatchesSnapshots;

    /** @test */
    public function it_highlights_code_blocks_with_a_specified_language()
    {
        $markdown = <<<MARKDOWN
Which looks like this in use:

```html
<generic-form
    :showBackButton="true"
    @back="goBack"
></generic-form>
```

Something feels wrong here.
MARKDOWN;

        $environment = Environment::createCommonMarkEnvironment();
        $environment->addBlockRenderer(FencedCode::class, new FencedCodeRenderer(['html']));

        $parser = new DocParser($environment);
        $htmlRenderer = new HtmlRenderer($environment);

        $document = $parser->parse($markdown);

        $html = $htmlRenderer->renderBlock($document);

        $this->assertMatchesXmlSnapshot('<div>'.$html.'</div>');
    }

    /** @test */
    public function it_highlights_code_blocks_with_an_autodetected_language()
    {
        $markdown = <<<MARKDOWN
Which looks like this in use:

```
<generic-form
    :showBackButton="true"
    @back="goBack"
></generic-form>
```

Something feels wrong here.
MARKDOWN;

        $environment = Environment::createCommonMarkEnvironment();
        $environment->addBlockRenderer(FencedCode::class, new FencedCodeRenderer(['html']));

        $parser = new DocParser($environment);
        $htmlRenderer = new HtmlRenderer($environment);

        $document = $parser->parse($markdown);

        $html = $htmlRenderer->renderBlock($document);

        $this->assertMatchesXmlSnapshot('<div>'.$html.'</div>');
    }
}
