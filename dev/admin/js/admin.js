jQuery(function ($) {
  $("#review_btn_color").wpColorPicker();

  $("#skt_plugin_settings").on("submit", function (e) {
    e.preventDefault();

    // var formData = $(this).serialize();
    let formData = new FormData(this);
    formData.append("_wpnonce", skt_plugin.nonce);
    formData.append("action", "get_review_settings");

    fetch(skt_plugin.ajax_url, {
      method: 'POST',
      body: formData,
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json(); // Parse JSON response
    })
    .then(data => {
      console.log(data); // Handle success response
    })
    .catch(error => {
      console.error('Error:', error); // Handle error response
    });

    // $.ajax({
    //   url: skt_plugin.ajax_url,
    //   type: "POST",
    //   data: {
    //     action: "get_review_settings",
    //     _wpnonce: skt_plugin.nonce,
    //     settings: formData,
    //   },
    //   success: function (response) {
    //     var data = JSON.parse(response);
    //     $("#review_btn_color").val(data.review_btn_color);
    //     $("#review_btn_text").val(data.review_btn_text);
    //   },
    //   error: function (error) {
    //     console.log(error);
    //   },
    // });
  });
});
