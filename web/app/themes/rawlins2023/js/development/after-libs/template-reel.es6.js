let timeOut;
window.addEventListener('DOMContentLoaded', function(){
  if (document.body.classList.contains('page-template-template-reel')) {
    const reelControls = document.querySelector('.reel__controls');
    const video = document.querySelector('.reel iframe');
    const player = new Vimeo.Player(video);

    const reelPlay = document.querySelector('.reel__play');
    const reelPause = document.querySelector('.reel__pause');
    window.addEventListener('mousemove', function(){
      reelControls.style.opacity = 1;
      clearTimeout(timeOut);
      timeOut = setTimeout(function(){
        reelControls.style.opacity = 0;
      }, 1000)
    })

    document.body.addEventListener('click', function(e){
        if(e.target.classList.contains('c-button')) {
          return;
        }
        document.querySelectorAll('.reel__controls > *').forEach(function(e){
          e.classList.remove('active');
        })
        player.getPaused().then(function(paused){
          if(paused){
            player.play();
            setTimeout(function(){
              reelControls.classList.remove('paused')
              reelPause.classList.add('active');
            }, 100)
            
          } else {
            player.pause();
            setTimeout(function(){
              reelControls.classList.add('paused')
              reelPlay.classList.add('active');
            }, 100)
          }
        });
    })

    const volumeButton = document.querySelector('.reel__volume .c-button');
    const volumnButtonInner = document.querySelector('.reel__volume .c-button span');
    volumeButton.addEventListener('click', function(e){
      player.getMuted().then(function(muted) {
        if (muted) {
          player.setMuted(false)
          volumnButtonInner.innerHTML = 'Sound Off';
        } else {
          player.setMuted(true)
          volumnButtonInner.innerHTML = 'Sound On';
        }
      })
    })
  }
})