<?php

/**
 * Reliv Common's Runtime Exception
 *
 * This file contains the methods to throw an SPL Runtime exception
 * from with in the Reliv Common Module
 *
 * PHP version 5.3
 *
 * LICENSE: No License yet
 *
 * @category  Reliv
 * @package   Common\Exception
 * @author    Westin Shafer <wshafer@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   http://www.nolicense.com None
 * @version   GIT: <git_id>
 * @link      http://ci.reliv.com/confluence
 */
namespace ElFinder\Exception;

/**
 * Reliv Common's Runtime Exception
 *
 * This file contains the methods to throw an SPL Runtime argument exception
 * from with in the Reliv Common Module
 *
 * @category  Reliv
 * @package   Common\Exception
 * @author    Westin Shafer <wshafer@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   http://www.nolicense.com None
 * @version   Release: 1.0
 * @link      http://ci.reliv.com/confluence
 */

class RuntimeException
    extends \RuntimeException
    implements \Zend\Acl\Exception\ExceptionInterface
{
    
}
