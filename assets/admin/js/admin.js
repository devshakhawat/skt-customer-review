jQuery(function ($) {
  $("#review_btn_color").wpColorPicker();
  $("#review_btn_txt_color").wpColorPicker();

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
        data.success ? toastr.success(data.data.status) : toastr.error(data.data.status);        
      })
  });

});
