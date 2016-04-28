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
 * CLI sync for full external database synchronisation.
 *
 * Sample cron entry:
 * # 5 minutes past 4am
 * 5 4 * * * $sudo -u www-data /usr/bin/php /var/www/moodle/enrol/dbself/cli/sync.php
 *
 * Notes:
 *   - it is required to use the web server account when executing PHP CLI scripts
 *   - you need to change the "www-data" to match the apache user account
 *   - use "su" if "sudo" not available
 *
 * @package    enrol_dbself
 * @copyright  2010 Petr Skoda {@link http://skodak.org}, 2015 Saylor Academy {@link http://www.saylor.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('CLI_SCRIPT', true);

require(__DIR__.'/../../../config.php');
require_once("$CFG->libdir/clilib.php");

// Now get cli options.
list($options, $unrecognized) = cli_get_params(array('verbose'=>false, 'help'=>false), array('v'=>'verbose', 'h'=>'help'));

if ($unrecognized) {
    $unrecognized = implode("\n  ", $unrecognized);
    cli_error(get_string('cliunknowoption', 'admin', $unrecognized));
}

if ($options['help']) {
    $help =
"Execute enrol sync with external database.
The enrol_database plugin must be enabled and properly configured.

Options:
-v, --verbose         Print verbose progress information
-h, --help            Print out this help

Example:
\$ sudo -u www-data /usr/bin/php enrol/dbself/cli/sync.php

Sample cron entry:
# 5 minutes past 4am
5 4 * * * sudo -u www-data /usr/bin/php /var/www/moodle/enrol/dbself/cli/sync.php
";

    echo $help;
    die;
}

if (!enrol_is_enabled('dbself')) {
    cli_error('enrol_dbself_plugin plugin is disabled, synchronisation stopped', 2);
}

if (empty($options['verbose'])) {
	$verbose = false;
}
else {
	$verbose = true;
}

$moodleusers = $DB->get_records('user');

/** @var enrol_database_plugin $enrol  */
$enrol = enrol_get_plugin('dbself');
$result = 0;

echo("Beginning user enrolment syncronization.\n\n");

$totalusers = count($moodleusers);
$usernum = 1;

foreach ($moodleusers as $user) {

	if ($verbose) {
		echo($usernum."/".$totalusers."   Syncing user ".$user->email."\n");
	}
	$enrol->sync_user_enrolments($user);

	$usernum = $usernum + 1;
}

echo("Finished syncing user enrolments.\n");

$result=1;
exit($result);
