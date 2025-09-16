jQuery(function ($) {
  // Initialize color pickers
  $("#review_btn_color").wpColorPicker();
  $("#review_btn_txt_color").wpColorPicker();

  // Tab functionality
  $(".sktpr-tab").on("click", function () {
    var tab = $(this).data("tab");
    
    // Update active tab
    $(".sktpr-tab").removeClass("active");
    $(this).addClass("active");
    
    // Show active content
    $(".sktpr-tab-content").removeClass("active");
    $('.sktpr-tab-content[data-tab-content="' + tab + '"]').addClass("active");
  });

  // Live preview for button styling
  $("#review_btn_color, #review_btn_txt_color, #review_btn_text").on("input change", function () {
    var bgColor = $("#review_btn_color").val();
    var textColor = $("#review_btn_txt_color").val();
    var btnText = $("#review_btn_text").val();
    
    $("#sktpr_preview_button").css({
      "background-color": bgColor,
      "color": textColor
    }).find("span").text(btnText);
  });

  // Form submission for general settings
  $("#sktpr_plugin_settings").on("submit", function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    formData.append("_wpnonce", sktpr_plugin.nonce);
    formData.append("action", "get_review_settings");

    fetch(sktpr_plugin.ajax_url, {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        if (data.success) {
          toastr.success(data.data.status);
          $("#sktpr_plugin_submit").siblings(".sktpr_submit_successful").show().fadeOut(3000);
        } else {
          toastr.error(data.data.status);
        }
      })
      .catch((error) => {
        toastr.error("An error occurred while saving settings");
        console.error("Error:", error);
      });
  });

  // Form submission for display settings
  $("#sktpr_plugin_settings_display").on("submit", function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    formData.append("_wpnonce", sktpr_plugin.nonce);
    formData.append("action", "get_review_settings");

    fetch(sktpr_plugin.ajax_url, {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        if (data.success) {
          toastr.success(data.data.status);
          $("#sktpr_plugin_submit_display").siblings(".sktpr_submit_successful").show().fadeOut(3000);
        } else {
          toastr.error(data.data.status);
        }
      })
      .catch((error) => {
        toastr.error("An error occurred while saving settings");
        console.error("Error:", error);
      });
  });

});