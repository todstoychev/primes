# Installation
Install as usually install Symfony bundles.
Run: ```composer require todstoychev/primes```.
It may be necessary to change your symfony installation ```minimum-stability``` directive to ```dev```. 
This can be done by adding: 
```json
{
    "minimum-stability": "dev"
}
``` 
to your composer.json file.

Then add to ```app/AppKernel.php``` in the bundles array:

```php
$bundles = [
            // Other bundles here
            new Todstoychev\PrimesBundle\TodstoychevPrimesBundle(),
];

```

# Commands
The bundle provides 2 commands.

- primes:show [--count] - this one provides a list of primes. If --count option used you must provide how many primes do you want to generate.
- primes:table [--count] - has the same way of usage as the previous command, but displays multiplication table of primes generated.