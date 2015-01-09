<?php
/**
* @package      Qapuas 5.0
* @version      Dev : 5.0
* @author       Rosi Abimanyu Yusuf <bima@abimanyu.net>
* @license      http://creativecommons.org/licenses/by-nc/3.0/ CC BY-NC 3.0
* @copyright    2015
* @since        File available since 5.0
* @category     pages function
*/

function VIEW_CHILD($parent="0", $level="0") {
  $sqld = new db;
  $sqld -> db_Select("PAGE_cat", "PCAT_ID, slug, c_name", "WHERE `c_parent_ID`='{$parent}'");

  while ($row = $sqld-> db_Fetch()) {
    echo "
    <tr>
        <td>".$row['PCAT_ID']."</td>
        <td>".str_repeat('—',$level)." ".$row['c_name']."</td>
        <td>".$row['slug']."</td>
        <td class=\"actions-hover actions-fade\">
            <a href=\"".c_SELF."?action=edit&id=".$row['PCAT_ID']."\"><i class=\"fa fa-pencil\"></i></a>
            <a href=\"".c_SELF."?action=delete&id=".$row['PCAT_ID']."\" class=\"delete-row\"><i class=\"fa fa-trash-o\"></i></a>
        </td>
    </tr>
    ";
    VIEW_CHILD($row['PCAT_ID'], $level+1);
  }
}

function SELECT_CHILD($parent="0", $level="0") {
  $sqld = new db;
  $sqld -> db_Select("PAGE_cat", "PCAT_ID, c_name", "WHERE `c_parent_ID`='{$parent}'");
  while ($row = $sqld-> db_Fetch()) {
    echo "<option value=\"{$row['PCAT_ID']}\">".str_repeat('├',$level)." {$row['c_name']}</option>";
    SELECT_CHILD($row['PCAT_ID'], $level+1);
  }
}