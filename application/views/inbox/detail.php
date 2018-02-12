<div class="row">
	<div class="col-12">
		<a href="<?php echo base_url('inbox'); ?>">Back to inbox</a>
		<h1>Inbox Detail</h1><hr>
		<div class="row">
			<div class="col-sm-6">
				<button onclick="showModalDisposisi()" class="btn btn-info" data-toggle="modal" data-target="#modal-disposisi"><i class="fa fa-plus"></i> Disposition</button>
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
		<hr>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
		            <label>Disposition from</label>
		            <p class="form-control-static" id="disposition-from"></p>
		        </div>
		        <div class="form-group">
		            <label>Date</label>
		            <p class="form-control-static" id="date"></p>
		        </div>
		        <div class="form-group">
		            <label>Subject</label>
		            <p class="form-control-static" id="subject"></p>
		        </div>
		        <div class="form-group">
		            <label>Code</label>
		            <p class="form-control-static" id="code"></p>
		        </div>
		        <div class="form-group">
		            <label>Type</label>
		            <p class="form-control-static" id="type"></p>
		        </div>
			</div>
			<div class="col-md-6">
		        <div class="form-group">
		            <label>From</label>
		            <p class="form-control-static" id="from"></p>
		        </div>
				<div class="form-group">
		            <label>To</label>
		            <p class="form-control-static" id="to"></p>
		        </div>
		        <div class="form-group">
		            <label>Notification</label>
		            <p class="form-control-static" id="notification"></p>
		        </div>
		        <div class="form-group">
		            <label>Description</label>
		            <p class="form-control-static" id="description"></p>
		        </div>
		        <div class="form-group">
		            <label>File</label>
		            <p class="form-control-static" id="file"></p>
		        </div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-disposisi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	        <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	            <h4 class="modal-title" id="myModalLabel">Disposition</h4>
	        </div>
	        <form id="modal-disposisi-form">
	        <div class="modal-body">
	        	<div class="alert alert-danger" id="notif-danger" style="display: none;"></div>
	        	<div class="alert alert-success" id="notif-success" style="display: none;"></div>
	        	<table class="table table-hover table-striped table-bordered" id="tabel-disposisi">
	        		<thead>
	        			<th>To</th>
	        			<th>Description</th>
	        			<th>Notification</th>
	        			<th>Status</th>
	        			<th></th>
	        		</thead>
	        		<tbody></tbody>
	        	</table>
	        	<hr>
	        	<div class="row">
	        		<input name="id" id="id" style="display: none">
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
	            <button type="submit" class="btn btn-info" onclick="tambahDisposisi(event)">Create disposition</button>
	        </div>
	        </form>
	    </div>
	</div>
</div>
<script>
	$(document).ready(() => {
		getData();
		refreshUser();
	});

	function refreshUser() {
		$.ajax({
			url: '<?php echo base_url('user/getAllLowLevel'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'level='+<?php echo $this->session->userdata('level'); ?>,
			success: (r) => {
				if (r.length == 0) {
					$('.user').html('<option value="">--You can\'t make a disposition--</option>');
					return;
				}
				html = '';
				$.each(r, (key,data) => {
					html += '<option value="'+data.id+'">'+data.fullname+'</option>';
				});
				$('.user').html(html);
			}
		});
	}

	function tambahDisposisi(event) {
		event.preventDefault();
		$('#notif-danger').slideUp();
		$.ajax({
			url: '<?php echo base_url('desposisi/tambah') ?>',
			type: 'POST',
			dataType: 'json',
			data: $('#modal-disposisi-form').serialize()+'&des_id='+<?php echo $id ?>,
			success: (r) => {
				if (r.status) {
					id = $('#id').val();
					$('#modal-disposisi-form').trigger('reset');
					$('#id').val(id);
					showModalDisposisi();
					$('#notif-success').html('Create disposition success');
					$('#notif-success').slideDown();
					setTimeout(() => {
						$('#notif-success').slideUp();
					} ,2000);
				} else {
					$('#notif-danger').html(r.error);
					$('#notif-danger').slideDown();
				}
			}
		});
	}

	function getData() {
		$.ajax({
			url: '<?php echo base_url('desposisi/getById'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'id='+<?php echo $id; ?>,
			success: (r) => {
				$('#id').val(r.mailid);
				$('#disposition-from').html(r.fullname+' at '+r.desposition_at);
				$('#date').html(r.mail_date);
				$('#subject').html(r.mail_subject);
				$('#code').html(r.mail_code);
				$('#type').html(r.type);
				$('#from').html(r.mail_from);
				$('#to').html(r.mail_to);
				$('#notification').html(r.notification);
				$('#description').html(r.description);
				$('#file').html('<a href="<?php echo base_url('assets/upload/'); ?>'+r.mail_upload+'" class="btn btn-warning btn-sm" target="_blank">Show file</a>');
			}
		});
	}

	function showModalDisposisi() {
		$.ajax({
			url: '<?php echo base_url('desposisi/getByDespositionId'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'id='+<?php echo $id; ?>,
			success: (r) => {
				if (r.length == 0) {
					$('#tabel-disposisi tbody').html('<tr><td colspan="5"><h5>There\'s no desposition yet.</h5></td></tr>');
					return;
				}
				html = '';
				$.each(r, (key,data) => {
					html += '<tr><td>'+data.fullname+'</td>\
						<td>'+data.description+'</td>\
						<td>'+data.notification+'</td>\
						<td>'+cekStatus(data.status)+'</td>\
						<td><button onclick="deleteDesposisi('+data.id+')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>\
					</tr>';
				});
				$('#tabel-disposisi tbody').html(html);
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
			success: (r) => {
				if (r.status) {
					showModalDisposisi();

					$('#notif-success').html('Delete desposition success');
					$('#notif-success').slideDown();
					setTimeout(() => {
						$('#notif-success').slideUp();
					}, 2000);
				} else {
					$('#notif-danger').html(r.error);
					$('#notif-danger').slideDown();
				}
			}
		});
	}

	function cekStatus(status) {
		if (status == 0) {
			return '<span class="label label-danger">Belum dibaca</span>';
		} else if (status == 1) {
			return '<span class="label label-primary">Sudah dibaca</span>';
		} else {
			return '<span class="label label-info">Sudah didisposisi</span>';
		}
	}
</script>