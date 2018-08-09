<?php

/**
 * Restjson
 *
 * @package    webservice
 * @subpackage restjson
 * @copyright  &copy; 2018 Kineo Pacific {@link http://kineo.com.au}
 * @author     tri.le
 * @version    1.0
 */
/* @var $DB moodle_database */
/* @var $CFG moodle_config */

defined('MOODLE_INTERNAL') || die();

function xmldb_webservice_restjson_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2016021901) {
        $table = new xmldb_table('restjson_log');

        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('functionname', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null);
        $table->add_field('parameters', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);
        $table->add_field('response', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);
        $table->add_field('timecreated', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);

        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        upgrade_plugin_savepoint(true, 2016021901, 'webservice', 'restjson');
    }

    return true;
}
