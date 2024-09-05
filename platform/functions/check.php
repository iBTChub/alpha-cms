<?php

# Полное удаление символов из текста без замены

function clearspecialchars($text) {
  $text = $text ?? '';
  $special_chars = array('?', '[', ']', '/', '\\', '=', '<', '>', ':', ';', ',', "'", '"', '&', '$', '#', '*', '(', ')', '|', '~', '`', '!', '{', '}', '%', '+', chr(0));
  $text = preg_replace("#\x{00a0}#siu", ' ', $text);
  $text = str_replace($special_chars, '', $text);
  $text = str_replace(array('%20', '+'), '', $text);
  $text = trim($text, '.-_');	
  return htmlspecialchars($text);
}

# Абсолютный текст с фильтрацией без бб-кодов, смайлов и т.п.
function tabs($text)
{
  if (!is_string($text)) {
    $text = '';
  }
  return stripslashes(htmlspecialchars($text, ENT_QUOTES, 'UTF-8'));
}

# Фильтрация текста перед записью в базу данных
function esc($text)
{
  if (!is_string($text)) {
    $text = '';
  }
  return addslashes($text);
}