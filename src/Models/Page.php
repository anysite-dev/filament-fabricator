<?php

namespace Z3d0X\FilamentFabricator\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Z3d0X\FilamentFabricator\Models\Contracts\Page as Contract;

class Page extends Model implements Contract
{
    protected $fillable = [
        'title',
        'slug',
        'blocks',
        'layout',
        'parent_id',
    ];

    protected $casts = [
        'blocks' => 'array',
        'parent_id' => 'integer',
    ];

    public function __construct(array $attributes = [])
    {
        if (blank($this->table)) {
            $this->setTable(config('filament-fabricator.table_name', 'pages'));
        }

        parent::__construct($attributes);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    public function allChildren(): HasMany
    {
        return $this->hasMany(static::class, 'parent_id')
            ->select('id', 'slug', 'title', 'parent_id')
            ->with('allChildren:id,slug,title,parent_id');
    }

    protected static function booted()
    {
        static::saved(fn () => Cache::forget('filament-fabricator::page-urls'));
        static::deleted(fn () => Cache::forget('filament-fabricator::page-urls'));
    }
}
