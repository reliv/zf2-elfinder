<?php
/**
 * Reliv Common's language not found exception
 *
 * Is thrown when a language is not found
 *
 * PHP version 5.3
 *
 * LICENSE: No License yet
 *
 * @category  Reliv
 * @package   Common\Exception
 * @author    Rod McNew <rmcnew@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   http://www.nolicense.com None
 * @version   GIT: <git_id>
 * @link      http://ci.reliv.com/confluence
 */
namespace Rcm\Exception;

/**
 * Reliv Common's language not found exception
 *
 * Is thrown when a language is not found
 *
 * @category  Reliv
 * @package   Common\Exception
 * @author    Rod McNew <rmcnew@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   http://www.nolicense.com None
 * @version   Release: 1.0
 * @link      http://ci.reliv.com/confluence
 */
class LanguageNotFoundException
    extends \InvalidArgumentException
    implements \Rcm\Exception\ExceptionInterface
{

}
