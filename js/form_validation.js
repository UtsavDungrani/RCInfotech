// Phone number validation
document
  .querySelector('input[name="frm_contact"]')
  .addEventListener("input", function (e) {
    // Remove any non-numeric characters
    this.value = this.value.replace(/[^0-9]/g, "");

    // Ensure first digit is 6-9
    if (this.value.length > 0) {
      const firstDigit = parseInt(this.value[0]);
      if (firstDigit < 6) {
        this.value = "";
      }
    }
  });

// Prevent paste of non-numeric characters
document
  .querySelector('input[name="frm_contact"]')
  .addEventListener("paste", function (e) {
    e.preventDefault();
    const pastedText = (e.clipboardData || window.clipboardData).getData(
      "text"
    );
    if (/^[6-9][0-9]*$/.test(pastedText)) {
      this.value = pastedText.slice(0, 10);
    }
  });
