# DeferredMediable

DeferredMediable is a trait that handles the attachment of Mediable entities to new entities that are in the process of being created.  This becomes relevant when, for example, uploading files to be attached to a new post on a blog: they can only be attached once the post is created and its ID is known.  With this trait in place, intended attached Mediables are queued and attached once the new post has been created.

Builds on Plank's [Laravel-Mediable](https://github.com/plank/laravel-mediable) package.

## Example Usage

(to be done)

## Installation

Add the package to your Laravel app using composer

```bash
composer require tibbsa/deferredmediable
```

## License

This package is released under the MIT license (MIT).

