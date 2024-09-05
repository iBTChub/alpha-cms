<?php
html::title('Контакты');
acms_header();

// Получаем последнюю запись контактов
$contact = db::get_string("SELECT * FROM `CONTACTS` ORDER BY `TIME` DESC LIMIT 1");

// Проверяем наличие прав доступа и существование контактной информации
if (access('contacts', null) && empty($contact)) {
    ?>
    <div class='list'>
        <a href='/m/contacts/add/' class='btn'><?=icons('pencil', 15, 'fa-fw')?> <?=lg('Добавить контактную информацию')?></a>
    </div>
    <?
} elseif (access('contacts', null)) {
    ?>
    <div class='list'>
        <a href='/m/contacts/edit/' class='btn'><?=icons('pencil', 15, 'fa-fw')?> <?=lg('Редактировать контактную информацию')?></a>
    </div>
    <?
}

// Проверяем, существуют ли контактные данные
if (!empty($contact)) {
    $contact_fields = ['EMAIL', 'PHONE', 'TELEGRAM', 'WHATSAPP', 'VIBER', 'VK', 'OK', 'FACEBOOK', 'TWITTER', 'INSTAGRAM', 'YOUTUBE', 'TIKTOK', 'MESSAGE', 'ADRESS'];

    // Проверка на наличие хотя бы одного заполненного поля
    $has_data = false;
    foreach ($contact_fields as $field) {
        if (str($contact[$field]) > 0) {
            $has_data = true;
            break;
        }
    }

    if ($has_data) {
        ?><div class='list-body'><?
        if (str($contact['ADRESS']) > 0) {
            ?>
            <div class='list-menu'>
                <b><?=lg('Адрес')?>:</b> <?=tabs($contact['ADRESS'])?>
            </div>
            <?
        }

        if (str($contact['EMAIL']) > 0) {
            ?>
            <div class='list-menu'>
                <b>Email:</b> <a href='mailto:<?=tabs($contact['EMAIL'])?>' ajax='no'><?=tabs($contact['EMAIL'])?></a>
            </div>
            <?
        }

        if (str($contact['PHONE']) > 0) {
            ?>
            <div class='list-menu'>
                <b><?=lg('Телефон')?>:</b> <a href='tel:<?=tabs($contact['PHONE'])?>' ajax='no'><?=tabs($contact['PHONE'])?></a>
            </div>
            <?
        }

        // Продолжаем выводить остальные поля, если они существуют
        foreach (['TELEGRAM', 'WHATSAPP', 'VIBER', 'VK', 'OK', 'FACEBOOK', 'TWITTER', 'INSTAGRAM', 'YOUTUBE', 'TIKTOK'] as $field) {
            if (str($contact[$field]) > 0) {
                ?>
                <div class='list-menu'>
                    <b><?=lg($field)?>:</b> <a href='<?=tabs($contact[$field])?>' ajax='no'><?=tabs($contact[$field])?></a>
                </div>
                <?
            }
        }

        if (str($contact['MESSAGE']) > 0) {
            ?>
            <div class='list-menu'>
                <?=tabs($contact['MESSAGE'])?>
            </div>
            <?
        }
        ?></div><?
    } else {
        html::empty('Пока пусто');
    }
} else {
    html::empty('Пока пусто');
}

back('/', 'На главную');
acms_footer();