jQuery(function ($) {
  $("#review_btn_color").wpColorPicker();

  $("#skt_plugin_settings").on("submit", function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    formData.append("_wpnonce", skt_plugin.nonce);
    formData.append("action", "get_review_settings");

    fetch(skt_plugin.ajax_url, {
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

  // Disabled Buttons
  // $('tr.disabled').hover(
  //   function() {
  //       $(this).css('background-color', '#4287f5');
  //   },
  //   function() {
  //       $(this).css('background-color', '');
  //   }
  // );


});
