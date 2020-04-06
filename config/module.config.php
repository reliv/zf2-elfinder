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

    'files' => array(
        'driver' => 'LocalFileSystem',
        // driver for accessing file system (REQUIRED)
        'path' => __DIR__ . '/../public/files/',
        // path to files (REQUIRED)
        'URL' => '/modules/el-finder/files/',
        // URL to files (REQUIRED)
        'accessControl' => 'access',
        // disable and hide dot starting files (OPTIONAL)
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
        // driver for accessing file system (REQUIRED)
        'driver' => 'LocalFileSystem',

        // path to files (REQUIRED)
        'path' =>
            __DIR__ . '/../public/files/images/',

        // URL to files (REQUIRED)
        'URL' => '/modules/el-finder/files/images/',

        //Allowed types
        'uploadAllow' => array('image'),

        // White list
        'uploadOrder' => array('allow', 'deny'),

        // disable and hide dot starting files (OPTIONAL)
        'accessControl' => 'access'
    ),
);

return array(

    'elfinder' => array(
        'useGoogleJquery' => true,
        'disableLayouts' => true,
        'connectorPath' => '/elfinder/connector',
        'mounts' => array(
            'images' => array(
                'roots' => array(
                    'images' => $elFinder['mounts']['images']
                ),
            ),
            'defaults' => array(
                'roots' => array(
                    'defaults' => $elFinder['mounts']['files'],
                ),
            ),
        ),
    ),

    'controllers' => array(
        'factories' => array(
            'ElFinderIndexController' => 'Reliv\ElFinder\Controller\IndexControllerFactory',
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(__DIR__ . '/../view',),
    ),

    'router' => array(
        'routes' => array(
            'elFinder' => array(
                'type' => \Laminas\Router\Http\Segment::class,
                'options' => array(
                    'route' => '/elfinder[/:fileType]',
                    'defaults' => array(
                        'controller'
                        => 'ElFinderIndexController',
                        'action' => 'index',
                    ),
                ),
            ),
            'elFinderConnector' => array(
                'type' => \Laminas\Router\Http\Segment::class,
                'options' => array(
                    'route' => '/elfinder/connector[/:fileType]',
                    'defaults' => array(
                        'controller'
                        => 'ElFinderIndexController',
                        'action' => 'connector',
                    )
                ),
            ),
            'elFinderStandAlone' => array(
                'type' => \Laminas\Router\Http\Segment::class,
                'options' => array(
                    'route' => '/elfinder/standalone[/:fileType]',
                    'defaults' => array(
                        'controller'
                        => 'ElFinderIndexController',
                        'action' => 'standAlone',
                    ),
                ),
            ),
            'elFinderCkEditor' => array(
                'type' => \Laminas\Router\Http\Segment::class,
                'options' => array(
                    'route' => '/elfinder/ckeditor[/:fileType]',
                    'defaults' => array(
                        'controller'
                        => 'ElFinderIndexController',
                        'action' => 'ckEditorFileManager',
                    )
                ),
            ),
            'elFinderTinyMce' => array(
                'type' => \Laminas\Router\Http\Segment::class,
                'options' => array(
                    'route' => '/elfinder/tinymce[/:fileType]',
                    'defaults' => array(
                        'controller'
                        => 'ElFinderIndexController',
                        'action' => 'tinymceFileManager',
                    )
                ),
            ),
        ),
    ),

    'asset_manager' => array(
        'resolver_configs' => array(
            'aliases' => array(
                'modules/el-finder/js/' => __DIR__ . '/../../../studio-42/elfinder/js/',
                'modules/el-finder/css/' => __DIR__ . '/../../../studio-42/elfinder/css/',
                'modules/el-finder/img/' => __DIR__ . '/../../../studio-42/elfinder/img/',
                'modules/el-finder/sounds/' => __DIR__ . '/../../../studio-42/elfinder/sounds/',
                'modules/el-finder/files/' => __DIR__ . '/../public/files/',
                'modules/el-finder/files/images/' => __DIR__ . '/../public/files/images/'
            ),
        ),
    ),
	
	'service_manager' => array(
        'factories' => array(
            'ElFinderManager' => 'Reliv\ElFinder\Service\ElFinderManagerFactory'
        ),
    ),
);