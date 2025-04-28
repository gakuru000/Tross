document.addEventListener("DOMContentLoaded", function () {
  // Mobile Menu Toggle
  const menuToggle = document.querySelector(".menu-toggle");
  const navLinks = document.querySelector("nav ul.nav-links");

  menuToggle.addEventListener("click", function () {
    navLinks.classList.toggle("active");
  });

  // Simple Testimonial Slider (if the slider exists)
  const testimonialSlider = document.querySelector(".testimonial-slider");
  if (testimonialSlider) {
    const testimonials = document.querySelectorAll(".testimonial-item");
    let currentIndex = 0;

    function showTestimonial(index) {
      testimonialSlider.style.transform = "translateX(" + -index * 100 + "%)";
    }

    setInterval(() => {
      currentIndex = (currentIndex + 1) % testimonials.length;
      showTestimonial(currentIndex);
    }, 5000); // change testimonial every 5 seconds
  }

  // Booking Form Handling
  const bookingForm = document.getElementById("bookingForm");
  if (bookingForm) {
    bookingForm.addEventListener("submit", function (e) {
      e.preventDefault();

      // Retrieve form values
      const name = document.getElementById("name").value.trim();
      const email = document.getElementById("email").value.trim();
      const date = document.getElementById("date").value;
      const service = document.getElementById("service").value;
      const message = document.getElementById("message").value.trim();

      // Simple validation
      if (name === "" || email === "" || date === "" || service === "") {
        alert("Please fill in all required fields.");
        return;
      }

      // In a real application, you might send the data via AJAX here.
      const bookingMessage = document.getElementById("bookingMessage");
      bookingMessage.style.color = "green";
      bookingMessage.textContent =
        "Thank you, " +
        name +
        "! Your booking request has been submitted. We will contact you soon.";

      // Reset form after submission
      bookingForm.reset();
    });
  }

  // (Optional) Additional JS for other forms such as a contact form can follow similar logic
});
