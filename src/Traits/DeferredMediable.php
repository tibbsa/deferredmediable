<?php
namespace TibbsA\DeferredMediable;

use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;

trait DeferredMediable
{
    public static function bootDeferredMediable()
    {
        static::created(function($model) {
            $model->handleDeferredMediables;
        });
    }
    
    protected function handleDeferredMediables()
    {
        Log::info('Deferred mediable for ' . class_basename($this) . ' called');
    }
}
