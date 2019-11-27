'use strict';

jQuery( document ).ready( function( $ ) {
	// add
	$( 'body' ).on( 'click touch', '.woosw-btn', function( e ) {
		var _this = $( this );
		var product_id = _this.attr( 'data-id' );
		var data = {
			action: 'wishlist_add',
			product_id: product_id
		};
		if ( _this.hasClass( 'woosw-added' ) ) {
			if ( $( '#woosw-area .woosw-content-mid' ).hasClass( 'woosw-content-loaded' ) ) {
				woosw_show();
			} else {
				woosw_load();
			}
		} else {
			_this.addClass( 'woosw-adding' );
			$.post( woosw_vars.ajax_url, data, function( response ) {
				_this.removeClass( 'woosw-adding' );
				response = JSON.parse( response );
				if ( (
					     response['status'] == 1
				     ) && woosw_vars.popup_content != 'message' ) {
					jQuery( '#woosw-area' ).removeClass( 'woosw-message' );
					$( '#woosw-area .woosw-content-mid' ).html( response['value'] ).removeClass( 'woosw-content-loaded-message' ).addClass( 'woosw-content-loaded' ).perfectScrollbar( {theme: 'wpc'} );
					if ( response['notice'] != null ) {
						$( '#woosw-area .woosw-notice' ).html( response['notice'] );
						woosw_notice_show();
						setTimeout( function() {
							woosw_notice_hide();
						}, 3000 );
					}
				} else {
					jQuery( '#woosw-area' ).addClass( 'woosw-message' );
					var message = '<div class="woosw-content-mid-message">';
					if ( response['image'] != null ) {
						message += '<img src="' + response['image'] + '"/>';
					}
					if ( response['notice'] != null ) {
						message += '<span>' + response['notice'] + '</span>';
					}
					message += '</div>';
					jQuery( '#woosw-area .woosw-content-mid' ).html( message ).removeClass( 'woosw-content-loaded' ).addClass( 'woosw-content-loaded-message' );
				}
				if ( response['status'] == 1 ) {
					_this.addClass( 'woosw-added' ).html( woosw_vars.button_text_added );
					_this.parent( '.wishlist-icon' ).attr('data-hint', woosw_vars.button_text_added );
				}
				if ( response['count'] != null ) {
					woosw_change_count( response['count'] );
				}
				woosw_show();
			} );
		}
		e.preventDefault();
	} );

	// remove
	$( 'body' ).on( 'click touch', '.woosw-content-item--remove span', function( e ) {
		var _this = $( this );
		var _this_item = _this.closest( '.woosw-content-item' );
		var product_id = _this_item.attr( 'data-id' );
		var data = {
			action: 'wishlist_remove',
			product_id: product_id
		};
		_this.addClass( 'removing' );
		$.post( woosw_vars.ajax_url, data, function( response ) {
			_this.removeClass( 'removing' );
			_this_item.remove();
			response = JSON.parse( response );
			if ( response['status'] == 1 ) {
				$( '.woosw-btn-' + product_id ).removeClass( 'woosw-added' ).html( woosw_vars.button_text );
				$( '.woosw-btn-' + product_id ).parent( '.wishlist-icon' ).attr('data-hint', woosw_vars.button_text );
				if ( response['notice'] != null ) {
					$( '#woosw-area .woosw-notice' ).html( response['notice'] );
					woosw_notice_show();
					setTimeout( function() {
						woosw_notice_hide();
					}, 3000 );
				}
			} else {
				if ( response['notice'] != null ) {
					$( '#woosw-area .woosw-content-mid' ).html( '<div class="woosw-content-mid-notice">' + response['notice'] + '</div>' );
				}
			}
			if ( response['count'] != null ) {
				woosw_change_count( response['count'] );
			}
		} );
		e.preventDefault();
	} );

	// click on area
	$( 'body' ).on( 'click touch', '#woosw-area', function( e ) {
		var woosw_content = $( '.woosw-content' );
		if ( $( e.target ).closest( woosw_content ).length == 0 ) {
			woosw_hide();
		}
	} );

	// continue
	$( 'body' ).on( 'click touch', '.woosw-continue', function( e ) {
		var url = $( this ).attr( 'data-url' );
		woosw_hide();
		if ( url != '' ) {
			window.location.href = url;
		}
		e.preventDefault();
	} );

	// close
	$( 'body' ).on( 'click touch', '.woosw-close', function( e ) {
		woosw_hide();
		e.preventDefault();
	} );

	// menu item
	$( 'body' ).on( 'click', '.red-header-wishlist-icon', function( e ) {
		if ( woosw_vars.menu_action == 'open_popup' || woosw_vars.menu_action == 'open_page' ) {
			if ( $( '#woosw-area .woosw-content-mid' ).hasClass( 'woosw-content-loaded' ) ) {
				woosw_show();
			} else {
				woosw_load();
			}
			e.preventDefault();
		}
	} );
} );

jQuery( window ).resize( function() {
	woosw_fix_height();
} );

function woosw_load() {
	var data = {
		action: 'wishlist_load'
	};
	jQuery( '#woosw-area' ).addClass('red-loading')
	jQuery.post( woosw_vars.ajax_url, data, function( response ) {
		jQuery( '#woosw-area' ).removeClass( 'woosw-message' );
		response = JSON.parse( response );
		if ( response['status'] == 1 ) {
			jQuery( '#woosw-area .woosw-content-mid' ).html( response['value'] );
		} else {
			if ( response['notice'] != null ) {
				jQuery( '#woosw-area .woosw-content-mid' ).html( '<div class="woosw-content-mid-notice">' + response['notice'] + '</div>' );
			}
		}
		jQuery( '#woosw-area .woosw-content-mid' ).removeClass( 'woosw-content-loaded-message' ).addClass( 'woosw-content-loaded' ).perfectScrollbar( {theme: 'wpc'} );
		woosw_show();
	} );
}

function woosw_load_count() {
	var data = {
		action: 'wishlist_load'
	};
	jQuery.post( woosw_vars.ajax_url, data, function( response ) {
		response = JSON.parse( response );
		if ( response['count'] != null ) {
			woosw_change_count( response['count'] );
		}
	} );
}

function woosw_show() {
	jQuery( '#woosw-area' ).addClass( 'woosw-open' ).removeClass('red-loading');
	jQuery( document.body ).trigger( 'woosw_show' );
	woosw_fix_height();
}

function woosw_hide() {
	jQuery( '#woosw-area' ).removeClass( 'woosw-open' );
	jQuery( document.body ).trigger( 'woosw_hide' );
}

function woosw_change_count( count ) {
	jQuery( '#woosw-area .woosw-count' ).html( count );
	jQuery( '.woosw-menu-item .woosw-menu-item-inner' ).attr( 'data-count', count );
	jQuery( '.red-header-wishlist-icon .wishlist-count' ).attr( 'data-count', count ).html(count);
	jQuery( document.body ).trigger( 'woosw_change_count', [count] );
}

function woosw_notice_show() {
	jQuery( '#woosw-area .woosw-notice' ).addClass( 'woosw-notice-show' );
}

function woosw_notice_hide() {
	jQuery( '#woosw-area .woosw-notice' ).removeClass( 'woosw-notice-show' );
}

function woosw_fix_height() {
	if ( (
		     woosw_vars.popup_content != 'message'
	     ) && (
		     jQuery( '#woosw-area' ).find( '.woosw-content-items' ).length
	     ) ) {
		var woosw_window_height = jQuery( window ).height();
		var $woosw_content = jQuery( '#woosw-area' ).find( '.woosw-content' );
		var $woosw_table = jQuery( '#woosw-area' ).find( '.woosw-content-items' );
		var woosw_content_height = $woosw_table.outerHeight() + 96;
		if (
			woosw_content_height < (
				                     woosw_window_height * .8
			                     ) ) {
			if ( parseInt( woosw_content_height ) % 2 !== 0 ) {
				$woosw_content.height( parseInt( woosw_content_height ) - 1 );
			} else {
				$woosw_content.height( parseInt( woosw_content_height ) );
			}
		} else {
			if ( (
				     parseInt( woosw_window_height * .8 )
			     ) % 2 !== 0 ) {
				$woosw_content.height( parseInt( woosw_window_height * .8 ) - 1 );
			} else {
				$woosw_content.height( parseInt( woosw_window_height * .8 ) );
			}
		}
	}
}

function woosw_copy_url() {
	var wooswURL = document.getElementById( 'woosw_copy_url' );
	wooswURL.select();
	document.execCommand( 'copy' );
	alert( woosw_vars.copied_text + ' ' + wooswURL.value );
}