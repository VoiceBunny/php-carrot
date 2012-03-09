# PHP Carrot - VoiceBunny Library

[PHP Carrot](https://github.com/VoiceBunny/php-carrot) is a PHP class that provides connection to the [VoiceBunny.com](http://voicebunny.com) HTTP RESTful API.
If you need more information on how to use our module check the [installation guide](https://github.com/VoiceBunny/php-carrot/wiki/installation) or the [tutorial](https://github.com/VoiceBunny/php-carrot/wiki/Use-tutorial).

### Basic usage

```php
# Import
require_once('lib/VoiceBunnyCarrot.php');

# Initialize the module
$vb_carrot = new VoiceBunnyCarrot('0','XXX');


# Get information
$response = $vb_carrot->gender_ages();
echo response['genderandages'];

# Post project
$project= array(
    'script' => "Test project",
    'specialInstructions' => "Posted from Ruby-Carrot",
    'title' => "Test Project" 
);
$response = $vb_carrot->create_project(project);
echo response['project'];

# Get a project
$response = $vb_carrot->get_project($response['project']['id']);
echo response['projects'];
```

### Request a VoiceBunny API Token
To use this library you need to request an API Token in the [VoiceBunny.com Developer's Section](http://voicebunny.com/developers/token).

### Don't you like PHP?
If you're not confortable with PHP language, you can also check our other libraries

* [Python Carrot](https://github.com/VoiceBunny/python-carrot)
* [Ruby Carrot](https://github.com/VoiceBunny/ruby-carrot)
* [Groovy Carrot](https://github.com/VoiceBunny/groovy-carrot)

Or why not, build your own library/module from scratch checking the [API documentation](http://voicebunny.com/developers/index).

### Copyright

Copyright (c) 2008 Torrenegra IP, LLC. Distributed under Creative Commons [CC-BY license](http://creativecommons.org/licenses/by/3.0/).