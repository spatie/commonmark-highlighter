<?php

namespace Spatie\CommonMarkHighlighter;

use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Renderer\IndentedCodeRenderer as BaseIndentedCodeRenderer;

class IndentedCodeRenderer implements BlockRendererInterface
{
    /** @var \Spatie\CommonMarkHighlighter\CodeBlockHighlighter */
    protected $highlighter;

    /** @var \League\CommonMark\Block\Renderer\IndentedCodeRenderer */
    protected $baseRenderer;

    public function __construct(array $autodetectLanguages = [])
    {
        $this->highlighter = new CodeBlockHighlighter($autodetectLanguages);
        $this->baseRenderer = new BaseIndentedCodeRenderer();
    }

    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, $inTightList = false)
    {
        $element = $this->baseRenderer->render($block, $htmlRenderer, $inTightList);

        $element->setContents(
            $this->highlighter->highlight($element->getContents())
        );

        return $element;
    }
}
