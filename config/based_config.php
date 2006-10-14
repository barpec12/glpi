<?php

/*
 * @version $Id$
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2006 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org
 -------------------------------------------------------------------------

 LICENSE

 This file is part of GLPI.

 GLPI is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 GLPI is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 --------------------------------------------------------------------------
 */


if (!defined('GLPI_ROOT')){
	die("Sorry. You can't access directly to this file");
	}
// Default location for based configuration
if (!defined("GLPI_CONFIG_DIR"))
	define("GLPI_CONFIG_DIR",GLPI_ROOT . "/config/");

// Default location for backup dump
if (!defined("GLPI_DUMP_DIR"))
	define("GLPI_DUMP_DIR",GLPI_ROOT . "/files/_dumps/");

// Path for documents storage
if (!defined("GLPI_DOC_DIR"))
	define("GLPI_DOC_DIR",GLPI_ROOT . "/files");


// If this file exists, it is load, allow to set configdir/dumpdir elsewhere
if(file_exists(GLPI_ROOT ."/config/config_path.php")) {
	include(GLPI_ROOT ."/config/config_path.php");
}

?>
