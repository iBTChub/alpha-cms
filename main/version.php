<?php

/*
------------------
Смена версии сайта
------------------
*/
  
setcookie('VERSION', tabs(get('name')), TM + 60*60*24*365, '/');
redirect('/');