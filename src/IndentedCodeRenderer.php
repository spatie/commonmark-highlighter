<?php

namespace Spatie\CommonMarkHighlighter;

use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Renderer\IndentedCodeRenderer as BaseIndentedCodeRenderer;

class IndentedCodeRenderer extends BaseIndentedCodeRenderer
{
    /** @var \Spatie\CommonMarkHighlighter\CodeBlockHighlighter */
    protected $highlighter;

    public function __construct(array $autodetectLanguages = [])
    {
        $this->highlighter = new CodeBlockHighlighter($autodetectLanguages);
    }

    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, $inTightList = false)
    {
        $element = parent::render($block, $htmlRenderer, $inTightList);

        $element->setContents(
            $this->highlighter->highlight($element->getContents())
        );

        return $element;
    }
}
