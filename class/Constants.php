<?php

declare(strict_types=1);


namespace XoopsModules\Wglinks;

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgBlocks module for xoops
 *
 * @copyright    2021 XOOPS Project (https://xoops.org)
 * @license      GPL 2.0 or later
 * @package      wglinks
 * @author       Goffy - Wedega.com - Email:webmaster@wedega.com - Website:https://xoops.wedega.com
 */

/**
 * Interface  Constants
 */
interface Constants
{

    // Constants for status
    public const int STATUS_OFFLINE = 0;
    public const int STATUS_ONLINE  = 1;

    // Constants for link types
    public const int TYPE_CONTENT = 0;
    public const int TYPE_DIRECT  = 1;

    // Constants for link target
    public const string TARGET_SELF   = '_self';
    public const string TARGET_BLANK  = '_blank';
    public const string TARGET_PARENT = '_parent';
    public const string TARGET_TOP    = '_top';

}
