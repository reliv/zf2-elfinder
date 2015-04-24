Zf2 Module for ElFinder
============== 
This module attempts to provide an integration layer between Zend Framework 2
and ElFinder.

Currently this module provides the configuration for routing to elfinder through
the following path `http://yourdomain.com/elfinder` and the connector is
located by default at `http://yourdomain.com/elfinder/connector`.  All of this
can be changed via configuration.

Also included are the needed hooks for CKEditor and TinyMce.

##IMPORTANT SECURITY NOTICE
This module DOES NOT provide any user authentication and if used on
it's own will grant anyone access to your public file system! It is expected
that through ZF2 you will be setting up your own authentication and user
management system.  For that reason this module has no plans for including any.
But if you need authentication you may want to check out the ZfUser module and
see if that works for you.


## Requirements
[PHP 5.4+](http://php.net/)
[Zend Framework 2](http://www.github.com/zendframework/zf2)

## Installation
This package uses composer to install.

#### Installation steps
  1. Edit your composer.json file from the root directory of your ZF2
     installation.

  2. If not already set you'll need to add the following line to your
     composer.json file.
     ```json
         "minimum-stability": "dev"
     ```

  3. Add the following to the "require" section of the file

     ```json
                 "reliv/elfinder" : "dev-master"
     ```

  4. Run `php composer.phar install` or `php composer.phar update`

  5. Once the package is installed you will find this under
     `vendor\reliv\elfinder` inside this folder you'll need to copy or symlink
     the public folder for this module to the public folder inside your project.
     By default the module expects to find all public assets under
     `[zf2 project folder]/public/modules/el-finder`.  *This path can be adjusted
     using a configuration flag if needed.

  6. Add 'ElFinder' to your list of modules in `[zf2 project folder]/config/application.config.php`

  7. (Optional) Configure the module for use in your project (see configuration
     below)

  8. (Optional) Add ElFinder finder to your views that need it.

  9. Test it out and report any bugs or issues back to the project.

  10. Tell others about it.


## Adding ElFinder to your project

#### Stand Alone
If just wanting to test out or use ElFinder as a standalone File Manager,
simply navigate your browser to the standalone route for ElFinder.  If your
using the defaults this URL is `http://yourdomain.com/elfinder/standalone`

#### CkEditor
To add ElFinder to CKEditor add the route to the explore window to
 CkEditors config.  This can be done when your initializing your editor or
simply by adding this to the CkEditor's global config file.  By default the
config file is located in CkEditors main folder `path/to/ckeditor/config.js`.

Add the following lines to CkEditor's config

```javascript
    filebrowserBrowseUrl : '/elfinder/ckeditor',
    filebrowserImageBrowseUrl : '/elfinder/ckeditor/images',
```

Note:  If you've changed the default routes to ElFinder, be sure to point the
code above to the correct place.


Optionally you can customize CkEditors popup window size to fit your needs
by adding the following line to CkEditors config and adjusting to your taste.

```javascript
    filebrowserWindowHeight : '400',
    filebrowserWindowWidth : '800'
```

#### TinyMce
To add ElFinder to TinyMce copy the 'public/tinymce/plugins/elfinder'
to your TinyMce instance plugins folder.

Register the plugin with TinyMce.

```javascript
    tinymce.init({
        ....
        plugins: 'elfinder',
        ....
    });
```


#### Using in your own application
This module can be used as a file uploader or to pick an existing file from
existing mount points.  In order to do that your program will need to open
up a popup window that points to the ElFinder's explorer window.  In addition
to that, the calling window MUST have a global javascript function defined.

The following is an example that you might add to your page:

```javascript
<script type="javascript">
function elFinderFileSelected(filePath) {
    // Do something with the file path returned.
}

function showElFinder(elFinderExplorerPath, windowWidth, windowHeight) {
    window.open(
        elFinderExplorerPath,
        '',
        'resizable=yes,
        location=no,
        menubar=no,
        scrollbars=yes,
        status=no,
        toolbar=no,
        fullscreen=no,
        dependent=no,
        width=windowWidth,
        height=windowHeight,
        status'
    );
}
</script>
```

## Configuration (Optional)

This module uses basic ZF2 configuration and passes this information on to
ElFinder.  All [server connector options](https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options)
are available to you but because there's not a one size fits all to this
we've extended this just a little so you can have additional or specific
settings based on your needs.

This module comes with some pre-defined configuration to get you up and running
as quickly as possible.  *Please Note: To use default configuration the contents
of the public folder for this modules must be located in
`[project home]/public/modules/el-finder`.  In other words `modules/el-finder`
must be publicly accessible.


####Configuring Mount Points

By default the system sets up two default mount points for you,
`[project home]/public/modules/el-finder/files` and
`[project home]/public/modules/el-finder/files/images` however there is no
limit to how many mount points you can define.

To add a new mount point simply open up your application config or projects
global config file and add your mount points like so.

```php
return array(
    'elfinder' => array(
        'mounts' => array(
            'defaults' => array(
                'myNewMountPoint' => array (
                    //Mount point definition goes here.
                    //Minimum config below.  See ElFinders "Connector
                    //configuration options" for more info
                    'roots' => array(
                        'driver' => 'LocalFileSystem',
                        'path'   => '/path/to/files/',
                        'URL'    => 'http://localhost/to/files/'
                    ),
                ),
            ),
        ),
    ),
);
```

For a full list of all mount point configuration settings please see ElFinders
wiki page titled [Connector configuration options](https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options)


####Configuring the Zf2 routes

There are four routes defined by default.

    `/elfinder` - Main route to open the explorer window which will pass
                  back the url for the file selected to the calling window.

    `/elfinder/connector` - Route to ElFinders php connector
    `/elfinder/standalone` - Route to standalone window.  This has no callback
                             and can be used by itself to manage the filesystem

    `/elfinder/ckeditor` - Hook for CKEditor


All of these routes can be customized based on your preferences.  To overwrite
these routes open up your application or project config and define the following
routes as needed:

```php
return array(
    'router' => array(
        'routes' => array (
            'elFinder' => array( // route definition goes here // ),
            'elFinderConnector' => array( // route definition goes here // ),
            'elFinderStandAlone' => array( // route definition goes here // ),
            'elFinderCkEditor' => array( // route definition goes here // ),
        ),
    ),
);
```

Important:  Please note that if you change the route for the connector you
will need to add the following lines to your application or project configuration
files:

```php
return array(
    'elfinder' => array(
        'connectorPath' => 'path/to/connector',
    )
);
```



####Additional Special configuration

This module is setup to understand and respect different configurations, mount
points, and settings based your needs.  This is done all through configuration.
As an example CKEditor uses a special flag for uploading Images.  So for
that we have setup an images folder that only allows images to uploaded.

To setup a different configuration you'll want to open up your application or
project config files and add the following:

```php
return array(
    'elfinder' => array(
        'mounts' => array(

            //Set Name for this configuration
            'myNewFileTypeOrConfigName' => array(

                //Mount point definition goes here.
                //Minimum config below.  See ElFinders "Connector
                //configuration options" for more info

                'myNewMountPoint' => array (
                    //Mount point definition goes here.
                    //Minimum config below.  See ElFinders "Connector
                    //configuration options" for more info
                    'roots' => array(
                        'driver' => 'LocalFileSystem',
                        'path'   => '/path/to/files/',
                        'URL'    => 'http://localhost/to/files/'
                    ),
                ),

            ),
        ),
    ),
);
```

Once that's complete, setup your view for ElFinder as described above, with
one exception.  You need to add your new definition or type to the URL or route
to ElFinder.   If using the example above my new URL this instance of ElFinder
would be `/elfinder/images`





##To Do
Setup MySql connector to use Zend DB or at least pass in the current DB settings
to ElFinders MySql connector class.

Setup MySql connector to use Doctrine ORM Module or at least pass in the current
DB settings when using Doctrine.




[elFinder](http://github.com/Studio-42/elFinder)
------------

<pre>
      _ ______ _           _
     | |  ____(_)         | |
  ___| | |__   _ _ __   __| | ___ _ __
 / _ \ |  __| | | '_ \ / _` |/ _ \ '__|
|  __/ | |    | | | | | (_| |  __/ |
 \___|_|_|    |_|_| |_|\__,_|\___|_|
</pre>

elFinder is an open-source file manager for web, written in JavaScript using
jQuery UI. Creation is inspired by simplicity and convenience of Finder program
used in Mac OS X operating system.


Features
--------

 * All operations with files and folders on a remote server (copy, move,
   upload, create folder/file, rename, etc.)
 * High performance server beckend and light client UI
 * Multi-root support
 * Local file system, MySQL, FTP volume storage drivers
 * Background file upload with Drag & Drop HTML5 support
 * List and Icons view
 * Kayboard shortcuts
 * Standart methods of file/group selection using mouse or keyboard
 * Move/Copy files with Drag & Drop
 * Archives create/extract (zip, rar, 7z, tar, gzip, bzip2)
 * Rich context menu and toolbar
 * Quicklook, preview for common file types
 * Edit text files and images
 * "Places" for your favorites
 * Calculate directory sizes
 * Thumbnails for image files
 * Easy to integrate with web editors (elRTE, CKEditor, TinyMCE)
 * Flexible configuration of access rights, upload file types, user interface
   and other
 * Extensibility
 * Simple client-server API based on JSON


Requirements
------------

### Client
 * Modern browser. elFinder was tested in Firefox 10, Internet Explorer 8+,
   Safari 5, Opera 11 and Chrome 15+

### Server
 * Any web server
 * PHP 5.2+ (for thumbnails - mogrify utility or GD/Imagick module)


3rd party connectors
--------------------
 * [Python](https://github.com/Studio-42/elfinder-python)
 * [Django](https://github.com/mikery/django-elfinder)
 * [Ruby/Rails](https://github.com/phallstrom/el_finder)
 * [Java Servlet](https://github.com/Studio-42/elfinder-servlet)
 * [ASP.NET Integration](http://code.google.com/p/elfinderintegration/)
 * [elFinder .Net connector](http://elfinderconnectornet.codeplex.com/)


Support
-------

 * [Homepage](http://elfinder.org)
 * [Wiki](https://github.com/Studio-42/elFinder/wiki)
 * [Issues](https://github.com/Studio-42/elFinder/issues)
 * [Forum](http://elfinder.org/forum/)
 * <dev@std42.ru>


Authors
-------

 * Chief developer: Dmitry "dio" Levashov <dio@std42.ru>
 * Maintainer: Troex Nevelin <troex@fury.scancode.ru>
 * Developers: Alexey Sukhotin <strogg@yandex.ru>, Naoki Sawada <hypweb@gmail.com>
 * Icons: [PixelMixer](http://pixelmixer.ru), [Yusuke Kamiyamane](http://p.yusukekamiyamane.com)

We hope our tools will be helpful for you.


License
-------

elFinder is issued under a 3-clauses BSD license.

<pre>
Copyright (c) 2009-2012, Studio 42
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:
    * Redistributions of source code must retain the above copyright
      notice, this list of conditions and the following disclaimer.
    * Redistributions in binary form must reproduce the above copyright
      notice, this list of conditions and the following disclaimer in the
      documentation and/or other materials provided with the distribution.
    * Neither the name of the Studio 42 Ltd. nor the
      names of its contributors may be used to endorse or promote products
      derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL "STUDIO 42" BE LIABLE FOR ANY DIRECT, INDIRECT,
INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE
OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
</pre>
