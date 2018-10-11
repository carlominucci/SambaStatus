<?php
echo $view->header()->setAttribute('template', $T('LockedFiles'));

$ver = shell_exec("cat /etc/nethserver-release | awk '{print $3}'");
$ver = explode(".", $ver);
if($ver[0] > 6){ $sudo = "sudo ";}
/* thanks to @mrmarkuz, @Ctek and @netbix */

echo "<div class=\"DataTable \" >";
echo "<table><thead>";
echo "<tr><td><b>" . $T('Username') . "</b></td><td><b>" . $T('IPAddress') . "</td><td><b>" . $T('Date') . " - " . $T('Share') . " - " . $T('LockedFiles') . "</b></td><thead><tbody>\n";
//thanks to @mrmarkuz
$command = $sudo . "smbstatus -b | grep \"@\" | awk '{print $2 \"\t\" $5 \"\t\" $1}' | sort -h | uniq";
$listusers = shell_exec($command);
$listusers_array = explode("\n", chop($listusers));
foreach($listusers_array as $users){
	$users_tmp = explode("\t", $users);
	echo "<tr><td>" . $users_tmp[0] . "</td><td>" . $users_tmp[1] . "</td><td>\n";

	// thanks to @MrE	
	$command = $sudo . "smbstatus -L | grep " . $users_tmp[2] . " | awk '{print $9 \" \" $10 \" \" $11 \" \" $12 \" \" $13 \" - \" $7 \"/\" $8}'";
	$locked = shell_exec($command);
	echo nl2br(str_replace("/var/lib/nethserver", "", $locked));

	echo "</td></tr>";
}
echo "<tbody></table>\n";
echo "</div>\n";

