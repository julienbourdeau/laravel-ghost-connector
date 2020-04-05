# Laravel Ghost connector

![Laravel](https://github.com/julienbourdeau/laravel-ghost-connector/workflows/Laravel/badge.svg)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/julienbourdeau/laravel-ghost-connector.svg?style=flat-square)](https://packagist.org/packages/julienbourdeau/laravel-ghost-connector)

This package retrieve content from a Ghost blog and make it available as a regular model using [Sushi](https://github.com/calebporzio/sushi).

The content will be kept in memory and reused anytime you call the model builder. It's not shared between requests.

I wrote this package because I built my custom blog on Laravel, with Laravel Nova. I like it for long articles but
 for journaling, I found the writing experience not so nice.
 With this package, I write in Ghost admin, but the content is still published via Laravel. 🏄‍♂️ 

## Installation

You can install the package via composer:

```bash
composer require julienbourdeau/laravel-ghost-connector
```

Add your Ghost credentials in our `.env`.

```bash
GHOST_API_URL=http://localhost:2369
GHOST_CONTENT_KEY=2b3934d798ccce67daacdc8adb
```

## Usage

Here are a few simple example how you'd typically use this package. 
The following code will make **one single HTTP call to Ghost**.
 
```php
Post::count();
Post::all()->map(function($x) {
    dump($x->title);
});
Post::where('featured', true)->get();
```

```blade
@foreach (Post::all() as $post)
  <h2>{{ $post->title }}</h2>
  <p>{{ nl2br($post->excerpt) }}</p>
  <hr>
@endforeach
```


### Ghost API

When retrieving the posts from Ghost, the package will [include tags and authors](https://ghost.org/docs/api/v3/content/#posts).

Content is also casted, using the regular `$casts` Model feature.

#### Example

[This is the API response](https://github.com/julienbourdeau/laravel-ghost-connector/blob/master/tests/fixtures/posts.json) and the following is `Post::first()->toArray()`.

```
array:34 [
  "id" => "5e80568dc50444aef65bea46"
  "uuid" => "97f42901-6b26-4a61-9ec6-96852d05e0f3"
  "title" => "Welcome to Ghost"
  "slug" => "welcome"
  "html" => "<h2 id="a-few-things-you-should-know"><strong>A few things you should know</strong></h2><ol><li>Ghost is
 designed for ambitious ... Blah blah blah"
  "comment_id" => "5e80568dc50444aef65bea46"
  "feature_image" => "https://static.ghost.org/v3.0.0/images/welcome-to-ghost.png"
  "featured" => false
  "visibility" => "public"
  "send_email_when_published" => false
  "created_at" => "2020-03-29T08:04:29.000000Z"
  "updated_at" => "2020-03-29T08:04:29.000000Z"
  "published_at" => "2020-03-29T08:04:35.000000Z"
  "custom_excerpt" => """
    Welcome, it's great to have you here.\n
    We know that first impressions are important, so we've populated your new site with some initial getting started posts that will help you get familiar with everything in no time.
    """
  "codeinjection_head" => null
  "codeinjection_foot" => null
  "custom_template" => null
  "canonical_url" => null
  "authors" => array:1 [
    0 => array:13 [
      "id" => "5951f5fca366002ebd5dbef7"
      "name" => "Ghost"
      "slug" => "ghost"
      "profile_image" => "https://static.ghost.org/v3.0.0/images/ghost.png"
      "cover_image" => null
      "bio" => "You can delete this user to remove all the welcome posts"
      "website" => "https://ghost.org"
      "location" => "The Internet"
      "facebook" => "ghost"
      "twitter" => "ghost"
      "meta_title" => null
      "meta_description" => null
      "url" => "http://localhost:2369/author/ghost/"
    ]
  ]
  "tags" => array:1 [
    0 => array:9 [
      "id" => "5e80568cc50444aef65be9e6"
      "name" => "Getting Started"
      "slug" => "getting-started"
      "description" => null
      "feature_image" => null
      "visibility" => "public"
      "meta_title" => null
      "meta_description" => null
      "url" => "http://localhost:2369/tag/getting-started/"
    ]
  ]
  "primary_author" => array:13 [
    "id" => "5951f5fca366002ebd5dbef7"
    "name" => "Ghost"
    "slug" => "ghost"
    "profile_image" => "https://static.ghost.org/v3.0.0/images/ghost.png"
    "cover_image" => null
    "bio" => "You can delete this user to remove all the welcome posts"
    "website" => "https://ghost.org"
    "location" => "The Internet"
    "facebook" => "ghost"
    "twitter" => "ghost"
    "meta_title" => null
    "meta_description" => null
    "url" => "http://localhost:2369/author/ghost/"
  ]
  "primary_tag" => array:9 [
    "id" => "5e80568cc50444aef65be9e6"
    "name" => "Getting Started"
    "slug" => "getting-started"
    "description" => null
    "feature_image" => null
    "visibility" => "public"
    "meta_title" => null
    "meta_description" => null
    "url" => "http://localhost:2369/tag/getting-started/"
  ]
  "url" => "http://localhost:2369/welcome/"
  "excerpt" => """
    Welcome, it's great to have you here.\n
    We know that first impressions are important, so we've populated your new site with some initial getting started posts that will help you get familiar with everything in no time.
    """
  "reading_time" => 1
  "og_image" => null
  "og_title" => null
  "og_description" => null
  "twitter_image" => null
  "twitter_title" => null
  "twitter_description" => null
  "meta_title" => null
  "meta_description" => null
  "email_subject" => null
]
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email julien@sigerr.org instead of using the issue tracker.

## Credits

- [Julien Bourdeau](https://github.com/julienbourdeau)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
