document.addEventListener("DOMContentLoaded", function () {
    const slider = document.getElementById("mySlider");
    const navButtons = document.querySelectorAll(".nav-button");
    let currentSet = 0;
    let isTransitioning = false;
    const slidesPerSet = 4;
    const totalSlides = 12;

    function showSlides(setIndex) {
        const startIndex = setIndex * slidesPerSet;
        const offset = -startIndex * 100 + "%";
        slider.style.transition = "transform 0.5s ease-in-out";
        slider.style.transform = "translateY(" + offset + ")";
    }

    function transitionEndHandler() {
        isTransitioning = false;
        slider.style.transition = ""; // Reset transition property
    }

    slider.addEventListener("transitionend", transitionEndHandler);

    function nextSet() {
        if (!isTransitioning && currentSet < totalSlides / slidesPerSet - 1) {
            isTransitioning = true;
            currentSet++;
            showSlides(currentSet);
        }
    }

    function prevSet() {
        if (!isTransitioning && currentSet > 0) {
            isTransitioning = true;
            currentSet--;
            showSlides(currentSet);
        }
    }

    function handleButtonClick(index) {
        // You can customize this function if needed
        console.log("Button clicked:", index);
    }

    navButtons[0].addEventListener("click", prevSet);
    navButtons[1].addEventListener("click", nextSet);
});
