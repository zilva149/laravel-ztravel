import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";
import PerfectScrollbar from "perfect-scrollbar";

window.PerfectScrollbar = PerfectScrollbar;

document.addEventListener("alpine:init", () => {
    Alpine.data("mainState", () => {
        let lastScrollTop = 0;
        const init = function () {
            window.addEventListener("scroll", () => {
                let st =
                    window.pageYOffset || document.documentElement.scrollTop;
                if (st > lastScrollTop) {
                    // downscroll
                    this.scrollingDown = true;
                    this.scrollingUp = false;
                } else {
                    // upscroll
                    this.scrollingDown = false;
                    this.scrollingUp = true;
                    if (st == 0) {
                        //  reset
                        this.scrollingDown = false;
                        this.scrollingUp = false;
                    }
                }
                lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
            });
        };

        const getTheme = () => {
            if (window.localStorage.getItem("dark")) {
                return JSON.parse(window.localStorage.getItem("dark"));
            }
            return (
                !!window.matchMedia &&
                window.matchMedia("(prefers-color-scheme: dark)").matches
            );
        };
        const setTheme = (value) => {
            window.localStorage.setItem("dark", value);
        };
        return {
            init,
            isDarkMode: getTheme(),
            toggleTheme() {
                this.isDarkMode = !this.isDarkMode;
                setTheme(this.isDarkMode);
            },
            isSidebarOpen: window.innerWidth > 1024,
            isSidebarHovered: false,
            handleSidebarHover(value) {
                if (window.innerWidth < 1024) {
                    return;
                }
                this.isSidebarHovered = value;
            },
            handleWindowResize() {
                if (window.innerWidth <= 1024) {
                    this.isSidebarOpen = false;
                } else {
                    this.isSidebarOpen = true;
                }
            },
            scrollingDown: false,
            scrollingUp: false,
        };
    });
});

Alpine.plugin(collapse);

Alpine.start();

const expandBtns = document.querySelectorAll("i[data-id='btn-expand']");

if (expandBtns) {
    expandBtns.forEach((btn) => {
        btn.addEventListener("click", (e) => {
            const accordionFooter =
                e.currentTarget.parentElement.parentElement.nextElementSibling;

            accordionFooter.classList.toggle("show");
            if (accordionFooter.classList.contains("show")) {
                e.currentTarget.style.transform = "rotate(180deg)";
            } else {
                e.currentTarget.style.transform = "rotate(0deg)";
            }
        });
    });
}
