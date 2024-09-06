<?php

$date = date('Y');
$host = tabs(HTTP_HOST);

// Translate function
$translate = fn($text) => lg($text);

// Navigation icons
$navGeneralMenuIcon = fn($icon, $size) => icons($icon, $size);
$navDefaultMenuIcon = fn($icon, $size, $color, $checkColor) => m_icons($icon, $size, $color, $checkColor);

// User information
$userId = user('ID');
$userAvatar = user::avatar($userId, 80);
$userLogin = user::login_mini($userId);

$userBalance = money(user('MONEY'), 1);
$userBonuses = money(user('BALLS'), 1);

// Admin panel link
$showAdmin = access('administration_show', null, 1);
$htmlLinkAccess = $showAdmin ? "<a href='/admin/' ajax='no' class='panel-left-menu pfm_gray hover'>{$navDefaultMenuIcon('gear', 13, '#2F454F', 0)} {$translate('Control panel')}</a>" : '';

// Output HTML
echo <<<HTML
<div class="left">
  <div class="pfm">
HTML;

// User-specific content
if ($userId > 0) {
    $userContent = <<<HTML
    <div class='panel-left-phone'>
        <div class='message cabinet-phone'>
            <div class='mess-circle1'></div>
            <div class='mess-circle2'></div>
        </div>
    </div>
    <center style='margin-bottom: 10px'>
        <div class='list-tr-avatar panel-left-avatar'>
            <a href='/id{$userId}'>{$userAvatar}</a>
        </div>
        <div class='panel-left-login'>{$userLogin}</div>
        {$translate('Your account')}: <b>{$userBalance}</b> {$translate('UAH')}.
        <br />
        {$translate('Bonuses')}: <b>{$userBonuses}</b> {$translate('UAH')}.
        <div class='panel-left-menu-nav'>
            <div class='cabinet-menu'>
                <a href='/account/cabinet/'>{$navGeneralMenuIcon('th-large', 19)}</a>
                <span>{$translate('Cabinet')}</span>
            </div>
            <div class='cabinet-menu'>
                <a href='/shopping/'>{$navGeneralMenuIcon('shopping-basket', 19)}</a>
                <span>{$translate('Shop')}</span>
            </div>
            <div class='cabinet-menu'>
                <a href='/account/settings/'>{$navGeneralMenuIcon('gear', 19)}</a>
                <span>{$translate('Settings')}</span>
            </div>
            <div class='cabinet-menu'>
                <a href='/exit/' ajax='no'>{$navGeneralMenuIcon('power-off', 19)}</a>
                <span>{$translate('Exit')}</span>
            </div>
        </div>
    </center>
    $htmlLinkAccess
    <a class='panel-left-menu pfm_gray hover' href='/id{$userId}'>{$navDefaultMenuIcon('user', 11, '#2F454F', 0)} <span>{$translate('My page')}</span></a>
HTML;
} else {
    // Authentication form for guests
    ob_start();
    html::input('login', $translate('Login'), null, config('REG_STR'), null, 'form-control-100', 'text', null, 'user');
    html::input('password', $translate('Password'), null, 24, null, 'form-control-100', 'password', null, 'lock');
    if (session('captcha') == 1 && !url_request_validate('/login') && !url_request_validate('/registration') && !url_request_validate('/password')) {
        html::captcha($translate('Enter numbers'));
    }
    html::button('button', 'ok_aut', null, $translate('Login'));
    $formHtml = ob_get_clean();
    $userContent = <<<HTML
    <div class='panel-left-menu pfm_name'>
      {$translate('Authorization')}
    </div>
    <div class='panel-left-menu' style='box-sizing: border-box; border-bottom: 1px #EBF2F7 solid'>
      <form method='post' action='/login/'>
        $formHtml
        <br />
        <a href='/password/' class='aut'>{$translate('Forgot your password?')}</a>
        <a href='/registration/' style='float: right;' class='aut'>{$translate('Registration')}</a>
      </form>
    </div>
HTML;
}

// Output user content or authentication form
echo $userContent;

echo <<<HTML
    <!-- Site sections -->
    <div class='panel-left-menu pfm_name'>
      {$translate('Site sections')}
    </div>
HTML;

direct::components(ROOT . '/main/components/main_menu_small/', 0);

echo <<<HTML
      <!-- Footer content -->
      <div class='panel-left-menu'>
        <center>
          <span class='time'>
            © $date - {$translate('Interactive Brand & Technologies: Courses, Services & Business Hub')}
            <br />
            <br />
            {$translate('IE')} {$translate('Dovhopol')} {$translate('Mykola')} {$translate('Ivanovich')}
            <br />
            {$translate('EDRPOU')} / {$translate('RNNOVP')} 3484109139
            <br />
          </span>
        </center>
      </div>
    <div class='panel-top-optimize3'></div>
  </div>
</div>
HTML;
