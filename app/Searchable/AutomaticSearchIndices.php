<?php

namespace App\Searchable;

use Illuminate\Support\Facades\DB;

/**
 * Allow an eloquent model to be searchable.
 */
trait AutomaticSearchIndices
{
    protected static function bootAutomaticSearchIndices()
    {
        static::created(function ($model) {
            self::recreateSearchIndex($model);
        });

        static::updated(function ($model) {
            self::recreateSearchIndex($model);
        });

        static::saved(function ($model) {
            self::recreateSearchIndex($model);
        });

        static::deleting(function ($model) {
            if ($index = SearchIndex::for($model)) {
                $index->delete();
            }
        });
    }

    public function prepareSearchResultLink()
    {
        return '';
    }

    /**
     * Update a model's search index entry.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    protected static function recreateSearchIndex($model)
    {
        if (! $index = SearchIndex::for($model)) {
            return;
        }

        $language = config('searchable.language', 'english');

        $vectorQuery = collect($model->composeSearchIndex())
            ->filter(function ($value, $key) {
                return in_array($key, ['A', 'B', 'C', 'D']) && ! empty($value);
            })
            ->map(function ($value, $key) use ($language) {
                return "setweight(to_tsvector('{$language}', '{$value}'), '{$key}')";
            })
            ->implode(' || ');

        $index->update([
            'vector' => DB::raw($vectorQuery),
        ]);

        $index->save();
    }

    /**
     * Create a weighted index structure for this model.
     *
     * @return array
     */
    public function composeSearchIndex()
    {
        return [
            'A' => '',
            'B' => '',
            'C' => '',
            'D' => '',
        ];
    }
}
