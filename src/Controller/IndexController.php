<?php
/**
 * Index Controller for the entire application
 *
 * This file contains the main controller used for the application.  This
 * should extend from the base class and should need no further modification.
 *
 * PHP version 5.3
 *
 * LICENSE: No License yet
 *
 * @category  Reliv
 * @author    Unkown <unknown@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   License.txt New BSD License
 * @version   GIT: <git_id>
 */
namespace Reliv\ElFinder\Controller;

use Reliv\ElFinder\Config\ConfigInterface;
use Reliv\ElFinder\Exception\RuntimeException;
use Reliv\ElFinder\Exception\InvalidArgumentException;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Index Controller for the entire application
 *
 * This is main controller used for the application.  This should extend from
 * the base class located in Rcm and should need no further
 * modification.
 *
 * @category  Reliv
 * @author    Westin Shafer <wshafer@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: 1.0
 *
 */
class IndexController extends AbstractActionController
{
    /**
     * Index Action - Used when index or root document is called.
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $view = $this->init();
        $view->setTemplate('el-finder/index/index.phtml');
        return $view;
    }

    /**
     * ckEditorFileManagerAction
     *
     * @return ViewModel
     */
    public function ckEditorFileManagerAction()
    {
        $view = $this->init();
        $view->setTemplate('el-finder/index/ck-editor-file-manager.phtml');
        return $view;
    }

    /**
     * Gets view for TinyMce based selector
     * tinymceFileManagerAction
     *
     * @return ViewModel
     */
    public function tinymceFileManagerAction()
    {
        $view = $this->init();
        $view->setTemplate('el-finder/index/tinymce-file-manager.phtml');
        return $view;
    }

    public function standAloneAction()
    {
        $view = $this->init();
        $view->setTemplate('el-finder/index/stand-alone.phtml');
        return $view;
    }

    public function init()
    {
        $viewParams = array();

        $connectorPath = $this->getConnectorPath();
        $viewParams['connectorPath'] = $connectorPath;

        $fileType = $this->getEvent()->getRouteMatch()->getParam('fileType');
        if (!empty($type)) {
            $viewParams['connectorPath'] .= '/' . $fileType;
        }

        $config = $this->getConfig();
        $viewParams['useGoogleJquery'] = $config['useGoogleJquery'];

        $view = new ViewModel($viewParams);

        if (!empty($config['disableLayouts']) && $config['disableLayouts'] === true) {
            $this->layout()->setTemplate('el-finder/index/blank-layout');
        }

        return $view;
    }

    public function connectorAction()
    {
        error_reporting(0);

        $type = $this->getEvent()->getRouteMatch()->getParam('fileType', null);

        $mount = $this->getMountConfig($type);

        $connector = new \elFinderConnector(new \elFinder($mount));
        $connector->run();
    }

    public function access($attr, $path, $data, $volume)
    {
        return strpos(basename($path), '.') === 0
            // if file/folder begins with '.' (dot)
            ? !($attr == 'read' || $attr == 'write')
            // set read+write to false, other (locked+hidden) set to true
            : null; // else elFinder decide it itself
    }


    public function getConfig()
    {
        $config = $this->getServiceLocator()->get('config');
        return $config['elfinder'];
    }

    public function getConnectorPath()
    {
        $config = $this->getConfig();

        $connectorPath = $config['connectorPath'];
        if (empty($connectorPath)) {
            throw new RuntimeException("No Connector path found in Module config");
        }

        return $connectorPath;
    }

    protected function getMountConfig($type=null)
    {
        $config = $this->getConfig();
        $mount = $config['mounts']['defaults'];

        if (!empty($type) && !empty($config['mounts'][$type])) {
            $mount = $config['mounts'][$type];
        }

        return $this->getElFinderConfig($mount);
    }

    protected function getElFinderConfig($mount)
    {
        foreach ($mount['roots'] as $k => $v) {
            if (isset($v['configService'])) {
                $configService = $this->getServiceLocator()->get($v['configService']);

                if (!$configService instanceof ConfigInterface) {
                    throw new InvalidArgumentException(
                        $k.' configuration error: Service Configs must be an instance of the ConfigInterface.'
                    );
                }

                $mount['roots'][$k] = $configService->getConfig();
            }

            $mount['roots'][$k]['accessControl'] = array($this, 'access');
        }

        return $mount;
    }
}
