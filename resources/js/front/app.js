import { starsRateOrder } from "./stars";
import { starsOffer } from "./stars";

import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";

Alpine.plugin(collapse);

Alpine.start();

// *********** NAVIGATION SIDEBAR **********

const burgerOpenBtn = document.getElementById("burger-open");

if (burgerOpenBtn) {
    burgerOpenBtn.addEventListener("click", (e) => {
        e.currentTarget.innerHTML =
            "<i class='fa-solid fa-xmark text-3xl'></i>";

        const sidebar = document.getElementById("front-sidebar");
        const overlay = document.getElementById("overlay");

        sidebar.style.transform = "translateX(0)";
        overlay.classList.add("active");
        overlay.style.zIndex = "699";

        overlay.addEventListener("click", (e) => {
            burgerOpenBtn.innerHTML =
                "<i class='fa-solid fa-bars text-2xl'></i>";
            sidebar.style.transform = "translateX(-100%)";
            e.currentTarget.classList.remove("active");
        });

        const burgerCloseBtn = sidebar.querySelector("#burger-close");
        burgerCloseBtn.addEventListener("click", () => {
            burgerOpenBtn.innerHTML =
                "<i class='fa-solid fa-bars text-2xl'></i>";
            sidebar.style.transform = "translateX(-100%)";
            overlay.classList.remove("active");
        });

        window.addEventListener("resize", () => {
            const width = window.innerWidth;
            if (width >= 992) {
                burgerOpenBtn.innerHTML =
                    "<i class='fa-solid fa-bars text-2xl'></i>";
                sidebar.style.transform = "translateX(-100%)";
                overlay.classList.remove("active");
            }
        });
    });
}

// ********** BACK TO TOP BUTTON *********

const btnTop = document.getElementById("btn-back-to-top");

window.addEventListener("scroll", () => {
    const scrollHeight = window.pageYOffset;

    if (scrollHeight > 200) {
        btnTop.classList.add("show");
    } else {
        btnTop.classList.remove("show");
    }
});

// ********** MESSAGES TIMEOUT ***********

const messages = document.querySelectorAll(".message");

if (messages) {
    messages.forEach((message) => {
        setTimeout(() => {
            message.remove();
        }, 3000);
    });
}

// *********** ACCORDIONS ***********

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

// ************* RATING STARS ***************

const openReviewsBtns = document.querySelectorAll(
    'button[data-modal-open="reviews"]'
);

if (openReviewsBtns) {
    const modal = document.getElementById("reviews");
    const overlay = document.getElementById("overlay");

    openReviewsBtns.forEach((btn) => {
        btn.addEventListener("click", async (e) => {
            modal.innerHTML = await appendInnerModal(
                e.currentTarget.dataset.modalOperation,
                e.currentTarget.dataset.modalRoute
            );

            modal.querySelectorAll(".star-label").forEach((star) => {
                star.addEventListener("click", () => {
                    modal.querySelectorAll(".star-label").forEach((x) => {
                        x.style.color = "";
                    });
                });
            });

            modal
                .querySelector("button[data-close-modal]")
                .addEventListener("click", (e) => {
                    modal.classList.remove("active");
                    overlay.classList.remove("active");
                });

            modal.querySelectorAll(".star-label").forEach((star) => {
                star.addEventListener("click", () => {
                    const ratingInner = modal.querySelector(".rating-inner");
                    ratingInner.classList.remove("hidden");
                    ratingInner.classList.add("flex");
                });
            });

            modal.classList.add("active");
            overlay.classList.add("active");

            overlay.addEventListener("click", (e) => {
                modal.classList.remove("active");
                e.currentTarget.classList.remove("active");
            });
        });
    });
}

async function appendInnerModal(operation, route = "") {
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    let review = null;
    if (operation === "update") {
        const id = route.split("/").pop();
        review = await fetchReview(id);
    }

    return `<form action="${route}" method="POST" class="w-full py-2 px-4 flex flex-col gap-4">
                <div class="flex justify-center items-center">${starsRateOrder(
                    review
                )}</div>
                <div class="rating-inner w-full py-4 ${
                    operation == "store" ? "hidden" : "flex"
                } flex-col gap-6 justify-center">
                    <input type="hidden" name="_token" id="csrf-token" value="${csrf}"/>
                    <textarea class="form-text" name="desc" rows="6" placeholder="Apibūdinkite savo patirtį...">${
                        review ? review.desc : ""
                    }</textarea>
                    <div class="flex gap-2 justify-center">
                        <button type="submit" class="btn-primary text-lg">
                                ${
                                    operation == "store"
                                        ? "Vertinti"
                                        : "Atnaujinti"
                                }
                        </button>
                        <button type="button" class="btn-primary bg-gray-400 hover:bg-gray-500 text-lg" data-close-modal="modal">Atšaukti</button>
                    </div>
                </div>
            </form>`;
}

async function fetchReview(id) {
    const resp = await fetch(`/api/reviews/${id}`);
    const data = await resp.json();

    return data;
}

// ********** FILTERS ***********

if (document.getElementById("filter")) {
    const filter = document.getElementById("filter");
    const sort = document.getElementById("sort");
    const search = document.getElementById("search");

    if (filter) {
        filter.addEventListener("change", async (e) => {
            const filterValue = filter && e.currentTarget.value;
            const sortValue = sort && sort.value;
            const searchValue = search && search.value;

            if (page === "offers") {
                const offers = await fetchFilteredOffers(
                    filterValue,
                    sortValue,
                    searchValue
                );

                let HTML = "";

                if (offers.length > 0) {
                    for (const offer of offers) {
                        HTML += appendOfferCard(offer);
                    }
                } else {
                    HTML += '<h2 class="empty-list">Nėra pasiūlymų</h2>';
                }

                document.getElementById("offers-container").innerHTML = HTML;
            }

            if (page === "destinations") {
                const destinations = await fetchFilteredDestinations(
                    filterValue,
                    searchValue
                );

                let HTML = "";

                if (destinations.length > 0) {
                    for (const destination of destinations) {
                        HTML += appendDestinationCard(destination);
                    }
                } else {
                    HTML += '<h2 class="empty-list">Nėra vietovių</h2>';
                }

                document.getElementById("destinations-container").innerHTML =
                    HTML;
            }
        });
    }

    if (sort) {
        sort.addEventListener("change", async (e) => {
            const filterValue = filter && filter.value;
            const sortValue = sort && e.currentTarget.value;
            const searchValue = search && search.value;

            const offers = await fetchFilteredOffers(
                filterValue,
                sortValue,
                searchValue
            );

            let HTML = "";

            if (offers.length > 0) {
                for (const offer of offers) {
                    HTML += appendOfferCard(offer);
                }
            } else {
                HTML += '<h2 class="empty-list">Nėra pasiūlymų</h2>';
            }

            document.getElementById("offers-container").innerHTML = HTML;
        });
    }

    if (search) {
        search.addEventListener("input", async (e) => {
            const filterValue = filter && filter.value;
            const sortValue = sort && sort.value;
            const searchValue = search && e.currentTarget.value;

            if (page === "offers") {
                const offers = await fetchFilteredOffers(
                    filterValue,
                    sortValue,
                    searchValue
                );

                let HTML = "";

                if (offers.length > 0) {
                    for (const offer of offers) {
                        HTML += appendOfferCard(offer);
                    }
                } else {
                    HTML += '<h2 class="empty-list">Nėra pasiūlymų</h2>';
                }

                document.getElementById("offers-container").innerHTML = HTML;
            }

            if (page === "destinations") {
                const destinations = await fetchFilteredDestinations(
                    filterValue,
                    searchValue
                );

                let HTML = "";

                if (destinations.length > 0) {
                    for (const destination of destinations) {
                        HTML += appendDestinationCard(destination);
                    }
                } else {
                    HTML += '<h2 class="empty-list">Nėra vietovių</h2>';
                }

                document.getElementById("destinations-container").innerHTML =
                    HTML;
            }
        });
    }
}

async function fetchFilteredOffers(filter, sort, search) {
    const resp = await fetch(
        `/api/offers?filter=${filter}&sort=${sort}&s=${search}`
    );
    const data = await resp.json();

    return data;
}

async function fetchFilteredDestinations(filter, search) {
    const resp = await fetch(
        `/api/destinations?filter=${filter}&sort&s=${search}`
    );
    const data = await resp.json();

    return data;
}

function appendOfferCard(offer) {
    return `<article class="shadow-md rounded-lg overflow-hidden">
                <div>
                    <img src="${
                        offer.hotel.image
                            ? offer.hotel.image
                            : "/assets/img/no-image.jpg"
                    }" alt="hotel">
                </div>
                <div class="p-4 flex flex-col items-start">
                    <p class="mb-1 text-gray-500 text-lg">${
                        offer.destination.name
                    }, ${offer.country.name}</p>
                    <p class="mb-3 text-sm">${offer.hotel.name}</p>
                    <p class="mb-4">${offer.travel_start} iki ${
        offer.travel_end
    }</p>
            <div class="mb-6 w-full flex justify-between">
                <p class="font-semibold">&euro;${offer.price}</p>
                ${offer.reviews.length !== 0 ? starsOffer(offer) : ""}
            </div>
            <a href="/offers/${
                offer.id
            }" class="btn-action-link text-md">Sužinokite daugiau</a>
        </div>
    </article>`;
}

function appendDestinationCard(destination) {
    return `<article class="w-full max-w-[600px] m-auto shadow-md rounded-lg overflow-hidden">
    <div>
        <img src="${
            destination.image ? destination.image : "/assets/img/no-image.jpg"
        }" alt="${destination.name}" class="w-full">
    </div>
    <div class="p-4 flex flex-col items-start">
        <p class="mb-1 text-gray-500">${destination.country.name}</p>
        <p class="mb-4">${destination.name}</p>
        <p class="mb-6 font-semibold">
            ${
                destination.min_price
                    ? "Nuo &euro;" + destination.min_price
                    : "Pasiūlymų nėra"
            }
        </p>
        
        <a href="#" class="btn-action-link text-md">Sužinokite daugiau</a>
    </div>
</article>`;
}
