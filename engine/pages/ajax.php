<?php
/**
* @package      Qapuas 5.0
* @version      Dev : 5.0
* @author       Rosi Abimanyu Yusuf <bima@abimanyu.net>
* @license      http://creativecommons.org/licenses/by-nc/3.0/ CC BY-NC 3.0
* @copyright    2015
* @since        File available since 5.0
* @category     ajax-wms
*/

@include ("../../l0t/render.php");

//Form ADD_CAT
if(trim(strip_tags($_GET['ac'])) == "add_cat") {
	if (!empty($_POST['c_name'])) {
		$rw = "";
		$sql -> db_Insert("taxonomy", "'', '3', '".$rw."', '".$_POST['c_name']."', '".$_POST['c_parent_ID']."', '' ");
	}
}
?>