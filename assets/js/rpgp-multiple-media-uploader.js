jQuery(function(jQuery) {
    
    var file_frame,
            bsgallery = {
        admin_thumb_ul: '',
        init: function() {
            this.admin_thumb_ul = jQuery('#bs_gallery_thumbs');
            this.admin_thumb_ul.sortable({
                placeholder: '',
				revert: true,
            });
            this.admin_thumb_ul.on('click', '.bsgallery_remove', function() {
                if (confirm('Are you sure you want to delete this?')) {
                    jQuery(this).parent().fadeOut(1000, function() {
                        jQuery(this).remove();
                    });
                }
                return false;
            });
            
            jQuery('#bs_gallery_upload_button').on('click', function(event) {
                event.preventDefault();
                if (file_frame) {
                    file_frame.open();
                    return;
                }

                file_frame = wp.media.frames.file_frame = wp.media({
                    title: jQuery(this).data('uploader_title'),
                    button: {
                        text: jQuery(this).data('uploader_button_text'),
                    },
                    multiple: true
                });

                file_frame.on('select', function() {
                    var images = file_frame.state().get('selection').toJSON(),
                            length = images.length;
                    for (var i = 0; i < length; i++) {
                        bsgallery.get_thumbnail_uris(images[i]['id']);
                    }
                });
                file_frame.open();
            });

           
        },
        get_thumbnail_uris: function(id, cb) {
            cb = cb || function() {
            };
            var data = {
                action: 'uris_get_thumbnail',
                imageid: id
            };
            jQuery.post(ajaxurl, data, function(response) {
                bsgallery.admin_thumb_ul.append(response);
                cb();
            });
        },
        get_all_thumbnails: function(post_id, included) {
            var data = {
                action: 'bsgallery_get_all_thumbnail',
                post_id: post_id,
                included: included
            };
            jQuery('#bsgallery_spinner').show();
            jQuery.post(ajaxurl, data, function(response) {
                bsgallery.admin_thumb_ul.append(response);
                jQuery('#bsgallery_spinner').hide();
            });
        }
    };
    bsgallery.init();
	
	/********media-upload******/
	// media upload js
	var uploadID = ''; /*setup the var*/
	jQuery('.upload_image_button').click(function() {
		uploadID = jQuery(this).prev('input'); /*grab the specific input*/
		
		formfield = jQuery('.upload').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		
		window.send_to_editor = function(html)
		{	imgurl = jQuery(html).attr('src');
			uploadID.val(imgurl); /*assign the value to the input*/
			tb_remove();
		};		
		return false;
	});	
});