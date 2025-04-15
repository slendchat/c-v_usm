<?php

require_once __DIR__ . '/testframework.php';

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../modules/database.php';
require_once __DIR__ . '/../modules/page.php';

$tests = new TestFramework();

// test 1: check database connection
function testDbConnection() {
    global $config;
    try {
        $db = new Database($config["db"]["path"]);
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// test 2: test count method
function testDbCount() {
    global $config;
    $db = new Database($config["db"]["path"]);
    $db->Execute("DROP TABLE IF EXISTS test_table");
    $db->Execute("CREATE TABLE test_table (id INTEGER PRIMARY KEY, name TEXT, value INTEGER)");

    $count = $db->Count("test_table");
    if ($count != 0) return false;

    $db->Execute("INSERT INTO test_table (name, value) VALUES ('test', 123)");
    $count = $db->Count("test_table");
    return ((int)$count === 1);
}

// test 3: test create method
function testDbCreate() {
    global $config;
    global $config;
    $db = new Database($config["db"]["path"]);
    $db->Execute("DROP TABLE IF EXISTS test_table");
    $db->Execute("CREATE TABLE test_table (id INTEGER PRIMARY KEY, name TEXT, value INTEGER)");

    $data = array('name' => 'Alice', 'value' => 42);
    $id = $db->Create("test_table", $data);
    if (!$id) return false;
    
    $record = $db->Read("test_table", $id);
    return ($record && $record['name'] === 'Alice' && $record['value'] == 42);
}

// test 4: test read method
function testDbRead() {
    global $config;
    $db = new Database($config["db"]["path"]);
    $db->Execute("DROP TABLE IF EXISTS test_table");
    $db->Execute("CREATE TABLE test_table (id INTEGER PRIMARY KEY, name TEXT, value INTEGER)");

    $id = $db->Create("test_table", array('name' => 'Bob', 'value' => 99));
    $record = $db->Read("test_table", $id);
    return ($record && $record['name'] === 'Bob' && $record['value'] == 99);
}

// add tests

function testDbDelete() {
  global $config;
  $db = new Database($config["db"]["path"]);
  $db->Execute("DROP TABLE IF EXISTS test_table");
  $db->Execute("CREATE TABLE test_table (id INTEGER PRIMARY KEY, name TEXT, value INTEGER)");

  $id = $db->Create("test_table", array('name' => 'Dave', 'value' => 77));
  $result = $db->Delete("test_table", $id);
  if (!$result) return false;
  
  $record = $db->Read("test_table", $id);
  return ($record === false || $record === null);
}

function testDbUpdate() {
  global $config;
  $db = new Database($config["db"]["path"]);
  $db->Execute("DROP TABLE IF EXISTS test_table");
  $db->Execute("CREATE TABLE test_table (id INTEGER PRIMARY KEY, name TEXT, value INTEGER)");

  $id = $db->Create("test_table", array('name' => 'Charlie', 'value' => 10));
  $result = $db->Update("test_table", $id, array('name' => 'Charles', 'value' => 20));
  if (!$result) return false;
  
  $record = $db->Read("test_table", $id);
  return ($record && $record['name'] === 'Charles' && $record['value'] == 20);
}

function testDbExecute() {
  global $config;
  $db = new Database($config["db"]["path"]);
  $db->Execute("DROP TABLE IF EXISTS test_execute_table");
  $result = $db->Execute("CREATE TABLE test_execute_table (id INTEGER PRIMARY KEY, name TEXT)");
  $tableExists = $db->Fetch("SELECT name FROM sqlite_master WHERE type='table' AND name='test_execute_table'");
  return !empty($tableExists);
}

function testDbFetch() {
  global $config;
  $db = new Database($config["db"]["path"]);
  $db->Execute("DROP TABLE IF EXISTS test_fetch_table");
  $db->Execute("CREATE TABLE test_fetch_table (id INTEGER PRIMARY KEY, name TEXT)");
  $db->Execute("INSERT INTO test_fetch_table (name) VALUES ('Row1')");
  $db->Execute("INSERT INTO test_fetch_table (name) VALUES ('Row2')");
  
  $results = $db->Fetch("SELECT * FROM test_fetch_table ORDER BY id ASC");
  return (count($results) === 2 && $results[0]['name'] === 'Row1' && $results[1]['name'] === 'Row2');
}



$tests->add('Database connection', 'testDbConnection');
$tests->add('Database Execute', 'testDbExecute');
$tests->add('Database Fetch', 'testDbFetch');
$tests->add('Database Count', 'testDbCount');
$tests->add('Database Create', 'testDbCreate');
$tests->add('Database Read', 'testDbRead');
$tests->add('Database Update', 'testDbUpdate');
$tests->add('Database Delete', 'testDbDelete');
// ...

// run tests
$tests->run();

echo $tests->getResult();
