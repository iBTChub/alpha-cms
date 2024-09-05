<?php

# Общая функция для обработки текста (проверка на null).
function sanitize_input($text)
{
  // Возвращает пустую строку, если $text равен null.
  return $text ?? '';
}

# Полное удаление символов из текста без замены.
function clearspecialchars($text)
{
  $text = sanitize_input($text);
  // Используем одиночный массив для замены символов.
  $special_chars = array_merge(
    ['?', '[', ']', '/', '\\', '=', '<', '>', ':', ';', ',', "'", '"', '&', '$', '#', '*', '(', ')', '|', '~', '`', '!', '{', '}', '%', '+', chr(0)],
    ['%20', '+']
  );
  // Замена специфического пробела.
  $text = preg_replace("#\x{00a0}#siu", ' ', $text);
  // Удаление спецсимволов.
  $text = str_replace($special_chars, '', $text);
  // Удаление ненужных символов с краев.
  $text = trim($text, '.-_');

  return htmlspecialchars($text);
}

# Абсолютный текст с фильтрацией без бб-кодов, смайлов и т.п.
function tabs($text)
{
  $text = sanitize_input($text);
  // Более строгая фильтрация.
  return stripslashes(htmlspecialchars($text, ENT_QUOTES, 'UTF-8'));
}

# Фильтрация текста перед записью в базу данных.
function esc($text)
{
  $text = sanitize_input($text);
  // Экранирование символов для SQL.
  return addslashes($text);
}
