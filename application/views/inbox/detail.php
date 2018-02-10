<div class="row">
	<div class="col-12">
		<a href="<?php echo base_url('inbox'); ?>">Back to inbox</a>
		<h1>Inbox Detail</h1><hr>
		<div class="row">
			<div class="col-sm-6">
				<button class="btn btn-info"><i class="fa fa-plus"></i> Create disposition</button>
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
<script>
	$(document).ready(() => {
		getData();
	});

	function getData() {
		$.ajax({
			url: '<?php echo base_url('desposisi/getById'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'id='+<?php echo $id; ?>,
			success: (r) => {
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
</script>