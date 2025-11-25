<?php
include 'config.php'; // connect to hiremedb
$msg = ""; // to hold message (success or error)

// check if form is using the post method
if ($_SERVER["REQUEST_METHOD"] === "POST") { //get input values
    $title       = trim($_POST['title'] ?? '');
    $company     = trim($_POST['company'] ?? '');
    $category    = trim($_POST['category'] ?? '');
    $location    = trim($_POST['location'] ?? '');
    $employment  = trim($_POST['employmenttype'] ?? '');
    $level       = trim($_POST['level'] ?? '');
    $mode        = trim($_POST['mode'] ?? '');
    $salary      = trim($_POST['salary'] ?? '');
    $updatedate  = date('Y-m-d');

// check if all fields are filled correctly 
    if ($title && $company && $category && $location && $employment && $level && $mode && $salary) {

        //insert a new job in jobs table
        $sql = "INSERT INTO jobs
                (title, company, category, location,
                 employmenttype, level, mode, salary, updatedate)
                VALUES
                ('$title', '$company', '$category', '$location',
                 '$employment', '$level', '$mode', '$salary', '$updatedate')";

//run query and check if it worked
        if ($conn->query($sql) === TRUE) {
            $msg = "Job added successfully!";
        } else {
            $msg = "Error: " . $conn->error;
        }

    } else {
        $msg = " Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADD JOB | HIREME WEBSITE</title>
</head>
<body>
    <h2>Add a New Job</h2>
<!-- message display-->
    <?php if (!empty($msg)) : ?>
        <p><?php echo $msg; ?></p>
    <?php endif; ?>
<!-- job form that collects job information -->
    <form method="POST">
        <input type="text"   name="title"           placeholder="Job title" required><br><br>
        <input type="text"   name="company"         placeholder="Company" required><br><br>
        <input type="text"   name="category"        placeholder="Category (software, data, cyber)" required><br><br>
        <input type="text"   name="location"        placeholder="Location (Beirut / Tripoli / Saida / Bekaa)" required><br><br>
        <input type="text"   name="employmenttype"  placeholder="Employment Type" required><br><br>
        <input type="text"   name="level"           placeholder="Level (entry, junior)" required><br><br>
        <input type="text"   name="mode"            placeholder="Mode (remote/on-site)" required><br><br>
        <input type="number" name="salary"          placeholder="Salary" required><br><br>
        <button type="submit">Add Job</button>
    </form>
</body>
</html>