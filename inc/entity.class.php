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

// ----------------------------------------------------------------------
// Original Author of file: Julien Dombre
// Purpose of file:
// ----------------------------------------------------------------------

if (!defined('GLPI_ROOT')){
	die("Sorry. You can't access directly to this file");
	}


// CLASSES entity
class Entity extends CommonDBTM{

	function Group () {
		$this->table="glpi_entities";
		$this->type=ENTITY_TYPE;
	}

	function defineOnglets($withtemplate){
		global $LANG;
		if (haveRight("user","r"))	
			$ong[1]=$LANG["Menu"][14];

		$ong[2]=$LANG["common"][1];
		return $ong;
	}



	/**
	 * Print a good title for coontact pages
	 *
	 *
	 *
	 *
	 *@return nothing (diplays)
	 *
	 **/
	function title(){
		global  $LANG,$CFG_GLPI;

		$buttons=array();
		$title=$LANG["Menu"][37];
		if (haveRight("group","w")){
			$buttons["entity.tree.php"]=$LANG["entity"][1];
			$title="";
		}
		displayTitle($CFG_GLPI["root_doc"]."/pics/groupes.png",$LANG["Menu"][37],$title,$buttons);
	}

	/**
	 * Print the group form
	 *
	 *
	 * Print group form
	 *
	 *@param $target filename : where to go when done.
	 *@param $ID Integer : Id of the contact to print
	 *
	 *
	 *@return Nothing (display)
	 *
	 **/
	function showForm ($target,$ID,$withtemplate='') {

		global $CFG_GLPI, $LANG;

		if (!haveRight("group","r")) return false;

		$con_spotted=false;

		if (empty($ID)) {

			if($this->getEmpty()) $con_spotted = true;
		} else {
			if($this->getfromDB($ID)&&haveAccessToEntity($this->fields["FK_entities"])) $con_spotted = true;
		}

		if ($con_spotted){

			$this->showOnglets($ID, $withtemplate,$_SESSION['glpi_onglet']);

			echo "<form method='post' name=form action=\"$target\"><div align='center'>";
			if (empty($ID)){
				echo "<input type='hidden' name='FK_entities' value='".$_SESSION["glpiactive_entity"]."'>";
			}

			echo "<table class='tab_cadre_fixe' cellpadding='2' >";
			echo "<tr><th colspan='2'><b>";
			if (empty($ID)) {
				echo $LANG["setup"][605].":";

			} else {
				echo $LANG["common"][35]." ID $ID:";
			}		
			echo "</b></th></tr>";

			echo "<tr><td class='tab_bg_1' valign='top'>";

			echo "<table cellpadding='1' cellspacing='0' border='0'>\n";

			echo "<tr><td>".$LANG["common"][16].":	</td>";
			echo "<td>";
			autocompletionTextField("name","glpi_groups","name",$this->fields["name"],30);	
			echo "</td></tr>";

			if(!empty($CFG_GLPI["ldap_host"])){
				echo "<tr><td colspan='2' align='center'>".$LANG["setup"][256].":	</td>";
				echo "</tr>";

				echo "<tr><td>".$LANG["setup"][260].":	</td>";
				echo "<td>";
				autocompletionTextField("ldap_field","glpi_groups","ldap_field",$this->fields["ldap_field"],30);	
				echo "</td></tr>";

				echo "<tr><td>".$LANG["setup"][601].":	</td>";
				echo "<td>";
				autocompletionTextField("ldap_value","glpi_groups","ldap_value",$this->fields["ldap_value"],30);	
				echo "</td></tr>";

				echo "<tr><td colspan='2' align='center'>".$LANG["setup"][257].":	</td>";
				echo "</tr>";


				echo "<tr><td>".$LANG["setup"][261].":	</td>";
				echo "<td>";
				autocompletionTextField("ldap_group_dn","glpi_groups","ldap_group_dn",$this->fields["ldap_group_dn"],30);	
				echo "</td></tr>";
			}

			echo "</table>";

			echo "</td>\n";	

			echo "<td class='tab_bg_1' valign='top'>";

			echo "<table cellpadding='1' cellspacing='0' border='0'><tr><td>";
			echo $LANG["common"][25].":	</td></tr>";
			echo "<tr><td align='center'><textarea cols='45' rows='4' name='comments' >".$this->fields["comments"]."</textarea>";
			echo "</td></tr></table>";

			echo "</td>";
			echo "</tr>";

			if (haveRight("group","w")) 
				if ($ID=="") {

					echo "<tr>";
					echo "<td class='tab_bg_2' valign='top' colspan='2'>";
					echo "<div align='center'><input type='submit' name='add' value=\"".$LANG["buttons"][8]."\" class='submit'></div>";
					echo "</td>";
					echo "</tr>";


				} else {

					echo "<tr>";
					echo "<td class='tab_bg_2' valign='top'>";
					echo "<input type='hidden' name='ID' value=\"$ID\">\n";
					echo "<div align='center'><input type='submit' name='update' value=\"".$LANG["buttons"][7]."\" class='submit' ></div>";
					echo "</td>\n\n";
					echo "<td class='tab_bg_2' valign='top'>\n";
					echo "<div align='center'><input type='submit' name='delete' value=\"".$LANG["buttons"][6]."\" class='submit'></div>";

					echo "</td>";
					echo "</tr>";

				}
			echo "</table></div></form>";

		} else {
			echo "<div align='center'><strong>".$LANG["common"][54]."</strong></div>";
			return false;

		}
		return true;
	}


}

?>
