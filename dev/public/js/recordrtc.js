jQuery(function ($) {
  let mediaRecorder;
  let recordedChunks = [];

  $("#start-recording").on("click", function (e) {
    e.preventDefault();
    navigator.mediaDevices
      .getUserMedia({ video: true, audio: true })
      .then(function (stream) {
        $("#gstm_recording_preview").prop("srcObject", stream);
        mediaRecorder = new MediaRecorder(stream);
        mediaRecorder.start();

        mediaRecorder.ondataavailable = function (event) {
          if (event.data.size > 0) {
            recordedChunks.push(event.data);
          }
        };

        $("#start-recording").hide();
        $("#stop-recording").show();
      });

      $('.open-popup-link').magnificPopup({
        type:'inline',
        midClick: true
      });
  });

  $("#stop-recording").on("click", function (e) {
    e.preventDefault();

    mediaRecorder.stop();
    mediaRecorder.onstop = function () {
      const videoBlob = new Blob(recordedChunks, { type: "video/mp4" });
      const videoURL = URL.createObjectURL(videoBlob);
      $("#gstm_recording_preview").prop("srcObject", null);
      $("#gstm_recording_preview").prop("src", videoURL);
      $("#upload-video").show();

      // console.log(videoURL);
      

      $("#upload-video").on("click", function () {
        const formData = new FormData();
        formData.append("action", "upload_video");
        formData.append("_wpnonce", gstm_video_recorder.nonce);
        formData.append("video", videoBlob, "testimonial_video.mp4");

        $.ajax({
          url: gstm_video_recorder.ajax_url,
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {      
                  
            alert(response.data.message);
            $('.video_preview').attr('src', videoURL);
            $('.video_preview').show();
            $('.video_url').attr('value', response.data.url);
            $('.mfp-close').trigger('click');            
          },
          error: function () {
            alert("Failed to upload video.");
          },
        });
      });

      $("#stop-recording").css("display", "none");
    };
  });
});
