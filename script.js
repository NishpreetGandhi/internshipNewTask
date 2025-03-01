document.addEventListener("DOMContentLoaded", function () {
    const addTaskBtn = document.querySelector(".addTaskBtn");
    const taskInput = document.querySelector(".taskInput");
    const taskList = document.querySelector(".taskList");
  
    addTaskBtn.addEventListener("click", function (e) {
      e.preventDefault();
      const taskText = taskInput.value.trim();
  
      if (!taskText) {
        alert("Please enter a task!");
        return;
      }
      fetch("saveTask.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ task: taskText }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.error) {
            alert("Error: " + data.error);
          } else {
            addTaskToUI(taskText); 
            taskInput.value = "";
          }
        })
        .catch((error) => console.error("Error:", error));
    });
  
    function addTaskToUI(taskText) {
      const taskDiv = document.createElement("div");
      taskDiv.className = "ToDo";
  
      const taskField = document.createElement("input");
      taskField.type = "text";
      taskField.value = taskText;
      taskField.readOnly = true;
  
      const checkbox = document.createElement("input");
      checkbox.type = "checkbox";
  
      const removeBtn = document.createElement("button");
      removeBtn.textContent = "Remove";
      removeBtn.className = "removeTaskBtn";
      removeBtn.addEventListener("click", function () {
        taskDiv.remove();
      });
  
      taskDiv.appendChild(taskField);
      taskDiv.appendChild(checkbox);
      taskDiv.appendChild(removeBtn);
      taskList.appendChild(taskDiv); 
    }
  });