export function starsOffer(offer) {
    const offerID = offer.id;
    const avgRating = offer.avg_rating.toFixed(1);
    const countRating = offer.count_rating;

    return `<a href="/offers/${offerID}#opinions" class="flex gap-2 items-center cursor-pointer" title="žiūrėti atsiliepimus">
        <p class="font-bold text-yellow-600">${avgRating}</p>
        <div class="flex gap-0 pointer-events-none">
            <input type="radio" name="1" id="rate-1" class="hidden">
            <label for="rate-1" class="fas fa-star text-yellow-500 ${
                Math.round(avgRating) >= 1 ? "opacity-100" : "opacity-40"
            } pointer-events-none"></label>
            <input type="radio" name="2" id="rate-2" class="hidden">
            <label for="rate-2" class="fas fa-star text-yellow-500 ${
                Math.round(avgRating) >= 2 ? "opacity-100" : "opacity-40"
            } pointer-events-none"></label>
            <input type="radio" name="3" id="rate-3" class="hidden">
            <label for="rate-3" class="fas fa-star text-yellow-500 ${
                Math.round(avgRating) >= 3 ? "opacity-100" : "opacity-40"
            } pointer-events-none"></label>
            <input type="radio" name="4" id="rate-4" class="hidden">
            <label for="rate-4" class="fas fa-star text-yellow-500 ${
                Math.round(avgRating) >= 4 ? "opacity-100" : "opacity-40"
            } pointer-events-none"></label>
            <input type="radio" name="5" id="rate-5" class="hidden">
            <label for="rate-5" class="fas fa-star text-yellow-500 ${
                Math.round(avgRating) == 5 ? "opacity-100" : "opacity-40"
            } pointer-events-none"></label>
        </div>
        <p>(${countRating})</p>
    </a>`;
}

export function starsRateOrder(review = null) {
    return `<div class="flex flex-row-reverse gap-0">
        <input type="radio" name="rating" value="5" id="rate-5" class="star">
        <label for="rate-5" class="fas fa-star star-label" style="${
            review && review.rating == 5 ? "color:#facc15" : ""
        }"></label>
        <input type="radio" name="rating" value="4" id="rate-4" class="star">
        <label for="rate-4" class="fas fa-star star-label" style="${
            review && review.rating >= 4 ? "color:#facc15" : ""
        }"></label>
        <input type="radio" name="rating" value="3" id="rate-3" class="star">
        <label for="rate-3" class="fas fa-star star-label" style="${
            review && review.rating >= 3 ? "color:#facc15" : ""
        }"></label>
        <input type="radio" name="rating" value="2" id="rate-2" class="star">
        <label for="rate-2" class="fas fa-star star-label" style="${
            review && review.rating >= 2 ? "color:#facc15" : ""
        }"></label>
        <input type="radio" name="rating" value="1" id="rate-1" class="star">
        <label for="rate-1" class="fas fa-star star-label" style="${
            review && review.rating >= 1 ? "color:#facc15" : ""
        }"></label>
    </div>`;
}
