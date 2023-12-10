  const linkArray = [
      'https://youtube.com/playlist?list=PLGuGa8SJRe0159zO5dSkFDGCaiRHaMEtq&si=Y4XiEJJvEv9SeCeK',
      'https://youtu.be/G3qQT9St7L4?si=oNnNujtjsXQgyVjf',
      'https://m.soundcloud.com/binaural_sub/binaural-sub-behold-master-wav',
      'https://podcastindex.org/podcast/6660977',
      'https://www.audiotool.com/track/w024o3e20q9/',
      'https://opensea.io/TreVvV-Unnamed',// rss album demo links 
      'https://binauralsubliminal.com/album_02/player/index.html',
      'https://binauralsubliminal.com/album_msp/index.html',
      'https://binauralsubliminal.com/album_01/player/index.html',
      'https://binauralsubliminal.com/album_00/player/index.html',
      'https://binauralsubliminal.com/mixes/index.html'
    ];

  function getLink(index) {

    console.log(`getlink ${index}`);

    switch (index) {

      case 0:
        window.location.href = linkArray[0];
        break;
      case 1:
        window.location.href = linkArray[1];
        break;
      case 2:
        window.location.href = linkArray[2];
        break;
      case 3:
        window.location.href = linkArray[3];
        break;
      case 4:
        window.location.href = linkArray[4];
        break;
      case 5:
        window.location.href = linkArray[5];
        break;
      case 6:
        window.location.href = linkArray[6];
        break;
      case 7:
        window.location.href = linkArray[7];
        break;
      case 8:
        window.location.href = linkArray[8];
        break;
      case 9:
        window.location.href = linkArray[9];
        break;
      case 10:
        window.location.href = linkArray[10];
        break;
    }
  }

  function openLinkBasedOnIndex(index) {
    const overlay = document.getElementById('overlay');
    overlay.style.right = '0'; // Slide into view

    // Simulate loading content in the overlay
    const overlayContent = document.querySelector('.overlay-content');
    overlayContent.innerHTML = `
        <p>This is the content for Link ${index}</p>
        <button onclick="closeOverlay()">Close</button>
    `;
  }

  function closeOverlay() {
    const overlay = document.getElementById('overlay');
    overlay.style.right = '-100%'; // Slide out of view

    const iframe = document.getElementById('iframe');
    iframe.src = '';
  }

  function openLinkAdress(href) {

    window.location.href = href;
  }

  const resizableImages = document.querySelectorAll('.resizableImage');

  resizableImages.forEach(image => {
    image.addEventListener('click', () => {
      image.classList.toggle('enlarged');
    });
  });

  document.addEventListener('click', (event) => {
    resizableImages.forEach(image => {
      if (!image.contains(event.target) && image.classList.contains('enlarged')) {
        image.classList.remove('enlarged');
      }
    });
  });