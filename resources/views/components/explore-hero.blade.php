{{-- video-player.blade.php --}}
<style>
    .video-container {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .video-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1;
        cursor: pointer;
    }

    .play-button {
        position: absolute;
        transform: translate(-50%, -50%);
        width: 130px;
        height: 130px;
        background-color: #FFFFFFCC;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: opacity 0.5s ease;
        box-shadow: 0px 4px 30px 10px #00000026;
    }

    .play-button-inner {
        width: 76px;
        height: 76px;
        background-color: #FFFFFFE5;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0px 4px 30px -10px #00000026;
    }

    .play-button-inner svg {
        width: 23.57px;
        height: 31.12px;
        fill: #084B974F;
        margin-left: 5px;
    }

    .control-button {
        opacity: 0;
        pointer-events: none;
    }

    .video-container:hover .control-button {
        opacity: 1;
        pointer-events: all;
    }

    .video-overlay {
        position: absolute;
        inset: 0;
        background-color: rgba(28, 28, 28, 0.2);
        z-index: 2;
    }

    /* Adaptation pour les écrans plus petits */
    @media (max-width: 768px) {
        .play-button {
            width: 80px;
            height: 80px;
        }

        .play-button-inner {
            width: 50px;
            height: 50px;
        }

        .play-button-inner svg {
            width: 15px;
            height: 20px;
        }
    }
    
    @media (max-width: 480px) {
        .play-button {
            width: 60px;
            height: 60px;
        }

        .play-button-inner {
            width: 40px;
            height: 40px;
        }

        .play-button-inner svg {
            width: 12px;
            height: 16px;
        }
    }
</style>

<div class="relative w-full max-w-[1512px] aspect-video mx-auto">
    <div class="video-container" id="videoContainer">
        <video id="mainVideo" class="video-bg" src="{{ $videoUrl }}" playsinline @if($autoplay) autoplay @endif @if($muted) muted @endif @if($loop) loop @endif></video>
        <div class="video-overlay"></div>
        <div class="play-button control-button" id="playButton">
            <div class="play-button-inner">
                <svg viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z" />
                </svg>
            </div>
        </div>
        <div class="play-button control-button" id="pauseButton" style="display: none;">
            <div class="play-button-inner">
                <svg viewBox="0 0 24 24">
                    <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
                </svg>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const videoContainer = document.getElementById('videoContainer');
        const video = document.getElementById('mainVideo');
        const playButton = document.getElementById('playButton');
        const pauseButton = document.getElementById('pauseButton');
        let isPlaying = {!! $autoplay ? 'true' : 'false' !!};
        let controlsTimeout;

        function updateControlsVisibility(forceShow = false) {
            if (isPlaying) {
                playButton.style.display = 'none';
                pauseButton.style.display = 'flex';
                if (!forceShow) {
                    clearTimeout(controlsTimeout);
                    controlsTimeout = setTimeout(() => {
                        pauseButton.classList.add('control-button');
                    }, 1500);
                } else {
                    pauseButton.classList.remove('control-button');
                }
            } else {
                playButton.style.display = 'flex';
                pauseButton.style.display = 'none';
                playButton.classList.remove('control-button');
            }
        }

        updateControlsVisibility();

        function playVideo() {
            if (video.paused) {
                video.muted = {!! $muted ? 'true' : 'false' !!};
                video.play();
                isPlaying = true;
                updateControlsVisibility();
            }
        }

        function pauseVideo() {
            if (!video.paused) {
                video.pause();
                isPlaying = false;
                updateControlsVisibility();
            }
        }

        function togglePlayPause() {
            if (isPlaying) {
                pauseVideo();
            } else {
                playVideo();
            }
        }

        video.addEventListener('ended', () => {
            if (!video.loop) {
                isPlaying = false;
                updateControlsVisibility();
            }
        });

        playButton.addEventListener('click', (e) => {
            e.stopPropagation();
            playVideo();
        });

        pauseButton.addEventListener('click', (e) => {
            e.stopPropagation();
            pauseVideo();
        });

        video.addEventListener('click', (e) => {
            e.stopPropagation();
            togglePlayPause();
        });

        videoContainer.addEventListener('mouseenter', () => {
            clearTimeout(controlsTimeout);
            updateControlsVisibility(true);
        });

        videoContainer.addEventListener('mouseleave', () => {
            if (isPlaying) {
                clearTimeout(controlsTimeout);
                controlsTimeout = setTimeout(() => {
                    pauseButton.classList.add('control-button');
                }, 500);
            }
        });

        if ({!! $autoplay ? 'true' : 'false' !!}) {
            isPlaying = true;
            updateControlsVisibility();
        }

        // Mise à jour des positions des boutons au centre du conteneur
        function updatePlayButtonPositions(){
            const containerWidth = videoContainer.offsetWidth;
            const containerHeight = videoContainer.offsetHeight;
            
            playButton.style.left = `${containerWidth / 2}px`;
            playButton.style.top = `${containerHeight / 2}px`;
            pauseButton.style.left = `${containerWidth / 2}px`;
            pauseButton.style.top = `${containerHeight / 2}px`;
        }

        updatePlayButtonPositions();
        window.addEventListener('resize', updatePlayButtonPositions);
    });
</script>
