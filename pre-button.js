// TinyMCE Plugin for <pre> button
// Version 1.0
// @package WordPress Sverige

(function() {
    tinymce.PluginManager.add('wpsvse_pre_btn', function( editor, url ) {
        editor.addButton( 'wpsvse_pre_btn', {
            title: 'Kod',
            icon: 'wp_code',
            onclick: function() {
								editor.windowManager.open( {
										width: 500,
   									height: 450,
										title: 'Infoga din kod',
										body: [{
												type: 'textbox',
												multiline: true,
												minHeight: 405,
												name: 'codeblock',
										}],
										onsubmit: function( e ) {
												editor.insertContent( '<pre>' + e.data.codeblock + '</pre>');
										}
								});
						}
        });
    });
})();