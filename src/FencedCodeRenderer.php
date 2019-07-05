<?php

namespace Spatie\CommonMarkHighlighter;

use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\Util\Xml;
use League\CommonMark\Block\Element\FencedCode;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Renderer\FencedCodeRenderer as BaseFencedCodeRenderer;

class FencedCodeRenderer implements BlockRendererInterface
{
    /** @var \Spatie\CommonMarkHighlighter\CodeBlockHighlighter */
    protected $highlighter;

    /** @var \League\CommonMark\Block\Renderer\FencedCodeRenderer */
    protected $baseRenderer;

    public function __construct(array $autodetectLanguages = [])
    {
        $this->highlighter = new CodeBlockHighlighter($autodetectLanguages);
        $this->baseRenderer = new BaseFencedCodeRenderer();
    }

    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, $inTightList = false)
    {
        $element = $this->baseRenderer->render($block, $htmlRenderer, $inTightList);

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
