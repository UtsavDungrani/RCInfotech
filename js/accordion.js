$(document).ready(function () {
  // Initialize the accordion with the first panel expanded
  $("#collapseOne").collapse("show");

  // Ensure only one panel is open at a time
  $("#accordion").on("show.bs.collapse", function (e) {
    $("#accordion .panel-collapse").not(e.target).collapse("hide");
  });

  // ---------- Fix the arrow icon alignment on page load ----------
  $("#accordion .panel-heading a").each(function () {
    var $this = $(this);
    var target = $($this.attr("href"));

    if (target.hasClass("in")) {
      $this.removeClass("collapsed");
    } else {
      $this.addClass("collapsed");
    }
  });

  // Update arrow icon on collapse toggle
  $("#accordion .panel-collapse").on("shown.bs.collapse", function () {
    $(this).prev(".panel-heading").find("a").removeClass("collapsed");
  });

  $("#accordion .panel-collapse").on("hidden.bs.collapse", function () {
    $(this).prev(".panel-heading").find("a").addClass("collapsed");
  });
});
