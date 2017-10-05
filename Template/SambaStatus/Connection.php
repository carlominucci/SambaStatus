<?php
echo $view->header()->setAttribute('template', $T('ActiveConnections'));

$command = "getent group domadmins | cut -d \":\" -f4";
/* thanks to @davidep */

$admin = shell_exec($command);
$admin_users = explode(",", $admin);

$ver = shell_exec("cat /etc/nethserver-release | awk '{print $3}'");
$ver = explode(".", $ver);
if($ver[0] > 6){ 
	$command = "sudo smbstatus -b | sed -e '1,4d' | col --tabs | awk '{print $2 \"\t\" $4 \"\t\" $5}' | sort -h";
}elseif($ver[0] < 7){
	$command = "smbstatus -b | sed -e '1,4d' | awk '{print $2 \"\t\" $4 \"\t\" $5}' | sort -h";
}

/* thanks to @mrmarkuz, @Ctek and @netbix */

$admin = shell_exec($command);
$admin_users = explode(",", $admin);
echo "<div class=\"DataTable \" >";
echo "<table>\n";
echo "<tr><td><b>" . $T('Username') . "</b></td><td><b>" . $T('Hostname') . "</b></td><td><b>" . $T('IPAddress') . "</b></td></tr>\n<tbody>\n";

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
