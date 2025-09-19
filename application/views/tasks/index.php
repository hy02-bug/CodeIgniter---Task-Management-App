<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<title>Tasks</title>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
	<h1>Tasks List</h1>
	<h2>Welcome <?php echo htmlspecialchars($user ?? 'no one'); ?></h2>
	<a href="<?php echo site_url('TaskController/create'); ?>">Create New Task</a>
	<!-- Add logout button/link below -->
	<a href="<?php echo site_url('auth/logout'); ?>" style="float:right; color:red;">Logout</a>
	<ul>
		<?php foreach ($tasks as $task): ?>
			<li>
				<strong>
					<a href="<?php echo site_url('TaskController/view/'.$task->id); ?>">
						<?php echo $task->title; ?>
					</a>
				</strong>
				- <?php echo $task->description; ?>
				( Status: <em><?php echo $task->status; ?></em> )
				<a href="<?php echo site_url('TaskController/edit/'.$task->id); ?>">Edit</a>
				<a href="<?php echo site_url('TaskController/delete/'.$task->id); ?>">Delete</a>
			</li>
		<?php endforeach; ?>
	</ul>
</body>
</html>
