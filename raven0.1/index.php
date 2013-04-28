<?php
define('RAVEN_INSTALL_PATH', dirname(__FILE__));
define('RAVEN_SITE_PATH', RAVEN_INSTALL_PATH . '/site');

require(RAVEN_INSTALL_PATH.'/src/CRaven/bootstrap.php');

$ra = CRaven::Instance();

$ra->FrontControllerRoute();

$ra->ThemeEngineRender();