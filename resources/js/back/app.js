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

// if (countrySelect) {
//     countrySelect.addEventListener("change", async (e) => {
//         for (const country of countries) {
//             if (country.id == e.currentTarget.value) {
//                 const start = country["season_start"];
//                 const end = country["season_end"];

//                 travelStartInput.setAttribute("min", start);
//                 travelStartInput.setAttribute("max", end);
//                 travelEndInput.setAttribute("min", start);
//                 travelEndInput.setAttribute("max", end);
//             }
//         }

//         const hotels = await fetchHotels(e.currentTarget.value);

//         const hotelSelectParent = document.getElementById(
//             "select_hotel_parent"
//         );

//         let HTML = `
//             <label for="hotel_id">Viešbutis:</label>
//             <select
//                 class="appearance-none w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
//                 aria-label="continent" name="hotel_id" id="hotel_id">
//                 <option selected disabled>-- Rinktis viešbutį</option>
//         `;

//         for (const hotel of hotels) {
//             HTML += `
//                 <option value="${hotel.id}">
//                     ${hotel.name}
//                 </option>
//             `;
//         }

//         HTML += `</select>`;

//         hotelSelectParent.innerHTML = HTML;
//     });
// }

// async function fetchHotels(countryID) {
//     const resp = await fetch(`/admin/travels/api/hotels/${countryID}`);
//     const data = await resp.json();

//     return data;
// }
