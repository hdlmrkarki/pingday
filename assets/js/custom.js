'use strict';

AOS.init({
    easing: 'ease-out-back',
    // mirror: 'true'
    once: 'true'
});

document.addEventListener('DOMContentLoaded', function () {
    // document.querySelectorAll('#menu-right').forEach(function(subMenu) {
    document.querySelectorAll('#menu-right li:last-child a').forEach(function (lastLi) {
        if (lastLi) {
            lastLi.classList.add('theme-btn');
            lastLi.classList.add('has-no-round-icon');
        }
    });

    //});
});

document.querySelectorAll('.media-block').forEach(block => {
    const video = block.querySelector('.video-player');
    const button = block.querySelector('.play-pause-btn');
    const icon = block.querySelector('.play-pause-icon');
    // const iconPlay = 
    const iconPlay = icon.getAttribute('data-play');
    const iconPause = icon.getAttribute('data-pause');

    button.addEventListener('click', () => {
        if (video.paused) {
            video.play();
            // icon.src = iconPause;
            icon.classList.remove('fa-play');
            icon.classList.add('fa-pause');
        } else {
            video.pause();
            // icon.src = iconPlay;
            icon.classList.add('fa-play');
            icon.classList.remove('fa-pause');
        }
    });
});