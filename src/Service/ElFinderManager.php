<?php
/**
 * Service ElFinderManager
 *
 * This file contains the service ElFinderManager used by Controllers.
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
namespace Reliv\ElFinder\Service;

class ElFinderManager
{

    /** @var ServiceManager */
    public $serviceManager;
    private function getServiceLocator(){
        return $this->serviceManager;
    }
    public function __construct($sm){
        $this->serviceManager = $sm;
    }

    public function getElFinderConfig($mount)
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