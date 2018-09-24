<?php
echo $view->header()->setAttribute('template', $T('Joined_Title'));

$command = "ls -l /var/lib/nethserver/home/ | grep \"domain computers\" | awk '{print $10}' | sort | tr \"\n\" \"|\"";
$pc = shell_exec($command);
$arrpc = explode("|", $pc);
//echo $pc;
echo "<table>";
echo "<tr>";
echo "<td>";
for($i=0; $i<count($arrpc); $i++){
	echo $arrpc[$i] . "<br />";
	if($i == intval((count($arrpc)/4))){
		echo "</td><td>";
	}
	if($i == intval((count($arrpc)/4)*2)){
                echo "</td><td>";
        }
	if($i == intval((count($arrpc)/4)*3)){
                echo "</td><td>";
        }
}
echo "</td>";
echo "</tr>";
echo "</table>";
