#!/bin/bash

sed -i 's/None/All/g' /etc/apache2/apache2.conf
service mysql start 1>/dev/null && \
		mysql < /root/sqlSetup && \
        mysql -u raceuser -pRac3R_we3 db_race < /root/database.sql && \
		service apache2 start > /dev/null 2>&1 && \
        echo "[#] Challenge can be accessed at: http://$(hostname -I)" && \
        tail -f /dev/null