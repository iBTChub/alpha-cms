<?php  
$account = db::get_string("SELECT `ID`,`LOGIN` FROM `USERS` WHERE `ID` = ? LIMIT 1", [$list['OBJECT_ID']]);
?>
<div class='notif-avatar'>
<a href='/id<?=$account['ID']?>'>
<?=user::avatar($account['ID'], 50)?>
</a>
<span class='notif-icon' style='background-color: #2196F3;'><?=icons('comment', 11, 'fa-fw')?></span>  
<?php   
if ($list['TIME'] + 3600 > TM){
  
  ?><br /><span class='notif-count'><?=lg('новое')?></span><?
  
}
?>  
</div>
  
<div class='notif-info'>
  
<a href='/id<?=$account['ID']?>'><b><?=$account['LOGIN']?></b></a> <?=lg('прокомментировал(-а) ваше фото')?> -   
  
<?php

$photo = db::get_string("SELECT `ID`,`NAME` FROM `PHOTOS` WHERE `ID` = ? LIMIT 1", [$list['OBJECT_ID_LIST']]);  
if (!isset($photo['ID'])){
  
  ?><font color='red'><?=lg('объект был удален')?></font><?
  
}else{
  
  ?>
  <a href='/m/photos/show/?id=<?=$photo['ID']?>'>  
  <?=tabs(crop_text($photo['NAME'], 0, 40))?>
  </a>
  <?
  
}
  
?>
  
<br /><br />
<span class='time'><?=ftime($list['TIME'])?></span>
  
</div>