<div class="row">
	<div class="col-12">
		<h1>E-Mail List</h1><hr>
		<div class="row print">
			<div class="col-sm-6">
				<button class="btn btn-success" data-target="#modal-tambah" data-toggle="modal"><i class="fa fa-plus"></i> Create E-Mail</button>
				<button class="btn btn-primary print" onclick="printPage()">
					<i class="fa fa-print"></i> Print
				</button>
			</div>
			<div class="col-sm-6">
				<div class="input-group custom-search-form">
	                <input type="text" class="form-control" placeholder="Search..." oninput="search($(this).val());">
	                <span class="input-group-btn">
	                <button class="btn btn-default" type="button">
	                    <i class="fa fa-search"></i>
	                </button>
	            </span>
	            </div>
			</div>
		</div>
		<table class="table table-striped table-hover" id="tabel-email">
			<thead>
				<th>Date</th>
				<th>Subject</th>
				<th>Code</th>
				<th>From</th>
				<th>To</th>
				<th>Type</th>
				<th>File</th>
				<th></th>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="modal-desposisi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	            <h4 class="modal-title" id="myModalLabel">E-Mail Desposition</h4>
	        </div>
	        <form id="modal-tambah-desposisi-form">
	        <div class="modal-body">
	        	<div class="alert alert-danger" id="notif-tambah-desposisi-danger" style="display: none;"></div>
	        	<div class="alert alert-success" id="notif-tambah-desposisi-success" style="display: none;"></div>
	        	<table class="table table-bordered table-hover table-striped" id="tabel-desposisi">
	        		<thead>
	        			<th>To</th>
	        			<th>Description</th>
	        			<th>Notification</th>
	        			<th>Status</th>
	        			<th class="print"></th>
	        		</thead>
	        		<tbody></tbody>
	        	</table>
	        	<hr>
	        	<div class="row">
	        		<input type="text" name="id" style="display: none;" id="id-desposisi">
	        		<div class="col-md-4">
	        			<div class="form-group">
			        		<label>Description</label>
		                    <textarea class="form-control" name="description" rows="1"></textarea>
		                </div>
	        		</div>
	        		<div class="col-md-4">
	        			<div class="form-group">
			        		<label>Notification</label>
		                    <input class="form-control" type="text" name="notification">
		                </div>
	        		</div>
	        		<div class="col-md-4">
	        			<div class="form-group">
			        		<label>To</label>
		                    <select class="form-control user" name="userid"></select>
		                </div>
	        		</div>
	        	</div>
	        </div>
	        <div class="modal-footer">
	            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	            <button type="submit" class="btn btn-info" onclick="tambahDesposisi()">Create Desposition</button>
	        </div>
	        </form>
	    </div>
	</div>
</div>
<div class="modal fade" id="modal-edit-file" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	            <h4 class="modal-title" id="myModalLabel">Edit E-Mail File</h4>
	        </div>
	        <form id="modal-edit-file-form" enctype="multipart/form-data">
	        <div class="modal-body">
	        	<div class="alert alert-danger" id="notif-edit-file" style="display: none"></div>
	        	<input type="text" name="id" style="display: none;" id="id-file">
	        	<div class="form-group">
                    <input class="form-control" name="file" type="file">
                </div>
	        </div>
	        <div class="modal-footer">
	            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	            <button type="submit" class="btn btn-primary" onclick="editFileEmail()">Edit</button>
	        </div>
	    	</form>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	        <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	            <h4 class="modal-title" id="myModalLabel">Create E-Mail</h4>
	        </div>
	        <form id="modal-tambah-form" enctype="multipart/form-data">
	        <div class="modal-body">
	        	<div class="alert alert-danger" id="notif-tambah" style="display: none"></div>
	        	<div class="row">
	        		<div class="col-md-6">
	        			<div class="form-group">
	                    	<label>Code</label>
		                    <input class="form-control" name="code" type="text">
		                </div>
		                <div class="form-group">
		                    <label>Date</label>
		                    <input class="form-control" name="date" type="date">
		                </div>
		                <div class="form-group">
		                    <label>From</label>
		                    <input class="form-control" name="from" type="text">
		                </div>
		                <div class="form-group">
		                    <label>To</label>
		                    <input class="form-control" name="to" type="text">
		                </div>
	        		</div>
	        		<div class="col-md-6">
		                <div class="form-group">
		                    <label>Subject</label>
		                    <input class="form-control" name="subject" type="text">
		                </div>
	        			<div class="form-group">
		                    <label>Description</label>
		                    <textarea class="form-control" name="description"></textarea>
		                </div>
		                <div class="form-group">
		                    <label>File</label>
		                    <input class="form-control" name="file" type="file">
		                </div>
		                <div class="form-group">
		                    <label>Mail Type</label>
		                    <select class="form-control type" name="type" required="true"></select>
		                </div>
	        		</div>
	        	</div>
	        </div>
	        <div class="modal-footer">
	            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	            <button type="submit" class="btn btn-success" onclick="tambahEmail()">Submit</button>
	        </div>
	        </form>
	    </div>
	</div>
</div>
<script>
	function printPage() {
		window.print();
	}

	$(document).ready(function() {
		refreshTabelEMail();
		refreshEmailType();
		refreshUser();
	});

	function refreshUser() {
		$.ajax({
			url: '<?php echo base_url('user/getAllLowLevel'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'level='+<?php echo $this->session->userdata('level'); ?>,
			success: function(r) {
				html = '';
				$.each(r, function(key,data) {
					html += '<option value="'+data.id+'">'+data.fullname+'</option>';
				});
				$('.user').html(html);
			}
		});
	}

	function refreshEmailType() {
		$.ajax({
			url: '<?php echo base_url('mail_type/getAll'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(r) {
				html = '';
				$.each(r, function(key,data) {
					html += '<option value="'+data.id+'">'+data.type+'</option>';
				});
				$('.type').html(html);
			}
		});
	}

	function refreshTabelEMail() {
		$.ajax({
			url: '<?php echo base_url('mail/getAll'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(r) {
				html = '';
				$.each(r, function(key,data) {
					html += '<tr>\
						<td>'+data.mail_date+'</td>\
						<td>'+data.mail_subject+'</td>\
						<td>'+data.mail_code+'</td>\
						<td>'+data.mail_from+'</td>\
						<td>'+data.mail_to+'</td>\
						<td>'+data.type+'</td>\
						<td>\
							<a href="<?php echo base_url('assets/upload/'); ?>'+data.mail_upload+'" target="_blank" class="btn btn-warning btn-sm">Show</a>\
							<button onclick="showModalEditFile('+data.id+')" class="btn btn-primary btn-sm print" data-toggle="modal" data-target="#modal-edit-file"><i class="fa fa-pencil"></i></button>\
						</td>\
						<td class="print">\
							<button onclick="showModalDesposisi('+data.id+')" data-toggle="modal" data-target="#modal-desposisi" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Desposition</button>\
							<button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</button>\
							<button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>\
						</td>\
					</tr>';
				});
				$('#tabel-email tbody').html(html);
			}
		});
	}

	function search(query) {
		
	}

	function tambahEmail() {
		$('#notif-tambah').slideUp();
		event.preventDefault();
		data = new FormData($('#modal-tambah-form')[0]);
		$.ajax({
			url: '<?php echo base_url('mail/tambah'); ?>',
			type: 'POST',
			dataType: 'json',
			data: data,
			mimeType: 'multipart/form-data',
			processData: false,
			contentType: false,
			success: function(r) {
				if (r.status) {
					refreshTabelEMail();
					$('.modal').modal('hide');
					$('#modal-tambah-form').trigger('reset');
				} else {
					$('#notif-tambah').html(r.error);
					$('#notif-tambah').slideDown();
				}
			}
		});
	}

	function showModalEditFile(id) {
		$('#notif-edit-file').slideUp();
		$('#id-file').val(id);
	}

	function editFileEmail() {
		event.preventDefault();
		$('#notif-edit-file').slideUp();
		data = new FormData($('#modal-edit-file-form')[0]);
		$.ajax({
			url: '<?php echo base_url('mail/editFile'); ?>',
			type: 'POST',
			dataType: 'json',
			data: data,
			mimeType: 'multipart/form-data',
			processData: false,
			contentType: false,
			success: function(r) {
				if (r.status) {
					refreshTabelEMail();
					$('.modal').modal('hide');
					$('#modal-edit-file-form').trigger('reset');
				} else {
					$('#notif-edit-file').html(r.error);
					$('#notif-edit-file').slideDown();
				}
			}
		});
	}

	function showModalDesposisi(id) {
		$('#notif-tambah-desposisi-danger').slideUp();
		$('#tabel-desposisi tbody').html('<tr><td colspan="5"><h5>Loading...</h5></td></tr>');
		$('#id-desposisi').val(id);
		refreshTabelDesposisi(id);
	}

	function refreshTabelDesposisi(id) {
		$.ajax({
			url: '<?php echo base_url('desposisi/getByMailId'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'id='+id,
			success: function(r) {
				if (r.length == 0) {
					$('#tabel-desposisi tbody').html('<tr><td colspan="5"><h5>There\'s no desposition yet.</h5></td></tr>');
					return;
				}
				html = '';
				$.each(r, function(key,data) {
					html += '<tr>\
						<td>'+data.fullname+'</td>\
						<td>'+data.description+'</td>\
						<td>'+data.notification+'</td>\
						<td>'+cekStatus(data.status)+'</td>\
						<td><button onclick="deleteDesposisi('+data.id+')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>\
					</tr>';
				});
				$('#tabel-desposisi tbody').html(html);
			}
		});
	}

	function cekStatus(status) {
		if (status == 0) {
			return 'Belum dibaca';
		} else if (status == 1) {
			return 'Sudah dibaca';
		} else {
			return 'Telah di desposisi';
		}
	}

	function tambahDesposisi() {
		event.preventDefault();
		$('#notif-tambah-desposisi-danger').slideUp();
		$.ajax({
			url: '<?php echo base_url('desposisi/tambah'); ?>',
			type: 'POST',
			dataType: 'json',
			data: $('#modal-tambah-desposisi-form').serialize(),
			success: function(r) {
				if (r.status) {
					id = $('#id-desposisi').val();
					refreshTabelDesposisi(id);
					$('#modal-tambah-desposisi-form').trigger('reset');
					$('#id-desposisi').val(id);

					$('#notif-tambah-desposisi-success').html('Create desposition success');
					$('#notif-tambah-desposisi-success').slideDown();
					setTimeout(function() {
						$('#notif-tambah-desposisi-success').slideUp();
					}, 2000);
				} else {
					$('#notif-tambah-desposisi-danger').html(r.error);
					$('#notif-tambah-desposisi-danger').slideDown();
				}
			}
		});
	}

	function deleteDesposisi(id) {
		event.preventDefault();
		$('#notif-tambah-desposisi-danger').slideUp();
		$.ajax({
			url: '<?php echo base_url('desposisi/delete'); ?>',
			type: 'POST',
			dataType: 'json',
			data: 'id='+id,
			success: function(r) {
				if (r.status) {
					refreshTabelDesposisi($('#id-desposisi').val());

					$('#notif-tambah-desposisi-success').html('Delete desposition success');
					$('#notif-tambah-desposisi-success').slideDown();
					setTimeout(function() {
						$('#notif-tambah-desposisi-success').slideUp();
					}, 2000);
				} else {
					$('#notif-tambah-desposisi-danger').html(r.error);
					$('#notif-tambah-desposisi-danger').slideDown();
				}
			}
		});
	}
</script>