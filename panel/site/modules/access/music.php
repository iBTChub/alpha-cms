<?php

$type = 'private_music';
$type_tumb = 'pm';
$type_ini = 'PRIVATE_MUSIC';
$type_text = "Музыка и аудиоальбомы";

?>

<div id='<?=$type?>'>
  
<?php

if (config($type_ini) == 0){
  
  $value = 1;
  $tumb = "tumb";
  
}else{
  
  $value = 0;
  $tumb = "tumb2";
  
}
  
if (get('private') == $type){
  
  ini::upgrade(ROOT.'/system/config/global/settings.ini', $type_ini, $value);
  
}

?>

</div>

<div class='list-menu'>
  
<b><?=icons('music', 18, 'fa-fw')?> <?=lg($type_text)?></b>
<input onclick="request('/admin/site/modules/?get=main&mod=index&private=<?=$type?>', '#<?=$type?>')" class="input-tumb" type="checkbox" id="<?=$type_tumb?>"><label class="<?=$tumb?> thumb-optimize" for="<?=$type_tumb?>"></label></input>
  
</div>