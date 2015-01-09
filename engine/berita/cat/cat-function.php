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
  $sqld -> db_Select("taxonomy", "T_ID, slug, c_name, c_count", "WHERE `c_parent_ID`='{$parent}' AND `type`='1'");

  while ($row = $sqld-> db_Fetch()) {
    echo "
    <tr>
      <td>".$row['T_ID']."</td>
      <td>".str_repeat('—',$level)."  <a href='#edit' class='text-bold'>".$row['c_name']."</a>
        <p class=\"actions-hover actions-fade\"><a href='#'>Edit</a> <a href='#'>Quick Edit</a> <a href='#'>View</a> 
        <a href='#modalAnim' data-id=\"".$row['T_ID']."\" class=\"delete-row modal-with-move-anim\">Delete</a>
        </p>
      </td>
      <td>".$row['slug']."</td>
      <td class='text-center'>".$row['c_count']."</td>
    </tr>
    ";
    VIEW_CHILD($row['T_ID'], $level+1);
  }
}

function SELECT_CHILD($parent="0", $level="0") {
  $sqld = new db;
  $sqld -> db_Select("taxonomy", "T_ID, c_name", "WHERE `c_parent_ID`='{$parent}' AND `type`='1'");
  while ($row = $sqld-> db_Fetch()) {
    echo "<option value=\"{$row['T_ID']}\">".str_repeat('├',$level)." {$row['c_name']}</option>";
    SELECT_CHILD($row['T_ID'], $level+1);
  }
}