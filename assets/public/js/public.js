jQuery(function ($) {
  // Media Uploader

  let sktpr_preview     = document.getElementById("sktpr_preview");
  let sktpr_recording   = document.getElementById("sktpr_recording");
  let sktpr_timer       = document.getElementById("sktpr_timer-text");
  let sktpr_startButton = document.getElementById("sktpr_startButton");
  let sktpr_stopButton  = document.getElementById("sktpr_stopButton");
  let sktpr_addButton   = document.getElementById("sktpr_addButton");

  let sktpr_recording_constraints = {
    audio: { noiseSuppression: false },
    video: {
      width: { min: 480, ideal: 800, max: 1280 },
      height: { min: 320, ideal: 470, max: 720 },
      framerate: 30,
    },
  };

  // Get the modal.
  var modal            = document.getElementById("sktpr_video_modal");
  var sktpr_modal_btn   = document.getElementById("sktpr_modal_btn");
  var sktpr_modal_close = document.getElementsByClassName("sktpr_modal_close")[0];
  var sktpr_no_camera   = document.getElementsByClassName("sktpr_no_camera")[0];
  var sktpr_background  = document.getElementsByClassName("sktpr_background")[0];

  if (sktpr_modal_btn) {
    // When the user clicks on <span> (x), close the modal.
    sktpr_background.onclick = function () {
      sktpr_modal_close.click();
    };
    sktpr_modal_close.onclick = function () {
      modal.style.display = "none";
      sktpr_recording.style.display = "none";
      sktpr_addButton.style.display = "none";
    };
    // When the user clicks anywhere outside of the modal, close it.
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };
    let max_record_time = sktpr_timer.getAttribute("data-maxtime");
    let recordingTimeMS = 1000 * 60 * max_record_time;

    var videoTimerInterval = null;
    function startTimer(duration, sktpr_timer) {
      var timer = duration,
        minutes,
        seconds;
      videoTimerInterval = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        sktpr_timer.innerHTML = minutes + `:` + seconds;
        sktpr_timer.style.display = "inline-block";
        if (--timer < 0) {
          timer = duration;
          clearInterval(videoTimerInterval);
          sktpr_stopButton.click();
        }
      }, 1000);
    }

    sktpr_preview.controls = false;
    sktpr_recording.controls = false;

    var mediaRecorder;
    var chunks = [];
    var localStream = null;
    var containerType = "video/webm"; //defaults to webm but we switch to mp4 on Safari 14.0.2+

    // When the user clicks on the button, open the modal.
    sktpr_modal_btn.onclick = function (e) {
      e.preventDefault();
      modal.style.display = "block";
      sktpr_preview.style.display = "block";
      sktpr_startButton.style.display = "block";

      if (!navigator.mediaDevices.getUserMedia) {
        alert(
          "navigator.mediaDevices.getUserMedia not supported on your browser, use the latest version of Firefox or Chrome"
        );
        sktpr_no_camera.style.display = "flex";
        $(".sktpr_record_video_buttons").css({ display: "none" });
      } else {
        if (window.MediaRecorder == undefined) {
          alert(
            "MediaRecorder not supported on your browser, use the latest version of Firefox or Chrome"
          );
          sktpr_no_camera.style.display = "flex";
          $(".sktpr_record_video_buttons").css({ display: "none" });
        } else {
          navigator.mediaDevices
            .getUserMedia(sktpr_recording_constraints)
            .then(function (stream) {
              localStream = stream;

              sktpr_preview.srcObject = localStream;
              sktpr_preview.play();

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
              sktpr_no_camera.style.display = "flex";
              $(".sktpr_record_video_buttons").css({ display: "none" });
            });
        }
      }
    };

    function onBtnRecordClicked() {
      if (localStream == null) {
        alert("Could not get local stream from mic/camera");
      } else {
        sktpr_startButton.disabled = true;
        sktpr_stopButton.disabled = false;

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
          startTimer(lengthInS, sktpr_timer);
        };

        mediaRecorder.onstop = function () {
            
          var recording = new Blob(chunks, { type: mediaRecorder.mimeType });
          sktpr_addButton.href = URL.createObjectURL(recording);
          // Even if they do, they may only support MediaStream.
          sktpr_recording.src = URL.createObjectURL(recording);
          sktpr_recording.controls = true;

          var rand = Math.floor(Math.random() * 10000000);
          switch (containerType) {
            case "video/mp4":
              var name = "video-testimonial-" + rand + ".mp4";
              break;
            default:
              var name = "video-testimonial-" + rand + ".webm";
          }

          sktpr_addButton.addEventListener("click", (e) => {
            e.preventDefault();
            sktpr_recording.style.display = "none";
            sktpr_addButton.style.display = "none";
            document.getElementById("sktpr_startButton_text").innerText =
              "Start Recording";
            let file = new File([recording], name, {
              type: recording.type,
            });

            let container = new DataTransfer();
            container.items.add(file);
            document.querySelector("#sktpr_client_video_upload").files =
              container.files;

            document.querySelector(".skt-video-wrapper video").src =
              sktpr_addButton.href;
            document.querySelector(
              ".skt-video-wrapper"
            ).style.display = "block";

            sktpr_modal_close.click();
          });

          // sktpr_addButton.innerHTML = 'Download '+name;
          sktpr_addButton.setAttribute("download", name);
          sktpr_addButton.setAttribute("name", name);
        };

        mediaRecorder.start(200);
      }
    }

    sktpr_startButton.addEventListener("click", () => {
      sktpr_no_camera.style.display = "none";
      sktpr_preview.style.display = "block";
      sktpr_recording.style.display = "none";

      sktpr_startButton.style.display = "none";
      sktpr_stopButton.style.display = "inline-block";

      onBtnRecordClicked();
    });

    sktpr_stopButton.addEventListener(
      "click",
      () => {
        sktpr_addButton.style.display = "inline-block";
        sktpr_preview.style.display = "none";
        sktpr_recording.style.display = "block";
        sktpr_timer.style.display = "none";
        sktpr_stopButton.style.display = "none";
        sktpr_startButton.style.display = "block";
        document.getElementById("sktpr_startButton_text").innerText =
          "Record again";
        // stop(sktpr_preview.srcObject);
        clearInterval(videoTimerInterval);
        sktpr_timer.innerText = "";
        onBtnStopClicked();
      },
      false
    );

    function onBtnStopClicked() {
      mediaRecorder.stop();
      sktpr_startButton.disabled = false;
      sktpr_stopButton.disabled = true;
    }
  }
});
