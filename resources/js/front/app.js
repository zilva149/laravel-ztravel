import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";

Alpine.plugin(collapse);

Alpine.start();

const expandBtns = document.querySelectorAll("*[data-id='btn-expand']");

if (expandBtns) {
    expandBtns.forEach((btn) => {
        btn.addEventListener("click", (e) => {
            if (document.getElementById("destination-expand")) {
                const accordionFooter =
                    e.currentTarget.parentElement.parentElement.parentElement
                        .nextElementSibling;

                accordionFooter.classList.toggle("show");
                if (accordionFooter.classList.contains("show")) {
                    e.currentTarget.style.transform = "rotate(180deg)";
                } else {
                    e.currentTarget.style.transform = "rotate(0deg)";
                }
            } else {
                const accordionFooter =
                    e.currentTarget.parentElement.parentElement
                        .nextElementSibling;

                accordionFooter.classList.toggle("show");
                if (accordionFooter.classList.contains("show")) {
                    e.currentTarget.style.transform = "rotate(180deg)";
                } else {
                    e.currentTarget.style.transform = "rotate(0deg)";
                }
            }
        });
    });
}

const modals = document.querySelectorAll(".modal");

if (modals) {
    modals.forEach((modal) => {
        setTimeout(() => {
            modal.remove();
        }, 3000);
    });
}

if (document.getElementById("filter")) {
    const filter = document.getElementById("filter");
    const sort = document.getElementById("sort");
    const search = document.getElementById("search");

    filter.addEventListener("change", async (e) => {
        const filterValue = e.currentTarget.value;
        const sortValue = sort.value;
        const searchValue = search.value;

        const offers = await fetchFilteredOffers(
            filterValue,
            sortValue,
            searchValue
        );
        console.log(offers);
    });

    sort.addEventListener("change", async (e) => {
        const filterValue = filter.value;
        const sortValue = e.currentTarget.value;
        const searchValue = search.value;

        const offers = await fetchFilteredOffers(
            filterValue,
            sortValue,
            searchValue
        );
        console.log(offers);
    });

    search.addEventListener("input", async (e) => {
        const filterValue = filter.value;
        const sortValue = sort.value;
        const searchValue = e.currentTarget.value;

        const offers = await fetchFilteredOffers(
            filterValue,
            sortValue,
            searchValue
        );
        console.log(offers);
    });
}

async function fetchFilteredOffers(filter, sort, search) {
    const resp = await fetch(
        `/api/offers?filter=${filter}&sort=${sort}&s=${search}`
    );
    const data = await resp.json();

    return data;
}
