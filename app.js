document.addEventListener("DOMContentLoaded", () => {
    // -------------------------------------------------------------
    // 1. SPLASH SCREEN INTRO ANIMATION
    // -------------------------------------------------------------
    const intro = document.querySelector(".intro");
    const introSubtext = document.querySelector(".intro-subtext");
    const introDescription = document.querySelector(".intro-description");

    if (intro && introSubtext && introDescription) {
        setTimeout(() => {
            introSubtext.classList.add("active");
        }, 500);

        setTimeout(() => {
            introDescription.classList.add("show");
        }, 1200);

        setTimeout(() => {
            introSubtext.classList.add("fade");
        }, 2300);

        setTimeout(() => {
            intro.classList.add("hide");
        }, 3000);
    }

    // -------------------------------------------------------------
    // 2. SCROLL REVEAL ANIMATIONS
    // -------------------------------------------------------------
    const revealElements = document.querySelectorAll(".project, .work-experience-item, .graphic-item, .skills");

    function revealOnScroll() {
        const windowHeight = window.innerHeight;

        revealElements.forEach((el) => {
            const elementTop = el.getBoundingClientRect().top;
            if (elementTop < windowHeight - 100) {
                el.classList.add("show");
            }
        });
    }

    window.addEventListener("scroll", revealOnScroll);
    revealOnScroll(); // Trigger immediately for elements already in viewport

    // -------------------------------------------------------------
    // 3. NAVIGATION ACTIVE LINK TRACKING
    // -------------------------------------------------------------
    const navLinks = document.querySelectorAll("nav.side-menu a");
    const sections = document.querySelectorAll("main section");

    function highlightNavOnScroll() {
        let scrollPosition = window.scrollY + 200;

        sections.forEach((section) => {
            const top = section.offsetTop;
            const height = section.offsetHeight;
            const id = section.getAttribute("id");

            if (scrollPosition >= top && scrollPosition < top + height) {
                navLinks.forEach((link) => {
                    link.classList.remove("active");
                    if (link.getAttribute("href") === `#${id}`) {
                        link.classList.add("active");
                    }
                });
            }
        });
    }

    window.addEventListener("scroll", highlightNavOnScroll);

    navLinks.forEach((link) => {
        link.addEventListener("click", function () {
            navLinks.forEach((item) => item.classList.remove("active"));
            this.classList.add("active");
        });
    });

    // -------------------------------------------------------------
    // 4. SHOP PRODUCT MODAL CONTROLLER
    // -------------------------------------------------------------
    const shopItems = document.querySelectorAll(".shop-item");
    const modal = document.getElementById("shopModal");
    const modalImg = document.getElementById("modalImg");
    const modalTitle = document.getElementById("modalTitle");
    const modalDesc = document.getElementById("modalDesc");
    const closeModal = document.getElementById("closeModal");

    if (shopItems.length && modal) {
        shopItems.forEach((item) => {
            const img = item.querySelector(".shop-item-img");
            const titleEl = item.querySelector("h3");
            const descEl = item.querySelector(".product-desc");

            const title = titleEl ? titleEl.innerText : "";
            const desc = descEl ? descEl.innerText : "";

            if (img) {
                img.addEventListener("click", () => {
                    modalImg.src = img.src;
                    modalImg.alt = title;
                    modalTitle.textContent = title;
                    modalDesc.textContent = desc;
                    modal.classList.add("show");
                });
            }
        });

        // Close Modal handlers
        const hideModal = () => modal.classList.remove("show");

        if (closeModal) {
            closeModal.addEventListener("click", hideModal);
        }

        modal.addEventListener("click", (e) => {
            if (e.target === modal) hideModal();
        });

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape" && modal.classList.contains("show")) {
                hideModal();
            }
        });
    }
});
// =====================================================================
// AJAX #2: send the contact form with fetch() and refresh only the messages
// =====================================================================
(() => {
    const form = document.getElementById("contactForm");
    const statusMsg = document.getElementById("status");
    const list = document.getElementById("messageList");
    if (!form || !statusMsg || !list) return;

    const sendBtn = form.querySelector("button[type='submit']");

    // Ask the server for the saved messages and rebuild only the list
    async function loadMessages() {
        try {
            const response = await fetch("get_messages.php", { cache: "no-store" });
            const messages = await response.json();

            const items = messages.map((m) => {
                const li = document.createElement("li");
                li.textContent = `${m.name} (${m.time}): ${m.message}`;   // textContent keeps it safe from HTML injection
                return li;
            });

            if (!items.length) {
                const empty = document.createElement("li");
                empty.className = "empty";
                empty.textContent = "No messages yet.";
                items.push(empty);
            }
            list.replaceChildren(...items);
        } catch (err) {
            // leave the current list as it is; the next refresh will try again
        }
    }

    form.addEventListener("submit", async (event) => {
        event.preventDefault();                       // stop the normal submit: no page reload

        statusMsg.textContent = "Sending...";
        statusMsg.className = "";
        sendBtn.disabled = true;

        try {
            const response = await fetch("save_message.php", {
                method: "POST",
                body: new FormData(form)
            });
            const data = await response.json();

            statusMsg.textContent = data.reply;
            statusMsg.className = data.ok ? "ok" : "error";

            if (data.ok) {
                form.reset();                         // clear the form
                loadMessages();                       // refresh only the list
            }
        } catch (err) {
            statusMsg.textContent = "Network error. Is XAMPP running?";
            statusMsg.className = "error";
        } finally {
            sendBtn.disabled = false;
        }
    });

    loadMessages();                                   // load once now
    setInterval(loadMessages, 5000);                  // then every 5 seconds
})();

// =====================================================================
// AJAX #3: a Like button for every project (count is saved on the server)
// =====================================================================
(() => {
    // Build one Like button for the project with this id
    function makeLikeButton(id) {
        const btn = document.createElement("button");
        btn.type = "button";
        btn.className = "like";
        btn.textContent = "Like (...)";

        const show = (data) => { btn.textContent = `Like (${data.likes})`; };

        // GET: ask the server for the current count
        fetch(`like.php?id=${id}`)
            .then((res) => res.json())
            .then(show)
            .catch(() => { btn.textContent = "Like"; });

        // POST: add 1 to the count, then show the new number
        btn.addEventListener("click", () => {
            const body = new FormData();
            body.append("id", id);
            btn.disabled = true;
            fetch("like.php", { method: "POST", body })
                .then((res) => res.json())
                .then(show)
                .catch(() => { btn.textContent = "Like (error)"; })
                .finally(() => { btn.disabled = false; });
        });

        return btn;
    }

    // Add a Like button under the text of every project
    document.querySelectorAll(".project-info[data-project-id]").forEach((project) => {
        const holder = project.querySelector(".project-text-content");
        if (holder) holder.appendChild(makeLikeButton(project.dataset.projectId));
    });
})();
