<?php

namespace Spatie\CommonMarkHighlighter\Tests;

use PHPUnit\Framework\TestCase;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;
use Spatie\Snapshots\MatchesSnapshots;
use League\CommonMark\Block\Element\IndentedCode;
use Spatie\CommonMarkHighlighter\IndentedCodeRenderer;

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

        $environment = Environment::createCommonMarkEnvironment();
        $environment->addBlockRenderer(IndentedCode::class, new IndentedCodeRenderer(['html']));

        $parser = new DocParser($environment);
        $htmlRenderer = new HtmlRenderer($environment);

        $document = $parser->parse($markdown);

        $html = $htmlRenderer->renderBlock($document);

        $this->assertMatchesXmlSnapshot('<div>'.$html.'</div>');
    }
}
