<?php
//echo $view->header()->setAttribute('template', $T('LockedFiles'));

$command = "sudo net ads search '(objectCategory=User)' name lastLogon | grep \":\" | tr -d \"\n\" | sed -e 's/name\: /,/g' | sed -e 's/lastLogon\: /|/g' | tr -s \",\" \"\n\" | sort";
$user = shell_exec($command);
$arruser = explode("\n", $user);
echo count($arruser) . " Total users - ";
$command = "sudo net ads search '(&(objectCategory=User)(lastLogon=0))' name | grep : | wc -l";
echo shell_exec($command) . " Never logged in";
echo "<hr />";
echo "<table><tr><td><b>Username</b></td><td><b>Last Login Date</b></td></tr>";
unset($arruser[0]);
foreach($arruser as $arr){
	$tmp = explode("|", $arr);
	echo "<tr><td>". $tmp[0] . "</td><td>";	
	if($tmp[1] == 0){
		echo "<i>Never logged in</i>";
	}else{
		echo date("r" , ($tmp[1]/10000000)-11644473600);
	}
	echo "</td></tr>";
}
echo "</table>";
