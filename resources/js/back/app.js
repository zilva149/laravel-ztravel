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

if (countrySelect) {
    countrySelect.addEventListener("change", async (e) => {
        if (document.getElementById("hotel_id")) {
            document.getElementById("hotel_select_parent").innerHTML = "";
        }

        if (page === "offers") {
            for (const country of countries) {
                if (country.id == e.currentTarget.value) {
                    const start = country["season_start"];
                    const end = country["season_end"];

                    travelStartInput.setAttribute("min", start);
                    travelStartInput.setAttribute("max", end);
                    travelEndInput.setAttribute("min", start);
                    travelEndInput.setAttribute("max", end);
                }
            }
        }

        const destinations = await fetchCountryDestinations(
            e.currentTarget.value
        );

        const destinationSelectParent = document.getElementById(
            "destination_select_parent"
        );

        let HTML = `
            <div class="mb-6 flex flex-col gap-2">
                <label for="destination_id">Vietovė:</label>
                <select
                    class="appearance-none w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    aria-label="destination" name="destination_id" id="destination_id">
                    <option selected disabled>-- Rinktis vietovę</option>
        `;

        for (const destination of destinations) {
            HTML += `
                <option value="${destination.id}">
                    ${destination.name}
                </option>
            `;
        }

        HTML += `</select> </div>`;

        destinationSelectParent.innerHTML = HTML;

        if (page === "offers") {
            const destinationSelect = document.getElementById("destination_id");

            destinationSelect.addEventListener("change", async (e) => {
                const hotels = await fetchDestinationHotels(
                    e.currentTarget.value
                );

                const hotelSelectParent = document.getElementById(
                    "hotel_select_parent"
                );

                let HTML = `
                    <div class="mb-6 flex flex-col gap-2">
                        <label for="hotel_id">Nakvynės vieta:</label>
                        <select
                            class="appearance-none w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                            aria-label="hotel" name="hotel_id" id="hotel_id">
                            <option selected disabled>-- Rinktis nakvynės vietą</option>
                `;

                for (const hotel of hotels) {
                    HTML += `
                        <option value="${hotel.id}">
                            ${hotel.name}
                        </option>
                    `;
                }

                HTML += `</select> </div>`;

                hotelSelectParent.innerHTML = HTML;
            });
        }
    });
}

if (document.getElementById("destination_id")) {
    const destinationSelect = document.getElementById("destination_id");

    destinationSelect.addEventListener("change", async (e) => {
        const hotels = await fetchDestinationHotels(e.currentTarget.value);

        const hotelSelectParent = document.getElementById(
            "hotel_select_parent"
        );

        let HTML = `
                    <div class="mb-6 flex flex-col gap-2">
                        <label for="hotel_id">Nakvynės vieta:</label>
                        <select
                            class="appearance-none w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                            aria-label="hotel" name="hotel_id" id="hotel_id">
                            <option selected disabled>-- Rinktis nakvynės vietą</option>
                `;

        for (const hotel of hotels) {
            HTML += `
                        <option value="${hotel.id}">
                            ${hotel.name}
                        </option>
                    `;
        }

        HTML += `</select> </div>`;

        hotelSelectParent.innerHTML = HTML;
    });
}

async function fetchCountryDestinations(countryID) {
    const resp = await fetch(`/admin/api/destinations/${countryID}`);
    const data = await resp.json();

    return data;
}

async function fetchDestinationHotels(destinationID) {
    const resp = await fetch(`/admin/api/hotels/${destinationID}`);
    const data = await resp.json();

    return data;
}
