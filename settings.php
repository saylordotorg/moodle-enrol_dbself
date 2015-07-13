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
 * @package    enrol_self_database
 * @copyright  2010 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {

    //--- general settings -----------------------------------------------------------------------------------
    $settings->add(new admin_setting_heading('enrol_self_database_settings', '', get_string('pluginname_desc', 'enrol_self_database')));

    $settings->add(new admin_setting_heading('enrol_self_database_exdbheader', get_string('settingsheaderdb', 'enrol_self_database'), ''));

    $options = array('', "access","ado_access", "ado", "ado_mssql", "borland_ibase", "csv", "db2", "fbsql", "firebird", "ibase", "informix72", "informix", "mssql", "mssql_n", "mssqlnative", "mysql", "mysqli", "mysqlt", "oci805", "oci8", "oci8po", "odbc", "odbc_mssql", "odbc_oracle", "oracle", "postgres64", "postgres7", "postgres", "proxy", "sqlanywhere", "sybase", "vfp");
    $options = array_combine($options, $options);
    $settings->add(new admin_setting_configselect('enrol_self_database/dbtype', get_string('dbtype', 'enrol_self_database'), get_string('dbtype_desc', 'enrol_self_database'), '', $options));

    $settings->add(new admin_setting_configtext('enrol_self_database/dbhost', get_string('dbhost', 'enrol_self_database'), get_string('dbhost_desc', 'enrol_self_database'), 'localhost'));

    $settings->add(new admin_setting_configtext('enrol_self_database/dbuser', get_string('dbuser', 'enrol_self_database'), '', ''));

    $settings->add(new admin_setting_configpasswordunmask('enrol_self_database/dbpass', get_string('dbpass', 'enrol_self_database'), '', ''));

    $settings->add(new admin_setting_configtext('enrol_self_database/dbname', get_string('dbname', 'enrol_self_database'), get_string('dbname_desc', 'enrol_self_database'), ''));

    $settings->add(new admin_setting_configtext('enrol_self_database/dbencoding', get_string('dbencoding', 'enrol_self_database'), '', 'utf-8'));

    $settings->add(new admin_setting_configtext('enrol_self_database/dbsetupsql', get_string('dbsetupsql', 'enrol_self_database'), get_string('dbsetupsql_desc', 'enrol_self_database'), ''));

    $settings->add(new admin_setting_configcheckbox('enrol_self_database/dbsybasequoting', get_string('dbsybasequoting', 'enrol_self_database'), get_string('dbsybasequoting_desc', 'enrol_self_database'), 0));

    $settings->add(new admin_setting_configcheckbox('enrol_self_database/debugdb', get_string('debugdb', 'enrol_self_database'), get_string('debugdb_desc', 'enrol_self_database'), 0));



    $settings->add(new admin_setting_heading('enrol_self_database_localheader', get_string('settingsheaderlocal', 'enrol_self_database'), ''));

    $options = array('id'=>'id', 'idnumber'=>'idnumber', 'shortname'=>'shortname');
    $settings->add(new admin_setting_configselect('enrol_self_database/localcoursefield', get_string('localcoursefield', 'enrol_self_database'), '', 'idnumber', $options));

    $options = array('id'=>'id', 'idnumber'=>'idnumber', 'email'=>'email', 'username'=>'username'); // only local users if username selected, no mnet users!
    $settings->add(new admin_setting_configselect('enrol_self_database/localuserfield', get_string('localuserfield', 'enrol_self_database'), '', 'idnumber', $options));

    $options = array('id'=>'id', 'shortname'=>'shortname');
    $settings->add(new admin_setting_configselect('enrol_self_database/localrolefield', get_string('localrolefield', 'enrol_self_database'), '', 'shortname', $options));

    $options = array('id'=>'id', 'idnumber'=>'idnumber');
    $settings->add(new admin_setting_configselect('enrol_self_database/localcategoryfield', get_string('localcategoryfield', 'enrol_self_database'), '', 'id', $options));


    $settings->add(new admin_setting_heading('enrol_self_database_remoteheader', get_string('settingsheaderremote', 'enrol_self_database'), ''));

    $settings->add(new admin_setting_configtext('enrol_self_database/remoteenroltable', get_string('remoteenroltable', 'enrol_self_database'), get_string('remoteenroltable_desc', 'enrol_self_database'), ''));

    $settings->add(new admin_setting_configtext('enrol_self_database/remotecoursefield', get_string('remotecoursefield', 'enrol_self_database'), get_string('remotecoursefield_desc', 'enrol_self_database'), ''));

    $settings->add(new admin_setting_configtext('enrol_self_database/remoteuserfield', get_string('remoteuserfield', 'enrol_self_database'), get_string('remoteuserfield_desc', 'enrol_self_database'), ''));

    $settings->add(new admin_setting_configtext('enrol_self_database/remoterolefield', get_string('remoterolefield', 'enrol_self_database'), get_string('remoterolefield_desc', 'enrol_self_database'), ''));

    $otheruserfieldlabel = get_string('remoteotheruserfield', 'enrol_self_database');
    $otheruserfielddesc  = get_string('remoteotheruserfield_desc', 'enrol_self_database');
    $settings->add(new admin_setting_configtext('enrol_self_database/remoteotheruserfield', $otheruserfieldlabel, $otheruserfielddesc, ''));

    $statusfieldlabel = get_string('remotestatusfield', 'enrol_self_database');
    $statusfielddesc  = get_string('remotestatusfield_desc', 'enrol_self_database');
    $settings->add(new admin_setting_configtext('enrol_self_database/remotestatusfield', $statusfieldlabel, $statusfielddesc, ''));

    if (!during_initial_install()) {
        $options = get_default_enrol_roles(context_system::instance());
        $student = get_archetype_roles('student');
        $student = reset($student);
        $settings->add(new admin_setting_configselect('enrol_self_database/defaultrole', get_string('defaultrole', 'enrol_self_database'), get_string('defaultrole_desc', 'enrol_self_database'), $student->id, $options));
    }

    $settings->add(new admin_setting_configcheckbox('enrol_self_database/ignorehiddencourses', get_string('ignorehiddencourses', 'enrol_self_database'), get_string('ignorehiddencourses_desc', 'enrol_self_database'), 0));

    $options = array(ENROL_EXT_REMOVED_UNENROL        => get_string('extremovedunenrol', 'enrol'),
                     ENROL_EXT_REMOVED_KEEP           => get_string('extremovedkeep', 'enrol'),
                     ENROL_EXT_REMOVED_SUSPEND        => get_string('extremovedsuspend', 'enrol'),
                     ENROL_EXT_REMOVED_SUSPENDNOROLES => get_string('extremovedsuspendnoroles', 'enrol'));
    $settings->add(new admin_setting_configselect('enrol_self_database/unenrolaction', get_string('extremovedaction', 'enrol'), get_string('extremovedaction_help', 'enrol'), ENROL_EXT_REMOVED_UNENROL, $options));



    $settings->add(new admin_setting_heading('enrol_self_database_newcoursesheader', get_string('settingsheadernewcourses', 'enrol_self_database'), ''));

    $settings->add(new admin_setting_configtext('enrol_self_database/newcoursetable', get_string('newcoursetable', 'enrol_self_database'), get_string('newcoursetable_desc', 'enrol_self_database'), ''));

    $settings->add(new admin_setting_configtext('enrol_self_database/newcoursefullname', get_string('newcoursefullname', 'enrol_self_database'), '', 'fullname'));

    $settings->add(new admin_setting_configtext('enrol_self_database/newcourseshortname', get_string('newcourseshortname', 'enrol_self_database'), '', 'shortname'));

    $settings->add(new admin_setting_configtext('enrol_self_database/newcourseidnumber', get_string('newcourseidnumber', 'enrol_self_database'), '', 'idnumber'));

    $settings->add(new admin_setting_configtext('enrol_self_database/newcoursecategory', get_string('newcoursecategory', 'enrol_self_database'), '', ''));

    require_once($CFG->dirroot.'/enrol/self_database/settingslib.php');

    $settings->add(new enrol_self_database_admin_setting_category('enrol_self_database/defaultcategory', get_string('defaultcategory', 'enrol_self_database'), get_string('defaultcategory_desc', 'enrol_self_database')));

    $settings->add(new admin_setting_configtext('enrol_self_database/templatecourse', get_string('templatecourse', 'enrol_self_database'), get_string('templatecourse_desc', 'enrol_self_database'), ''));
}
