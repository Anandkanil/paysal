<?php 
include 'db_connect.php'; 
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM employee where id = ".$_GET['id'])->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}
?>

<div class="container-fluid">
	<form id='employee_frm'>
		<div class="form-group">
			<label>Full Name</label>
			<input type="hidden" name="id" value="<?php echo isset($id) ? $id : "" ?>" />
			<input type="text" autocomplete="off" name="firstname" required="required" class="form-control" value="<?php echo isset($firstname) ? $firstname : "" ?>" />
		</div>
		
		<div class="form-group">
			<label>Department</label>
			<select class="custom-select browser-default select2" name="department_id">
				<option value="">Select Department</option>
			<?php
			$dept = $conn->query("SELECT * from department order by name asc");
			while($row=$dept->fetch_assoc()):
			?>
				<option value="<?php echo $row['id'] ?>" <?php echo isset($department_id) && $department_id == $row['id'] ? "selected" :"" ?>><?php echo $row['name'] ?></option>
			<?php endwhile; ?>
			</select>
		</div>
		
		<div class="form-group">
			<label>Position</label>
			<select class="custom-select browser-default select2" name="position_id">
				<option value="">Select Position</option>
			<?php
			$pos = $conn->query("SELECT * from position order by name asc");
			while($row=$pos->fetch_assoc()):
			?>
				<option class="opt" value="<?php echo $row['id'] ?>" data-did="<?php echo $row['department_id'] ?>" <?php echo isset($department_id) && $department_id == $row['department_id'] ? '' :"disabled" ?> <?php echo isset($position_id) && $position_id == $row['id'] ? " selected" : '' ?> ><?php echo $row['name'] ?></option>
			<?php endwhile; ?>
			</select>
		</div>
		<div class="form-group">
			<label>Monthly Salary</label>
			<input type="number" name="salary" required="required" class="form-control text-right" step="any" value="<?php echo isset($salary) ? $salary : "" ?>" />
		</div>
		<div class="form-group">
			<label>Allowances</label>
			<select class="custom-select browser-default select2" name="allowance_id">
				<option value="">Select Allowance</option>
			<?php
			$allow = $conn->query("SELECT * from allowances order by allowance asc");
			while($row=$allow->fetch_assoc()):
			?>
				<option value="<?php echo $row['id'] ?>" <?php echo isset($allowance_id) && $allowance_id == $row['id'] ? "selected" :"" ?>><?php echo $row['allowance'] ?></option>
			<?php endwhile; ?>
			</select>
		</div>
		<div class="form-group">
			<label>Deductions</label>
			<select class="custom-select browser-default select2"placeholder="Please select here" name="allowance_id">
				<option value="">Select Deduction</option>
			<?php
			$allow = $conn->query("SELECT * from deductions order by deduction asc");
			while($row=$allow->fetch_assoc()):
			?>
				<option value="<?php echo $row['id'] ?>" <?php echo isset($deduction_id) && $deduction_id == $row['id'] ? "selected" :"" ?>><?php echo $row['deduction'] ?></option>
			<?php endwhile; ?>
			</select>
		</div>
	</form>
</div>
<!-- <script>
	$('[name="department_id"]').change(function(){
		var did = $(this).val()
		$('[name="position_id"] .opt').each(function(){
			if($(this).attr('data-did') == did){
				$(this).attr('disabled',false)
			}else{
				$(this).attr('disabled',true)
			}
		})
	})
	$(document).ready(function(){
		$('.select2').select2({
			placeholder:"Please Select Here",
			width:"100%"
		})
		$('#employee_frm').submit(function(e){
				e.preventDefault()
				start_load();
			$.ajax({
				url:'ajax.php?action=save_employee',
				method:"POST",
				data:$(this).serialize(),
				error:err=>console.log(),
				success:function(resp){
						if(resp == 1){
							alert_toast("Employee's data successfully saved","success");
								setTimeout(function(){
								location.reload();

							},1000)
						}
				}
			})
		})
	})
</script> -->