<?php

function generateNewUser($count = Null, $method = 'make')
{
   $generate = factory('App\Model\User', $count)->$method();
   $newUser = json_decode($generate, true);
   return $newUser;
}

function generateNewEmptyUser($count = Null, $method = 'make')
{
   $generate = factory('App\Model\User', 'noDetail', $count)->$method();
   $newUser = json_decode($generate, true);
   return $newUser;
}