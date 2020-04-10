<?php
    $errors = "";
    // контакт с базой 
    $db = mysqli_connect('localhost', 'root', '', 'todo');

    if (isset($_POST['submit'])) {
        $task = $_POST['task'];
        if (empty($task)) {
            $errors = "Вы должны заполнить задание";
        }else {
            mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
            header("location: index.php");
        }
    }
    // удаляю задачу
    if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];
        mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
        header('location: index.php');
    }

    $tasks = mysqli_query($db, "SELECT * FROM tasks");
?>

    <!DOCTYPE html>
    <html>
        <head>


            <title>Список задач</title>
            <link rel="icon" href="img/ico.ico" />
            <link href="style.css" rel="stylesheet" type="text/css"/>
        </head>
        <body>
        <div class="heading">
            <h2>Приложение списка задач с PHP и MySQL</h2>
        </div>
        <form method="POST" action="index.php">
        <?php if (isset($errors)) { ?>
            <p><?php echo $errors; ?></p>
        <?php } ?>

            <input type="text" name="task" class="task_input">
            <button type="submit" class="add_btn" name="submit">Добавить задачу</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>№</th>
                    <th>Задача</th>
                    <th>Действие</th>
                </tr>
            </thead>

            <tbody>
            <?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
                <tr>
                    <td><?php echo $i; ?></td>
                        <td class="task"><?php echo $row['task']; ?></td>
                        <td class="delete">
                            <a href="index.php?del_task=<?php echo $row['id'] ?>">x</a>
                        </td>
                </tr>

            <?php $i++; } ?>

            </tbody>
        </table>
    </body>
    </html>
    