<?php
namespace TibbsA\DeferredMediable;

use Plank\Mediable\Mediable;

trait DeferredMediable
{
    // This array will hold each of the deferred Mediable entities that
    // are to be attached.  See attachMediaDeferred()
    protected $deferred_mediables = [];

    public static function bootDeferredMediable()
    {
        if (!in_array('Plank\Mediable\Mediable', class_uses(get_class()))) {
            throw new \ErrorException('Class '  . get_class() . ' is attempting to use DeferredMediable trait without Plank\Mediable\Mediable');
        }

        static::created(function($model) {
            $model->handleDeferredMediables();
        });
    }

    protected function handleDeferredMediables()
    {
        if (count($this->deferred_mediables) == 0)
            return;

        $deferred = $this->deferred_mediables;
        $this->deferred_mediables = [];

        // Add each deferred mediable in the order they were
        // attached.
        foreach ($deferred as $m) {
            $this->attachMedia($m['media'], $m['tags']);
        }

        $this->afterDeferredMediableAttached ($deferred);
    }

    // Adds the attached media to the deferral list.  $media could be one
    // media object or multiple, as can $tags.
    public function attachMediaDeferred($media, $tags)
    {
        $this->deferred_mediables[] = [
            'media' => $media,
            'tags' => $tags
        ];
    }

    // Implementing classes may want to override this to do something
    // with the now-attached media items
    protected function afterDeferredMediableAttached ($deferred)
    {
        // no op by default
    }

}
