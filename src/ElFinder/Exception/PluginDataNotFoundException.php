<?php
/**
 * Plugin Instance Not Found Exception
 *
 * The Plugin Instance Not Found Exception is used when the system asks for a
 * plugin instance that does not exist
 *
 * PHP version 5.3
 *
 * LICENSE: No License yet
 *
 * @category  Reliv
 * @package   Navigation\Exception
 * @author    Rod McNew <rmcnew@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   http://www.nolicense.com None
 * @version   GIT: <git_id>
 * @link      http://ci.reliv.com/confluence
 */
namespace ElFinder\Exception;

/**
 * Reliv Common's Invalid Argument Exception
 *
 * This file contains the methods to throw an SPL invalid argument exception
 * from with in the Reliv Common Module
 *
 * @category  Reliv
 * @package   RcmPlugins\Navigation
 * @author    Rod McNew <rmcnew@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   http://www.nolicense.com None
 * @version   Release: 1.0
 * @link      http://ci.reliv.com/confluence
 */
class PluginDataNotFoundException extends \RuntimeException
    implements ExceptionInterface
{

}
