import { ratingStars } from "./ratingStars";

import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";

Alpine.plugin(collapse);

Alpine.start();

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

const openRatingBtns = document.querySelectorAll('button[data-modal-open="rating"]');

if(openRatingBtns) {
    const modal = document.getElementById('rating');
    const overlay = document.getElementById('overlay');

    openRatingBtns.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            modal.innerHTML = appendInnerModal(
                e.currentTarget.dataset.modalOperation,
                e.currentTarget.dataset.modalRoute
            );

            modal.querySelector('button[data-close-modal]').addEventListener('click', (e) => {
                modal.classList.remove('active');
                overlay.classList.remove('active');
            })

            modal.classList.add('active');
            overlay.classList.add('active');

            overlay.addEventListener('click', (e) => {
                modal.classList.remove('active');
                e.currentTarget.classList.remove('active');
            })
        });
    })
}

function appendInnerModal(operation, object, route) {
    let modalMessage = "";
    switch (operation) {
        case "delete":
            modalMessage = `Ar tikrai norite ištrinti ${object}?`;
            break;
        case "approve":
            modalMessage = `Ar tikrai norite patvirinti ${object}?`;
            break;
        case "cancel":
            modalMessage = `Ar tikrai norite atšaukti ${object}?`;
            break;
        default:
            modalMessage = `Ar tikrai norite tęsti?`;
            break;
    }

    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    return `<div class="w-full py-4 text-2xl text-center">${modalMessage}</div>
            <div class="w-full py-4 flex gap-4 justify-center">
                <form action="${route}" method="POST">
                    <input type="hidden" name="_token" id="csrf-token" value="${csrf}" />
                    <button 
                        ${
                            operation === "approve"
                                ? "name='status_approve'"
                                : ""
                        }
                        ${operation === "cancel" ? "name='status_cancel'" : ""}
                        value="1" type="submit" class="btn-primary text-lg">
                            Taip
                    </button>
                </form>
                <button class="btn-primary bg-gray-400 hover:bg-gray-500 text-lg" data-close-modal="modal">Atšaukti</button>
            </div>`;
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

        let HTML = '';

        if (offers.length > 0) {
            for (const offer of offers) {
                HTML += `<article class="shadow-md rounded-lg overflow-hidden">
                            <div>
                                <img src="${offer.hotel.image ? offer.hotel.image : '/assets/img/no-image.jpg'}" alt="hotel">
                            </div>
                            <div class="p-4 flex flex-col items-start">
                                <p class="mb-1 text-gray-500 text-lg">${offer.destination.name}, ${offer.country.name}</p>
                                <p class="mb-3 text-sm">${offer.hotel.name}</p>
                                <p class="mb-4">${offer.travel_start} iki ${offer.travel_end}</p>
                                <div class="mb-6 w-full flex justify-between">
                                    <p class="font-semibold">&euro;${offer.price}</p>
                                    ${ratingStars}
                                </div>
                                <a href="/offers/${offer.id}" class="btn-action-link text-md">Sužinokite daugiau</a>
                            </div>
                        </article>`;
            }
        } else {
            HTML += '<h2 class="col-span-3 text-3xl text-center font-semibold">Nėra pasiūlymų</h2>';
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
                                <img src="${offer.hotel.image ? offer.hotel.image : '/assets/img/no-image.jpg'}" alt="hotel">
                            </div>
                            <div class="p-4 flex flex-col items-start">
                                <p class="mb-1 text-gray-500 text-lg">${offer.destination.name}, ${offer.country.name}</p>
                                <p class="mb-3 text-sm">${offer.hotel.name}</p>
                                <p class="mb-4">${offer.travel_start} iki ${offer.travel_end}</p>
                                <div class="mb-6 w-full flex justify-between">
                                    <p class="font-semibold">&euro;${offer.price}</p>
                                    ${ratingStars}
                                </div>
                                <a href="/offers/${offer.id}" class="btn-action-link text-md">Sužinokite daugiau</a>
                            </div>
                        </article>`;
            }
        } else {
            HTML += '<h2 class="col-span-3 text-3xl text-center font-semibold">Nėra pasiūlymų</h2>';
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
                                <img src="${offer.hotel.image ? offer.hotel.image : '/assets/img/no-image.jpg'}" alt="hotel">
                            </div>
                            <div class="p-4 flex flex-col items-start">
                                <p class="mb-1 text-gray-500 text-lg">${offer.destination.name}, ${offer.country.name}</p>
                                <p class="mb-3 text-sm">${offer.hotel.name}</p>
                                <p class="mb-4">${offer.travel_start} iki ${offer.travel_end}</p>
                                <div class="mb-6 w-full flex justify-between">
                                    <p class="font-semibold">&euro;${offer.price}</p>
                                    ${ratingStars}
                                </div>
                                <a href="/offers/${offer.id}" class="btn-action-link text-md">Sužinokite daugiau</a>
                            </div>
                        </article>`;
            }
        } else {
            HTML += '<h2 class="col-span-3 text-3xl text-center font-semibold">Nėra pasiūlymų</h2>';
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
