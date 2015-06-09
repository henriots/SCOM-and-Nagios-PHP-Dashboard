<?php
# Copyright (C) 2015 Henri Ots
#
# This code is a modification of Remy van Elst config.php file. The project can be found from : https://github.com/RaymiiOrg/simple-nagios-dashboard
# Design footprint: Job van der Voort
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program. If not, see <http://www.gnu.org/licenses/>.
require_once("./functions.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php print($organization); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Henri Ots">
    <meta http-equiv="refresh" content="25">
    <link href="//netdna.bootstrapcdn.com/bootswatch/3.0.2/united/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
		h3 {
			font-size:35px;
		}
		body {
			font-size:33px;
			text-align: center;
		}
        a {
            color: #333 !important;
        }
        .alert { 
            padding:5px 13px !important;
            border-radius: 0px !important;
            margin-bottom: 2px !important;
        }
		.alert-danger {
			color:#FFFFFF;
			background-color:red;
			border-color:red;
			}
		.alert-warning{
			color:#FFFFFF;
			background-color:#F39C12;
			border-color:#F39C12}
		.alert-info{
			color:#FFFFFF;
			background-color:#3498DB;
			border-color:#3498DB}
			
		.col-md-6{
			width:33%;
		}
		.alert-success{
			color:#FFFFFF;
			background-color:green;
			border-color:green;
			}
		
    </style>
</head>
<script>

function pageScroll() {
    	window.scrollBy(0,200); // horizontal and vertical scroll increments
    	scrolldelay = setTimeout('pageScroll()',10000); // scrolls every 100 milliseconds
		
};
window.onscroll = function(ev) {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
		clearTimeout(scrolldelay);
        location.reload();
		window.scrollTo(0, 0);
		setTimeout("",3000);
    }
};
</script>
<body >
	<script>
		setTimeout(pageScroll(),1000);
	</script>
	<div class="row">
        <div class="col-md-12">
        <?php
			$scom_hostid_critical = critical_email_count();
			//For printing out how many hosts and services in total are being monitored with Nagios
		  # print($hosts_total . " Hosts"); 
           #print("<br />" . $service_total . " Services<br />");
		   //
		   ##Checks to show red banner on top the screen if there are any critical problems in SCOM or in Nagios
           if($criticals_count > 0 || $host_issue_count > 0 || $scom_hostid_critical > 0) {
               print('<div class="alert alert-danger"><h1>');
                    #print('<script type="text/javascript">document.body.style.backgroundColor = "red";</script>');
				if($criticals_count > 0 && $scom_hostid_critical > 0 ) {
					print("Kriitilises seisus olevaid teenuseid: <b>");
					print(($criticals_count . " </b> + <b>" . $scom_hostid_critical . "</b><br/>"));
				}
                if($criticals_count > 0 && $scom_hostid_critical == 0 ) {
					print("Kriitilises seisus olevaid Nagiose teenuseid: <b>");
                    print(($criticals_count . " </b><br/>"));
					#print(($criticals_count . " </b> + <b>" . $scom_hostid_critical . "</b><br/>"));
                }
				if ($criticals_count == 0 && $scom_hostid_critical > 0) {
					print("Kriitilises seisus olevaid SCOM teenuseid: <b>");
                    print(($criticals_count . " </b><br/>"));
				}
                if ($host_issue_count > 0) {
                 print("Maas olevaid hoste: <b>" . $host_issue_count . "</b>" );
             } 
             print("<h2></div>");
         } elseif(($warnings_count) > 0) {
            print(($warnings_count));
            print(" mitte kriitilist teenust</h1></div>");
        } else {
           print('<div class="alert alert-success"><h1>');
           print(" Kõik OK!</h1></div>");
		}
        ?>
</div>
<div class="row">
	<div class="col-md-6">	
        <?php
		#Print out Critical Nagios Services
        service_alert_cards("Kriitilised teenused", "danger", $criticals_count, $criticals);
		?>	
    </div>
	<div class="col-md-6">
        <?php
		#Print out Nagios Services which are in Warning State
		service_alert_cards("Probleemsed teenused", "warning", $warnings_count, $warnings);
		print ("<br/>");
		#Print out "Acknwoledged" Nagios hosts services (warning and criticals)
        #service_alert_cards("Teadaolevad probleemsed teenused", "info", $warnings_ack_count, $warnings_ack_issues);
        service_alert_cards("Teadaolevad kriitilised teenused", "info", $criticals_ack_count, $criticals_ack);
		print ("<br/>");
		#Print out "Acknowledged" hosts
		host_alert_cards("Hostid, mis on määratud maasolevaks", "info", $host_ack_issues_count, $host_ack_issues);
	?>	
    </div>
    <div class="col-md-6">
		<?php
		#Print out SCOM ERRORS AND WARNINGS
        email();
        ?>
    </div>
</div>
<br />
<div class="row"> 
</div>
</body>
</html>
