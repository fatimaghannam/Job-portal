<?php
include 'config.php'; // connect to database

//select all jobs from db
$sql    = "SELECT * FROM jobs ORDER BY updatedate DESC";
$result = $conn->query($sql);

// TO SPLIT JOBS TO EACH OF THE 3 CATEGORIES
$softwareJobs = [];
$dataScienceJobs = [];
$cyberJobs = [];


// check if the query returned any rows
if ($result && $result->num_rows > 0) {
    // loop through each row (each job) from the result
    while ($row = $result->fetch_assoc()) {
         // if the job category is software development  put it in $softwareJobs
        if ($row['category'] == 'Software Development') {
            $softwareJobs[] = $row;
            // same for data science
        } elseif ($row['category'] == 'Data Science') {
            $dataScienceJobs[] = $row;
            //same for cyber 
        } elseif ($row['category'] == 'Cyber Security') {
            $cyberJobs[] = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RECOMMENDED JOBS | HIREME</title>
    <link rel="stylesheet" href="final.css">
</head>
<body>
<header class="site-header">
    <div class="logo">
        <img src="briefcase--v1.png" class="logo-icon" alt="">
        Hire<span>Me</span></div>
    <section class="header-links">
        <a href="jobs.php">Jobs</a>
        <a href="logout.php">Sign Out</a>
    </section>
</header>

<div class="container">
    <h1>Recommended Jobs</h1>

    <!-- FILTER BAR -->
    <form class="filterbar" id="filterForm" onsubmit="return false">
        <input type="text" id="q" name="q"
               placeholder="Search title, company, or keywords…" aria-label="Search text" />
        <select id="city" name="city" aria-label="Filter by location">
<!-- location filter-->
        <option value="">All Locations</option>
            <option>Beirut</option>
            <option>Tripoli</option>
            <option>Saida</option>
            <option>Bekaa</option>
        </select>
        <select id="price" name="price" aria-label="Filter by salary">
            <!-- salary filter-->
        <option value="">Any Salary</option>
            <option value="1000-1500">$1k–$1.5k</option>
            <option value="1501-2000">$1.5k–$2k</option>
            <option value="2001-2500">$2k–$2.5k</option>
            <option value="2501-3000">$2.5k–$3k</option>
        </select>
         <!-- filter btn -->
        <button class="btn" id="applyFilters" type="button">Filter</button>
         <!-- cancel filter-->
        <button class="btn-outline" id="clearFilters" type="button">Clear</button>
    </form>

     <!-- if no jobs at all in any category, show message -->
    <?php if (empty($softwareJobs) && empty($dataScienceJobs) && empty($cyberJobs)) { ?>
        <p>No jobs available. Please try adding jobs to the website.</p>
    <?php } ?>

    <!-- SOFTWARE DEVELOPMENT SECTION  -->
    <?php if (!empty($softwareJobs)) { ?> <!-- check if we have software jobs -->
        <h2 class="section-title">Software Development</h2>
        <div class="jobs-wrapper">  <!-- wrapper for arrows + scroll row -->
            <!-- left arrow -->
            <button class="scroll-btn prev" type="button"
                    onclick="scrollRow('softRow', -1)">&#10094;</button>

            <!-- scrollable row for S.D job cards -->
            <div class="jobs-row" id="softRow">
                <?php foreach ($softwareJobs as $row) { ?>  <!-- loop through each software job -->
                    <div class="job-card"
                         data-title="<?php echo htmlspecialchars($row['title']); ?>"  
                         data-company="<?php echo htmlspecialchars($row['company']); ?>"  
                         data-category="<?php echo htmlspecialchars($row['category']); ?>"
                         data-location="<?php echo htmlspecialchars($row['location']); ?>"
                         data-salary="<?php echo htmlspecialchars($row['salary']); ?>">

                         <!-- top row: job title + update date -->
                        <div class="job-header">
                            <div class="job-title"><?php echo htmlspecialchars($row['title']); ?></div>
                            <div class="job-date"><?php echo htmlspecialchars($row['updatedate']); ?></div>
                        </div>
                        

                        <div class="job-company"><?php echo htmlspecialchars($row['company']); ?></div>

                        <div class="tags">
                            <span><?php echo htmlspecialchars($row['employmenttype']); ?></span>
                            <span><?php echo htmlspecialchars($row['level']); ?></span>
                            <span><?php echo htmlspecialchars($row['mode']); ?></span>
                            <span><?php echo htmlspecialchars($row['category']); ?></span>
                        </div>

                        <div class="job-location">
                            <?php echo htmlspecialchars($row['location']); ?>
                        </div>

                         <!-- bottom bar: salary + Details button -->
                        <div class="job-bottom">
                            <div class="salary">
                                $<?php echo htmlspecialchars($row['salary']); ?>
                            </div>

                            <!-- link to job details page, passing job id in URL -->
                            <a href="viewjob.php?id=<?php echo $row['id']; ?>"
                               class="details-btn">Details</a>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- right arrow -->
            <button class="scroll-btn next" type="button"
                    onclick="scrollRow('softRow', 1)">&#10095;</button>
        </div>
    <?php } ?>

    <!-- DATA SCIENCE SECTION  -->
    <?php if (!empty($dataScienceJobs)) { ?>
        <h2 class="section-title">Data Science</h2>
        <div class="jobs-wrapper">
            <!-- left arrow -->
            <button class="scroll-btn prev" type="button"
                    onclick="scrollRow('dataRow', -1)">&#10094;</button>

            <!-- scrollable row -->
            <div class="jobs-row" id="dataRow">
                <?php foreach ($dataScienceJobs as $row) { ?>
                    <div class="job-card"
                         data-title="<?php echo htmlspecialchars($row['title']); ?>"
                         data-company="<?php echo htmlspecialchars($row['company']); ?>"
                         data-category="<?php echo htmlspecialchars($row['category']); ?>"
                         data-location="<?php echo htmlspecialchars($row['location']); ?>"
                         data-salary="<?php echo htmlspecialchars($row['salary']); ?>">

                        <div class="job-header">
                            <div class="job-title"><?php echo htmlspecialchars($row['title']); ?></div>
                            <div class="job-date"><?php echo htmlspecialchars($row['updatedate']); ?></div>
                        </div>

                        <div class="job-company"><?php echo htmlspecialchars($row['company']); ?></div>

                        <div class="tags">
                            <span><?php echo htmlspecialchars($row['employmenttype']); ?></span>
                            <span><?php echo htmlspecialchars($row['level']); ?></span>
                            <span><?php echo htmlspecialchars($row['mode']); ?></span>
                            <span><?php echo htmlspecialchars($row['category']); ?></span>
                        </div>

                        <div class="job-location">
                            <?php echo htmlspecialchars($row['location']); ?>
                        </div>

                        <div class="job-bottom">
                            <div class="salary">
                                $<?php echo htmlspecialchars($row['salary']); ?>
                            </div>
                            <a href="viewjob.php?id=<?php echo $row['id']; ?>"
                               class="details-btn">Details</a>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- right arrow -->
            <button class="scroll-btn next" type="button"
                    onclick="scrollRow('dataRow', 1)">&#10095;</button>
        </div>
    <?php } ?>

    <!--CYBER SECURITY SECTION  -->
    <?php if (!empty($cyberJobs)) { ?>
        <h2 class="section-title">Cyber Security</h2>
        <div class="jobs-wrapper">
            <!-- left arrow -->
            <button class="scroll-btn prev" type="button"
                    onclick="scrollRow('cyberRow', -1)">&#10094;</button>

            <!-- scrollable row -->
            <div class="jobs-row" id="cyberRow">
                <?php foreach ($cyberJobs as $row) { ?>
                    <div class="job-card"
                         data-title="<?php echo htmlspecialchars($row['title']); ?>"
                         data-company="<?php echo htmlspecialchars($row['company']); ?>"
                         data-category="<?php echo htmlspecialchars($row['category']); ?>"
                         data-location="<?php echo htmlspecialchars($row['location']); ?>"
                         data-salary="<?php echo htmlspecialchars($row['salary']); ?>">

                        <div class="job-header">
                            <div class="job-title"><?php echo htmlspecialchars($row['title']); ?></div>
                            <div class="job-date"><?php echo htmlspecialchars($row['updatedate']); ?></div>
                        </div>

                        <div class="job-company"><?php echo htmlspecialchars($row['company']); ?></div>

                        <div class="tags">
                            <span><?php echo htmlspecialchars($row['employmenttype']); ?></span>
                            <span><?php echo htmlspecialchars($row['level']); ?></span>
                            <span><?php echo htmlspecialchars($row['mode']); ?></span>
                            <span><?php echo htmlspecialchars($row['category']); ?></span>
                        </div>

                        <div class="job-location">
                            <?php echo htmlspecialchars($row['location']); ?>
                        </div>

                        <div class="job-bottom">
                            <div class="salary">
                                $<?php echo htmlspecialchars($row['salary']); ?>
                            </div>
                            <a href="viewjob.php?id=<?php echo $row['id']; ?>"
                               class="details-btn">Details</a>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- right arrow -->
            <button class="scroll-btn next" type="button"
                    onclick="scrollRow('cyberRow', 1)">&#10095;</button>
        </div>
    <?php } ?>

</div>

<script src="jobs.js"></script>
<footer class="footer">
    <div class="footer-container">

        <div class="footer-left">
            <h3>HireMe</h3>
            <p>Your gateway to internships, jobs, and career opportunities.</p>

            <h4>Quick Links</h4>
            <a href="index.php">Home</a>
            <a href="jobs.php">Jobs</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
        </div>

        <div class="footer-right">
            <h4>Contact</h4>
            <p>Email: support@hireme.com</p>
            <p>Lebanon | 2025</p>
        </div>

    </div>
    <p class="back-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
    ↑ Back to Top
</p>
    <p class="footer-bottom">© 2025 HireMe. All rights reserved.</p>
</footer>

</body>
</html>

