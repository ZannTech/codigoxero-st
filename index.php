<?php
require 'server/db_config.php';
require 'server/web_config.php';
require 'server/functions_helpers.php';
require 'libs/Bootstrap.php';
require 'libs/Controller.php';
require 'libs/Model.php';
require 'libs/View.php';
require 'libs/Database.php';
require 'libs/Session.php';
require 'server/sys_config.php';

require 'libs/Hash.php';
require 'vendor/autoload.php';

$bootstrap = new Bootstrap();
$bootstrap->init();
