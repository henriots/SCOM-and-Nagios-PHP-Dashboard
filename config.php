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

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

$title = "Nagios && SCOM Dashboard";
$organization = "Your Organization";
#Set the Nagios servers url, where is the php script that is used to generated json
$json_url = "http://nagiosSRVip/json.php";
?>
