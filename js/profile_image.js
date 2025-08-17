document.addEventListener("DOMContentLoaded", function () {
  // Photo upload preview
  const photoInput = document.getElementById("photo");
  if (photoInput) {
    photoInput.addEventListener("change", function (e) {
      const file = e.target.files[0];
      const reader = new FileReader();
      const imagePreview = document.getElementById("imagePreview");

      if (file) {
        if (!file.type.match("image.*")) {
          alert("Please select an image file");
          this.value = "";
          return;
        }

        if (file.size > 5 * 1024 * 1024) {
          alert("File size must be less than 5MB");
          this.value = "";
          return;
        }

        reader.onload = function (e) {
          imagePreview.src = e.target.result;
          imagePreview.style.display = "block";
        };

        reader.readAsDataURL(file);
      }
    });
  }

  // Updated Image Modal functionality
  const imageModal = document.getElementById("imageModal");
  const modalImage = document.getElementById("modalImage");
  const closeBtn = document.getElementById("closeModalBtn");

  window.openModal = function (src) {
    if (imageModal && modalImage) {
      imageModal.style.display = "flex";
      modalImage.src = src;
      document.body.style.overflow = "hidden";
    }
  };

  function closeModal() {
    if (imageModal) {
      imageModal.style.display = "none";
      document.body.style.overflow = "auto";
    }
  }

  if (closeBtn) {
    closeBtn.addEventListener("click", closeModal);
  }

  if (imageModal) {
    imageModal.addEventListener("click", function (e) {
      if (e.target === imageModal) {
        closeModal();
      }
    });
  }

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      closeModal();
    }
  });
});
