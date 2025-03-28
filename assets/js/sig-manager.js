(function() {
      window.requestAnimFrame = (function(callback) {
          return window.requestAnimationFrame ||
              window.webkitRequestAnimationFrame ||
              window.mozRequestAnimationFrame ||
              window.oRequestAnimationFrame ||
              window.msRequestAnimaitonFrame ||
              function(callback) {
                  window.setTimeout(callback, 1000 / 60);
              };
      })();

      var canvas = document.getElementById("sig-canvas-manager");
      var ctx = canvas.getContext("2d");
      ctx.strokeStyle = "#222222";
      ctx.lineWidth = 3;

      var drawing = false;
      var mousePos = {
          x: 0,
          y: 0
      };
      var lastPos = mousePos;

      canvas.addEventListener("mousedown", function(e) {
          drawing = true;
          lastPos = getMousePos(canvas, e);
      }, false);

      canvas.addEventListener("mouseup", function(e) {
          drawing = false;
      }, false);

      canvas.addEventListener("mousemove", function(e) {
          mousePos = getMousePos(canvas, e);
      }, false);

      // Add touch event support for mobile
      canvas.addEventListener("touchstart", function(e) {

      }, false);

      canvas.addEventListener("touchmove", function(e) {
          var touch = e.touches[0];
          var me = new MouseEvent("mousemove", {
              clientX: touch.clientX,
              clientY: touch.clientY
          });
          canvas.dispatchEvent(me);
      }, false);

      canvas.addEventListener("touchstart", function(e) {
          mousePos = getTouchPos(canvas, e);
          var touch = e.touches[0];
          var me = new MouseEvent("mousedown", {
              clientX: touch.clientX,
              clientY: touch.clientY
          });
          canvas.dispatchEvent(me);
      }, false);

      canvas.addEventListener("touchend", function(e) {
          var me = new MouseEvent("mouseup", {});
          canvas.dispatchEvent(me);
      }, false);

      function getMousePos(canvasDom, mouseEvent) {
          var rect = canvasDom.getBoundingClientRect();
          return {
              x: mouseEvent.clientX - rect.left,
              y: mouseEvent.clientY - rect.top
          }
      }

      function getTouchPos(canvasDom, touchEvent) {
          var rect = canvasDom.getBoundingClientRect();
          return {
              x: touchEvent.touches[0].clientX - rect.left,
              y: touchEvent.touches[0].clientY - rect.top
          }
      }

      function renderCanvas() {
          if (drawing) {
              ctx.moveTo(lastPos.x, lastPos.y);
              ctx.lineTo(mousePos.x, mousePos.y);
              ctx.stroke();
              lastPos = mousePos;
          }
      }

      // Prevent scrolling when touching the canvas
      document.body.addEventListener("touchstart", function(e) {
          if (e.target == canvas) {
              e.preventDefault();
          }
      }, false);
      document.body.addEventListener("touchend", function(e) {
          if (e.target == canvas) {
              e.preventDefault();
          }
      }, false);
      document.body.addEventListener("touchmove", function(e) {
          if (e.target == canvas) {
              e.preventDefault();
          }
      }, false);

      (function drawLoop() {
          requestAnimFrame(drawLoop);
          renderCanvas();
      })();

      function clearCanvas() {
          canvas.width = canvas.width;
      }

      // Set up the UI
      var clearBtnMng = document.getElementById("sig-clearBtn-manager");
      var submitBtnMng = document.getElementById("sig-submitBtn-manager");
      var sigImage = document.getElementById("sig-image");
      var sigTextMng = document.getElementById("sig-dataUrl-manager");
      if (clearBtnMng) {
          clearBtnMng.addEventListener("click", function(e) {
              clearCanvas();
              Swal.fire({
                  title: "Tanda Tangan telah dibersihkan",
                  text: "Silahkan melakukan tanda tangan ulang",
                  timer: 2000,
                  timerProgressBar: true,
                  icon: "warning",
              })
              // sigImage.setAttribute("src", "");
              sigTextMng.value = '';
              document.getElementById("sig-check-manager").style.display = "none";
          }, false);
      }
      if (submitBtnMng) {
          submitBtnMng.addEventListener("click", function(e) {
              var dataUrl = canvas.toDataURL();
              sigTextMng.innerHTML = dataUrl;
              // alert('Berhasil menyimpan tanda tangan!');
              Swal.fire({
                  title: "Tanda Tangan berhasil disimpan",
                  icon: "success",
                  timer: 1500,
                  timerProgressBar: true,
              });
              document.getElementById("sig-check-manager").style.display = "block";
              sigTextMng.value = dataUrl;
              console.log('ttd manager ' + dataUrl);
              // var ttd = dataUrl;
              // sigImage.setAttribute("src", dataUrl);
          }, false);
      }

  })();