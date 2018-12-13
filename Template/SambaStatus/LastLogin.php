<?php
//echo $view->header()->setAttribute('template', $T('LockedFiles'));

//$command = "sudo net ads search '(objectCategory=User)' name lastLogon displayName | grep \":\" | tr -d \"\n\" | sed -e 's/displayName\: /,/g' | sed -e 's/lastLogon\: /|/g' | sed -e 's/name\: /|/g' | tr -s \",\" \"\n\" | sort";
//$command = "sudo net ads search '(objectCategory=User)' name lastLogon displayName | grep \":\" | tr -d \"\n\" | sed -e 's/displayName\: /,/g' | sed -e 's/lastLogon\: /|/g' | sed -e 's/name\: /|/g' | tr -s \",\" \"\n\" | awk -F \"|\" '{print $2 \"|\" $1 \"|\" $3}' | sort";
$command = "sudo net ads search '(objectCategory=User)' name lastLogon displayName";
$user = shell_exec($command);
$user_explose = explode("\n\n", $user);
unset($user_explose[0]);
echo count($user_explose) . " Total users - ";
$command = "sudo net ads search '(&(objectCategory=User)(lastLogon=0))' name | grep : | wc -l";
echo shell_exec($command) . " Never logged in<hr />";
//echo "<table><tr><td><b>Username</b></td><td><b>Display Name</b></td><td><b>Last Login Date</b></td></tr>";

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
                $megatmp .= "<i>Never logged in</i>";
        }else{
                $megatmp .= date("r" , ($tmp[lastLogon]/10000000)-11644473600);
        }
	$megatmp .= "\n";
	unset($tmp);
}
//echo nl2br($megatmp);
echo "<table><tr><td><b>Username</b></td><td><b>Display Name</b></td><td><b>Last Login Date</b></td></tr>";
//$megatmpsort=asort($megatmp);
$megaarr=explode("\n", $megatmp);
asort($megaarr);
//print_r($megaarr);

foreach($megaarr as $arr){
        echo "<tr><td>";
        echo str_ireplace("|", "</td><td>", $arr);
        echo "</td></tr>\n";
} 
echo "</table>";
//print_r($megaarr); 
