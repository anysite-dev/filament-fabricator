<?php

namespace Z3d0X\FilamentFabricator\Forms\Components;

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Builder;
use Filament\Support\Enums\MaxWidth;
use Z3d0X\FilamentFabricator\Facades\FilamentFabricator;

class PageBuilder extends Builder
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->hiddenLabel();

        $this->blockPreviews();

        $this->collapsible();

        $this->cloneable();

        $this->blockPickerColumns(3);

        $this->blockIcons();

        $this->blockPickerWidth(MaxWidth::FiveExtraLarge);

        $this->blocks(FilamentFabricator::getPageBlocks());

        $this->mutateDehydratedStateUsing(static function (?array $state): array {
            if (! is_array($state)) {
                return array_values([]);
            }

            $registerPageBlockNames = array_keys(FilamentFabricator::getPageBlocksRaw());

            return collect($state)
                ->filter(fn (array $block) => in_array($block['type'], $registerPageBlockNames, true))
                ->values()
                ->toArray();
        });

        $this->deleteAction(
            fn (Action $action) => $action->requiresConfirmation(),
        );

        $this->editAction(
            fn (Action $action) => $action->modalSubmitActionLabel('Update'),
        );
    }

    public static function make(string $name = 'blocks'): static
    {
        return parent::make($name);
    }
}
