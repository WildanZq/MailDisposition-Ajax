<div class="row">
	<div class="col-12">
		<h1>Inbox</h1><hr>
		<div class="row print">
			<div class="col-sm-6">
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
		<table class="table table-striped table-hover" id="tabel-disposisi">
			<thead>
				<th>Sent at</th>
				<th>From</th>
				<th>Notification</th>
				<th>File</th>
				<th>Status</th>
				<th class="print"></th>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>
<script>
	function printPage() {
		window.print();
	}

	$(document).ready(() => {
		refreshTabelDisposisi();
	});

	function refreshTabelDisposisi() {
		$.ajax({
			url: '<?php echo base_url('desposisi/getByUserId'); ?>',
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
						<td class="print"><a href="<?php echo base_url('inbox/detail/'); ?>'+data.id+'" class="btn btn-info">Show detail</a></td>\
					</tr>';
				});
				$('#tabel-disposisi tbody').html(html);
			}
		});
	}

	function search(query) {
		
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