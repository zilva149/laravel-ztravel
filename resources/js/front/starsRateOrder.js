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
