<?php
/**
* @package      Qapuas 5.0
* @version      Dev : 5.0
* @author       Rosi Abimanyu Yusuf <bima@abimanyu.net>
* @license      http://creativecommons.org/licenses/by-nc/3.0/ CC BY-NC 3.0
* @copyright    2015
* @since        File available since 5.0
* @category     berita function
*/

/**
NAV status index
*/
function NAV_STATUS($current=""){
    
    $count_publish = GET_COUNT("BERITA B","B.`status`", "WHERE B.`status`='1'");
    $count_draft = GET_COUNT("BERITA B","B.`status`", "WHERE B.`status`='2'");
    $count_all = $count_publish + $count_draft;
    $nav_aktif = " class='text-bold'";
    $on = "
    <p><a href=\"./\"".(empty($current) ? $nav_aktif : "").">Semua</a> (".$count_all.") | 
    <a href=\"./?s=1\"".($current == "1"? $nav_aktif : "").">Publish</a> (".$count_publish.") | 
    <a href=\"./?s=2\"".($current == "2"? $nav_aktif : "").">Draft</a> (".$count_draft.")</p>
    ";
    return $on;
}

/**
filter index
*/
function FILTER_DATE($current=""){
    
  $sqld = new db;
  $sqld -> db_Select("BERITA", "DATE_FORMAT(create_date, '%Y-%m') AS `key`, DATE_FORMAT(create_date, '%M %Y') AS `val`", "GROUP BY YEAR(create_date), MONTH(create_date)");
  $on = true;
  while ($row = $sqld-> db_Fetch()) {
    $selected = ($current == $row['key'] ? " selected" : "" );
    $on .= "<option value=\"{$row['key']}\"{$selected}>{$row['val']}</option>";
  }
  return $on;
}

function CAT_SELECT ($current= "", $parent="0", $level="0") {
  $sqld = new db;
  $sqld -> db_Select("taxonomy", "T_ID, c_name", "WHERE `c_parent_ID`='0' AND `type`='1'");
  while ($row = $sqld-> db_Fetch()) {
    $selected = ($current == $row['T_ID'] ? " selected" : "" );
    echo "<option value=\"{$row['T_ID']}\"{$selected}>{$row['c_name']}</option>";
    CAT_SELECT_CHILD ($row['T_ID'], $level+1, $current);
  }
}

function CAT_SELECT_CHILD ($parent="0", $level="0", $current="") {
  $sqld = new db;
  $sqld -> db_Select("taxonomy", "T_ID, c_name", "WHERE `c_parent_ID`='{$parent}' AND `type`='1'");
  while ($row = $sqld-> db_Fetch()) {
    $selected = ($current == $row['T_ID'] ? " selected" : "" );
    echo "<option value=\"{$row['T_ID']}\"{$selected}>".str_repeat('├',$level)." {$row['c_name']}</option>";
    SELECT_CHILD($row['T_ID'], $level+1, $current);
  }
}

/**
add select
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