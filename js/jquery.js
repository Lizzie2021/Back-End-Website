$(".btn-hide").on("click", function () {
  $(".btn-filter").css("display", "block");
  $(".btn-hide").css("display", "none");
  $(".filter-title").css("display", "none");
  $(".filter-list-wrapper").css("display", "none");
  $(".product-list-wrapper").addClass("w-100");
});
$(".btn-filter").on("click", function () {
  $(".btn-filter").css("display", "none");
  $(".btn-hide").css("display", "inline-block");
  $(".filter-title").css("display", "inline-block");
  $(".filter-list-wrapper").css("display", "block");
  $(".product-list-wrapper").removeClass("w-100");
});
