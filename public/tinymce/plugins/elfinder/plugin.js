tinymce.PluginManager.add(
    "elfinder", function (editor, url) {
        editor.settings.file_browser_callback = function (id, value, type, win) {

            /**
             * This is to be consistent between the different editors
             * @type {{image: string}}
             */
            var typeMap = {
                'image': 'images'
            }

            var getTypeMapValue = function(value){

                if(typeMap[value]){

                    return typeMap[value];
                }

                return value;
            }

            tinymce.activeEditor.windowManager.open(
                {
                    file: '/elfinder/tinymce/' + getTypeMapValue(type),// use an absolute path!
                    title: 'File Browser',
                    width: 750,
                    height: 450,
                    resizable: 'yes'
                }, {
                    setUrl: function (value) {
                        win.document.getElementById(id).value = value;
                    }
                }
            );
            return false;
        };
    }
);