<?php
// portfolio.php - the OLD way: contact.php saves the message, then sends the browser back here (full page reload)
session_start();
date_default_timezone_set('Asia/Manila');

$flash = $_SESSION['flash'] ?? null;   // one-time result from contact.php
unset($_SESSION['flash']);

$old = $flash['old'] ?? ['name' => '', 'email' => '', 'message' => ''];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rakki Nico Credo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/png" href="icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <div class="intro">
        <div class="intro-text">
            <span class="intro-subtext">My Portfolio</span>
            <span class="intro-description">Explore my projects and get to know me better.</span>
        </div>
    </div>

    <header>
        <h4>My Portfolio</h4>
        <div class="header-text">
            <h1>RAKKI NICO P. CREDO</h1>
            <p>Web Developer | Data Analyst | Server Administrator | Graphic Designer</p>
        </div>
    </header>

    <nav class="side-menu">
        <img src="photo.jpg" alt="My Profile Picture" class="profile-picture">
        <ul>
            <li><span class="num">01</span> <a href="#projects" class="active">WORK <span
                        class="arrow">&rarr;</span></a></li>
            <li><span class="num">02</span> <a href="#shop">SHOP</a></li>
            <li><span class="num">03</span> <a href="#graphics">GRAPHICS</a></li>
            <li><span class="num">04</span> <a href="#about">ABOUT</a></li>
            <li><span class="num">05</span> <a href="#services">SERVICES</a></li>
            <li><span class="num">06</span> <a href="#work-experience">EXPERIENCE</a></li>
            <li><span class="num">07</span> <a href="#reviews">REVIEWS</a></li>
            <li><span class="num">08</span> <a href="#register">REGISTER</a></li>
            <li><span class="num">09</span> <a href="#contact">CONTACT</a></li>
        </ul>

        <div class="sidebar-socials">
            <h4>Contact Me: </h4>
            <div class="sidebar-socials-icons">
                <a href="mailto:rakkinicopcredo@example.com" title="Email Me">
                    <i class="fa-solid fa-envelope"></i>
                </a>
                <a href="https://www.facebook.com/rakki.nico.credo.2024" target="_blank" rel="noopener"
                    title="Chat on Messenger">
                    <i class="fa-brands fa-facebook-messenger"></i>
                </a>
                <a href="https://www.instagram.com/akiie_3/" target="_blank" rel="noopener" title="Instagram">
                    <i class="fa-brands fa-instagram"></i>
                </a>
            </div>


        </div>

    </nav>

    <main>
        <section id="projects">
            <h2>FEATURED WORKS</h2>

            <!-- PROJECT 1: WEB DEVELOPMENT -->
            <div class="project-info" data-project-id="1">
                <div class="project-text-content">
                    <h3>Web Development Project</h3>
                    <p>The Web Development Project focuses on creating a functional and user-friendly website using web
                        technologies such as HTML, CSS, and JavaScript. The project aims to organize and present
                        information through a clear and responsive interface that users can easily navigate.</p>
                    <a href="#" class="project-btn">View Live Project</a>
                </div>

                <div class="project-image-content">
                    <div class="image-card-wrapper">
                        <img src="webdev.jpg" alt="Web Development Project" class="project-img">
                    </div>
                </div>
                <hr class="project-separator">
            </div>
            <!-- PROJECT 2: SERVER ADMINISTRATION -->
            <div class="project-info" data-project-id="2">
                <div class="project-text-content">
                    <h3>Server Administration Project</h3>
                    <p>Focuses on managing and maintaining computer servers to ensure services, applications, and
                        network resources operate properly. It involves tasks such as configuring the server, managing
                        users and permissions, monitoring system performance, and maintaining security layers.</p>
                    <br>
                    <a href="#" class="project-btn">Access Console Log</a>
                </div>
                <div class="project-image-content">
                    <div class="image-card-wrapper">
                        <img src="serveradmin.jpg" alt="Server Administration Project" class="project-img">
                    </div>
                </div>
                <hr class="project-separator">
            </div>

            <!-- PROJECT 3: DATA ANALYSIS -->
            <div class="project-info" data-project-id="3">
                <div class="project-text-content">
                    <h3>Data Analysis Project</h3>
                    <p>Focuses on collecting, organizing, processing, and interpreting data matrices to identify useful
                        system patterns. It utilizes distinct tools and calculation methodologies to clean datasets,
                        analyze metrics, and present visual patterns via charts or data funnels.</p>
                    <br>
                    <a href="#" class="project-btn">View Report Insights</a>
                </div>
                <div class="project-image-content">
                    <div class="image-card-wrapper">
                        <img src="data.jpg" alt="Data Analysis Project" class="project-img">
                    </div>
                </div>
            </div>
        </section>

        <section id="shop">
            <h2>Shop list</h2>

            <div class="shop-grid">
                <!-- Product 1 -->
                <div class="shop-item">
                    <h3>Sandwich</h3>
                    <img src="Sanwich.jpg" alt="Sandwich" class="shop-item-img">
                    <p class="product-desc">Freshly made artisan sandwich with organic ingredients.</p>
                </div>

                <!-- Product 2 -->
                <div class="shop-item">
                    <h3>Skincare</h3>
                    <img src="skincare.jpg" alt="Skincare" class="shop-item-img">
                    <p class="product-desc">Hydrating daily moisturizer suitable for all skin types.</p>
                </div>

                <!-- Product 3 -->
                <div class="shop-item">
                    <h3>Earbuds</h3>
                    <img src="earbuds.jpg" alt="Earbuds" class="shop-item-img">
                    <p class="product-desc">Wireless noise-canceling earbuds with 24-hour battery life.</p>
                </div>
            </div>

            <p class="footer-note">Click any image for detailed specs & modal view.</p>
        </section>

        <!-- Shop Product Modal -->
        <div id="shopModal" class="shop-modal">
            <div class="modal-content">
                <span id="closeModal" class="close-btn">&times;</span>
                <img id="modalImg" src="" alt="">
                <h3 id="modalTitle"></h3>
                <p id="modalDesc"></p>
            </div>
        </div>

        <section id="graphics">
            <h2>Graphics</h2>
            <div class="graphic-item">
                <h3>Graphic Design Project 1</h3>
                <img src="graphic1.jpg" alt="Graphic Design Project 1" class="graphic-img">
                <p class="graphic-desc">A visually appealing poster created for a local event, showcasing bold
                    typography and a clean, balanced layout.</p>
            </div>

        </section>

        <!-- Added placeholder IDs or sections matching the nav menu links -->
        <section id="about">
            <h2>About Me</h2>
            <p>
                I'm Rakki Nico P. Credo, a Computer Science student from Consolacion, Cebu who
                builds web applications and works with data and servers. I enjoy solving problems
                with code and keep learning new tools. I'm looking for chances to grow in a team
                and contribute to real projects.
            </p>

            <h3>Skill Levels</h3>
            <div class="skills">
                <div class="skill">
                    <div class="skill-head"><span>Python </span><span>90%</span></div>
                    <div class="bar" role="img" aria-label="Python: 90 out of 100">
                        <div class="fill" style="--level:90%"></div>
                    </div>
                </div>
                <div class="skill">
                    <div class="skill-head"><span>SQL </span><span>90%</span></div>
                    <div class="bar" role="img" aria-label="SQL: 90 out of 100">
                        <div class="fill" style="--level:90%"></div>
                    </div>
                </div>
                <div class="skill">
                    <div class="skill-head"><span>JavaScript </span><span>80%</span></div>
                    <div class="bar" role="img" aria-label="JavaScript: 80 out of 100">
                        <div class="fill" style="--level:80%"></div>
                    </div>
                </div>
                <div class="skill">
                    <div class="skill-head"><span>React </span><span>70%</span></div>
                    <div class="bar" role="img" aria-label="React: 70 out of 100">
                        <div class="fill" style="--level:70%"></div>
                    </div>
                </div>
                <div class="skill">
                    <div class="skill-head"><span>Node.js </span><span>60%</span></div>
                    <div class="bar" role="img" aria-label="Node.js: 60 out of 100">
                        <div class="fill" style="--level:60%"></div>
                    </div>
                </div>
                <div class="skill">
                    <div class="skill-head"><span>PC Repair </span><span>85%</span></div>
                    <div class="bar" role="img" aria-label="PC Repair: 85 out of 100">
                        <div class="fill" style="--level:85%"></div>
                    </div>
                </div>
            </div>
        </section>


        <section id="services">
            <h2>Services</h2>

            <div class="project">
                <h3>Web Development</h3>
                <p>Custom, responsive, and user-friendly websites built using modern web standards (HTML, CSS,
                    JavaScript). Focused on clean code, mobile optimization, and seamless user experiences.</p>
            </div>

            <div class="project">
                <h3>Data Analysis & Insights</h3>
                <p>Collecting, cleaning, and processing complex datasets to generate actionable business insights,
                    visual dashboards, and comprehensive reports.</p>
            </div>

            <div class="project">
                <h3>Server Administration</h3>
                <p>Managing, configuring, and securing Linux/Windows server infrastructure. Ensuring high availability,
                    routine backups, access control, and system monitoring.</p>
            </div>

            <div class="project">
                <h3>Graphic & Interface Design</h3>
                <p>Designing digital assets, branding logos, promotional materials, and clean website layouts tailored
                    to client requirements.</p>
            </div>
        </section>

        <section id="work-experience">
            <h2>Work Experience</h2>
            <p><strong>HERE IS THE SUMMARY OF MY WORK EXPERIENCES:</strong></p>
            <div class="work-experience-item">
                <h4>Web Developer at Refurnishing Company</h4>
                <p>Duration: Jan 2020 - Present</p>
                <p>Responsibilities: Developing and maintaining websites, collaborating with designers and clients...
                </p>
            </div>
            <div class="work-experience-item">
                <h4>Data Analyst at ABC Corporation</h4>
                <p>Duration: Jun 2018 - Dec 2019</p>
                <p>Responsibilities: Analyzing data sets, creating reports, and providing insights...</p>
            </div>
            <div class="work-experience-item">
                <h4>Server Administrator at DEF Solutions</h4>
                <p>Duration: Mar 2016 - May 2018</p>
                <p>Responsibilities: Managing server infrastructure, ensuring system security...</p>
            </div>
        </section>

        <section id="reviews">
            <h2>Reviews</h2>
            <img src="review.jpg" alt="Client Reviews" class="reviews-img">
            <p class="reviews-desc">Client testimonials and feedback on my work quality and professionalism.</p>
        </section>

        <section id="resume">
            <h2>Resume</h2>
            <p>You can view my resume by clicking the link below: <a href="Resume-portfolio.jpg" target="_blank"
                    rel="noopener">View
                    Resume</a></p>
        </section>

        <section id="register">
            <h2>Register</h2>
            <p>Want to get in touch? Create an account here: <a href="registrationform.html">Go to the registration
                    form</a></p>
        </section>

        <section id="contact">
            <h2>Contact Me</h2>
            <p class="contact-intro">Have a project or a question? Send me a message and I'll get back to you.</p>

            <!-- AJAX: app.js sends this form with fetch() to save_message.php (no page reload).
                 If JavaScript is off, it still falls back to the old way through contact.php. -->
            <form id="contactForm" action="contact.php" method="POST" class="contact-form">
                <div class="form-group">
                    <label for="c-name">Name</label>
                    <input type="text" id="c-name" name="name" required autocomplete="name"
                        value="<?php echo htmlspecialchars($old['name']); ?>">
                </div>

                <div class="form-group">
                    <label for="c-email">Email</label>
                    <input type="email" id="c-email" name="email" required autocomplete="email"
                        value="<?php echo htmlspecialchars($old['email']); ?>">
                </div>

                <div class="form-group">
                    <label for="c-message">Message</label>
                    <textarea id="c-message" name="message" rows="4" required><?php echo htmlspecialchars($old['message']); ?></textarea>
                </div>

                <button type="submit" class="submit-btn send-btn">Send</button>
            </form>

            <!-- Server time when this page was built. With AJAX it does NOT change after sending. -->
            <p class="loaded">Page loaded at: <strong><?php echo date('h:i:s A'); ?></strong></p>

            <p id="status" role="status" aria-live="polite"<?php if ($flash) echo ' class="' . ($flash['ok'] ? 'ok' : 'error') . '"'; ?>><?php if ($flash) echo htmlspecialchars($flash['text']); ?></p>

            <h3 class="messages-title">Messages</h3>
            <ul id="messageList" class="messages-list"></ul>
        </section>


    </main>

    <footer>
        <p>&copy; 2026 My Portfolio. All rights reserved. Page loaded at <?php date_default_timezone_set('Asia/Manila'); echo date('h:i:s A'); ?></p>
    </footer>

    <script src="app.js"></script>
</body>

</html>