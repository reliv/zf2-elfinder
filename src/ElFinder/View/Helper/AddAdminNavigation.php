<?php
/**
* Add Layout Container Helper.
*
* Contains the view helper to add a layout container to a page layout
*
* PHP version 5.3
*
* LICENSE: No License yet
*
* @category  Reliv
* @package   Common\View\Helper
* @author    Westin Shafer <wshafer@relivinc.com>
* @copyright 2012 Reliv International
* @license   http://www.nolicense.com None
* @version   GIT: <git_id>
* @link      http://ci.reliv.com/confluence
*/

namespace Rcm\View\Helper;

use \Zend\View\Helper\AbstractHelper;

/**
* Create a layout container in your page layouts.
*
* This is a view helper to render out page containers inside page layouts.
*
* @category  Reliv
* @package   Common\View\Helper
* @author    Westin Shafer <wshafer@relivinc.com>
* @copyright 2012 Reliv International
* @license   http://www.nolicense.com None
* @version   Release: 1.0
* @link      http://ci.reliv.com/confluence
*
*/
class AddAdminNavigation extends AbstractHelper
{
    /**
    * Function called when using $this->view->addLayoutContainer().  Will
    * call method renderLayoutContainer.  See method renderLayoutContainer
    * for more info
    *
    * @param array $containerNum Container Number to Render
    *
    * @return string Rendered HTML from plugins for the container specified
    */
    public function __invoke($data)
    {
    return $this->renderAdminNav($data);
    }

    public function renderAdminNav($data)
    {
        if (empty($data) || !is_array($data)) {
            return null;
        }

        $html = '';

        foreach ($data as $linkName => $link) {

            if (empty($link)) {
                continue;
            }

            $html .= '<li class="'.$link['cssClass'].'">';
            $html .= '<a href="'.$link['href'].'"';

            if (!empty($link['links']) && is_array($link['links'])) {
                $html .= 'class="additionalMenus"';
            }

            $html .= '>'.$linkName.'</a>';

            if (!empty($link['links']) && is_array($link['links'])) {
                $html .= '<ul>';
                    $html .= $this->renderAdminNav($link['links']);
                $html .= '</ul>';
            }
        }

        return $html;
    }
}