<?php
/*------------------------------------------------------------------------

# TZ MULTIPURPOSE Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2013 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/
function tzMULTIPURPOSEimport($package)
{
    $path = COM_TZ_MULTIPURPOSE_ADMIN_PATH . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR
        . $package. '.php';
    if (file_exists($path)) {
        include_once $path;
    } else {
        trigger_error('tzmultipurposeimport not found object: ' . $package, E_USER_ERROR);
    }
}

