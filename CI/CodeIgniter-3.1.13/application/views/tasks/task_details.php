<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Task Details</title>
</head>
<body>
	<h1>Task Details</h1>

	<p><strong>Title:</strong> <?php echo $task->title; ?></p>
	<p><strong>Description:</strong> <?php echo $task->description; ?></p>
	<p><strong>Status:</strong> <?php echo $task->status; ?></p>

	<hr>

	<form method="post" enctype="multipart/form-data">
		<p>
			<label>Start Date:</label>
			<input type="date" name="start_date" value="">
		</p>

		<p>
			<label>End Date:</label>
			<input type="date" name="end_date" value="">
		</p>

		<p>
			<label>Person in Charge:</label>
			<input type="text" name="person_in_charge" placeholder="Enter name">
		</p>

		<p>
			<label>Attach Document:</label>
			<input type="file" name="document">
		</p>

		<button type="submit">Update Task Details</button>
	</form>

	<p>
		<a href="<?php echo site_url('TaskController'); ?>">Back to Task List</a>
	</p>
</body>
</html>
