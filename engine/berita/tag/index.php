<?php
/**
* @package      Qapuas 5.0
* @version      Dev : 5.0
* @author       Rosi Abimanyu Yusuf <bima@abimanyu.net>
* @license      http://creativecommons.org/licenses/by-nc/3.0/ CC BY-NC 3.0
* @copyright    2015
* @since        File available since 5.0
* @category     category Berita
*/

@include ("../../../l0t/render.php");

/**
	Load Component
*/
$ITEM_HEAD = "bootstrap.css, font-awesome.css, magnific-popup.css, datepicker3.css, 
				pnotify.custom.css, jquery.appear.js, 
				theme.css, default.css, modernizr.js";

$ITEM_FOOT = "jquery.js, jquery.browser.mobile.js, bootstrap.js, nanoscroller.js, bootstrap-datepicker.js, magnific-popup.js, jquery.placeholder.js, 
				pnotify.custom.js, 
				theme.js, theme.init.js";

require_once(c_THEMES."auth.php");

$SCRIPT_FOOT = "
<script>
$(document).ready(function(){
	$('nav li.nav2').addClass('nav-expanded nav-active');
	$('nav li.bt').addClass('nav-active');
});
</script>
<script src=\"tag.js\"></script>
";

?>
<section role="main" class="content-body">
<header class="page-header">
	<h2>Tags Berita</h2>
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li><a href="<?php echo c_LANDING;?>"><i class="fa fa-home"></i></a></li>
			<li><a href="../"><span>Berita</span></a></li>
			<li><span>Tags</span></li>
		</ol>
		<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
	</div>
</header>

<div class="row"><div class="col-md-9"></div><div class="col-md-3">
<form action="" class="search">
<div class="input-group input-search"><input type="text" class="form-control" name="q" id="q" placeholder="Search...">
<span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button></span>
</div></form></div></div>

	<div class="row">
		<div class="col-md-8">
			<section class="panel panel-featured panel-featured-primary">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="fa fa-caret-down"></a>
					</div>
					<h2 class="panel-title">Tags Berita</h2>
				</header>
				
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover table-striped mb-none">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Slug</th>
									<th width="10px;">Count</th>
								</tr>
							</thead>
							<tbody id="isi_table">
							<?php
							$sql -> db_Select("taxonomy", "*", "WHERE `type`='2'");
							while ($row = $sql-> db_Fetch()) {
							    echo "
							    <tr>
							        <td><a href='#edit' class='text-bold'>".$row['c_name']."</a>
							        	<p class=\"actions-hover actions-fade\"><a href='#'>Edit</a> <a href='#'>Quick Edit</a> <a href='#'>View</a> 
							        	<a href='#modalAnim' data-id=\"".$row['T_ID']."\" class=\"delete-row modal-with-move-anim\">Delete</a>
							        	</p>
							        </td>
							        <td>".$row['slug']."</td>
							        <td class='text-center'>".$row['c_count']."</td>
							    </tr>
							    ";
							  }
							?>
							</tbody>
						</table>

						<div id="modalAnim" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
							<section class="panel">
								<header class="panel-heading">
									<h2 class="panel-title">Delete Data?</h2>
								</header>
								<div class="panel-body">
									<div class="modal-wrapper">
										<div class="modal-icon">
											<i class="fa fa-question-circle"></i>
										</div>
										<div class="modal-text">
											<p>Apakah anda yakin akan menghapus Tag ini?</p>
										</div>
									</div>
								</div>
								<footer class="panel-footer">
									<div class="row">
										<div class="col-md-12 text-right">
											<form method="post" id="post_id">
											<input type="hidden" id="T_ID" name="T_ID" value="" />
											<button id="T_ID" data-id="" class="btn btn-primary modal-confirm">Confirm</button>
											<button class="btn btn-default modal-dismiss">Cancel</button>
											</form>
										</div>
									</div>
								</footer>
							</section>
						</div>
					</div>
				</div>

			</section>
			<section>
				<blockquote>
					<p>Menghapus Tag tidak akan menghapus artikel Berita didalamnya. Melainkan Artikel Berita akan di alihkan kedalam kelompok Uncategories.
					</p>
					<small>Delete Tag, <cite title="Berita">Berita</cite></small>
				</blockquote>
			</section>
		</div>

		<div class="col-md-4">
			<section class="panel panel-transparent">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="fa fa-caret-down"></a>
					</div>

					<h2 class="panel-title">Tag Baru</h2>
				</header>
				<form id="add_tags" class="form-horizontal form-bordered">
				<div class="panel-body">
					<div class="row form-group">
						<div class="col-md-12">							
							<label class="control-label" for="c_name">Nama</label>
							<input name="c_name" id="c_name" placeholder="Nama Tag" type="text" class="form-control">
						</div>
					</div>
				</div>
				<footer class="panel-footer">
					<button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit </button>
					<button type="reset" class="btn btn-default">Reset</button>
				</footer>				
				</form>
			</section>
		</div>
	</div>

</section>
</div>
<?php
@include(AdminFooter);
?>