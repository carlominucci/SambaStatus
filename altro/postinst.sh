#!/bin/bish
if [ "$(cat /etc/nethserver-release | grep 7)" ]
	then
		echo "NethServer 7 found: update sudoers file..."
		echo "#" > /etc/sudoers.d/30_nethserver_sambastatus
		echo "# 30_nethserver_sambastatus" >> /etc/sudoers.d/30_nethserver_sambastatus
		echo "#" >> /etc/sudoers.d/30_nethserver_sambastatus
		echo "%srvmgr ALL=NOPASSWD: /usr/bin/smbstatus" >> /etc/sudoers.d/30_nethserver_sambastatus
		echo "Done"
fi
