AB-test
=======
A/B Testing library for CodeIgniter 1.7.3

Instalation
-----------
The AUTH AB testing library consists of:   
tables: 
feature
feature_x_abgroup
js:
js/AUTH-AB.js
php:
/application/libraries/ab.php
/application/models/feature_model.php

The php library (ab) should be loaded by your auth library. 
Once you have an authenticated user and know the ab group they are assigned to,
you can pass that ab group to as a paramter to the ab class constructor.

Methods are:
-isFeatureA($tag)
-isFeatureB($tag)
-execute($tag, $argsB, $argsA)

$argsA in the execute method is optional. If not provided, nothing will execute for A group members.

$argsX structure

$arg = array(
        'obj'       => $this->CI->myLibrary, // optional - method can be custom or core function
        'method'    => 'myMethod', 
        'params'    => array('key1' => 'value1') // optional
    );


The JS library (AB) is loaded into the JOGO namespace

    JOGO.AB.isFeatureA(tag)
    JOGO.AB.isFeatureB(tag)
    JOGO.AB.execute(tag, callbackB, callbackA)

callbackA is optional. If not provided, nothing will execute for A group members.

callback params can be static routes, functions, or objects containing an object and function




The JOGO AB testing library consists of:   

    tables
        feature
        feature_x_abgroup
    js
        /js/jogo-AB.js
    php
        /application/libraries/AB.php


In order for the system to work, each user must have an ab_group assigned to them.   For OJO Agent, the values are random between 0 and 9.   When a new user is created, a random digit is inserted into the user table.


