jQuery(document).ready(function ($) {
  $(".wca_accordian").each(function () {
    const $container = $(this);
    const $items = $container.find(".wca_accordian_item");

    // Make the first item active on load
    $items.first().addClass("active");

    $items.each(function () {
      const $item = $(this);
      const $title = $item.find(".wpd-accordion-title");
      const $content = $item.find(".wpd-accordion-description");
      const $img = $item.find(".wpd-accordion-img");

      // Set initial active item's content and image
      if ($item.hasClass("active")) {
        $content.css("maxHeight", $content[0].scrollHeight + "px");
        $img.show();
      } else {
        $img.hide();
      }

      $title.on("click", function () {
        const isActive = $item.hasClass("active");
        const activeCount = $container.find(".wca_accordian_item.active").length;

        if (isActive && activeCount === 1) {
          return;
        }

        $items.each(function () {
          const $el = $(this);
          const $elContent = $el.find(".wpd-accordion-description");
          const $elImg = $el.find(".wpd-accordion-img");
          $el.removeClass("active");
          $elContent.css("maxHeight", 0);
          $elImg.hide();
        });

        $item.addClass("active");
        $content.css("maxHeight", $content[0].scrollHeight + "px");
        $img.show();
      });
    });
  });
});
