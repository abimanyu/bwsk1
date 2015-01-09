<?php
/**
* @package      Qapuas 5.0
* @version      Dev : 5.0
* @author       Rosi Abimanyu Yusuf <bima@abimanyu.net>
* @license      http://creativecommons.org/licenses/by-nc/3.0/ CC BY-NC 3.0
* @copyright    2015
* @since        File available since 5.0
* @category     category pages
*/

@include ("../../l0t/render.php");

/**
	Load Component
*/
$ITEM_HEAD = "bootstrap.css, font-awesome.css, magnific-popup.css, datepicker3.css, 
				pnotify.custom.css, select2.css,
				theme.css, default.css, modernizr.js";

$ITEM_FOOT = "jquery.js, jquery.browser.mobile.js, bootstrap.js, nanoscroller.js, bootstrap-datepicker.js, magnific-popup.js, jquery.placeholder.js, 
				pnotify.custom.js, select2.js,
				theme.js, theme.init.js";

require_once(c_THEMES."auth.php");

$SCRIPT_FOOT = "
<script>
$(document).ready(function(){
	$('html').addClass('sidebar-left-collapsed');
	$('nav li.nav-cat').addClass('nav-expanded nav-active');
	$('nav li.pg').addClass('nav-active');
});
</script>
<script src=\"custom.js\"></script>
";
?>
<section role="main" class="content-body">
<header class="page-header">
	<h2>Web Pages  <a href="add" class="mb-xs mt-xs mr-xs btn btn-warning btn-xs"><i class="fa fa-plus"></i> Page Baru</a></h2>
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li><a href="<?php echo c_LANDING;?>"><i class="fa fa-home"></i></a></li>
			<li><span>Pages</span></li>
		</ol>
		<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
	</div>
</header>

<div class="row"><div class="col-md-9">
	<div class="row"><div class="col-md-12"><a href="" class='text-bold'><p>Semua</a> (1) | <a href="">Publish</a> (1) | <a href="">Drafts</a> (1)</p></div></div>
	<div class="row"><div class="col-md-12">
		<form action="" class="form-inline">
			<div class="form-group">
				<select name="m" class="form-control input-sm mb-md">
					<option value="">Semua Tanggal</option>
					<option>Oktober 2014</option>
					<option>November 2014</option>
					<option>Desember 2014</option>
				</select>
				<select name="cat" class="form-control input-sm mb-md">
					<option value="">Lihat Semua Kategori</option>
					<option>Uncategories</option>
				</select>
				<button type="submit" class="btn btn-sm mb-md btn-default">Filter</button>
			</div>
		</form>
	</div></div>
</div><div class="col-md-3">
<div class="row"><div class="col-md-12"><form action="" class="search">
<div class="input-group input-search"><input type="text" class="form-control" name="q" id="q" placeholder="Cari...">
<span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button></span></div>
</form></div></div>
<div class="row"><div class="col-md-12 text-right"><p></p><em>12 items</em></div></div>
</div></div>

<?php
/**

*/
$START = (!empty($_POST['start']) ? date("Y-m-d", strtotime($_POST['start'])) : date("Y-m-d") );
$END = date("Y-m-d", strtotime($_POST['end']));

$DISPLAY = ( $END!="1970-01-01" ? 
	"Antara tanggal (".date("d M, Y", strtotime($START)).") s/d (".date("d M, Y", strtotime($END)).")" : 
	($START == date("Y-m-d") ? "Semua" : "Tanggal ".date("d M, Y", strtotime($START))) );

if(($START == $END) OR  ($END=="1970-01-01")) {
	$sql_filter = " G.tgl_sp='".$START."' ";
}else {
	$sql_filter = " (G.tgl_sp BETWEEN '".$START."' AND '".$END."') ";
}

if(!empty($_POST['search'])) {
  unset($sql_filter);
  $DISPLAY = "";
  $SEARCH = str_replace("SJJ-", "", $_POST['search']);
  $sql_filter = " G.no_sp='".$SEARCH."' ";
}
?>

<div class="row">
	<div class="col-md-12">
		<section class="panel panel-featured panel-featured-primary">
			<header class="panel-heading">
				<div class="panel-actions"><a href="#" class="fa fa-caret-down"></a></div>
				<h2 class="panel-title">Pages</h2><em class="panel-subtitle"><?php echo $DISPLAY;?></em>
			</header>
			<div class="panel-body">
				<div class="table-responsive">
				<table class="table table-hover table-striped mb-none">
					<thead>
						<tr>
							<th width="1%" class="text-center">#ID</th>
							<th>Pages</th>
							<th width="15%">Kategori</th>
							<th width="10%">Penulis</th>
							<th width="6%" class="text-center"><i class="fa fa-comments"></i></th>
							<th width="10%">Tanggal</th>
						</tr>
					</thead>
					<tbody id="isi_table">
					<?php
					$sql -> db_Select("PAGES P LEFT JOIN PAGE_cat C ON P.PCAT_ID=C.PCAT_ID LEFT JOIN 3E_users U ON P.UID=U.ID", 
							"P.PID, P.p_name, C.c_name, C.PCAT_ID, P.UID, U.user_nicename, P.status, P.comment, P.last_action, P.last_action_date", 
							"");

					$action = array(
							    '1'=>array('Created'), 
							    '2'=>array('Published'), 
							    '3'=>array('Last Modified')
								);

					while($row = $sql-> db_Fetch()){

						echo "
						<tr>
							<td>".$row['PID']."</td>
							<td><a href='#edit-".$row['PID']."' class='text-bold'>".$row['p_name']."</a>".($row['status']=="3" ? " &dash; <em class='text-warning'>Draft</em>" : "")."
					        	<p class=\"actions-hover actions-fade\"><a href='#'>Edit</a> <a href='#'>Quick Edit</a> <a href='#'>View</a> 
					        	<a href='#modalAnim' data-id=\"".$row['PID']."\" class=\"delete-row modal-with-move-anim\">Delete</a>
					        	</p>
					        </td>
							<td><a href='#cat-".$row['PCAT_ID']."'>".$row['c_name']."</a></td>
							<td><a href='#user-".$row['UID']."'>".$row['user_nicename']."</a></td>
							<td class=\"text-center\"><a href='#comment-".$row['PID']."'>".$row['comment']."</a></td>
							<td>2014/11/25<p>".$action[ $row['last_action'] ][0]."</p></td>
						</tr>";
					}
					?>
					</tbody>
				</table>
				</div>
			</div>
		</section>
	</div>
</div>

</section>
</div>
<?php
@include(AdminFooter);
?>