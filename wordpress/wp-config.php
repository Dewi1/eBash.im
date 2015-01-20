<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи и ABSPATH. Дополнительную информацию можно найти на странице
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется скриптом для создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения вручную.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'testing');

/** Имя пользователя MySQL */
define('DB_USER', 'admin');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'password');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'fS8E6=n-O@9[uG>--A(_dP6*-C7v$[s+GSSko+Y{x[$3kf6er!cA[=I`<H&%[kn0');
define('SECURE_AUTH_KEY',  'xsMHMsz?-|zY{|nQoNNpn2S>|]rvY317Ve11zq[5(bY#7tdbQ|-8$)qPd@p<kr%+');
define('LOGGED_IN_KEY',    'zz?1(GScM&cR2c?0IE ^oI>$_P&pXhtJPLZ>*Sy I:r2tHxKLGLHBT39%2h[nhM ');
define('NONCE_KEY',        '=czcG<d|`-<ph+J^2-Yr7Xbs8)hwg-PDo@,I8=J%hEFmL_,u4rdS&fNlc{BiZ<a,');
define('AUTH_SALT',        '1~AyJQ:hmu&|fQM~Kgr3E9=UW4)`hvP*N%l36iW!}?]ab;M2/-|)WcQnl{O>_f^M');
define('SECURE_AUTH_SALT', '%X4uO-@I(N-er;Qy--~Q:>uYga)Q+bshnnee7+=i!zQ}mq&?}a#+?Vx ?O*}Dxsl');
define('LOGGED_IN_SALT',   '-*Q[pS8.;<l=90RmIpTZj_V(i3Co4j^,.cfoai#ePF-  @Z+R;>(KSAO(n%zPzl!');
define('NONCE_SALT',       'j0CKO4T6Fd`-k6B3C-U+J|H{,b+61 a0pO.:wKUyq:u}I}cVcJXt0%]-3.Q|AJy ');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', true);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
