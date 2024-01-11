// app/Console/worker.php
require_once APP . 'Vendor' . DS . 'autoload.php'; // Adjust the path if needed
Resque::setBackend('localhost:6379'); // Set the Redis server details
$worker = new Resque_Worker('default');
$worker->work(3600); // Run the worker for a maximum of 1 hour (adjust as needed)
