<?php
include 'config.php'; // include database connection so we can read job details from DB
//The page needs the job ID so it knows which job to get
if (!isset($_GET['id'])) {
    echo "No job selected.";
    exit;
}
//It gets the job ID and turns it into a number.
$job_id = (int) $_GET['id']; 

// Get job data
$sql = "SELECT * FROM jobs WHERE id = $job_id";
//It sends the query to the database and gets the result
$result = $conn->query($sql);

// If there is no job with that ID show error
if ($result->num_rows == 0) {
    echo "Job not found.";
    exit;
}

//Fetch the job data into an array
$job = $result->fetch_assoc();

// This line reads the 'description' column and stores it in $about
$about = trim((string)$job['description']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $job['title']; ?> | Job Details</title>
    <link rel="stylesheet" href="final.css">
</head>
<body>
    <header class="site-header">
    <div class="logo">Hire<span>Me</span></div>
    <section class="header-links">
        <a href="jobs.php">Jobs</a>
        <a href="logout.php">Sign Out</a>
    </section>
</header>


<div class="view-container">

    <h1 class="job-title-main">
        <?php echo htmlspecialchars($job['title']); ?> <!-- job title from DB -->
    </h1>
 <!-- META INFORMATION (company, location, etc.) -->
    <div class="job-meta">
        <?php echo htmlspecialchars($job['company']); ?>  
        <span class="dot"><?php echo htmlspecialchars($job['location']); ?></span>
        <span class="dot"><?php echo htmlspecialchars($job['employmenttype']); ?></span>
        <span class="dot"><?php echo htmlspecialchars($job['level']); ?></span>
        <br>
        <!-- salary and date posted -->
        <span>Salary: <?php echo htmlspecialchars($job['salary']); ?> USD</span>
        <span class="dot">Posted on: <?php echo htmlspecialchars($job['updatedate']); ?></span>
    </div>

    <!-- APPLY BUTTON (opens modal to choose student or professional) -->
    <button type="button" class="apply-btn" id="openApplyChoice">Apply</button>

    <hr>

    <h3>Requirements</h3>
    <ul>
        <li>Currently enrolled in or holding a Bachelor's degree in Computer Science, or a related field.</li>
        <li>Ability to work in teams and communicate clearly.</li>
        <li>Time-management and ability to handle multiple tasks.</li>
        <li>Eagerness to learn and grow in a professional environment.</li>
    </ul>

    <!-- APPLY FORMS (hidden until choice) -->
    <div class="apply-forms-wrapper" id="applyForms">

        <!-- STUDENT FORM -->
        <form class="apply-form" id="studentForm">
            <h3>Student Application</h3>
            <!-- 2-column grid for organized layout -->
            <div class="form-grid">
                <div class="form-group">

                    <label>First Name</label>
                    <input type="text" name="s_first_name" required>
                </div>
                <div class="form-group">

                    <label>Middle Name</label>
                    <input type="text" name="s_middle_name">
                </div>
                <div class="form-group">

                    <label>Last Name</label>
                    <input type="text" name="s_last_name" required>
                </div>
                <div class="form-group">

                    <label>Email</label>
                    <input type="email" name="s_email" required>
                </div>
                <div class="form-group">

                    <label>Date of Birth</label>
                    <input type="date" name="s_dob" required>
                </div>
                <div class="form-group">

                    <label>Gender</label>
                    <div class="form-radio-row">
                        <label><input type="radio" name="s_gender" value="Male" required> Male</label>
                        <label><input type="radio" name="s_gender" value="Female"> Female</label>
                    </div>
                </div>
                <div class="form-group">

                    <label>Mobile Phone</label>
                    <input type="tel" name="s_phone" required>
                </div>
                <div class="form-group">

                    <label>University</label>
                    <input type="text" name="s_university" required>
                </div>
                <div class="form-group">

                    <label>Major / Degree</label>
                    <input type="text" name="s_major" required>
                </div>
                <div class="form-group">

                    <label>Expected Graduation Year</label>
                    <input type="number" name="s_grad_year" min="2024" max="2100" required>
                </div>
                <div class="form-group">

                    <label>LinkedIn Profile (optional)</label>
                    <input type="url" name="s_linkedin">
                </div>
            </div>

            <div class="form-group">

                <label>Why do you want this opportunity?</label>
                <textarea name="s_reason" required></textarea>
            </div>

            <div class="form-group">

                <label>Upload Documents (CV, transcript, etc.)</label>
                <input type="file" name="s_docs" multiple>
                <div class="upload-note">PDF / DOC / DOCX.</div>
            </div>

            <div class="form-actions">

                <button type="reset" class="reset-btn">Reset</button>
                <button type="submit" class="submit-btn">Submit</button>
            </div>
        </form>

        <!-- PROFESSIONAL FORM -->
        <form class="apply-form" id="proForm">
            <h3>Professional Application</h3>
            <div class="form-grid">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="p_first_name" required>
                </div>
                <div class="form-group">
                    <label>Middle Name</label>
                    <input type="text" name="p_middle_name">
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="p_last_name" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="p_email" required>
                </div>
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" name="p_dob" required>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <div class="form-radio-row">
                        <label><input type="radio" name="p_gender" value="Male" required> Male</label>
                        <label><input type="radio" name="p_gender" value="Female"> Female</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Mobile Phone</label>
                    <input type="tel" name="p_phone" required>
                </div>
                <div class="form-group">
                    <label>Preferred Time</label>
                    <div class="form-radio-row">
                        <label><input type="radio" name="p_time" value="Morning" required> Morning</label>
                        <label><input type="radio" name="p_time" value="Evening"> Evening</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Upload Documents (CV, Portfolio, etc.)</label>
                <input type="file" name="p_docs" multiple>
                <div class="upload-note">PDF / DOC / DOCX.</div>
            </div>

            <div class="form-actions">
                <button type="reset" class="reset-btn">Reset</button>
                <button type="submit" class="submit-btn">Submit</button>
            </div>
        </form>
    </div>

    <!-- Back button to return to job list -->
    <a href="jobs.php" class="back-btn">← Back to Jobs</a>
</div>

<!-- Modal -->
<div class="apply-modal-backdrop" id="applyChoiceModal"> <!-- background overlay -->
    <div class="apply-modal">
        <h4>Apply as</h4>
        <p>Select how you want to apply for this opportunity.</p>
        <button class="choice-btn choice-student" id="chooseStudent">Student</button>
        <button class="choice-btn choice-pro" id="choosePro">Professional</button>
    </div>
</div>

<script src="viewjob.js"></script>
</body>
</html>

</body>
</html>


