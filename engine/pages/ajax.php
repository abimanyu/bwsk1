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
require_once(c_THEMES."function.php");


//jQuery UI AutoComplete customer
if(trim(strip_tags($_GET['ac'])) == "customer") {
	if (!empty($_GET['term'])) {
		$term = '%'.trim(strip_tags($_GET['term'])).'%';
		$sql -> db_Select("customer", "CID, c_name, c_corp, c_alamat", "WHERE `c_name` LIKE '".$term."' OR `c_corp` LIKE '".$term."' GROUP BY c_name LIMIT 10");
		while ($row = $sql-> db_Fetch()) {
			$item['CID']=(int)$row['CID'];
			$item['nama']=htmlentities(stripslashes($row['c_name']));
			$item['corp']=htmlentities(stripslashes($row['c_corp']));
			$item['alamat']=htmlentities(stripslashes($row['c_alamat']));
			$row_set[] = $item;
		}
		echo json_encode($row_set);
	}
}
//Corfirmed PO_ID
elseif(trim(strip_tags($_GET['ac'])) == "po_confirm") {
	if (!empty($_POST['po_id'])) {
		$po_id = trim(strip_tags($_POST['po_id']));
		$NOW = date("Y-m-d");
		$sql -> db_Update("WMS_po", "`confirm`='1', `confirm_date`='".$NOW."' WHERE `PO_ID`='".$po_id."' ");
		echo "<a class=\"mb-xs mt-xs mr-xs btn btn-xs btn-success text-uppercase\" disabled><i class=\"fa fa-check\"></i> Confirmed</a> ";
	}
}
//Form ADD_CAT
elseif(trim(strip_tags($_GET['ac'])) == "add_cat") {
	if (!empty($_POST['c_name'])) {
		$rw = "";
		$sql -> db_Insert("PAGE_cat", "'', '".$rw."', '".$_POST['c_name']."', '".$_POST['c_parent_ID']."' ");
		//echo "<a class=\"mb-xs mt-xs mr-xs btn btn-xs btn-success text-uppercase\" disabled><i class=\"fa fa-check\"></i> Confirmed</a> ";
	}
}
/*
if($_GET['p'] == "add-cat") {
	$ident = "cat_item";
	$sql -> db_Insert("taxonomy", "'', '".$ident."', '".$_POST['taxonomy_name']."', '', '".$_POST['parent']."', '0'	");
	$sql -> db_Select("taxonomy", "taxonomy_id, name, count", "`type`='cat_item' AND `option`='0' GROUP BY taxonomy_id");
	while($row = $sql-> db_Fetch()){
		echo "
		<tr>
			<td>".$row['name']."</td>
			<td>".$row['name']."</td>
			<td>".$row['count']."</td>
			<td class=\"actions-hover actions-fade\">
				<a href=\"".c_SELF."?action=edit&id=".$row['taxonomy_id']."\"><i class=\"fa fa-pencil\"></i></a>
				<a href=\"".c_SELF."?action=delete&id=".$row['taxonomy_id']."\" class=\"delete-row\"><i class=\"fa fa-trash-o\"></i></a>
			</td>
		</tr>";
		echo VIEW_CHILD_TAXONOMY($row['taxonomy_id'],1);
	}
}
*/
?>