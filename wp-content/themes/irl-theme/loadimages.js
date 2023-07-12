 var loadFile = function (event, id) {
              var image = document.getElementById(id)
              image.src = URL.createObjectURL(event.target.files[0])
              const ids = ['image-alert', id]
              document.getElementById('upload-msg').style.display = 'none'
              ids.map((a) => {
                document.getElementById(a).style.display = 'block'
              })
            }

            var loadFiles = function (event,id,msg,alert,count) {
              var image = document.getElementById(id)
              image.src = URL.createObjectURL(event.target.files[0])
              const ids = [alert, id]
              if(msg){
                document.getElementById(msg).style.display = 'none'
              } 
            }