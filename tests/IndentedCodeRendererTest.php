<?php

namespace Spatie\CommonMarkHighlighter\Tests;

use League\CommonMark\Block\Element\IndentedCode;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;
use PHPUnit\Framework\TestCase;
use Spatie\CommonMarkHighlighter\CodeBlockHighlighterExtension;
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

        $extensionEnvironment = Environment::createCommonMarkEnvironment();
        $extensionEnvironment->addExtension(new CodeBlockHighlighterExtension());
        $inlineEnvironment = Environment::createCommonMarkEnvironment();
        $inlineEnvironment->addBlockRenderer(IndentedCode::class, new IndentedCodeRenderer(['html']));

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
