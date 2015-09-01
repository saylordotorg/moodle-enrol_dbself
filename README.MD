#Enrol DBSelf plugin for Moodle#

This plugin is a modification of the base external database enrol plugin that enrols the student in a self-enrol instance. Unlike the base plugin, this allows the student to control their own enrolment and unenrol from the synced course at will.

The master branch also syncs both 'in progress' and 'completed' courses from the external database, and if completed, syncs the course enrolment date, course completion date, marks the course as complete, and syncs the course grade as a final exam grade (if the final is in the format "COURSEXXX: Final Exam"). This branch, however, uses assumptions based on the saylor.org ePortfolio system and may need to be modified for your own use.

##Installation##

- Copy the moodle-enrol_dbself folder to {{moodle-dir}}/enrol/dbself
- Enter in the information on the settings page  for "External database (Self)" (Site Administration->Plugins->Enrolments->Manage enrol plugins) and then enable the plugin

Each user's enrolment information will now sync each time that user logs in. To refresh, they must log out log back in.

###CLI Sync##

There is also the option to sync ALL users' enrolment and course completion information at the same time from the CLI. To do so, run the following command (assuming the web server is running under the www-data user):

```
sudo -u www-data /usr/bin/php {{moodle-dir}}/enrol/dbself/cli/sync.php
```
