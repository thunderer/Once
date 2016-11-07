# Once

This is a small experiment about making a function `once()` that makes sure that given callable is called only once.

Remember, **DO NOT USE THIS IN ANY PROJECT**.

Inspiration:

* https://murze.be/2016/11/magic-memoization-function
* https://github.com/spatie/once

## Usage

**Closure**

```php
$closure = function() {
    $range = range('A', 'Z');

    return $range[array_rand($range)];
}

assert(once($closure) === once($closure));
```

**Class**

```php
$class = new class($range) {
    public function foo() {
        $range = range('A', 'Z');

        return $range[array_rand($range)];
    }
};

assert(once([$class, 'foo']) === once([$class, 'foo']));
```

# License

MIT, of course.
