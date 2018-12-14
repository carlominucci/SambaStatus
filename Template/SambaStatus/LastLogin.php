<?php
$command = "sudo net ads search '(objectCategory=User)' name lastLogon displayName";
$user = shell_exec($command);
$user_explose = explode("\n\n", $user);
unset($user_explose[0]);
echo count($user_explose) . " " . $T('TotalUser') . " - ";
$command = "sudo net ads search '(&(objectCategory=User)(lastLogon=0))' name | grep : | wc -l";
echo shell_exec($command) . " " . $T('NeverLogged') . "<hr />";

$megatmp="";
foreach($user_explose as $explose){
	$foo = explode("\n", $explose);
	$tmp = array();
	foreach($foo as $boh){
		$stecaz = explode(":", $boh);
		$tmp[$stecaz[0]] = $stecaz[1];
	}
	$megatmp .= $tmp[name] . "|" . $tmp[displayName] . "|";
	if($tmp[lastLogon] == 0){
                $megatmp .= "<i>" . $T('NeverLogged') . "</i>";
        }else{
                $megatmp .= date("r" , ($tmp[lastLogon]/10000000)-11644473600);
        }
	$megatmp .= "\n";
	unset($tmp);
}
echo "<table><tr><td><b>". $T('Username') . "</b></td><td><b>" . $T('DisplayName') . "</b></td><td><b>" . $T('LastLogin_Title') . "</b></td></tr>";
$megaarr=explode("\n", $megatmp);
asort($megaarr);

foreach($megaarr as $arr){
        echo "<tr><td>";
        echo str_ireplace("|", "</td><td>", $arr);
        echo "</td></tr>\n";
}
echo "</table>";
