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
 * @package    enrol_dbself
 * @copyright  2010 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {

    //--- general settings -----------------------------------------------------------------------------------
    $settings->add(new admin_setting_heading('enrol_dbself_settings', '', get_string('pluginname_desc', 'enrol_dbself')));

    $settings->add(new admin_setting_heading('enrol_dbself_exdbheader', get_string('settingsheaderdb', 'enrol_dbself'), ''));

    $options = array('', "access","ado_access", "ado", "ado_mssql", "borland_ibase", "csv", "db2", "fbsql", "firebird", "ibase", "informix72", "informix", "mssql", "mssql_n", "mssqlnative", "mysql", "mysqli", "mysqlt", "oci805", "oci8", "oci8po", "odbc", "odbc_mssql", "odbc_oracle", "oracle", "postgres64", "postgres7", "postgres", "proxy", "sqlanywhere", "sybase", "vfp");
    $options = array_combine($options, $options);
    $settings->add(new admin_setting_configselect('enrol_dbself/dbtype', get_string('dbtype', 'enrol_dbself'), get_string('dbtype_desc', 'enrol_dbself'), '', $options));

    $settings->add(new admin_setting_configtext('enrol_dbself/dbhost', get_string('dbhost', 'enrol_dbself'), get_string('dbhost_desc', 'enrol_dbself'), 'localhost'));

    $settings->add(new admin_setting_configtext('enrol_dbself/dbuser', get_string('dbuser', 'enrol_dbself'), '', ''));

    $settings->add(new admin_setting_configpasswordunmask('enrol_dbself/dbpass', get_string('dbpass', 'enrol_dbself'), '', ''));

    $settings->add(new admin_setting_configtext('enrol_dbself/dbname', get_string('dbname', 'enrol_dbself'), get_string('dbname_desc', 'enrol_dbself'), ''));

    $settings->add(new admin_setting_configtext('enrol_dbself/dbencoding', get_string('dbencoding', 'enrol_dbself'), '', 'utf-8'));

    $settings->add(new admin_setting_configtext('enrol_dbself/dbsetupsql', get_string('dbsetupsql', 'enrol_dbself'), get_string('dbsetupsql_desc', 'enrol_dbself'), ''));

    $settings->add(new admin_setting_configcheckbox('enrol_dbself/dbsybasequoting', get_string('dbsybasequoting', 'enrol_dbself'), get_string('dbsybasequoting_desc', 'enrol_dbself'), 0));

    $settings->add(new admin_setting_configcheckbox('enrol_dbself/debugdb', get_string('debugdb', 'enrol_dbself'), get_string('debugdb_desc', 'enrol_dbself'), 0));



    $settings->add(new admin_setting_heading('enrol_dbself_localheader', get_string('settingsheaderlocal', 'enrol_dbself'), ''));

    $options = array('id'=>'id', 'idnumber'=>'idnumber', 'shortname'=>'shortname');
    $settings->add(new admin_setting_configselect('enrol_dbself/localcoursefield', get_string('localcoursefield', 'enrol_dbself'), '', 'idnumber', $options));

    $options = array('id'=>'id', 'idnumber'=>'idnumber', 'email'=>'email', 'username'=>'username'); // only local users if username selected, no mnet users!
    $settings->add(new admin_setting_configselect('enrol_dbself/localuserfield', get_string('localuserfield', 'enrol_dbself'), '', 'idnumber', $options));

    $options = array('id'=>'id', 'shortname'=>'shortname');
    $settings->add(new admin_setting_configselect('enrol_dbself/localrolefield', get_string('localrolefield', 'enrol_dbself'), '', 'shortname', $options));

    $options = array('id'=>'id', 'idnumber'=>'idnumber');
    $settings->add(new admin_setting_configselect('enrol_dbself/localcategoryfield', get_string('localcategoryfield', 'enrol_dbself'), '', 'id', $options));


    $settings->add(new admin_setting_heading('enrol_dbself_remoteheader', get_string('settingsheaderremote', 'enrol_dbself'), ''));

    $settings->add(new admin_setting_configtext('enrol_dbself/remoteenroltable', get_string('remoteenroltable', 'enrol_dbself'), get_string('remoteenroltable_desc', 'enrol_dbself'), ''));

    $settings->add(new admin_setting_configtext('enrol_dbself/remotecoursefield', get_string('remotecoursefield', 'enrol_dbself'), get_string('remotecoursefield_desc', 'enrol_dbself'), ''));

    $settings->add(new admin_setting_configtext('enrol_dbself/remoteuserfield', get_string('remoteuserfield', 'enrol_dbself'), get_string('remoteuserfield_desc', 'enrol_dbself'), ''));

    $settings->add(new admin_setting_configtext('enrol_dbself/remoterolefield', get_string('remoterolefield', 'enrol_dbself'), get_string('remoterolefield_desc', 'enrol_dbself'), ''));

    $otheruserfieldlabel = get_string('remoteotheruserfield', 'enrol_dbself');
    $otheruserfielddesc  = get_string('remoteotheruserfield_desc', 'enrol_dbself');
    $settings->add(new admin_setting_configtext('enrol_dbself/remoteotheruserfield', $otheruserfieldlabel, $otheruserfielddesc, ''));

    $coursestatusfieldlabel = get_string('remotecoursestatusfield', 'enrol_dbself');
    $coursestatusfielddesc  = get_string('remotecoursestatusfield_desc', 'enrol_dbself');
    $settings->add(new admin_setting_configtext('enrol_dbself/remotecoursestatusfield', $coursestatusfieldlabel, $coursestatusfielddesc, ''));

    $coursestatuscurrentfieldlabel = get_string('remotecoursestatuscurrentfield', 'enrol_dbself');
    $coursestatuscurrentfielddesc  = get_string('remotecoursestatuscurrentfield_desc', 'enrol_dbself');
    $settings->add(new admin_setting_configtext('enrol_dbself/remotecoursestatuscurrentfield', $coursestatuscurrentfieldlabel, $coursestatuscurrentfielddesc, ''));

    $coursestatuscompletedfieldlabel = get_string('remotecoursestatuscompletedfield', 'enrol_dbself');
    $coursestatuscompletedfielddesc  = get_string('remotecoursestatuscompletedfield_desc', 'enrol_dbself');
    $settings->add(new admin_setting_configtext('enrol_dbself/remotecoursestatuscompletedfield', $coursestatuscompletedfieldlabel, $coursestatuscompletedfielddesc, ''));

    $coursegradefieldlabel = get_string('remotecoursegradefield', 'enrol_dbself');
    $coursegradefielddesc  = get_string('remotecoursegradefield_desc', 'enrol_dbself');
    $settings->add(new admin_setting_configtext('enrol_dbself/remotecoursegradefield', $coursegradefieldlabel, $coursegradefielddesc, ''));

    $courseenroldatefieldlabel = get_string('remotecourseenroldatefield', 'enrol_dbself');
    $courseenroldatefielddesc  = get_string('remotecourseenroldatefield_desc', 'enrol_dbself');
    $settings->add(new admin_setting_configtext('enrol_dbself/remotecourseenroldatefield', $courseenroldatefieldlabel, $courseenroldatefielddesc, ''));

    $coursecompletiondatefieldlabel = get_string('remotecoursecompletiondatefield', 'enrol_dbself');
    $coursecompletiondatefielddesc  = get_string('remotecoursecompletiondatefield_desc', 'enrol_dbself');
    $settings->add(new admin_setting_configtext('enrol_dbself/remotecoursecompletiondatefield', $coursecompletiondatefieldlabel, $coursecompletiondatefielddesc, ''));

    if (!during_initial_install()) {
        $options = get_default_enrol_roles(context_system::instance());
        $student = get_archetype_roles('student');
        $student = reset($student);
        $settings->add(new admin_setting_configselect('enrol_dbself/defaultrole', get_string('defaultrole', 'enrol_dbself'), get_string('defaultrole_desc', 'enrol_dbself'), $student->id, $options));
    }

    $settings->add(new admin_setting_configcheckbox('enrol_dbself/ignorehiddencourses', get_string('ignorehiddencourses', 'enrol_dbself'), get_string('ignorehiddencourses_desc', 'enrol_dbself'), 0));

    $options = array(ENROL_EXT_REMOVED_UNENROL        => get_string('extremovedunenrol', 'enrol'),
                     ENROL_EXT_REMOVED_KEEP           => get_string('extremovedkeep', 'enrol'),
                     ENROL_EXT_REMOVED_SUSPEND        => get_string('extremovedsuspend', 'enrol'),
                     ENROL_EXT_REMOVED_SUSPENDNOROLES => get_string('extremovedsuspendnoroles', 'enrol'));
    $settings->add(new admin_setting_configselect('enrol_dbself/unenrolaction', get_string('extremovedaction', 'enrol'), get_string('extremovedaction_help', 'enrol'), ENROL_EXT_REMOVED_UNENROL, $options));



    $settings->add(new admin_setting_heading('enrol_dbself_newcoursesheader', get_string('settingsheadernewcourses', 'enrol_dbself'), ''));

    $settings->add(new admin_setting_configtext('enrol_dbself/newcoursetable', get_string('newcoursetable', 'enrol_dbself'), get_string('newcoursetable_desc', 'enrol_dbself'), ''));

    $settings->add(new admin_setting_configtext('enrol_dbself/newcoursefullname', get_string('newcoursefullname', 'enrol_dbself'), '', 'fullname'));

    $settings->add(new admin_setting_configtext('enrol_dbself/newcourseshortname', get_string('newcourseshortname', 'enrol_dbself'), '', 'shortname'));

    $settings->add(new admin_setting_configtext('enrol_dbself/newcourseidnumber', get_string('newcourseidnumber', 'enrol_dbself'), '', 'idnumber'));

    $settings->add(new admin_setting_configtext('enrol_dbself/newcoursecategory', get_string('newcoursecategory', 'enrol_dbself'), '', ''));

    require_once($CFG->dirroot.'/enrol/dbself/settingslib.php');

    $settings->add(new enrol_dbself_admin_setting_category('enrol_dbself/defaultcategory', get_string('defaultcategory', 'enrol_dbself'), get_string('defaultcategory_desc', 'enrol_dbself')));

    $settings->add(new admin_setting_configtext('enrol_dbself/templatecourse', get_string('templatecourse', 'enrol_dbself'), get_string('templatecourse_desc', 'enrol_dbself'), ''));
}
