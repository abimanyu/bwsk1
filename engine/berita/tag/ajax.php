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

@include ("../../../l0t/render.php");


//Form add cat
if(trim(strip_tags($_GET['ac'])) == "add_tag") {
	if (!empty($_POST['c_name'])) {
		$rw = createSlugDB($_POST['c_name'], "taxonomy");
		$sql -> db_Insert("taxonomy", "'', '2', '".$rw."', '".$_POST['c_name']."', '".$_POST['c_parent_ID']."', '' ");
		$sql -> db_Select("taxonomy", "*", "WHERE `type`='2'");
		while ($row = $sql-> db_Fetch()) {
		    echo "
		    <tr>
		        <td><a href='#edit' class='text-bold'>".$row['c_name']."</a>
		        	<p class=\"actions-hover actions-fade\"><a href='#'>Edit</a> <a href='#'>Quick Edit</a> <a href='#'>View</a> <a href='#modalAnim' data-id=\"".$row['T_ID']."\" class=\"delete-row modal-with-move-anim\">Delete</a></p>
		        </td>
		        <td>".$row['slug']."</td>
		        <td class='text-center'>".$row['c_count']."</td>
		    </tr>
		    ";
		}
	}
}
//Form del cat
if(trim(strip_tags($_GET['ac'])) == "del_tag") {
	if (!empty($_GET['id'])) {
		$sql -> db_Delete("taxonomy", "T_ID='".$_GET['id']."'");
		$sql -> db_Select("taxonomy", "*", "WHERE `type`='2'");
		while ($row = $sql-> db_Fetch()) {
		    echo "
		    <tr>
		        <td>".$row['T_ID']."</td>
		        <td><a href='#edit' class='text-bold'>".$row['c_name']."</a>
		        	<p class=\"actions-hover actions-fade\"><a href='#'>Edit</a> <a href='#'>Quick Edit</a> <a href='#'>View</a> <a href='#modalAnim' data-id=\"".$row['T_ID']."\" class=\"delete-row modal-with-move-anim\">Delete</a></p>
		        </td>
		        <td>".$row['slug']."</td>
		        <td class='text-center'>".$row['c_count']."</td>
		    </tr>
		    ";
		}
	}
}
?>