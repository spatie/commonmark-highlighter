<?php

namespace Spatie\CommonMarkHighlighter;

use DomainException;
use Highlight\Highlighter;
use function HighlightUtilities\splitCodeIntoArray;

class CodeBlockHighlighter
{
    /** @var \Highlight\Highlighter */
    protected $highlighter;

    public function __construct(array $autodetectLanguages = [])
    {
        $this->highlighter = new Highlighter();

        $this->highlighter->setAutodetectLanguages($autodetectLanguages);
    }

    public function highlight(string $codeBlock, ?string $infoLine = null)
    {
        $codeBlockWithoutTags = strip_tags($codeBlock);
        $contents = htmlspecialchars_decode($codeBlockWithoutTags);

        $definition = $this->parseLangAndLines($infoLine);
        $language = $definition['lang'];

        try {
            $result = $language
                ? $this->highlighter->highlight($language, $contents)
                : $this->highlighter->highlightAuto($contents);

            $code = $result->value;

            if (count($definition['lines']) > 0) {
                $loc = splitCodeIntoArray($code);

                foreach ($loc as $i => $line) {
                    $loc[$i] = vsprintf('<span class="loc%s">%s</span>', [
                        isset($definition['lines'][$i + 1]) ? ' highlighted' : '',
                        $line,
                    ]);
                }

                $code = implode("\n", $loc);
            }

            return vsprintf('<code class="%s hljs %s" data-lang="%s">%s</code>', [
                'language-'.($language ? $language : $result->language),
                $result->language,
                $language ? $language : $result->language,
                $code,
            ]);
        } catch (DomainException $e) {
            return $codeBlock;
        }
    }

    private function parseLangAndLines(?string $language)
    {
        $parsed = [
            'lang' => $language,
            'lines' => [],
        ];

        if ($language === null) {
            return $parsed;
        }

        $bracePos = strpos($language, '{');

        if ($bracePos === false) {
            return $parsed;
        }

        $parsed['lang'] = substr($language, 0, $bracePos);
        $lineDef = substr($language, $bracePos + 1, -1);
        $lineNums = explode(',', $lineDef);

        foreach ($lineNums as $lineNum) {
            if (strpos($lineNum, '-') === false) {
                $parsed['lines'][intval($lineNum)] = true;

                continue;
            }

            $extremes = explode('-', $lineNum);

            if (count($extremes) !== 2) {
                continue;
            }

            $start = intval($extremes[0]);
            $end = intval($extremes[1]);

            for ($i = $start; $i <= $end; $i++) {
                $parsed['lines'][$i] = true;
            }
        }

        return $parsed;
    }
}
