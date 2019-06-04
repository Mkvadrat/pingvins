<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'pingvins' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '1234' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'gzVW=C HbOSP$Nmsz9mp,g7]znXx:on$Zaa@_hE31o0bE5UpN,1vU7Ryre3I:b!=' );
define( 'SECURE_AUTH_KEY',  ',Vma;6=oG%vEl~[C-k.k885#a}W|,1ri4>|fkdHn_WI0yZ?oRBu@%pws2~PFU7RQ' );
define( 'LOGGED_IN_KEY',    ';Wd#MpLAm-F[X6H|(sz>*INfXL6NBED>/Mv#.4^F(ZE(o|!6]NpN24f1~M&5d+i%' );
define( 'NONCE_KEY',        'o~q~u/JQT=:&K6`Au$+AO}E1iZuP655+582^YxJwm3,WBQ?AuYHd[gJ>L=vhCh~3' );
define( 'AUTH_SALT',        'Ob/eefSAZ<3=@ $FG/Ms@;n!/jT#{U/|DF4z~t#=#<X$[EoIefdNjwF:Y`.{$du)' );
define( 'SECURE_AUTH_SALT', ']JQvuqSq8L{r8-YS{;y.!y1-gx0AQy-iCptXstsr=:OB!3P9TS:uXS:L@=_N<B1}' );
define( 'LOGGED_IN_SALT',   'f,whl},y04O8IG{ 18-_[bLhUW?;+3KU25y1dq}Xp|0<EU(Bv+$`kLo|Dr2nSu8N' );
define( 'NONCE_SALT',       'hM?Ls1a#~7#=Lj^W6myeDSMk6B|bY`_VESsuEw>r^m*}*?PsR,@f;U[qXNcPu>; ' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
