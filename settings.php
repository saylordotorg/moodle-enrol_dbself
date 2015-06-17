<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Database enrolment plugin settings and presets.
 *
 * @package    enrol_database_self
 * @copyright  2010 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {

    //--- general settings -----------------------------------------------------------------------------------
    $settings->add(new admin_setting_heading('enrol_database_self_settings', '', get_string('pluginname_desc', 'enrol_database_self')));

    $settings->add(new admin_setting_heading('enrol_database_self_exdbheader', get_string('settingsheaderdb', 'enrol_database_self'), ''));

    $options = array('', "access","ado_access", "ado", "ado_mssql", "borland_ibase", "csv", "db2", "fbsql", "firebird", "ibase", "informix72", "informix", "mssql", "mssql_n", "mssqlnative", "mysql", "mysqli", "mysqlt", "oci805", "oci8", "oci8po", "odbc", "odbc_mssql", "odbc_oracle", "oracle", "postgres64", "postgres7", "postgres", "proxy", "sqlanywhere", "sybase", "vfp");
    $options = array_combine($options, $options);
    $settings->add(new admin_setting_configselect('enrol_database_self/dbtype', get_string('dbtype', 'enrol_database_self'), get_string('dbtype_desc', 'enrol_database_self'), '', $options));

    $settings->add(new admin_setting_configtext('enrol_database_self/dbhost', get_string('dbhost', 'enrol_database_self'), get_string('dbhost_desc', 'enrol_database_self'), 'localhost'));

    $settings->add(new admin_setting_configtext('enrol_database_self/dbuser', get_string('dbuser', 'enrol_database_self'), '', ''));

    $settings->add(new admin_setting_configpasswordunmask('enrol_database_self/dbpass', get_string('dbpass', 'enrol_database_self'), '', ''));

    $settings->add(new admin_setting_configtext('enrol_database_self/dbname', get_string('dbname', 'enrol_database_self'), get_string('dbname_desc', 'enrol_database_self'), ''));

    $settings->add(new admin_setting_configtext('enrol_database_self/dbencoding', get_string('dbencoding', 'enrol_database_self'), '', 'utf-8'));

    $settings->add(new admin_setting_configtext('enrol_database_self/dbsetupsql', get_string('dbsetupsql', 'enrol_database_self'), get_string('dbsetupsql_desc', 'enrol_database_self'), ''));

    $settings->add(new admin_setting_configcheckbox('enrol_database_self/dbsybasequoting', get_string('dbsybasequoting', 'enrol_database_self'), get_string('dbsybasequoting_desc', 'enrol_database_self'), 0));

    $settings->add(new admin_setting_configcheckbox('enrol_database_self/debugdb', get_string('debugdb', 'enrol_database_self'), get_string('debugdb_desc', 'enrol_database_self'), 0));



    $settings->add(new admin_setting_heading('enrol_database_self_localheader', get_string('settingsheaderlocal', 'enrol_database_self'), ''));

    $options = array('id'=>'id', 'idnumber'=>'idnumber', 'shortname'=>'shortname');
    $settings->add(new admin_setting_configselect('enrol_database_self/localcoursefield', get_string('localcoursefield', 'enrol_database_self'), '', 'idnumber', $options));

    $options = array('id'=>'id', 'idnumber'=>'idnumber', 'email'=>'email', 'username'=>'username'); // only local users if username selected, no mnet users!
    $settings->add(new admin_setting_configselect('enrol_database_self/localuserfield', get_string('localuserfield', 'enrol_database_self'), '', 'idnumber', $options));

    $options = array('id'=>'id', 'shortname'=>'shortname');
    $settings->add(new admin_setting_configselect('enrol_database_self/localrolefield', get_string('localrolefield', 'enrol_database_self'), '', 'shortname', $options));

    $options = array('id'=>'id', 'idnumber'=>'idnumber');
    $settings->add(new admin_setting_configselect('enrol_database_self/localcategoryfield', get_string('localcategoryfield', 'enrol_database_self'), '', 'id', $options));


    $settings->add(new admin_setting_heading('enrol_database_self_remoteheader', get_string('settingsheaderremote', 'enrol_database_self'), ''));

    $settings->add(new admin_setting_configtext('enrol_database_self/remoteenroltable', get_string('remoteenroltable', 'enrol_database_self'), get_string('remoteenroltable_desc', 'enrol_database_self'), ''));

    $settings->add(new admin_setting_configtext('enrol_database_self/remotecoursefield', get_string('remotecoursefield', 'enrol_database_self'), get_string('remotecoursefield_desc', 'enrol_database_self'), ''));

    $settings->add(new admin_setting_configtext('enrol_database_self/remoteuserfield', get_string('remoteuserfield', 'enrol_database_self'), get_string('remoteuserfield_desc', 'enrol_database_self'), ''));

    $settings->add(new admin_setting_configtext('enrol_database_self/remoterolefield', get_string('remoterolefield', 'enrol_database_self'), get_string('remoterolefield_desc', 'enrol_database_self'), ''));

    $otheruserfieldlabel = get_string('remoteotheruserfield', 'enrol_database_self');
    $otheruserfielddesc  = get_string('remoteotheruserfield_desc', 'enrol_database_self');
    $settings->add(new admin_setting_configtext('enrol_database_self/remoteotheruserfield', $otheruserfieldlabel, $otheruserfielddesc, ''));

    if (!during_initial_install()) {
        $options = get_default_enrol_roles(context_system::instance());
        $student = get_archetype_roles('student');
        $student = reset($student);
        $settings->add(new admin_setting_configselect('enrol_database_self/defaultrole', get_string('defaultrole', 'enrol_database_self'), get_string('defaultrole_desc', 'enrol_database_self'), $student->id, $options));
    }

    $settings->add(new admin_setting_configcheckbox('enrol_database_self/ignorehiddencourses', get_string('ignorehiddencourses', 'enrol_database_self'), get_string('ignorehiddencourses_desc', 'enrol_database_self'), 0));

    $options = array(ENROL_EXT_REMOVED_UNENROL        => get_string('extremovedunenrol', 'enrol'),
                     ENROL_EXT_REMOVED_KEEP           => get_string('extremovedkeep', 'enrol'),
                     ENROL_EXT_REMOVED_SUSPEND        => get_string('extremovedsuspend', 'enrol'),
                     ENROL_EXT_REMOVED_SUSPENDNOROLES => get_string('extremovedsuspendnoroles', 'enrol'));
    $settings->add(new admin_setting_configselect('enrol_database_self/unenrolaction', get_string('extremovedaction', 'enrol'), get_string('extremovedaction_help', 'enrol'), ENROL_EXT_REMOVED_UNENROL, $options));



    $settings->add(new admin_setting_heading('enrol_database_self_newcoursesheader', get_string('settingsheadernewcourses', 'enrol_database_self'), ''));

    $settings->add(new admin_setting_configtext('enrol_database_self/newcoursetable', get_string('newcoursetable', 'enrol_database_self'), get_string('newcoursetable_desc', 'enrol_database_self'), ''));

    $settings->add(new admin_setting_configtext('enrol_database_self/newcoursefullname', get_string('newcoursefullname', 'enrol_database_self'), '', 'fullname'));

    $settings->add(new admin_setting_configtext('enrol_database_self/newcourseshortname', get_string('newcourseshortname', 'enrol_database_self'), '', 'shortname'));

    $settings->add(new admin_setting_configtext('enrol_database_self/newcourseidnumber', get_string('newcourseidnumber', 'enrol_database_self'), '', 'idnumber'));

    $settings->add(new admin_setting_configtext('enrol_database_self/newcoursecategory', get_string('newcoursecategory', 'enrol_database_self'), '', ''));

    require_once($CFG->dirroot.'/enrol/database_self/settingslib.php');

    $settings->add(new enrol_database_self_admin_setting_category('enrol_database_self/defaultcategory', get_string('defaultcategory', 'enrol_database_self'), get_string('defaultcategory_desc', 'enrol_database_self')));

    $settings->add(new admin_setting_configtext('enrol_database_self/templatecourse', get_string('templatecourse', 'enrol_database_self'), get_string('templatecourse_desc', 'enrol_database_self'), ''));
}
