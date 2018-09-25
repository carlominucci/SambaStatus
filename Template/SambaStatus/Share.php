<?php
echo $view->header()->setAttribute('template', $T('Shared'));

$ver = shell_exec("cat /etc/nethserver-release | awk '{print $3}'");
$ver = explode(".", $ver);
if($ver[0] > 6){ $sudo = "sudo ";}
/* thanks to @mrmarkuz, @Ctek and @netbix */

echo "<div class=\"DataTable \" >";
echo "<table><thead>";
echo "<tr><th>" . $T('Share') . "</th><th>" . $T('Hostname') . "</th><th>" . $T('Date') . "</th><thead><tbody>\n";
$command= $sudo . "smbstatus -S | grep CEST | awk '{print $1 \"\t\" $3 \"\t\" $4\"/\"$5\"/\"$6 \" \" $7}' | sort";
$locked = shell_exec($command);
$locked_files = explode("\n", chop($locked));
foreach($locked_files as $file){
	$file_tmp = explode("\t", $file);
	echo "<tr><td>" . $file_tmp[0] . "</td><td>" . $file_tmp[1] . "</td><td>" . $file_tmp[2] . "</td></tr>";
}
echo "<tbody></table>\n";
echo "</div>\n";

