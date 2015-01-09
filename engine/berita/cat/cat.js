(function( $ ) {
	
	'use strict';

	$("#add_kategori").submit(function(event){
				
		event.preventDefault();
		
		var values = $(this).serialize();
		var stack_bar_bottom = {"dir1": "up", "dir2": "right", "spacing1": 0, "spacing2": 0};
		
		$.ajax({
			url: "ajax.php?ac=add_cat",
			type: "POST",
			data: values,
			success: function(response){
				var notice = new PNotify({
					title: 'Notification',
					text: 'Penambahan data berhasil di lakukan.',
					type: 'success',
					addclass: 'stack-bar-bottom',
					stack: stack_bar_bottom,
					width: "60%"
				});

				$("#isi_table").html(response);

				$("#add_kategori")[0].reset();
			}
		 });
	});

	$('.modal-with-move-anim').click(function(){
		var datanya = $(this).data('id');
	    $('#T_ID').attr('data-id', datanya);
	});

	$('.modal-with-move-anim').magnificPopup({
		type: 'inline',

		fixedContentPos: false,
		fixedBgPos: true,

		overflowY: 'auto',

		closeBtnInside: true,
		preloader: false,
		
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-slide-bottom',
		modal: true
	});

	/*
	Modal Dismiss
	*/
	$(document).on('click', '.modal-dismiss', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});

	/*
	Modal Confirm
	*/
	$(document).on('click', '.modal-confirm', function (e) {
		e.preventDefault();
		var dataku = $("#T_ID").data('id');
		$.magnificPopup.close();
		$(this).removeData();

		var stack_bar_bottom = {"dir1": "up", "dir2": "right", "spacing1": 0, "spacing2": 0};
		$.ajax({
			url: "ajax.php?ac=del_cat&id="+dataku,
			type: "GET",
			data: dataku,
			success: function(response){
				var notice = new PNotify({
					title: 'Notification'+ dataku,
					text: 'Penghapusan data berhasil di lakukan.',
					type: 'warning',
					addclass: 'stack-bar-bottom',
					stack: stack_bar_bottom,
					width: "60%"
				});

				$("#isi_table").html(response);
			}
		});
	});

}).apply( this, [ jQuery ]);