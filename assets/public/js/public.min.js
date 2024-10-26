jQuery(function ($) {
  // Media Uploader

  let tpro_preview     = document.getElementById("tpro_preview");
  let tpro_recording   = document.getElementById("tpro_recording");
  let tpro_timer       = document.getElementById("tpro_timer-text");
  let tpro_startButton = document.getElementById("tpro_startButton");
  let tpro_stopButton  = document.getElementById("tpro_stopButton");
  let tpro_addButton   = document.getElementById("tpro_addButton");

  let tpro_recording_constraints = {
    audio: { noiseSuppression: false },
    video: {
      width: { min: 480, ideal: 800, max: 1280 },
      height: { min: 320, ideal: 470, max: 720 },
      framerate: 30,
    },
  };
  // let tpro_dataElement = document.querySelector('#log');

  // Get the modal.
  var modal            = document.getElementById("tpro_video_modal");
  var tpro_modal_btn   = document.getElementById("tpro_modal_btn");
  var tpro_modal_close = document.getElementsByClassName("tpro_modal_close")[0];
  var tpro_no_camera   = document.getElementsByClassName("tpro_no_camera")[0];
  var tpro_background  = document.getElementsByClassName("tpro_background")[0];

  if (tpro_modal_btn) {
    // When the user clicks on <span> (x), close the modal.
    tpro_background.onclick = function () {
      tpro_modal_close.click();
    };
    tpro_modal_close.onclick = function () {
      modal.style.display = "none";
      tpro_recording.style.display = "none";
      tpro_addButton.style.display = "none";
    };
    // When the user clicks anywhere outside of the modal, close it.
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };
    let max_record_time = tpro_timer.getAttribute("data-maxtime");
    let recordingTimeMS = 1000 * 60 * max_record_time;

    var videoTimerInterval = null;
    function startTimer(duration, tpro_timer) {
      var timer = duration,
        minutes,
        seconds;
      videoTimerInterval = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        tpro_timer.innerHTML = minutes + `:` + seconds;
        tpro_timer.style.display = "inline-block";
        if (--timer < 0) {
          timer = duration;
          clearInterval(videoTimerInterval);
          tpro_stopButton.click();
        }
      }, 1000);
    }

    tpro_preview.controls = false;
    tpro_recording.controls = false;

    var mediaRecorder;
    var chunks = [];
    var localStream = null;
    var containerType = "video/webm"; //defaults to webm but we switch to mp4 on Safari 14.0.2+

    // When the user clicks on the button, open the modal.
    tpro_modal_btn.onclick = function (e) {
      e.preventDefault();
      modal.style.display = "block";
      tpro_preview.style.display = "block";
      tpro_startButton.style.display = "block";

      if (!navigator.mediaDevices.getUserMedia) {
        alert(
          "navigator.mediaDevices.getUserMedia not supported on your browser, use the latest version of Firefox or Chrome"
        );
        tpro_no_camera.style.display = "flex";
        $(".tpro_record_video_buttons").css({ display: "none" });
      } else {
        if (window.MediaRecorder == undefined) {
          alert(
            "MediaRecorder not supported on your browser, use the latest version of Firefox or Chrome"
          );
          tpro_no_camera.style.display = "flex";
          $(".tpro_record_video_buttons").css({ display: "none" });
        } else {
          navigator.mediaDevices
            .getUserMedia(tpro_recording_constraints)
            .then(function (stream) {
              localStream = stream;

              tpro_preview.srcObject = localStream;
              tpro_preview.play();

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
              tpro_no_camera.style.display = "flex";
              $(".tpro_record_video_buttons").css({ display: "none" });
            });
        }
      }
    };

    function onBtnRecordClicked() {
      if (localStream == null) {
        alert("Could not get local stream from mic/camera");
      } else {
        tpro_startButton.disabled = true;
        tpro_stopButton.disabled = false;

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
          startTimer(lengthInS, tpro_timer);
        };

        mediaRecorder.onstop = function () {
            
          var recording = new Blob(chunks, { type: mediaRecorder.mimeType });
          tpro_addButton.href = URL.createObjectURL(recording);
          // Even if they do, they may only support MediaStream.
          tpro_recording.src = URL.createObjectURL(recording);
          tpro_recording.controls = true;

          var rand = Math.floor(Math.random() * 10000000);
          switch (containerType) {
            case "video/mp4":
              var name = "video-testimonial-" + rand + ".mp4";
              break;
            default:
              var name = "video-testimonial-" + rand + ".webm";
          }

          tpro_addButton.addEventListener("click", (e) => {
            e.preventDefault();
            tpro_recording.style.display = "none";
            tpro_addButton.style.display = "none";
            document.getElementById("tpro_startButton_text").innerText =
              "Start Recording";
            let file = new File([recording], name, {
              type: recording.type,
            });

            let container = new DataTransfer();
            container.items.add(file);
            document.querySelector("#tpro_client_video_upload").files =
              container.files;

            document.querySelector(".sp-testimonial-video-wrapper video").src =
              tpro_addButton.href;
            document.querySelector(
              ".sp-testimonial-video-wrapper"
            ).style.display = "block";

            tpro_modal_close.click();
          });

          // tpro_addButton.innerHTML = 'Download '+name;
          tpro_addButton.setAttribute("download", name);
          tpro_addButton.setAttribute("name", name);
        };

        mediaRecorder.start(200);
      }
    }

    tpro_startButton.addEventListener("click", () => {
      tpro_no_camera.style.display = "none";
      tpro_preview.style.display = "block";
      tpro_recording.style.display = "none";

      tpro_startButton.style.display = "none";
      tpro_stopButton.style.display = "inline-block";

      onBtnRecordClicked();
    });

    tpro_stopButton.addEventListener(
      "click",
      () => {
        tpro_addButton.style.display = "inline-block";
        tpro_preview.style.display = "none";
        tpro_recording.style.display = "block";
        tpro_timer.style.display = "none";
        tpro_stopButton.style.display = "none";
        tpro_startButton.style.display = "block";
        document.getElementById("tpro_startButton_text").innerText =
          "Record again";
        // stop(tpro_preview.srcObject);
        clearInterval(videoTimerInterval);
        tpro_timer.innerText = "";
        onBtnStopClicked();
      },
      false
    );

    function onBtnStopClicked() {
      mediaRecorder.stop();
      tpro_startButton.disabled = false;
      tpro_stopButton.disabled = true;
    }
  }
});
