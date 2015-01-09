<?php
/**
* @package      Qapuas 5.0
* @version      Dev : 5.0
* @author       Rosi Abimanyu Yusuf <bima@abimanyu.net>
* @license      http://creativecommons.org/licenses/by-nc/3.0/ CC BY-NC 3.0
* @copyright    2015
* @since        File available since 5.0
* @category     Themes Menu
*/

if (SUBADMIN) {
echo "
<div class=\"inner-wrapper\">
<aside id=\"sidebar-left\" class=\"sidebar-left\">
                
<div class=\"sidebar-header\">
<div class=\"sidebar-title\">Navigation</div>
<div class=\"sidebar-toggle hidden-xs\" data-toggle-class=\"sidebar-left-collapsed\" data-target=\"html\" data-fire-event=\"sidebar-left-toggle\"><i class=\"fa fa-bars\" aria-label=\"Toggle sidebar\"></i></div>
</div>

<div class=\"nano\">
<div class=\"nano-content\">
<nav id=\"menu\" class=\"nav-main\" role=\"navigation\">
<ul class=\"nav nav-main\">
<li class=\"landing\"><a href=\"".c_LANDING."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i><span>Dashboard</span></a></li>
<li class=\"nav-parent nav1\"><a href=\"#\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i><span>Berita</span></a>
    <ul class=\"nav nav-children\">
        <li class=\"fk\"><a href=\"#\">Berita</a></li>
        <li class=\"rt\"><a href=\"#\">Tambah Berita</a></li>
    </ul>
</li>
<li class=\"nav-parent nav2\"><a href=\"#\"><i class=\"fa fa-tags\" aria-hidden=\"true\"></i><span>Kategori &amp; Tags</span></a>
    <ul class=\"nav nav-children\">
        <li class=\"fk\"><a href=\"#\">Kategori</a></li>
        <li class=\"rt\"><a href=\"#\">Tags</a></li>
    </ul>
</li>
<li class=\"nav-parent nav3\"><a href=\"#\"><i class=\"fa fa-database\" aria-hidden=\"true\"></i><span>Database</span></a>
    <ul class=\"nav nav-children\">
        <li class=\"fk\"><a href=\"#\">Peta</a></li>
        <li class=\"rt\"><a href=\"#\">Files Download</a></li>
    </ul>
</li>
<li class=\"nav-parent nav-cat\"><a href=\"#\"><i class=\"fa fa-copy\" aria-hidden=\"true\"></i><span>Pages</span></a>
    <ul class=\"nav nav-children\">
        <li class=\"pg\"><a href=\"".c_URL.$ModuleDir."pages/\">Pages</a></li>
        <li class=\"pk\"><a href=\"".c_URL.$ModuleDir."pages/cat/\">Kategori Pages</a></li>
    </ul>
</li>
<li class=\"nav-parent nav5\"><a href=\"#\"><i class=\"fa fa-file-image-o\" aria-hidden=\"true\"></i><span>Media</span></a>
    <ul class=\"nav nav-children\">
        <li class=\"fk\"><a href=\"#\">Images</a></li>
        <li class=\"rt\"><a href=\"#\">Video</a></li>
    </ul>
</li>
<li class=\"rp\"><a href=\"#\"><i class=\"fa fa-bar-chart-o\" aria-hidden=\"true\"></i><span>Statistics</span></a></li>
<li class=\"cs\"><a href=\"".c_URL.$ModuleDir."customer/\"><i class=\"fa fa-users\" aria-hidden=\"true\"></i><span>Users</span></a></li>
<li class=\"st\"><a href=\"#\"><i class=\"fa fa-cogs\" aria-hidden=\"true\"></i><span>Settings <em class=\"not-included\">(Global)</em></span></a></li>
</ul>
</nav>
<hr class=\"separator\" />
<div class=\"sidebar-widget widget-stats\">
<div class=\"sidebar-copyright\">
    <p>&copy;2015 ".c_APP." ".c_APPVER.".</p>
    <p>".c_CLIENT.". All Rights Reserved.</p>
</div>
</div>
</div>
</div>
</aside>
";
}
//CEK_PASSWORD_EXPIRED();
?>