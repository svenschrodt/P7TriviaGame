<?php
require_once 'Autoload.php';

use P7TriviaGame\Persistence\Driver\PdoMysql;
use P7TriviaGame\Application\Configuration;
use P7TriviaGame\Core\Factory;

//var_dump($cats); die;

$db = PdoMysql::getInstance( Factory::get('configuration')->getDbSettings());
var_dump($db->query('DESCRIBE question')->fetchAll());