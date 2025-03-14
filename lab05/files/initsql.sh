#!/bin/bash

echo "=== Starting MariaDB for initialization ==="
service mariadb start

# Ждем, пока MariaDB полностью запустится (до 30 секунд)
echo "=== Waiting for MariaDB to be ready ==="
timeout=30
while ! mysqladmin ping --silent &>/dev/null; do
    sleep 1
    timeout=$((timeout - 1))
    if [ "$timeout" -le 0 ]; then
        echo "MariaDB did not start in time. Exiting."
        exit 1
    fi
done
echo "=== MariaDB is ready ==="

# Выполняем инициализацию БД
echo "=== Initializing database ==="
mysql -u root <<EOF
CREATE DATABASE IF NOT EXISTS wordpress;
CREATE USER IF NOT EXISTS 'wordpress'@'%' IDENTIFIED BY 'wordpress';
GRANT ALL PRIVILEGES ON wordpress.* TO 'wordpress'@'%';
FLUSH PRIVILEGES;
EOF

echo "=== Database initialized successfully ==="

# Завершаем MariaDB, чтобы Supervisor мог управлять процессом
echo "=== Stopping MariaDB ==="
service mariadb stop

# Запускаем Supervisor
exec /usr/bin/supervisord -n -c /etc/supervisor/conf.d/supervisord.conf
