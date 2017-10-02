<?php
echo $view->header()->setAttribute('template', $T('Joined_Title'));

$command = "cat /var/lib/nethserver/db/accounts | grep machine | awk -F \"=\" '{print $1 \"<br />\"}' | tr -d \"$\" | sort";
$pc = shell_exec($command);
echo $pc;
