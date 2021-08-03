<?php

namespace Spatie\CommonMarkHighlighter\Tests;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use League\CommonMark\Parser\MarkdownParser;
use League\CommonMark\Renderer\HtmlRenderer;
use PHPUnit\Framework\TestCase;
use Spatie\CommonMarkHighlighter\IndentedCodeRenderer;
use Spatie\Snapshots\MatchesSnapshots;

class IndentedCodeRendererTest extends TestCase
{
    use MatchesSnapshots;

    /** @test */
    public function it_highlights_code_blocks()
    {
        $markdown = <<<'MARKDOWN'
Which looks like this in use:

    <generic-form
        :showBackButton="true"
        @back="goBack"
    ></generic-form>

Something feels wrong here.
MARKDOWN;

        $environment = new Environment();
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addRenderer(IndentedCode::class, new IndentedCodeRenderer(['html']));

        $parser = new MarkdownParser($environment);
        $htmlRenderer = new HtmlRenderer($environment);

        $document = $parser->parse($markdown);

        $html = $htmlRenderer->renderDocument($document);

        $this->assertMatchesXmlSnapshot('<div>'.$html.'</div>');
    }
}
