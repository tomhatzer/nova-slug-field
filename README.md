# Laravel Nova Slug Field

Simple Laravel Nova Slug field. Generating a slugified version of a text 
input. See the result of the slug  while typing.
 
### Edit form

![details page select](https://raw.githubusercontent.com/benjaminhirsch/benjaminhirsch.github.io/master/repository-assets/nova-slug-demo.gif)

## Installation

In order to use this package, you need a Laravel installation which uses [Nova](https://nova.laravel.com).

**Composer**

```bash
composer require benjaminhirsch/nova-slug-field
```

## Usage

```
TextWithSlug::make('Name')
    ->sortable()
    ->slug('Slug')
    ->rules('required', 'max:255'),

Slug::make('Slug')
    ->rules('required', 'max:255'),
```

This first field definition is the field which you want to create the slug of. The second field 
definition represents the slugified version. With the ```->slug('name')``` method, you  define 
the name of the field which holds the slug. It is possible to create multiple slugs on a single
resource, just add more field definitions. Every ```TextWithSlug``` field needs a  corresponding
```Slug``` field.