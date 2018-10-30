<?php
echo $view->header()->setAttribute('template', $T('Joined_Title'));

//thanks to @mrmarkuz
$command = "sudo /usr/bin/net ads search -P objectClass=Computer | grep 'cn: ' | cut -f 2 -d ' ' | sort";
$pc = shell_exec($command);
$arrpc = explode("\n", $pc);
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
