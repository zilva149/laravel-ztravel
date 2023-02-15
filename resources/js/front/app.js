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
