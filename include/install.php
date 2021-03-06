<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgLinks module for xoops
 *
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        wglinks
 * @since          1.0
 * @min_xoops      2.5.7
 * @author         XOOPS on Wedega - Email:<webmaster@wedega.com> - Website:<https://xoops.wedega.com>
 * @version        $Id: 1.0 install.php 13070 Sun 2016-03-20 15:20:15Z XOOPS Development Team $
 */
// Copy base file
$indexFile = XOOPS_UPLOAD_PATH.'/index.html';
$blankFile = XOOPS_UPLOAD_PATH.'/blank.gif';
// Making of uploads/wglinks folder
$wglinks = XOOPS_UPLOAD_PATH.'/wglinks';
if(!is_dir($wglinks)) {
	mkdir($wglinks, 0777);
	chmod($wglinks, 0777);
}
copy($indexFile, $wglinks.'/index.html');
// Making of cats uploads folder
$categories = $wglinks.'/categories';
if(!is_dir($categories)) {
    mkdir($categories, 0777);
    chmod($categories, 0777);
}
copy($indexFile, $categories.'/index.html');
// Making of links uploads folder
$links = $wglinks.'/links';
if(!is_dir($links)) {
	mkdir($links, 0777);
	chmod($links, 0777);
}
copy($indexFile, $links.'/index.html');

// Making of images folder
$images = $wglinks.'/images';
if(!is_dir($images)) {
	mkdir($images, 0777);
	chmod($images, 0777);
}
copy($indexFile, $images.'/index.html');
copy($blankFile, $images.'/blank.gif');
// Making of images/links folder
$links = $images.'/links';
if(!is_dir($links)) {
	mkdir($links, 0777);
	chmod($links, 0777);
}
copy($indexFile, $links.'/index.html');
copy($blankFile, $links.'/blank.gif');
$links = $images.'/links/large';
if(!is_dir($links)) {
	mkdir($links, 0777);
	chmod($links, 0777);
}
copy($indexFile, $links.'/index.html');
copy($blankFile, $links.'/blank.gif');
$links = $images.'/links/thumbs';
if(!is_dir($links)) {
	mkdir($links, 0777);
	chmod($links, 0777);
}
copy($indexFile, $links.'/index.html');
copy($blankFile, $links.'/blank.gif');

// Making of images/links folder
$categories = $images.'/categories';
if(!is_dir($categories)) {
    mkdir($categories, 0777);
    chmod($categories, 0777);
}
copy($indexFile, $categories.'/index.html');
copy($blankFile, $categories.'/blank.gif');
// ------------------- Install Footer ------------------- //
