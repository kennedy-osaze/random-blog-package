# Blog

A simple and random markdown-powered package for Laravel

## Installation
Add the following to `composer.json`
```json
{
    "require": {
        "kennedy/random-blog-package": "dev-master"
    },
    "repositories": {
        "type": "git",
        "url": "https://github.com/kennedy/random-blog-package"
    }
}
```
Then run `composer update` in the terminal at the root folder of the application.

### Migration
To run migrations, do: `php artisan migrate`

### Publish package config
Publish the package assets, run:
`php artisan vendor:publish --tag=blog`

A default config file for the package will now be created and located at `config/blog.php`

### Create directory to hold posts
The last step for installation is to create a directory for your markdown files that the package will turn into a blog post.
By default, the directory used by the package is `storage/app/blogs` (where the `blog` directory has already been created). This path can be change in the `config/blog.php` file.

### Sample Post
Here is a sample markdown file that can be converted to a post:

```markdown
---
title: Any Title
description: Any random description works here
---

# Any Heading

Hello People...
```

## Warning
This is not an actual package. It is just for learning purposes and not production ready. It was developed based on the course: https://coderstape.com/series/1-laravel-package-development
