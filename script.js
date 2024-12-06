document.querySelectorAll(".discover-button").forEach((button) => {
  button.addEventListener("click", function () {
    this.classList.add("moving");
    setTimeout(function () {
      window.location.href = "boat-brands.html";
    }, 1000);
  });
});
