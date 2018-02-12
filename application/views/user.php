<div class="row">
	<div class="col-12">
		<h1>User List</h1><hr>
		<div class="row">
			<div class="col-sm-6 print">
				<button class="btn btn-success" data-target="#modal-tambah" data-toggle="modal"><i class="fa fa-plus"></i> Create User</button>
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
		<table class="table table-striped table-hover" id="tabel-user">
			<thead>
				<th>Username</th>
				<th>Full Name</th>
				<th>Level</th>
				<th class="print"></th>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
	        <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	            <h4 class="modal-title" id="myModalLabel">Create User</h4>
	        </div>
	        <form id="modal-tambah-form">
	        <div class="modal-body">
	        	<div class="alert alert-danger" id="notif-tambah" style="display: none"></div>
	            <div class="form-group">
                    <label>Username</label>
                    <input class="form-control" name="username" type="text">
                </div>
                <div class="form-group">
                    <label>Full Name</label>
                    <input class="form-control" name="nama" type="text">
                </div>
                <div class="form-group">
                    <label>Level</label>
                    <select class="form-control jabatan" name="level">
                    	<option value="1">1</option>
                    	<option value="2">2</option>
                    	<option value="3">3</option>
                    	<option value="4">4</option>
                    	<option value="5">5</option>
                    </select>
                </div>
	        </div>
	        <div class="modal-footer">
	            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	            <button type="submit" class="btn btn-success" onclick="tambahUser(event)">Submit</button>
	        </div>
	        </form>
	    </div>
	</div>
</div>
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
	        <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	            <h4 class="modal-title" id="myModalLabel">Edit User</h4>
	        </div>
	        <form id="modal-edit-form">
	        <div class="modal-body">
	        	<div class="alert alert-danger" id="notif-edit" style="display: none"></div>
	        	<input name="id" id="id" style="display: none">
	            <div class="form-group">
                    <label>Username</label>
                    <input id="username" class="form-control" name="username" type="text" disabled>
                </div>
                <div class="form-group">
                    <label>Full Name</label>
                    <input id="nama" class="form-control" name="nama" type="text">
                </div>
                <div class="form-group">
                    <label>Level</label>
                    <select id="level" class="form-control jabatan" name="level">
                    	<option value="1">1</option>
                    	<option value="2">2</option>
                    	<option value="3">3</option>
                    	<option value="4">4</option>
                    	<option value="5">5</option>
                    </select>
                </div>
	        </div>
	        <div class="modal-footer">
	            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	            <button type="submit" class="btn btn-primary" onclick="editUser(event)">Edit</button>
	        </div>
	        </form>
	    </div>
	</div>
</div>
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content modal-sm">
	        <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	            <h4 class="modal-title" id="myModalLabel">Delete User?</h4>
	        </div>
	        <form id="modal-delete-form">
	        <input type="text" name="id" id="id-delete" style="display: none">
	       	<div class="modal-footer">
	            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	            <button type="submit" class="btn btn-danger" onclick="deleteUser($('#id-delete').val(),event)">
	            	<i class="fa fa-trash"></i> Delete
	        	</button>
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
		refreshTabelUser();
	});

	function refreshTabelUser() {
		$.ajax({
			url: '<?php echo base_url('user/getAll'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(r) {
				html = '';
				$.each(r, function(key,data) {
					html += '<tr>\
						<td>'+data.username+'</td>\
						<td>'+data.fullname+'</td>\
						<td>'+data.level+'</td>\
						<td class="print"><button onclick="showModalEdit('+data.id+')" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-pencil"></i> Edit</button>&nbsp;';
					if (data.id != <?php echo $this->session->userdata('id'); ?>) {
						html += '<button class="btn btn-danger btn-sm" onclick="showModalDeleteUser('+data.id+')" data-toggle="modal" data-target="#modal-delete">\
									<i class="fa fa-trash"></i>\
								</button>';
					} else {
						html += '<span class="text-muted"><em>This is you</em></span>';
					}
					html += '</td></tr>';
				});
				$('#tabel-user tbody').html(html);
			}
		});
	}

	function search(query) {
		$.ajax({
			url: '<?php echo base_url('user/search'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'query='+query,
			success: function(r) {
				if (r.length == 0) {
					html = 'Data not found';
					$('#tabel-user tbody').html(html);
					return;
				}
				html = '';
				$.each(r, function(key,data) {
					html += '<tr>\
						<td>'+data.username+'</td>\
						<td>'+data.fullname+'</td>\
						<td>'+data.level+'</td>\
						<td class="print">\
							<button onclick="showModalEdit('+data.id+')" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-pencil"></i> Edit</button>&nbsp;'+cekUserId(data.id)+'\
						</td></tr>';
				});
				$('#tabel-user tbody').html(html);
			}
		});
	}

	function cekUserId(id) {
		if (id != <?php echo $this->session->userdata('id'); ?>) {
			return '<button class="btn btn-danger btn-sm" onclick="showModalDeleteUser('+id+')" data-toggle="modal" data-target="#modal-delete">\
				<i class="fa fa-trash"></i>\
			</button>';
		} else {
			return '<span class="text-muted"><em>This is you</em></span>';
		}
	}

	function tambahUser(event) {
		$('#notif-tambah').slideUp();
		event.preventDefault();
		$.ajax({
			url: '<?php echo base_url('user/tambah'); ?>',
			type: 'POST',
			dataType: 'json',
			data: $('#modal-tambah-form').serialize(),
			success: function(r) {
				if (r.status) {
					refreshTabelUser();
					$('.modal').modal('hide');
					$('#modal-tambah-form').trigger('reset');
				} else {
					$('#notif-tambah').html(r.error);
					$('#notif-tambah').slideDown();
				}
			}
		});
	}

	function showModalDeleteUser(id) {
		$('#id-delete').val(id);
	}

	function deleteUser(id,event) {
		event.preventDefault();
		$.ajax({
			url: '<?php echo base_url('user/delete'); ?>',
			type: 'POST',
			dataType: 'json',
			data: 'id='+id,
			success: function(r) {
				if (r.status) {
					refreshTabelUser();
					$('.modal').modal('hide');
				}
			}
		});
	}

	function showModalEdit(id) {
		$('#notif-edit').slideUp();
		$.ajax({
			url: '<?php echo base_url('user/getById'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'id='+id,
			success: function(r) {
				$('#username').val(r.username);
				$('#nama').val(r.fullname);
				$('#level').val(r.level);
				$('#id').val(r.id);
			}
		});
	}

	function editUser(event) {
		event.preventDefault();
		$('#notif-edit').slideUp();
		$.ajax({
			url: '<?php echo base_url('user/edit'); ?>',
			type: 'POST',
			dataType: 'json',
			data: $('#modal-edit-form').serialize(),
			success: function(r) {
				$('#notif-edit').slideUp();
				if (r.status) {
					refreshTabelUser();
					$('.modal').modal('hide');
				} else {
					$('#notif-edit').html(r.error);
					$('#notif-edit').slideDown();
				}
			}
		});
	}
</script>