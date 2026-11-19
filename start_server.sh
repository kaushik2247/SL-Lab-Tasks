#!/bin/bash
# Scripting Languages Lab - Service Starter

DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
export PATH="$HOME/.local/bin:$PATH"
export PHP_INI_SCAN_DIR="$HOME/.config/php"

# Start MySQL if not already running
if ! pgrep -f "mysqld.*lab-mysql" > /dev/null 2>&1; then
    echo "Starting MySQL Server..."
    "$HOME/.lab-env/bin/mysqld" --datadir="$HOME/.lab-mysql/data" --socket=/tmp/mysql.sock --port=3306 --mysqlx=OFF --daemonize
else
    echo "MySQL Server is already running."
fi

# Start PHP Built-in Server on port 8000 if not already running
if ! pgrep -f "php.*-S.*8000" > /dev/null 2>&1; then
    echo "Starting PHP Server on http://localhost:8000..."
    nohup "$HOME/.local/bin/php" -S localhost:8000 -t "$DIR" > /tmp/php_server.log 2>&1 &
    sleep 1
else
    echo "PHP Server is already running on http://localhost:8000"
fi

echo ""
echo "=========================================================="
echo "  Scripting Languages Lab - All Tasks Ready (1 to 10)"
echo "=========================================================="
echo "Task 1 (Portfolio & Timetable):"
echo "  http://localhost:8000/TASK1A.html"
echo "  http://localhost:8000/TASK1B.html"
echo ""
echo "Task 2 (JavaScript Form Validation):"
echo "  http://localhost:8000/TASK2.html"
echo ""
echo "Task 3 (Multiplication Table & Image Toggle):"
echo "  Task 3a: http://localhost:8000/TASK3A.html"
echo "  Task 3b: http://localhost:8000/TASK3B.html"
echo ""
echo "Task 4 (JavaScript To-Do List):"
echo "  http://localhost:8000/TASK4.html"
echo ""
echo "Task 5 (PHP Explode Item Bill Form):"
echo "  http://localhost:8000/TASK5.html"
echo ""
echo "Task 6 (PHP Session Timeout & Cookies):"
echo "  Task 6a (Session): http://localhost:8000/TASK6A.html"
echo "  Task 6b (Cookies): http://localhost:8000/TASK6B.html"
echo ""
echo "Task 7 (PHP + MySQL Database Registration & Login):"
echo "  Task 7a (Registration): http://localhost:8000/TASK7A.html"
echo "  Task 7c (Login/Auth):   http://localhost:8000/TASK7C.html"
echo ""
echo "Task 8 (PHP + MySQL Update & Delete Records):"
echo "  Task 8a (Update): http://localhost:8000/TASK8A.html"
echo "  Task 8b (Delete): http://localhost:8000/TASK8B.html"
echo ""
echo "Task 9 (XML + DTD + XSL Four Stroke Motorbike Catalog):"
echo "  http://localhost:8000/motorbikes_catalog.xml"
echo ""
echo "Task 10 (jQuery AJAX HTTP Request Date & Time):"
echo "  http://localhost:8000/TASK10.html"
echo "=========================================================="
