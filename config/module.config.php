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
 * @author    Westin Shafer <wshafer@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   License.txt New BSD License
 * @version   GIT: <git_id>
 */

$elFinder['mounts'] = array(
    'files' => array (
        'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
        'path'          => __DIR__.'/../../../../public/modules/el-finder/files/',         // path to files (REQUIRED)
        'URL'           => '/modules/el-finder/files/', // URL to files (REQUIRED)
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
        'path'          => __DIR__.'/../../../../public/modules/el-finder/files/images/',         // path to files (REQUIRED)
        'URL'           => '/modules/el-finder/files/images/', // URL to files (REQUIRED)
        'uploadAllow' => array('image'),        //Allowed types
        'uploadOrder' => array('allow', 'deny'), // White list
        'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
    ),
);

return array(

    'elfinder' => array(
        'useGoogleJquery' => true,
        'disableLayouts' => true,
        'connectorPath' => '/elfinder/connector',  //See routes below.  This must be routeable.
        'publicFolder' => '/modules/el-finder',
        'mounts' => array(
            'images' => array(
                'roots' => array(
                    'images' => $elFinder['mounts']['images']
                ),
            ),
            'defaults' => array(
                'roots' => array(
                    'defaults' => $elFinder['mounts']['files']
                ),
            ),
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            /*
             * Do not change this invokable name.
             * Some implementations override it to add security hooks.
             */
            'ElFinderIndexController'
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
                        => 'ElFinderIndexController',
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
                        => 'ElFinderIndexController',
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
                        => 'ElFinderIndexController',
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
                        => 'ElFinderIndexController',
                        'action'     => 'ckEditorFileManager',
                    )
                ),
            ),
        ),
    ),


);