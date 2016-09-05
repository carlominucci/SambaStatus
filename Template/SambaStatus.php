<?php

echo $view->header()->setAttribute('template', $T('SambaStatus_Title'));

$command = "getent group domadmins | cut -d \":\" -f4";
/* thanks to @davidep */
$admin = shell_exec($command);
$admin_users = explode(",", $admin);

echo "<b>" . $T('ActiveConnections' ) . "</b>\n";
echo "<div class=\"DataTable \" >";
echo "<table><thead>\n";
echo "<tr><th>" . $T('Username') . "</th><th>" . $T('Hostname') . "</th><th>" . $T('IPAddress') . "</th></tr><thead><tbody>\n";

$command = "smbstatus -b | sed -e '1,4d' | awk '{print $2 \"\t\" $4 \"\t\" $5}' | sort -h";
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
		echo "</td><td> </td><td>" . $admin_tmp[1] . "</td></tr>\n";
	}else{
		echo "</td><td>" . $admin_tmp[1] . "</td><td>" . $admin_tmp[2] . "</td></tr>\n";
	}
}

echo "<tbody></table>\n";
echo "</div>\n";
echo "<br />\n";

echo "<b>" . $T('LockedFiles') . "</b><br />";
echo "<pre>\n";
$command= "smbstatus -L | sed -e '1,3d' | awk -F'/var/lib/nethserver' '{print $2}'";
$out = shell_exec($command);
echo $out;
echo "</pre>\n";

