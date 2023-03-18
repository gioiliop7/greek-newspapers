document.addEventListener("DOMContentLoaded", function () {
  // Select all elements with class "splide"
  const splideElements = document.querySelectorAll(".splide");

  // Loop through the NodeList and extract the IDs of the elements
  const splideIds = [];
  splideElements.forEach((element) => {
    splideIds.push(element.id);
  });

  // Loop through the NodeList and extract the IDs of the elements
  if (splideIds.length > 0) {
      splideIds.forEach((element) => {
        let splide = new Splide(`#${element}`, {
          type: "loop",
          perPage: 3,
          breakpoints: {
            600: {
              perPage: 1,
            },
            992: {
              perPage: 2,
            },
          },
        });
        splide.mount();
      });
  }
});
