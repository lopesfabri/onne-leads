//Script to change the background images of the header. 

document.addEventListener("DOMContentLoaded", function () {
    //Get all images inside the carousel.
    const images = document.querySelectorAll("#image-carousel figure");

    let currentIndex = 0;

    //Function to toggle images.
    function changeImage() {
        images[currentIndex].classList.remove("active");

        //Update the index or go back to the beginning if at the end.
        currentIndex = (currentIndex + 1) % images.length;

        images[currentIndex].classList.add("active");
    }

    //Start the animation every 3 seconds. 
    setInterval(changeImage, 3000);
});
