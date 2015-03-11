    /**
     * @summary	Allow the user to select a file, and then use the file's URL to create a download link on the fly.
     * @since	1.0.0
     */

    jQuery(function($){
        $(document).ready(function(){
            $('#insert-plist-file').click(open_media_window);
        })

        function open_media_window(){
            if ( this.window === undefined ) {
                this.window = wp.media({
                    title:    'Insert a .plist file',
                    library:  {type:'*'},
                    multiple: true,
                    button:   {text:'Get Link'}
                });

                var self = this; // Needed to retrieve the function below
                this.window.on('select',function(){
                    var files = self.window.state().get('selection').toArray();
                    var fileURL;
                    for ( var i = 0; i < files.length; i++ ) {
                        var file = files[i].toJSON();
                        if ( fileURL === undefined ){
                            var fileURL = file.url;
                        } else {
                            var fileURL = fileURL + ',' + file.url;
                        }
                    };
                    wp.media.editor.insert(fileURL);
                    console.log( 'fileURL=' + fileURL );
                    var itms = 'itms-services://?action=download-manifest&url=';
                    var link = '<a href=\"' + itms + fileURL + '\">Download!</a>';
                    var header_link = '<h1>' + link + '</h1>';
                    document.getElementById('link').innerHTML = header_link;
                    var message = 'Please check your home screen for progress after touching the Install button';
                    document.getElementById('message').innerHTML = message;
                });
            }

            this.window.open();
            return false; 
        }
    });
