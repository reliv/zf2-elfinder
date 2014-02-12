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
 * @author    Westin Shafer <wshafer@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   License.txt New BSD License
 * @version   GIT: <git_id>
 */
namespace ElFinder\Exception;

/**
 * Reliv Common's Runtime Exception
 *
 * This file contains the methods to throw an SPL Runtime argument exception
 * from with in the Reliv Common Module
 *
 * @category  Reliv
 * @author    Westin Shafer <wshafer@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: 1.0
 */

class RuntimeException
    extends \RuntimeException
    implements \Zend\Acl\Exception\ExceptionInterface
{
    
}
