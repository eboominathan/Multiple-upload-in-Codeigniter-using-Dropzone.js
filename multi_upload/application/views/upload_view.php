<!DOCTYPE HTML>

<html>
<head>
	<title>Multiple Upload</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap.min.css') ?>"> 
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dropzone.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/basic.min.css') ?>">
	<script type="text/javascript" src="<?php echo base_url('assets/jquery.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/dropzone.min.js') ?>"></script>
	<style type="text/css">
		.alert-success{
			display: none;
		}
		
	</style>
</head>
<body>
<div class="alert alert-danger">Dropzone Disbled</div>
<div class="alert  alert-success">Dropzone Enabled</div>

<div class="container">
<label>ENABLE / DISABLE</label>
<select name="status"  id="status" class="form-control">
		<option value="" selected="selected">Select</option>
		<option value="Enable">Enable</option>
		<option value="Disable">Disble</option>
		option
	</select>
	</div>
	<div class="dropzone">
		<div class="dz-message">
			<h3> Drag and Drop your files here Or Click here to upload</h3>
		</div>
	</div>
	


	<script type="text/javascript">

		Dropzone.autoDiscover = false;
		var file= new Dropzone(".dropzone",{
			url: "<?php echo base_url('upload/upload_files') ?>",
			// maxFilesize: 2,  // maximum size to uplaod 
			method:"post",
			// acceptedFiles:"image/*", // allow only images
			paramName:"userfile",
			// dictInvalidFileType:"Image files only allowed", // error message for other files on image only restriction 
			addRemoveLinks:true,
			autoProcessQueue: false
		});


		$('#status').change(function(){
			if($(this).val()=='Enable'){
				$('.alert-success').show();
				$('.alert-danger').hide();		
				file.processQueue();
			}else{
				$('.alert-success').hide();
				$('.alert-danger').show();
			}
		});
//Upload file onchange 

file.on("sending",function(a,b,c){
	a.token=Math.random();
	c.append("token",a.token); //Random Token generated for every files 
});


// delete on upload 

file.on("removedfile",function(a){
	var token=a.token;
	$.ajax({
		type:"post",
		data:{token:token},
		url:"<?php echo base_url('upload/delete') ?>",
		cache:false,
		dataType: 'json',
		success: function(res){
			// alert('Selected file removed !');			

		}

	});
});


</script>


</body>
</html>