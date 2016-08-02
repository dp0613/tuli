$( document ).ready( function() {
	
	/*Assigning $_GET when click on sidebar items
	==================================================*/
	$( '.dp-menu' ).click( function() {
		var mod = $( this ).data( 'mod' ); //This var is global
		window.location = 'admin.php?mod=' + mod;
	} )
	
	/*Highlight sidebar items when click
	================================================*/
	var mod = location.href.split( '=' )[1];
	mod = mod === undefined ? 'home' : mod; //Fix issue when right now access admin page
	
	$( '.sidebar-active' ).removeClass( 'sidebar-active' );
	$( '.dp-menu[data-mod=' + mod + ']' ).addClass( 'sidebar-active' );
	
	/*Set title for window
	================================================*/
	var title = $( '.dp-menu[data-mod=' + mod + ']' ).html();
	document.title = title + ' - YIT Cpanel';
	
	
	/*Handling 2nd menu items click event
	===========================================================*/
	$( '.dp-2nd-menu-item' ).click( function() {
		
		//Highlight
		$( '.active' ).removeClass( 'active' );
		$( this ).addClass( 'active' );
		
		//Ajax load tpl
		var tpl = $( this ).data( 'tpl' );
		var inc = $( this ).data( 'inc' );
		var magic = $( this ).data( 'magic' );
		$.ajax( {
			url: '/modules/templates/' + tpl + '.tpl.php',
			type: 'GET',
			data: {},
			success: function( html ) {
				if( inc ) {
					//Get inc 
					$.ajax( {
						url: '/modules/includes/' + inc + '.inc.php',
						type: 'GET',
						data: {},
						success: function( html2 ) {
							//Replace magic keywords
							html = html.replace( magic, html2 );
							
							//Append HTML
							$( '.dp-2nd-main' ).html( html );
							
							//WYSIWYG Initializing
							tinymce.init({ 
								selector:'textarea#dp-wysiwyg',
								plugins : 'advlist autolink link image lists charmap print preview media table codesample fullscreen code contextmenu',
							});
						}
					} )
				} 
				else {
					//Append HTML
					$( '.dp-2nd-main' ).html( html );
					
					//WYSIWYG Initializing
					tinymce.init({ 
						selector:'textarea#dp-wysiwyg',
						plugins : 'advlist autolink link image lists charmap print preview media table codesample fullscreen code contextmenu',
					});
				}
			}
		} )
	} )
	
	/*Click 1st item as default
	==============================================*/
	$( '.dp-2nd-menu-item' )[0].click();
	
	/*Add category
	==============================================*/
	$( document ).on( 'click', '#cate-btn', function( e ) {
		e.preventDefault();
		$.ajax( {
			url: '/modules/includes/category-add.inc.php',
			type: 'POST',
			data: $( this ).parent().serialize(),
			success: function( html ) {
				alert( html );
			}
		} )
	} )
	
	/*Edit category
	=============================================*/
	$( document ).on( 'click', '.dp-cate-edit-btn', function() {
		//Show input
		var row = $( this ).parent().parent();
		row.find( 'input' ).removeAttr( 'readonly' );
		
		//Show save button
		$( this ).hide();
		$( this ).next().show();
		
	} )
	
	$( document ).on( 'click', '.dp-cate-save-btn', function() {
		var row = $( this ).parent().parent();
		var cateName = row.find( 'input:eq(0)' ).val();
		var cateUri = row.find( 'input:eq(1)' ).val();
		var cateId = $( this ).data( 'id' );
		var $this = $( this );
		$.ajax( {
			url: '/modules/includes/category-save.inc.php',
			type: 'POST',
			data: {
				'cate_name' : cateName,
				'cate_uri' : cateUri,
				'cate_id' : cateId
			},
			success: function( html ) {
				alert( html );
				row.find( 'input' ).prop( 'readonly', 'readonly' );
				$this.hide();
				$this.prev().show();
			}
		} )
	} )
	
	$( document ).on( 'click', '.dp-cate-delete-btn', function() {
		var cateId = $( this ).data( 'id' );
		
		$.ajax( {
			url: '/modules/includes/category-delete.inc.php',
			type: 'POST',
			data: {
				'cate_id' : cateId
			},
			success: function( html ) {
				alert( html );
				$( '.active' ).click();
			}
		} )
	} )
	
	/*Post new post
	================================================*/
	$( document ).on( 'click', '#post-btn', function( e ) {
		e.preventDefault();
		tinyMCE.triggerSave();
		$.ajax( {
			url: '/modules/includes/new-post-add.inc.php',
			type: 'POST',
			data: $( this ).parent().serialize(),
			success: function( html ) {
				alert( html );
			}
		} )
	} )
	
	
	/*Add user
	==============================================*/
	$( document ).on( 'click', '#user-btn', function( e ) {
		e.preventDefault();
		$.ajax( {
			url: '/modules/includes/user-add.inc.php',
			type: 'POST',
			data: $( this ).parent().serialize(),
			success: function( html ) {
				alert( html );
			}
		} )
	} )
	
	/*Edit post
	===============================================*/
	$( document ).on( 'click', '.dp-post-edit-btn', function() {
		var id = $( this ).data( 'id' );
		$.ajax( {
			url: '/modules/includes/new-post-edit.inc.php',
			type: 'POST',
			data: {
				post_id : id
			},
			success: function( html ) {
				$( '.dp-2nd-main' ).html( html );
				
				//WYSIWYG Initializing
				tinymce.init({ 
					selector:'textarea#dp-wysiwyg',
					plugins : 'advlist autolink link image lists charmap print preview media table codesample fullscreen code contextmenu',
				});
			}
		} )
	} )
	
	/*Delete post
	==============================================*/
	$( document ).on( 'click', '.dp-post-delete-btn', function() {
		var id = $( this ).data( 'id' );
		$.ajax( {
			url: '/modules/includes/new-post-delete.inc.php',
			type: 'POST',
			data: {
				post_id : id
			},
			success: function( html ) {
				$( '.active' ).click();
				console.log( html );
			}
		} )
	} )
	
	/*Unpublish
	=============================================*/
	$( document ).on( 'click', '.dp-post-unpublish-btn', function() {
		var id = $( this ).data( 'id' );
		$.ajax( {
			url: '/modules/includes/new-post-unpublish.inc.php',
			type: 'POST',
			data: {
				post_id : id
			},
			success: function( html ) {
				$( '.active' ).click();
				console.log( html );
			}
		} )
	} )
	
	/*Publish
	=============================================*/
	$( document ).on( 'click', '.dp-post-publish-btn', function() {
		var id = $( this ).data( 'id' );
		$.ajax( {
			url: '/modules/includes/new-post-publish.inc.php',
			type: 'POST',
			data: {
				post_id : id
			},
			success: function( html ) {
				$( '.active' ).click();
				console.log( html );
			}
		} )
	} )
	
	/*Block user
	==============================================*/
	$( document ).on( 'click', '.dp-user-block-btn', function() {
		var id = $( this ).data( 'id' );
		$.ajax( {
			url: '/modules/includes/user-block.inc.php',
			type: 'POST',
			data: {
				user_id : id
			},
			success: function( html ) {
				$( '.active' ).click();
				console.log( html );
			}
		} )
	} )
	
	/*Unblock user
	==============================================*/
	$( document ).on( 'click', '.dp-user-unblock-btn', function() {
		var id = $( this ).data( 'id' );
		$.ajax( {
			url: '/modules/includes/user-unblock.inc.php',
			type: 'POST',
			data: {
				user_id : id
			},
			success: function( html ) {
				$( '.active' ).click();
				console.log( html );
			}
		} )
	} )
	
	/*Delete user
	==============================================*/
	$( document ).on( 'click', '.dp-user-delete-btn', function() {
		var id = $( this ).data( 'id' );
		$.ajax( {
			url: '/modules/includes/user-delete.inc.php',
			type: 'POST',
			data: {
				user_id : id
			},
			success: function( html ) {
				$( '.active' ).click();
				console.log( html );
			}
		} )
	} )
} )