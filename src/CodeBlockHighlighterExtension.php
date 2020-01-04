<?php

declare(strict_types=1);

namespace Spatie\CommonMarkHighlighter;

use League\CommonMark\Block\Element\FencedCode;
use League\CommonMark\Block\Element\IndentedCode;
use League\CommonMark\Extension\ExtensionInterface;
use Spatie\CommonMarkHighlighter\FencedCodeRenderer;
use League\CommonMark\ConfigurableEnvironmentInterface;
use Spatie\CommonMarkHighlighter\IndentedCodeRenderer;

class CodeBlockHighlighterExtension implements ExtensionInterface
{
    /**
     * Register the actual extensions to the framework.
     *
     * @param ConfigurableEnvironmentInterface $environment
     */
    public function register(ConfigurableEnvironmentInterface $environment): void
    {
        $environment->addBlockRenderer(FencedCode::class, new FencedCodeRenderer());
        $environment->addBlockRenderer(IndentedCode::class, new IndentedCodeRenderer());
    }
}
