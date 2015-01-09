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

	$STATUS_POST = ($_POST['form_submit'] == "1" ? 1 : 2);
	// status post : 1=draft 2=publish
	$PUBLISH_DATE = ($STATUS_POST == "2" ? "NOW()" : "''");

	if (!empty($_POST['title'])) {
		$rw = createSlugDB($_POST['title'], "PAGES");
		
		$ID = $sql -> db_Insert("PAGES", "'', '".$rw."', '".$_POST['title']."', '".$_POST['T_ID']."', '".UID."', '".$STATUS_POST."', '0', '".$STATUS_POST."', NOW(), ".$PUBLISH_DATE." , NOW() ");
		
		//add Meta post
		//$sql -> db_Insert("PAGES_meta", "'', '".$ID."', 'META_TITLE', '".$_POST['title']."', 'seo' ");
		//$sql -> db_Insert("PAGES_meta", "'', '".$ID."', 'META_KEYWORD', '".$_POST['title']."', 'seo' ");
		//$sql -> db_Insert("PAGES_meta", "'', '".$ID."', 'META_DESC', '".$_POST['title']."', 'seo' ");

		//add count taxonomy
		$sql -> db_Update("taxonomy", "`t_count`=`t_count`+1 WHERE `T_ID`='".$_POST['T_ID']."'");
	}

	return _redirect ( "./edit?landing=".$ID );
}
?>
<section role="main" class="content-body">
<header class="page-header">
	<h2>Edit Pages</h2>
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li><a href="<?php echo c_LANDING;?>"><i class="fa fa-home"></i></a></li>
			<li><a href="./">Pages</a></li>
			<li><span>Edit</span></li>
		</ol>
		<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
	</div>
</header>

<form method='post' action='<?php echo c_SELF;?>' class="form-horizontal form-bordered">
<div class="row">

<?php
if (!empty($_GET['s'])) {

	if ($_GET['s'] == "1") { 
		$notif['color'] = "warning"; $notif['text'] = "Data berhasil di simpan!"; $notif['type'] = "Draft";
	}elseif ($_GET['s'] == "2"){
		$notif['color'] = "info"; $notif['text'] = "Input data berhasil!"; $notif['type'] = "Publish";
	}

echo "
<div class=\"alert alert-".$notif['color']."\">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
	<strong>".$notif['text']."</strong> silahkan <a href=\"./post?id=".$_GET['landing']."\" class=\"alert-link\" target=\"_blank\">klik disini</a> untuk melihat hasil ".$notif['type'].", anda bisa melihatnya secara langsung.
</div>";
}
?>
<div class="col-md-8">
	<div class="row">
	<section class="panel panel-transparent">
		<div class="panel-body">
			<div class="form-group">				
				<div class="col-md-12">
					<input name="title" placeholder="Ketik Title Disini" class="form-control input-lg">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12">
					<textarea class="summernote" id="article" name="article" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "mode": "text/html", "htmlMode": "true", "lineNumbers": "true", "theme": "monokai" } }'><?php echo htmlspecialchars($_post['text']); ?></textarea>
				</div>
			</div>
		</div>
	</section>
	</div>

	<div class="row">
	<div class="toggle panel" data-plugin-toggle>
		<section class="toggle active">
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
					<select name="T_ID" id="T_ID" class="form-control mb-md">
						<?php
						include "pages-function.php";
			            $sql -> db_Select("taxonomy", "T_ID, c_name", "WHERE `c_parent_ID`='0' AND `type`='3' GROUP BY T_ID");
			            while($row = $sql-> db_Fetch()){
			                echo "<option value=\"{$row['T_ID']}\">{$row['c_name']}</option>\n";
			                SELECT_CHILD($row['T_ID'], 1);
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
			<button type="submit" name="form_submit" value="1" class="btn btn-default"><i class="fa fa-save"></i> Draft </button>
			<button type="submit" name="form_submit" value="2" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Publish </button>
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