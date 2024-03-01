<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Home page</h2>
    </div>
    <div class="content">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="error success">
                <h3>
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION["username"])): ?>
            <p align = center >Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
            <div class="container">
                <div class="form">
                    <input type="text" class="input" placeholder="Notes" />
                    <input type="submit" class="add" value="Add Note" />
                </div>
                <div class="tasks"></div>
            </div> 
            <form action="server.php" method="post">
                <button type="submit" name="logout" class="btn" style="color: black ;">Logout</button>
            </form>
        <?php endif; ?>
    </div>
    <script> let input = document.querySelector(".input");
    let submit = document.querySelector(".add");
  let taskDivs = document.querySelector(".tasks");
 
 // [{id , title , flase}]
  let arrayOfTasks = [];
  if (localStorage.getItem("tasks")) {
   arrayOfTasks = JSON.parse(localStorage.getItem("tasks"));
  }
 
  submit.onclick = function () {
    if (input.value !== "") {
     addTask(input.value);
     input.value = "";
   }
  };
 
  taskDivs.addEventListener("click", (e) => {
    if (e.target.classList.contains("edit")) {
      let taskId = e.target.parentElement.getAttribute("task-id");
      let taskElemnt = e.target.parentElement;
      let taskTitle = taskElemnt.firstChild.textContent;
 
      let inputEdit = document.createElement("input");
      inputEdit.type = "text";
      inputEdit.value = taskTitle;
      inputEdit.className = "edit-input";
 
      taskElemnt.firstChild.replaceWith(inputEdit);
 
      e.target.textContent = "save";
      e.target.className = "save";
 
      e.target.removeEventListener("click", handleEdit);
      e.target.addEventListener("click", ()=>{handleSave(taskId, taskElemnt)});
    }
    if (e.target.classList.contains("del")) {
      deleteTask(e.target.parentElement.getAttribute("task-id"));
    }
  });
 
  function handleEdit(e) {
    let taskId = e.target.parentElement.getAttribute("task-id");
    let taskElemnt = e.target.parentElement;
    let taskTitle = taskElemnt.firstChild.textContent;
    let inputEdit = document.createElement("input");
     inputEdit.type = "text";
    inputEdit.value = taskTitle;
    inputEdit.className = "edit-input";
 
    taskElemnt.firstChild.replaceWith(inputEdit);
 
    e.target.textContent = "save";
    e.target.className = "save";
 
    e.target.removeEventListener("click", handleEdit);
  target.addEventListener("click", ()=>{handleSave(taskId, taskElemnt)});
  }
 
  function handleSave(taskId, taskElemnt) {
    let editInput = taskElemnt.querySelector(".edit-input");
    let newTitle = editInput.value;
 
    arrayOfTasks.forEach((task) => {
      if (task.id == taskId) {
        task.title = newTitle;
      }
    });
    addDataToLocal(arrayOfTasks);
    addElements(arrayOfTasks);
 
    taskElemnt.firstChild.replaceWith(newTitle);
 
    let btn = taskElemnt.querySelector(".save");
    btn.textContent = "edit";
    btn.className = "edit";
 
    btn.removeEventListener("click", handleSave);
    btn.addEventListener("click", handleEdit);
  }
 
  function addTask(task) {
    let taskObj = {
      id: Date.now(),
      title: task,
      completed: false,
    };
    arrayOfTasks.push(taskObj);
    addElements(arrayOfTasks);
    addDataToLocal(arrayOfTasks);
  }
  function addElements(eles) {
    taskDivs.innerHTML = "";
    eles.forEach(function (ele) {
      let div = document.createElement("div");
      div.className = "task";
      div.setAttribute("task-id", ele.id);
      div.appendChild(document.createTextNode(ele.title));
      let span = document.createElement("span");
      span.appendChild(document.createTextNode("Delete"));
      span.className = "del";
      div.appendChild(span);
      let edit = document.createElement("span");
      edit.className = "edit";
      edit.appendChild(document.createTextNode("Edit"));
      div.appendChild(edit);
      taskDivs.appendChild(div);
    });
  }
 
  function addDataToLocal(arrayOfTasks) {
    localStorage.setItem("tasks", JSON.stringify(arrayOfTasks));
  }
 
  function getDataFromLocal() {
    let data = localStorage.getItem("tasks");
    addElements(JSON.parse(data));
  }
 
  function deleteTask(taskId) {
    arrayOfTasks = arrayOfTasks.filter((ele) => ele.id != taskId);
    addDataToLocal(arrayOfTasks);
    addElements(arrayOfTasks);
  }
  </script>
</body>
</html>