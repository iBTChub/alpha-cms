<?php

# Функция определения длины строки
function str($str)
{
  if (!is_string($str)) {
    $str = '';
  }
  $str = str_replace("\r\n", "", $str);
  return mb_strlen($str, 'UTF-8');
}