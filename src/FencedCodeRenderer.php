<?php

namespace Spatie\CommonMarkHighlighter;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\FencedCode;
use League\CommonMark\Block\Renderer\FencedCodeRenderer as BaseFencedCodeRenderer;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Util\Xml;

class FencedCodeRenderer extends BaseFencedCodeRenderer
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
            $this->highlighter->highlight(
                $element->getContents(),
                $this->getSpecifiedLanguage($block)
            )
        );

        return $element;
    }

    protected function getSpecifiedLanguage(FencedCode $block): ?string
    {
        $infoWords = $block->getInfoWords();

        if (empty($infoWords) || empty($infoWords[0])) {
            return null;
        }

        return Xml::escape($infoWords[0], true);
    }
}
