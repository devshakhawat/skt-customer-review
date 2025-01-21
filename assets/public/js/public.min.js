jQuery(function ($) {
  // Media Uploader

  let skt_preview     = document.getElementById("skt_preview");
  let skt_recording   = document.getElementById("skt_recording");
  let skt_timer       = document.getElementById("skt_timer-text");
  let skt_startButton = document.getElementById("skt_startButton");
  let skt_stopButton  = document.getElementById("skt_stopButton");
  let skt_addButton   = document.getElementById("skt_addButton");

  let skt_recording_constraints = {
    audio: { noiseSuppression: false },
    video: {
      width: { min: 480, ideal: 800, max: 1280 },
      height: { min: 320, ideal: 470, max: 720 },
      framerate: 30,
    },
  };

  // Get the modal.
  var modal            = document.getElementById("skt_video_modal");
  var skt_modal_btn   = document.getElementById("skt_modal_btn");
  var skt_modal_close = document.getElementsByClassName("skt_modal_close")[0];
  var skt_no_camera   = document.getElementsByClassName("skt_no_camera")[0];
  var skt_background  = document.getElementsByClassName("skt_background")[0];

  if (skt_modal_btn) {
    // When the user clicks on <span> (x), close the modal.
    skt_background.onclick = function () {
      skt_modal_close.click();
    };
    skt_modal_close.onclick = function () {
      modal.style.display = "none";
      skt_recording.style.display = "none";
      skt_addButton.style.display = "none";
    };
    // When the user clicks anywhere outside of the modal, close it.
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };
    let max_record_time = skt_timer.getAttribute("data-maxtime");
    let recordingTimeMS = 1000 * 60 * max_record_time;

    var videoTimerInterval = null;
    function startTimer(duration, skt_timer) {
      var timer = duration,
        minutes,
        seconds;
      videoTimerInterval = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        skt_timer.innerHTML = minutes + `:` + seconds;
        skt_timer.style.display = "inline-block";
        if (--timer < 0) {
          timer = duration;
          clearInterval(videoTimerInterval);
          skt_stopButton.click();
        }
      }, 1000);
    }

    skt_preview.controls = false;
    skt_recording.controls = false;

    var mediaRecorder;
    var chunks = [];
    var localStream = null;
    var containerType = "video/webm"; //defaults to webm but we switch to mp4 on Safari 14.0.2+

    // When the user clicks on the button, open the modal.
    skt_modal_btn.onclick = function (e) {
      e.preventDefault();
      modal.style.display = "block";
      skt_preview.style.display = "block";
      skt_startButton.style.display = "block";

      if (!navigator.mediaDevices.getUserMedia) {
        alert(
          "navigator.mediaDevices.getUserMedia not supported on your browser, use the latest version of Firefox or Chrome"
        );
        skt_no_camera.style.display = "flex";
        $(".skt_record_video_buttons").css({ display: "none" });
      } else {
        if (window.MediaRecorder == undefined) {
          alert(
            "MediaRecorder not supported on your browser, use the latest version of Firefox or Chrome"
          );
          skt_no_camera.style.display = "flex";
          $(".skt_record_video_buttons").css({ display: "none" });
        } else {
          navigator.mediaDevices
            .getUserMedia(skt_recording_constraints)
            .then(function (stream) {
              localStream = stream;

              skt_preview.srcObject = localStream;
              skt_preview.play();

              try {
                window.AudioContext =
                  window.AudioContext || window.webkitAudioContext;
                window.audioContext = new AudioContext();
              } catch (e) {
                console.log("Web Audio API not supported.");
              }
            })
            .catch(function (err) {
              // Handle the error.
              skt_no_camera.style.display = "flex";
              $(".skt_record_video_buttons").css({ display: "none" });
            });
        }
      }
    };

    function onBtnRecordClicked() {
      if (localStream == null) {
        alert("Could not get local stream from mic/camera");
      } else {
        skt_startButton.disabled = true;
        skt_stopButton.disabled = false;

        chunks = [];

        /* use the stream */
        if (typeof MediaRecorder.isTypeSupported == "function") {

          if (MediaRecorder.isTypeSupported("video/webm")) {
            var options = { mimeType: "video/webm" };
          } else if (MediaRecorder.isTypeSupported("video/mp4")) {
            // Safari 14.0.2 has an EXPERIMENTAL version of MediaRecorder enabled by default
            containerType = "video/mp4";
            var options = {
              mimeType: "video/mp4",
              videoBitsPerSecond: 2500000,
            };
          }

          mediaRecorder = new MediaRecorder(localStream, options);
        } else {
          mediaRecorder = new MediaRecorder(localStream);
        }

        mediaRecorder.ondataavailable = function (e) {
          if (e.data && e.data.size > 0) {
            chunks.push(e.data);
          }
        };

        mediaRecorder.onstart = function () {
          var lengthInS = recordingTimeMS / 1000;
          startTimer(lengthInS, skt_timer);
        };

        mediaRecorder.onstop = function () {
            
          var recording = new Blob(chunks, { type: mediaRecorder.mimeType });
          skt_addButton.href = URL.createObjectURL(recording);
          // Even if they do, they may only support MediaStream.
          skt_recording.src = URL.createObjectURL(recording);
          skt_recording.controls = true;

          var rand = Math.floor(Math.random() * 10000000);
          switch (containerType) {
            case "video/mp4":
              var name = "video-testimonial-" + rand + ".mp4";
              break;
            default:
              var name = "video-testimonial-" + rand + ".webm";
          }

          skt_addButton.addEventListener("click", (e) => {
            e.preventDefault();
            skt_recording.style.display = "none";
            skt_addButton.style.display = "none";
            document.getElementById("skt_startButton_text").innerText =
              "Start Recording";
            let file = new File([recording], name, {
              type: recording.type,
            });

            let container = new DataTransfer();
            container.items.add(file);
            document.querySelector("#skt_client_video_upload").files =
              container.files;

            document.querySelector(".skt-video-wrapper video").src =
              skt_addButton.href;
            document.querySelector(
              ".skt-video-wrapper"
            ).style.display = "block";

            skt_modal_close.click();
          });

          // skt_addButton.innerHTML = 'Download '+name;
          skt_addButton.setAttribute("download", name);
          skt_addButton.setAttribute("name", name);
        };

        mediaRecorder.start(200);
      }
    }

    skt_startButton.addEventListener("click", () => {
      skt_no_camera.style.display = "none";
      skt_preview.style.display = "block";
      skt_recording.style.display = "none";

      skt_startButton.style.display = "none";
      skt_stopButton.style.display = "inline-block";

      onBtnRecordClicked();
    });

    skt_stopButton.addEventListener(
      "click",
      () => {
        skt_addButton.style.display = "inline-block";
        skt_preview.style.display = "none";
        skt_recording.style.display = "block";
        skt_timer.style.display = "none";
        skt_stopButton.style.display = "none";
        skt_startButton.style.display = "block";
        document.getElementById("skt_startButton_text").innerText =
          "Record again";
        // stop(skt_preview.srcObject);
        clearInterval(videoTimerInterval);
        skt_timer.innerText = "";
        onBtnStopClicked();
      },
      false
    );

    function onBtnStopClicked() {
      mediaRecorder.stop();
      skt_startButton.disabled = false;
      skt_stopButton.disabled = true;
    }
  }

  
  // document.addEventListener('DOMContentLoaded', function() {
    
  //   var reviewForm = document.getElementById('commentform');
  //   if (reviewForm) {
  //     reviewForm.setAttribute('enctype', 'multipart/form-data');
  //   }
  // });

  
    
    let reviewForm = $('#commentform');
    if (reviewForm.length) {
      reviewForm.attr('enctype', 'multipart/form-data');
    }
  

});
