JerRouteLayouts Module for Zend Framework 2
===============

Version 1.0.0 created by Juergen Eger

Introduction
---------------
JerRouteLayouts is a very simple ZF2 module (less than 50 lines) that simply allows you to specify alternative layouts to use for each route.
If no layout is defined for a specific route JerRouteLayouts is able to find layouts in parent routes too.

Usage
---------------
Using JerRouteLayouts is very, very simple. In any module config or autoloaded config file simply specify the following:

```php
array(
  'route_layouts' => array(
    //will be used for each child route under the "some" route. Except for the defined "some/route" route
    'some' => 'layout/some-layout',
    //will be used for each child route under the "some/route" route.
    'some/route' => 'layout/some-other-layout',
  ),
);
```

That's it!
