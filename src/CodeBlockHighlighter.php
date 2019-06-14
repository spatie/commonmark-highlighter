<?php

namespace Spatie\CommonMarkHighlighter;

use DomainException;
use Highlight\Highlighter;

class CodeBlockHighlighter
{
    /** @var \Highlight\Highlighter */
    protected $highlighter;

    public function __construct(array $autodetectLanguages = [])
    {
        $this->highlighter = new Highlighter();

        $this->highlighter->setAutodetectLanguages($autodetectLanguages);
    }

    public function highlight(string $codeBlock, ?string $language = null)
    {
        $codeBlockWithoutTags = strip_tags($codeBlock);
        $contents = htmlspecialchars_decode($codeBlockWithoutTags);

        try {
            $result = $language
                ? $this->highlighter->highlight($language, $contents)
                : $this->highlighter->highlightAuto($contents);

            return vsprintf('<code class="%s hljs %s" data-lang="%s">%s</code>', [
                'language-'.($language ? $language : $result->language),
                $result->language,
                $language ? $language : $result->language,
                $result->value,
            ]);
        } catch (DomainException $e) {
            return $codeBlock;
        }
    }
}
