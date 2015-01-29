AB-test
=======
A/B Testing library for CodeIgniter 1.7.3

Installation
-----------
The feature and feature_x_abgroup tables need to be added. An ab_group field needs to be added to your user table.

In order for the system to work, each user must have an ab_group assigned to them.
I recommend you add an ab_group field to your user table.
Then you would assign a random integer between 0 and 9 to each user assuming you wanted 10 ab groups.
You also need something in place to assign a random digit when a new user is created.

The php library (ab) should be loaded by your auth library. 
Once you have an authenticated user and know the ab group they are assigned to,
you can pass that ab group to as a paramter to the ab class constructor.

The AUTH AB testing library consists of:   
###tables: 
- feature
- feature_x_abgroup

###js:
- js/AUTH-AB.js

###php:
- /application/libraries/ab.php
- /application/models/feature_model.php

Use
---
####PHP
#####Methods are:
- isFeatureA($tag)
- isFeatureB($tag)
- execute($tag, $argsB, $argsA)

$argsA in the execute method is optional. If not provided, nothing will execute for A group members.

#####$argsX structure

        $arg = array(
                'obj'       => $this->CI->myLibrary, // optional - method can be custom or core function
                'method'    => 'myMethod', 
                'params'    => array('key1' => 'value1') // optional
        );

####JS
The JS library (AB) is loaded into the AUTH namespace
- AUTH.AB.isFeatureA(tag)
- AUTH.AB.isFeatureB(tag)
- AUTH.AB.execute(tag, callbackB, callbackA)

callbackA is optional. If not provided, nothing will execute for A group members.

callback params can be static routes, functions, or objects containing an object and function
