const data = window.PORTFOLIO_DATA || {
    tabs: [],
    skillCategories: [],
    skills: [],
    projects: [],
    statuses: {},
};

function portfolioTerminal() {
    return {
        isAuthenticated: false,
        activeTab: "overview",
        clockTime: "",
        selectedSkillCategory: "ALL",
        modalOpen: false,
        activeProject: null,

        tabs: data.tabs,

        loginForm: {
            username: "",
            password: "",
            isAuthenticating: false,
            statusMessage: "INITIALIZING AUTHORIZATION PROTOCOL...",
        },

        contactForm: {
            name: "",
            email: "",
            website: "",
            message: "",
            isSending: false,
            errors: {},
            logs: [],
        },

        skillCategories: data.skillCategories,

        skills: data.skills,

        projects: data.projects,

        statusClass(status) {
            const map = data.statuses || {};
            return map[status] || map["default"] || "";
        },

        get filteredSkills() {
            if (this.selectedSkillCategory === "ALL") return this.skills;
            return this.skills.filter(
                (s) => s.category === this.selectedSkillCategory,
            );
        },

        startClock() {
    const update = () => {
        const now = new Date();
        this.clockTime = now.toLocaleTimeString('en-GB', { 
            timeZone: 'Asia/Jakarta', // You can also use 'Asia/Jakarta'
            hour12: false 
        }) + " GMT+7";
    };
    update();
    setInterval(update, 1000);
},

        tabFromHash() {
    const id = location.hash.slice(1);
    return this.tabs.some(t => t.id === id) ? id : 'overview';
},

initKeys() {
    window.addEventListener('keydown', (e) => {
        if (e.ctrlKey || e.metaKey || e.altKey) return;
        if (e.target && e.target.matches && e.target.matches('input, textarea, select, [contenteditable]')) return;

        if (e.key === 'Escape') {
            this.modalOpen = false;
            return;
        }

        if (!this.isAuthenticated || this.modalOpen) return;

        const tab = this.tabs[parseInt(e.key, 10) - 1];
        if (tab) this.switchTab(tab.id);
    });

    window.addEventListener('hashchange', () => {
        if (this.isAuthenticated) this.activeTab = this.tabFromHash();
    });
},

        switchTab(tabId) {
    this.activeTab = tabId;
    history.replaceState(null, '', '#' + tabId);
},

        startAutoLogin() {
            let seen = false;
            try {
                seen = sessionStorage.getItem("frost_intro_seen") === "1";
            } catch (e) {}

            if (seen) {
                this.isAuthenticated = true;
                this.activeTab = this.tabFromHash();
                return;
            }

            setTimeout(() => this.executeAuthSequence(), 600);
        },

        executeAuthSequence() {
            if (this.loginForm.isAuthenticating) return;

            this.loginForm.isAuthenticating = true;
            this.loginForm.statusMessage = "AUTHENTICATING EMPLOYEE ACCOUNT...";

            let userTarget = "FROSTED";
            let passTarget = "••••••••••••••••";
            let uIdx = 0,
                pIdx = 0;

            let interval = setInterval(() => {
                if (uIdx <= userTarget.length) {
                    this.loginForm.username = userTarget.substring(0, uIdx);
                    uIdx++;
                } else if (pIdx <= passTarget.length) {
                    this.loginForm.password = passTarget.substring(0, pIdx);
                    pIdx++;
                } else {
                    clearInterval(interval);
                    this.loginForm.statusMessage =
                        "ACCESS GRANTED // REDIRECTING...";

                    setTimeout(() => {
                        this.loginForm.isAuthenticating = false;
                        this.isAuthenticated = true;
                        this.activeTab = this.tabFromHash();
                        try {
                            sessionStorage.setItem("frost_intro_seen", "1");
                        } catch (e) {}
                    }, 700);
                }
            }, 40);
        },

        openProjectModal(proj) {
            this.activeProject = proj;
            this.modalOpen = true;
        },

        async dispatchMessage() {
            const f = this.contactForm;
            if (f.isSending) return;

            f.isSending = true;
            f.errors = {};

            const now = () => new Date().toLocaleTimeString();
            const log = (text, type = "info") =>
                f.logs.push({ time: now(), text, type });

            log("Packing payload data...");

            try {
                log("Transmitting packet to Director Frost...");

                const res = await fetch(data.contactUrl, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]',
                        ).content,
                    },
                    body: JSON.stringify({
                        name: f.name,
                        email: f.email,
                        message: f.message,
                        website: f.website,
                    }),
                });

                const body = await res.json().catch(() => ({}));

                if (res.ok) {
                    log("DISPATCH SUCCESSFUL // ACK RECEIVED", "success");
                    f.name = "";
                    f.email = "";
                    f.message = "";
                } else if (res.status === 422) {
                    f.errors = Object.fromEntries(
                        Object.entries(body.errors || {}).map(
                            ([field, msgs]) => [field, msgs[0]],
                        ),
                    );
                    log("TRANSMISSION REJECTED // CHECK FIELDS", "warn");
                } else if (res.status === 429) {
                    log(
                        "RATE LIMIT EXCEEDED // RETRY IN A FEW MINUTES",
                        "warn",
                    );
                } else {
                    log("DISPATCH FAILED // SERVER ERROR", "warn");
                }
            } catch (e) {
                log("LINK FAILURE // NETWORK ERROR", "warn");
            } finally {
                f.isSending = false;
            }
        },
    };
}

window.portfolioTerminal = portfolioTerminal;
