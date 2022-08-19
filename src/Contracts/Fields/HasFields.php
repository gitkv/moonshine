<?php

declare(strict_types=1);

namespace Leeto\MoonShine\Contracts\Fields;

use Leeto\MoonShine\Fields\Field;

interface HasFields
{
    public function fields(array $fields): static;

    public function hasFields(): bool;

    /**
     * @return Field[]
     */
    public function getFields(): array;
}
