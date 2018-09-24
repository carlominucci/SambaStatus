<?php
echo $view->header()->setAttribute('template', $T('ActiveConnections'));

$ver = shell_exec("cat /etc/nethserver-release | awk '{print $3}'");
$ver = explode(".", $ver);
if($ver[0] > 6){ $sudo = "sudo ";}
/* thanks to @mrmarkuz, @Ctek and @netbix */

$command = "getent group domadmins | cut -d \":\" -f4";
/* thanks to @davidep */

$admin = shell_exec($command);
$admin_users = explode(",", $admin);
echo "<div class=\"DataTable \" >";
echo "<table><thead>\n";
echo "<tr><th>" . $T('Username') . "</th><th>" . $T('IPAddress') . "</th></tr><thead><tbody>\n";

$command = $sudo . "smbstatus -b | sed -e '1,4d' | awk '{print $2 \"\t\" $5}' | sort -h";
$admin_shell = shell_exec($command);
$admins = explode("\n", chop($admin_shell));
foreach($admins as $admin){
        $admin_tmp = explode("\t", $admin);
	echo "<tr><td>";
	if(in_array($admin_tmp[0], $admin_users)){
		echo "<i>$admin_tmp[0]</i>";
	}else{
		echo $admin_tmp[0];
	}
	if($admin_tmp[2] == ""){
		echo "</td><td>" . $admin_tmp[1] . "</td></tr>\n";
	}else{
		echo "</td><td>" . $admin_tmp[1] . "</td></tr>\n";
	}
}
echo "<tbody></table>\n";
echo "</div>\n";
