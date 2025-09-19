<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
</head>
<body>
    <h1>Edit Task</h1>
    <form method="post">
        <label>Title</label><br>
        <input type="text" name="title" value="<?php echo $task->title; ?>" required><br><br>

        <label>Description</label><br>
        <textarea name="description"><?php echo $task->description; ?></textarea><br><br>

        <label>Status</label><br>
        <select name="status">
            <option value="pending" <?php echo $task->status == 'pending' ? 'selected' : ''; ?>>Pending</option>
            <option value="completed" <?php echo $task->status == 'completed' ? 'selected' : ''; ?>>Completed</option>
        </select><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
