import { ratingStars } from "./ratingStars";
import { ratingCard } from "./ratingCard";

import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";

Alpine.plugin(collapse);

Alpine.start();

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

async function appendInnerModal(operation, route) {
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    let review = null;
    if (operation === "update") {
        const id = route.split("/").pop();
        review = await fetchReview(id);
    }

    return `<form action="${route}" method="POST" class="w-full py-2 px-4 flex flex-col gap-4">
                <div class="flex justify-center items-center">${ratingStars(
                    review
                )}</div>
                <div class="rating-inner w-full py-4 ${
                    operation == "store" ? "hidden" : "flex"
                } flex-col gap-6 justify-center">
                    <input type="hidden" name="_token" id="csrf-token" value="${csrf}"/>
                    <textarea class="w-full px-3 py-1.5 text-gray-700 resize-none border border-solid border-[var(--green)] rounded-md transition ease-in-out focus:border-[var(--green)] focus:outline-none focus:ring-2 focus:ring-[var(--dgreen)]" name="desc" rows="6" placeholder="Apibūdinkite savo patirtį...">${
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

    filter.addEventListener("change", async (e) => {
        const filterValue = e.currentTarget.value;
        const sortValue = sort.value;
        const searchValue = search.value;

        const offers = await fetchFilteredOffers(
            filterValue,
            sortValue,
            searchValue
        );

        let HTML = "";

        if (offers.length > 0) {
            for (const offer of offers) {
                console.log(offer);
                HTML += `<article class="shadow-md rounded-lg overflow-hidden">
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
                                    <p class="font-semibold">&euro;${
                                        offer.price
                                    }</p>
                                    ${ratingCard}
                                </div>
                                <a href="/offers/${
                                    offer.id
                                }" class="btn-action-link text-md">Sužinokite daugiau</a>
                            </div>
                        </article>`;
            }
        } else {
            HTML +=
                '<h2 class="col-span-3 text-3xl text-center font-semibold">Nėra pasiūlymų</h2>';
        }

        document.getElementById("offers-container").innerHTML = HTML;
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

        let HTML = "";

        if (offers.length > 0) {
            for (const offer of offers) {
                HTML += `<article class="shadow-md rounded-lg overflow-hidden">
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
                                    <p class="font-semibold">&euro;${
                                        offer.price
                                    }</p>
                                    ${ratingCard}
                                </div>
                                <a href="/offers/${
                                    offer.id
                                }" class="btn-action-link text-md">Sužinokite daugiau</a>
                            </div>
                        </article>`;
            }
        } else {
            HTML +=
                '<h2 class="col-span-3 text-3xl text-center font-semibold">Nėra pasiūlymų</h2>';
        }

        document.getElementById("offers-container").innerHTML = HTML;
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

        let HTML = "";

        if (offers.length > 0) {
            for (const offer of offers) {
                HTML += `<article class="shadow-md rounded-lg overflow-hidden">
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
                                    <p class="font-semibold">&euro;${
                                        offer.price
                                    }</p>
                                    ${ratingCard}
                                </div>
                                <a href="/offers/${
                                    offer.id
                                }" class="btn-action-link text-md">Sužinokite daugiau</a>
                            </div>
                        </article>`;
            }
        } else {
            HTML +=
                '<h2 class="col-span-3 text-3xl text-center font-semibold">Nėra pasiūlymų</h2>';
        }

        document.getElementById("offers-container").innerHTML = HTML;
    });
}

async function fetchFilteredOffers(filter, sort, search) {
    const resp = await fetch(
        `/api/offers?filter=${filter}&sort=${sort}&s=${search}`
    );
    const data = await resp.json();

    return data;
}
