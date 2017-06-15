<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Table SQL executor
 *
 * @package PhpMyAdmin
 */
use PMA\libraries\config\PageSettings;
use PMA\libraries\Response;

/**
 *
 */
require_once 'libraries/common.inc.php';
require_once 'libraries/config/user_preferences.forms.php';
require_once 'libraries/config/page_settings.forms.php';

PageSettings::showGroup('Sql_queries');

/**
 * Runs common work
 */
$response = Response::getInstance();
$header   = $response->getHeader();
$scripts  = $header->getScripts();
$scripts->addFile('makegrid.js');
$scripts->addFile('vendor/jquery/jquery.uitablefilter.js');
$scripts->addFile('sql.js');

require 'libraries/tbl_common.inc.php';
$url_query .= '&amp;goto=tbl_sql.php&amp;back=tbl_sql.php';

require_once 'libraries/sql_query_form.lib.php';

$err_url   = 'tbl_sql.php' . $err_url;
// After a syntax error, we return to this script
// with the typed query in the textarea.
$goto = 'tbl_sql.php';
$back = 'tbl_sql.php';

/**
 * Query box, bookmark, insert data from textfile
 */
$response->addHTML(
    PMA_getHtmlForSqlQueryForm(
        true, false,
        isset($_REQUEST['delimiter'])
        ? htmlspecialchars($_REQUEST['delimiter'])
        : ';'
    )
);
