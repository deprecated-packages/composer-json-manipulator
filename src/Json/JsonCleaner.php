<?php

declare(strict_types=1);

namespace Symplify\ComposerJsonManipulator\Json;

final class JsonCleaner
{
    /**
     * @param mixed[] $data
     * @return mixed[]
     */
    public function removeEmptyKeysFromJsonArray(array $data): array
    {
        foreach ($data as $key => $value) {
            if (! is_array($value)) {
                continue;
            }

            if (count($value) === 0) {
                unset($data[$key]);
            } else {
                $data[$key] = $this->removeEmptyKeysFromJsonArray($value);
            }
        }

        return $data;
    }
}
