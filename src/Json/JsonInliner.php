<?php

declare(strict_types=1);

namespace Symplify\ComposerJsonManipulator\Json;

use Nette\Utils\Strings;
use Symplify\ComposerJsonManipulator\ValueObject\Option;
use Symplify\PackageBuilder\Parameter\ParameterProvider;

final class JsonInliner
{
    /**
     * @var string
     * @see https://regex101.com/r/jhWo9g/1
     */
    private const SPACE_REGEX = '#\s+#';

    /**
     * @var ParameterProvider
     */
    private $parameterProvider;

    public function __construct(ParameterProvider $parameterProvider)
    {
        $this->parameterProvider = $parameterProvider;
    }

    public function inlineSections(string $jsonContent): string
    {
        if (! $this->parameterProvider->hasParameter(Option::INLINE_SECTIONS)) {
            return $jsonContent;
        }

        $inlineSections = $this->parameterProvider->provideArrayParameter(Option::INLINE_SECTIONS);

        foreach ($inlineSections as $inlineSection) {
            $pattern = '#("' . preg_quote($inlineSection, '#') . '": )\[(.*?)\](,)#ms';

            $jsonContent = Strings::replace($jsonContent, $pattern, function (array $match): string {
                $inlined = Strings::replace($match[2], self::SPACE_REGEX, ' ');
                $inlined = trim($inlined);
                $inlined = '[' . $inlined . ']';

                return $match[1] . $inlined . $match[3];
            });
        }

        return $jsonContent;
    }
}
