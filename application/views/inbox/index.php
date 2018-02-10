<div class="row">
	<div class="col-12">
		<div class="row">
			<div class="col-sm-6">
				<h1>Inbox</h1>
			</div>
			<div class="col-sm-6" style="margin-top: 25px">
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
		<table class="table table-striped table-hover" id="tabel-disposisi">
			<thead>
				<th>Sent at</th>
				<th>From</th>
				<th>Notification</th>
				<th>File</th>
				<th>Status</th>
				<th></th>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>
<script>
	$(document).ready(() => {
		refreshTabelDisposisi();
	});

	function refreshTabelDisposisi() {
		$.ajax({
			url: '<?php echo base_url('desposisi/getUnReadedByUserId'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'id='+<?php echo $this->session->userdata('id'); ?>,
			success: (r) => {
				html = '';
				$.each(r, (key,data) => {
					html += '<tr>\
						<td>'+data.desposition_at+'</td>\
						<td>'+data.fullname+'</td>\
						<td>'+data.notification+'</td>\
						<td><a href="<?php echo base_url('assets/upload/') ?>'+data.mail_upload+'" target="_blank" class="btn btn-warning btn-sm">Show</a></td>\
						<td>'+cekStatus(data.status)+'</td>\
						<td><a href="<?php echo base_url('inbox/detail/'); ?>'+data.id+'" class="btn btn-info">Show detail</a></td>\
					</tr>';
				});
				$('#tabel-disposisi tbody').html(html);
			}
		});
	}

	function cekStatus(status) {
		if (status == 0) {
			return '<label class="label label-danger">Belum dibaca</label>';
		} else if (status == 1) {
			return '<label class="label label-info">Sudah dibaca</label>';
		} else {
			return '<label class="label label-primary">Sudah didisposisi</label>';
		}
	}
</script>