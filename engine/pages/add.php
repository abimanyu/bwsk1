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
				jquery-ui.min.css, pnotify.custom.css, select2.css, summernote.css, summernote-bs3.css, codemirror.css, monokai.css, bootstrap-tagsinput.css, 
				bootstrap-timepicker.css,
				theme.css, default.css, modernizr.js";

$ITEM_FOOT = "jquery.js, jquery.browser.mobile.js, bootstrap.js, nanoscroller.js, bootstrap-datepicker.js, magnific-popup.js, jquery.placeholder.js, 
				jquery-ui.min.js, pnotify.custom.js, jquery.appear.js, select2.js, jquery.autosize.js, codemirror.js, active-line.js, matchbrackets.js, 
				javascript.js, xml.js, htmlmixed.js,css.js, summernote.js, bootstrap-tagsinput.js, bootstrap-timepicker.js, 
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

/**
	Form Submit
*/
//include ("../wms-function.php");

if(isset($_POST['form_submit'])) {
	$NO_SP = str_replace("SJJ-", "", $_POST['no_sp']);
	$TGL_SP = explode("/", $_POST['tgl_sp']);
	$TGL_SP = $TGL_SP[2]."-".$TGL_SP[0]."-".$TGL_SP[1];
	$NOW = date("Y-m-d H:i:s");

	//costumer
	if(!empty($_POST['customer_id'])) {
		//update data customer terbaru via form ini
		$sql -> db_Update("customer", "c_name='".$_POST['customer']."', c_corp='".$_POST['corp']."', c_alamat='".$_POST['alamat']."'  
			WHERE CID='".$_POST['customer_id']."' ");
		$CID = $_POST['customer_id'];

	}else { //customer belum ada di database
		if(!empty($_POST['customer']) OR !empty($_POST['corp'])) {
			$CID = $sql -> db_Insert("customer", "'', '".$_POST['customer']."', '".$_POST['corp']."', '','','1','".mysql_real_escape_string($_POST['alamat'])."'");
		}
	}
	$warehouse_code = get_user_option("U_WAREHOUSE");

	$PO_ID = $sql -> db_Insert("WMS_po", "'', '".$TGL_SP."', '".$NO_SP."', '".mysql_real_escape_string( $_POST['keterangan'] )."', '".$CID."', '0', '', '".$warehouse_code."','".U_ID."', '".$NOW."' ");

	//jika berhasil, update LAST_NO_SP
	if($PO_ID) {
		$sql -> db_Update("3E_taxonomy", "`value`='".$NO_SP."' WHERE `type`='warehouse' AND `key`='po-last' ");
	}

	
	$Dyn = count($_POST['dyn']);
	for($x=0; $x<$Dyn; $x++){
		
		$CEK_ID_KAIN = GET_ID_KAIN( $_POST['jeniskain'][$x] );
		if( $CEK_ID_KAIN ) {//jika jenis kain tersedia di database
			$KAIN_ID = $CEK_ID_KAIN;
		}
		else {//jika ga ada di database, tambah data kain
			$KAIN_ID = $sql -> db_Insert("WMS_kain", "'', '".mysql_real_escape_string($_POST['jeniskain'][$x])."', '', '' ");
		}

		$CEK_ID_WARNA = GET_ID_WARNA( $_POST['warna'][$x] );
		if( $CEK_ID_WARNA ) {//jika warna tersedia di database
			$WARNA_ID = $CEK_ID_WARNA;
		}
		else {//jika ga ada di database, tambah data warna
			$WARNA_ID = $sql -> db_Insert("WMS_warna", "'', '".$_POST['warna'][$x]."', '', '' ");
		}

		$ROLL = HANYA_ANGKA( $_POST['roll'][$x] );
		$JAR = HANYA_ANGKA( $_POST['jar'][$x] );
		$KG = HANYA_ANGKA( $_POST['kg'][$x] );
		$HARGA = HANYA_ANGKA( $_POST['harga'][$x] );

		$sql -> db_Insert("WMS_po_items", "'', '".$PO_ID."', '".$ROLL."', '".$JAR."', '".$KG."', '".$KAIN_ID."', '".$WARNA_ID."', 
					'', '".$_POST['setting'][$x]."', '".$_POST['gramasi'][$x]."', '".$HARGA."' ");
	}

	return _redirect ( "./printview?landing=".$PO_ID );
}

/**
	Load needed
*/
$LAST_NO_SP = get_option("warehouse", "po-last");
?>
<section role="main" class="content-body">
<header class="page-header">
	<h2>Tambah Pages</h2>
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li><a href="<?php echo c_LANDING;?>"><i class="fa fa-home"></i></a></li>
			<li><a href="./">Pages</a></li>
			<li><span>Add</span></li>
		</ol>
		<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
	</div>
</header>

<form method='post' action='<?php echo c_SELF;?>' class="form-horizontal form-bordered">
<div class="row">

<div class="col-md-8">
	<div class="row">
	<section class="panel panel-transparent">
		<div class="panel-body">
			<div class="form-group">				
				<div class="col-md-12">
					<input name="p_name" placeholder="Ketik Title Disini" class="form-control input-lg">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12">
					<div class="summernote" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "mode": "text/html", "htmlMode": "true", "lineNumbers": "true", "theme": "monokai" } }'></div>
				</div>
			</div>
		</div>
	</section>
	</div>

	<div class="row">
	<div class="toggle panel" data-plugin-toggle>
		<section class="toggle">
			<label>SEO Panel</label>
			<div class="toggle-content panel-body">
				<div class="form-group">
					<label class="col-md-3 control-label" for="seo_title">Meta Title</label>
					<div class="col-md-9">
						<input name="seo_title" id="seo_title" type="text" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label" for="seo_keyword">Meta Keyword</label>
					<div class="col-md-9">
						<input name="seo_keyword" id="tags-input" data-role="tagsinput" data-tag-class="label label-primary" class="form-control" />
						<p>Pisahkan dengan tanda <code>, (koma)</code> untuk setiap keyword yang di inputkan.</p>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label" for="seo_desc">Meta Description</label>
					<div class="col-md-9">
						<textarea rows="6" name="seo_desc" id="seo_desc" data-plugin-textarea-autosize class="form-control" ></textarea>
					</div>
				</div>
			</div>
		</section>
	</div>
	</div>

</div>

<div class="col-md-4">
	<section class="panel panel-featured-primary">
		<header class="panel-heading panel-featured-left">
			<div class="panel-actions">
				<a href="#" class="fa fa-caret-down"></a>
			</div>
			<h2 class="panel-title">Atribut Pages</h2>
		</header>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-md-3 control-label" for="customer">Kategori</label>
				<div class="col-md-9">
					<select name="CPID" id="CPID" class="form-control mb-md">
						<?php
						include "cat/cat-function.php";
			            $sql -> db_Select("PAGE_cat", "PCAT_ID, c_name", "WHERE `c_parent_ID`='0' GROUP BY PCAT_ID");
			            while($row = $sql-> db_Fetch()){
			                echo "<option value=\"{$row['PCAT_ID']}\">{$row['c_name']}</option>\n";
			                SELECT_CHILD($row['PCAT_ID'], 1);
			            }
			            ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label" for="corp">Tanggal Post</label>
				<div class="col-md-9">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						<input name= "publish_date" type="text" data-plugin-datepicker class="form-control" value="<?php echo date("m/d/Y");?>"> 
						<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
						<input name="publish_time" type="text" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }'>
					</div>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<button type="submit" name="form_submit" value="2" class="btn btn-default"><i class="fa fa-save"></i> Draft </button>
			<button type="submit" name="form_submit" value="1" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Publish </button>
		</footer>
	</section>
</div>
</div>
</form>
	
<div class="row"><p></p><div class="col-md-12">
<section class="panel"><a href="./" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali ke Pages</a></section>
</div></div>

</section>
</div>
<?php
@include(AdminFooter);
?>