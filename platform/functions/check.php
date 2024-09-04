<?php

# Абсолютный текст с фильтрацией без бб-кодов, смайлов и т.п.
function tabs($text) {
  if (!is_string($text)) {
      $text = '';
  }
  return stripslashes(htmlspecialchars($text, ENT_QUOTES, 'UTF-8'));
}