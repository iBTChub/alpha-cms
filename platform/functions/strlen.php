<?php

# Функция определения длины строки (str_length)
function str($str)
{
  $str = sanitize_input($str);
  return mb_strlen($str, 'UTF-8');
}