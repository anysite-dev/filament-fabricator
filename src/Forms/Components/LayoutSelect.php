<?php

namespace Z3d0X\FilamentFabricator\Forms\Components;

use Filament\Forms\Components\Select;
use Z3d0X\FilamentFabricator\Facades\FilamentFabricator;

class LayoutSelect extends Select
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('filament-fabricator::page-resource.labels.layout'))
            ->options(FilamentFabricator::getLayouts())
            ->default(fn () => FilamentFabricator::getDefaultLayoutName())
            ->required();
    }

    public static function make(string $name = 'layout'): static
    {
        return parent::make($name);
    }
}
