# Prototypes
> Dinamically add methods to PHP classes

Using this library you can dinamcally add methods to classes, as in the following example:  
```php
use skrtdev\Prototypes\Prototypeable;

class MyClass{
    use Prototypeable;
}

MyClass::addMethod('wow', function () {
    return "What a nice way to use PHP";
});

$instance = new MyClass();

echo $instance->wow();
```
Output is `What a nice way to use PHP`

### Main Features

- Closures are bound to the original object, so you can access `$this` inside closures in the same way as you do when writing a normal method for that class.
- Supports **static** methods too, and you can access `self` and `static` too.  
- A native-like `\Error` will be thrown when trying to call a non-existent method.  
- A `skrtdev\Prototypes\Exception` will be thrown if class method already exists, is a prototype, class does not exist or isn't Prototypeable (when using `skrtdev\Prototypes\Prototypes::addMethod()`).  

### Check if a Class is Prototypeable

You may need to know if a class is `Prototypeable` before trying to add methods to it.

You can use `isPrototypeable` method:  
```php
use skrtdev\Prototypes\Prototypes;

var_dump(Prototypes::isPrototypeable($instance::class)); // you must pass the class name as string (use get_class() in php7.x)
var_dump(Prototypes::isPrototypeable(MyClass::class));
```

### Fun fact

The `Prototypes` class itself is `Prototypeable`, how strange.  

### Known issues

- This library does not have `Inheritance`: you won't be able to use Prototypes methods defined for a class in his child classes. (this is going to be added soon)  
- You won't be able to use [named arguments](https://www.php.net/manual/en/functions.arguments.php#functions.named-arguments) in Prototypes methods, as `array unpacking` doesn't work with string keys [yet](https://wiki.php.net/rfc/array_unpacking_string_keys).  
- You can't override already-prototyped methods, but this will be added soon.  
- Any kind of `Error/Exception`(s) look a bit strange in the Stack traces, and method name is hidden. Maybe there is a solution; if you find it, feel free to open an `Issue/Pull Request`.  

### Future scope

- Add the ability to use `callable`s instead of `Closure`s.  
- Use `class_parent()` to implement some kind of `Inheritance`. This may slow up calling prototypes in classes with a long hierarchy.  
- Maybe add the ability to add a method to a class without adding it to his children. (does it make sense?)
- Allow to add all methods of a normal/anonymous class into a Prototypeable one (Using `Reflection`?).  
- Add ability to use some kind of [Attributes](https://www.php.net/manual/en/language.attributes.overview.php) to functions, classes and methods in order to add them as methods to a class, instead of manually adding them.  
- Add the ability to define prototype methods that has been already defined as prototypes, overwriting them.  
- Add the ability to define prototypes for all the Prototypeable classes. (do you see any use cases?)  
