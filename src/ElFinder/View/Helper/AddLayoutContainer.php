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
class AddLayoutContainer extends AbstractHelper
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
    public function __invoke($containerNum)
    {
        return $this->renderLayoutContainer($containerNum);
    }

    /**
     * Will render all plugins for the container passed to it.  For instance if
     * I want to render container number two in my page layout I would call
     * echo $this->view->addLayoutContainer(2);
     * Note: This object expects or assumes that the view or page layout has
     * an array of plugin view objects to render.
     *
     * @param array $containerNum Container Number to Render
     *
     * @return string Rendered HTML from plugins for the container specified
     */
    public function renderLayoutContainer($containerNum)
    {
        /** @var \Zend\View\Renderer\PhpRenderer $renderer */
        $renderer = $this->getView();

        /** @var \Zend\View\Helper\ViewModel $helper  */
        $helper = $renderer->plugin('view_model');

        $view = $helper->getCurrent();

        $plugins  =  $view->plugins;

        $html = '<div id="rcmContainer_'.$containerNum.'">';

        $loopCount = 0;

        if (!empty($plugins[$containerNum])
            && is_array($plugins[$containerNum])
        ) {
            /** @var \Rcm\Entity\PluginInstance $plugin */
            foreach ($plugins[$containerNum] as $plugin) {
                $pluginInstanceId = $plugin->getInstanceId();
                $pluginName = $plugin->getPlugin()->getName();

                $html .= '<div id="rcmContainer_'.$containerNum.'_';
                $html .= $loopCount.'">';

                $html .= '<div data-rcmPluginName="'.$pluginName.'" ';
                $html .= 'data-rcmPluginInstanceId="'.$pluginInstanceId.'" ';
                $html .= 'data-rcmContainer="'.$containerNum.'" ';

                if ($plugin->isSiteWide()) {
                    $html .= 'data-rcmSiteWidePlugin="Y" ';
                } else {
                    $html .= 'data-rcmSiteWidePlugin="N" ';
                }

                $html .= '>';

                $html .= $renderer->render($plugin->getView());
                $html .= '</div>';

                $html .= '</div>';

                $loopCount++;
            }
        }

        $html .= '</div>';

        $helper->setCurrent($view);

        return $html;
    }
}
