# SCOM & Nagios PHP Dashboard
This is simple PHP dashboard for Nagios and Microsoft System Center Operations Manager. It uses Nagios "status.dat" file for showing Nagios service/host statuses and SCOM e-mail functions to show its alerts(using PHP IMAP).

#About this project
This is the first release of this dashboard and as I'm not very good developer, the code needs alot of tweaking. I am trying to update and fix it as much as possible. If you'd like to help me out, feel free to do so. Dashboard uses GPLv3 license.

#Picture example of the dashboard
![Alt text](http://i.imgur.com/BUJmphK.png "SCOM and Nagios Dashboard")

#Installation
Nagios
 - Change $statusFile variable in "json.php" file to your Nagios status.dat file's location. (You can find its location from Nagios.cfg file)
 - Move "json.php" to your Nagios webservers' DocumentRoot directory, so that .php file can be access outside of the server. You only have to do this step if your dashboard will run in different server (e.g. on Raspberry Pi). 
 - In "config.php", change "json_url" variable to your json.php address (e.g. $json_url = "http://192.168.56.200/json.php";)
 - After you've done that, dashboard should start showing Nagios' host && service statuses.

SCOM
 - Dashboard parses e-mail subject fields to show problems with hosts and services.
 - In SCOM, you have to make new E-mail notification channel and change e-mails subject format to:
```sh  
$Data[Default='Not Present']/Context/DataItem/AlertName$|$Data[Default='Not Present']/Context/DataItem/ManagedEntityPath$|$Data[$Data[Default='Not Present']/Context/DataItem/LastModifiedLocal$|$Data[Default='Not Present']/Context/DataItem/Severity$|
```
 - Next you have configure your e-mail servers settings for PHP to connect to mailbox. There are 2 functions in "functions.php" ("email" and "critical_email_count") in which you have to set the settings.

If you use Microsoft Exchange, you may run into problem with Kerberos authentication. To fix it, I used the following [guide].
#Credits
Big thanks to:
- [Simple PHP 5 Nagios Dashboard by RaymiiOrg] - GPLv3
- [PHP Nagios JSON by Christian Lizell] - GPLv3
- [Job van der Voort], Design
- Twitter Bootstrap 3

[guide]:http://forums.kayako.com/threads/fix-kerberos-error-on-email-parser.29626/
[Simple PHP 5 Nagios Dashboard by RaymiiOrg]:https://github.com/RaymiiOrg/simple-nagios-dashboard
[PHP Nagios JSON by Christian Lizell]:https://github.com/lizell/php-nagios-json
[Job van der Voort]:https://github.com/JobV
