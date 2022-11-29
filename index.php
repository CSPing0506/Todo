<?php
  $errors = "";
  $db = mysqli_connect('localhost','root','Csp52039154951','todolist');

  if (isset($_POST['submit'])){
      $task = $_POST['task'];
      if (empty($task)) {
          $errors = "You must fill in the task";
      }else{
          mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
          header('location: index.php');
    }
  }

  if (isset($_GET['del_task'])) {
    $id = $_GET['del_task'];
    mysqli_query($db, "DELETE FROM tasks WHERE ID=$id");
    header('location: index.php');
  }

  if (isset($_GET['status'])) {
    $status = $_GET['status'];
    mysqli_query($db, "INSERT INTO tasks (status) VALUES ('$status')");  
    header('location: index.php');  
  }

  $tasks = mysqli_query($db,"SELECT * FROM tasks");
?>
<!DOCTYPE html>
<html>
<head>
    <title>To-do List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="heading">
        <h2>To-do List</h2>
    </div>
    <form method="POST" action="index.php">
    <?php if (isset($errors)) { ?>
	      <p><?php echo $errors; ?></p>
    <?php } ?>
        <input type="text" name="task" class="task_input">
        <button type="submit" class="add_btn" name="submit">Add</button>
    </form>
    <table>
      <thead>
        <tr>
          <th>Task</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
      <?php while ($row = mysqli_fetch_array($tasks)) { ?>
            <tr>
                <td class="task"><?php echo $row['task']; ?></td>
                <td><input type="checkbox" name="status" value = "1" ><label for="boxes">Uncomplete</label>
                </td>              
                <td class="delete">
                    <a href="index.php?del_task=<?php echo $row['ID'] ?>"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
      <?php } ?>
      </tbody>
    </table>
</body>
</html>
