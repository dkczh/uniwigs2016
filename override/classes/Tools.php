<?php
class Tools extends ToolsCore
{
    protected static $is_addons_up = false;
    public static function addonsRequest($request, $params = array())
    {
        return false;
    }
}
