<?php

/**
 * ZF2 Module Config file for Rcm
 *
 * This file contains all the configuration for the Module as defined by ZF2.
 * See the docs for ZF2 for more information.
 *
 * PHP version 5.3
 *
 * LICENSE: No License yet
 *
 * @category  Reliv
 * @package   ContentManager\ZF2
 * @author    Westin Shafer <wshafer@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   http://www.nolicense.com None
 * @version   GIT: <git_id>
 * @link      http://ci.reliv.com/confluence
 */

$elFinder['mounts'] = array(
    'files' => array (
        'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
        'path'          => __DIR__.'/../../../../public/modules/elfinder/files/',         // path to files (REQUIRED)
        'URL'           => '/modules/elfinder/files/', // URL to files (REQUIRED)
        'accessControl' => 'access',             // disable and hide dot starting files (OPTIONAL)
        'attributes' => array(
            array( // hide readmes
                'pattern' => '/images/',
                'read' => false,
                'write' => false,
                'hidden' => true,
                'locked' => false
            ),
        ),
    ),

    'images' => array(
        'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
        'path'          => __DIR__.'/../../../../public/modules/elfinder/files/images/',         // path to files (REQUIRED)
        'URL'           => '/modules/elfinder/files/images/', // URL to files (REQUIRED)
        'uploadAllow' => array('image'),        //Allowed types
        'uploadOrder' => array('allow', 'deny'), // White list
        'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
    ),
);

return array(

    'elfinder' => array(
        'connectorPath' => '/elfinder/connector',  //See routes below.  This must be routeable.
        'publicFolder' => '/modules/elfinder',
        'mounts' => array(
            'images' => array(
                'roots' => array(
                    'images' => $elFinder['mounts']['images']
                ),
            ),
            'defaults' => array(
                'roots' => array(
                    $elFinder['mounts']['files']
                ),
            ),
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            'ElFinder\Controller\IndexController'
            => 'ElFinder\Controller\IndexController',
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    
    'router' => array(
        'routes' => array (
            'elFinder' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/elfinder[/:fileType]',
                    'defaults' => array(
                        'controller'
                        => 'ElFinder\Controller\IndexController',
                        'action'     => 'index',
                    ),
                ),
            ),
            'elFinderConnector' => array(
                'type'    => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/elfinder/connector[/:fileType]',
                    'defaults' => array(
                        'controller'
                        => 'ElFinder\Controller\IndexController',
                        'action'     => 'connector',
                    )
                ),
            ),
            'elFinderStandAlone' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/elfinder/standalone[/:fileType]',
                    'defaults' => array(
                        'controller'
                        => 'ElFinder\Controller\IndexController',
                        'action'     => 'standAlone',
                    ),
                ),
            ),
            'elFinderCkEditor' => array(
                'type'    => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/elfinder/ckeditor[/:fileType]',
                    'defaults' => array(
                        'controller'
                        => 'ElFinder\Controller\IndexController',
                        'action'     => 'ckEditorFileManager',
                    )
                ),
            ),
        ),
    ),


);