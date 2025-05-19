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

<div class="relative w-full max-w-[1512px] aspect-video mx-auto overflow-hidden rounded-xl sm:rounded-2xl lg:rounded-3xl shadow-2xl group">
    <div class="absolute inset-0 bg-black/20 backdrop-blur-[2px] z-[5] transition-opacity duration-700 opacity-100 group-hover:opacity-60"></div>
    
    {{-- Video Container --}}
    <div class="relative w-full h-full overflow-hidden" id="videoContainer">
        {{-- Poster Image (shown before video loads) --}}
        <div class="absolute inset-0 bg-center bg-cover bg-no-repeat z-[2]" 
             style="background-image: url('{{ asset('images/video-poster.jpg') }}');"
             id="videoPoster">
        </div>
        
        {{-- Main Video --}}
        <video 
            id="mainVideo" 
            class="absolute inset-0 w-full h-full object-cover z-[3]"
            src="{{ $videoUrl }}" 
            playsinline 
            @if($autoplay) autoplay @endif 
            @if($muted) muted @endif 
            @if($loop) loop @endif
        ></video>
        
        {{-- Content Overlay (can be used for titles/descriptions) --}}
        <div class="absolute inset-0 z-[15] flex flex-col items-center justify-center text-white px-6 sm:px-8 md:px-12">
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-center leading-tight mb-4 md:mb-6 drop-shadow-lg max-w-4xl opacity-0 translate-y-8 transition-all duration-700 delay-300 group-hover:opacity-100 group-hover:translate-y-0">
                {{ $title ?? 'Découvrez Notre Expérience' }}
            </h2>
            
            <p class="text-base sm:text-lg md:text-xl text-center max-w-2xl mb-8 drop-shadow-md opacity-0 translate-y-8 transition-all duration-700 delay-500 group-hover:opacity-100 group-hover:translate-y-0">
                {{ $description ?? 'Plongez dans l\'univers de BKBG et découvrez nos espaces exceptionnels' }}
            </p>
            
            <div class="opacity-0 scale-90 transition-all duration-700 delay-700 group-hover:opacity-100 group-hover:scale-100">
                <a href="{{ $ctaLink ?? '#' }}" class="btn btn-primary btn-lg glass gap-2">
                    {{ $ctaText ?? 'Explorer' }}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    
    {{-- Play Button (Shown when video is paused) --}}
    <div id="playButton" 
         class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-[20] cursor-pointer transition-all duration-500 
                w-24 h-24 sm:w-28 sm:h-28 md:w-32 md:h-32 lg:w-36 lg:h-36
                bg-white/60 hover:bg-white/80 backdrop-blur-sm rounded-full 
                flex items-center justify-center 
                shadow-[0_0_30px_rgba(0,0,0,0.25)] hover:shadow-[0_0_40px_rgba(0,0,0,0.3)] 
                scale-100 hover:scale-105 group-hover:scale-110">
        <div class="w-16 h-16 sm:w-18 sm:h-18 md:w-20 md:h-20 lg:w-24 lg:h-24 
                    bg-white/90 hover:bg-white rounded-full 
                    flex items-center justify-center 
                    shadow-[0_4px_15px_rgba(0,0,0,0.1)]">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" 
                 class="w-8 h-8 sm:w-10 sm:h-10 text-primary opacity-70 hover:opacity-100 ml-1">
                <path fill-rule="evenodd" d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z" clip-rule="evenodd" />
            </svg>
        </div>
    </div>
    
    {{-- Pause Button (Shown when video is playing) --}}
    <div id="pauseButton" 
         class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-[20] cursor-pointer transition-all duration-500 
                w-24 h-24 sm:w-28 sm:h-28 md:w-32 md:h-32 lg:w-36 lg:h-36
                bg-white/60 hover:bg-white/80 backdrop-blur-sm rounded-full 
                flex items-center justify-center 
                shadow-[0_0_30px_rgba(0,0,0,0.25)] hover:shadow-[0_0_40px_rgba(0,0,0,0.3)] 
                scale-100 hover:scale-105 opacity-0 pointer-events-none"
         style="display: none;">
        <div class="w-16 h-16 sm:w-18 sm:h-18 md:w-20 md:h-20 lg:w-24 lg:h-24 
                    bg-white/90 hover:bg-white rounded-full 
                    flex items-center justify-center 
                    shadow-[0_4px_15px_rgba(0,0,0,0.1)]">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" 
                 class="w-8 h-8 sm:w-10 sm:h-10 text-primary opacity-70 hover:opacity-100">
                <path fill-rule="evenodd" d="M6.75 5.25a.75.75 0 01.75-.75H9a.75.75 0 01.75.75v13.5a.75.75 0 01-.75.75H7.5a.75.75 0 01-.75-.75V5.25zm7.5 0A.75.75 0 0115 4.5h1.5a.75.75 0 01.75.75v13.5a.75.75 0 01-.75.75H15a.75.75 0 01-.75-.75V5.25z" clip-rule="evenodd" />
            </svg>
        </div>
    </div>
    
    {{-- Progress Bar --}}
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-white/20 z-[25]">
        <div id="progressBar" class="h-full bg-primary transition-all duration-300 w-0"></div>
    </div>
    
    {{-- Controls Tray (appears on hover) --}}
    <div class="absolute bottom-0 left-0 right-0 p-4 flex justify-between items-center z-[30] 
                bg-gradient-to-t from-black/70 to-transparent 
                opacity-0 translate-y-full transition-all duration-500 
                group-hover:opacity-100 group-hover:translate-y-0">
        <div class="flex items-center gap-3">
            <button id="muteButton" class="btn btn-circle btn-sm btn-ghost text-white">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5" id="volumeOnIcon">
                    <path d="M13.5 4.06c0-1.336-1.616-2.005-2.56-1.06l-4.5 4.5H4.508c-1.141 0-2.318.664-2.66 1.905A9.76 9.76 0 001.5 12c0 .898.121 1.768.35 2.595.341 1.24 1.518 1.905 2.659 1.905h1.93l4.5 4.5c.945.945 2.561.276 2.561-1.06V4.06zM18.584 5.106a.75.75 0 011.06 0c3.808 3.807 3.808 9.98 0 13.788a.75.75 0 11-1.06-1.06 8.25 8.25 0 000-11.668.75.75 0 010-1.06z" />
                    <path d="M15.932 7.757a.75.75 0 011.061 0 6 6 0 010 8.486.75.75 0 01-1.06-1.061 4.5 4.5 0 000-6.364.75.75 0 010-1.06z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 hidden" id="volumeOffIcon">
                    <path d="M13.5 4.06c0-1.336-1.616-2.005-2.56-1.06l-4.5 4.5H4.508c-1.141 0-2.318.664-2.66 1.905A9.76 9.76 0 001.5 12c0 .898.121 1.768.35 2.595.341 1.24 1.518 1.905 2.659 1.905h1.93l4.5 4.5c.945.945 2.561.276 2.561-1.06V4.06z" />
                </svg>
            </button>
            
            <span id="timeDisplay" class="text-xs sm:text-sm text-white/90 font-mono">00:00 / 00:00</span>
        </div>
        
        <div class="flex items-center gap-3">
            <button id="fullscreenButton" class="btn btn-circle btn-sm btn-ghost text-white">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M15 3.75a.75.75 0 01.75-.75h4.5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0V5.56l-3.97 3.97a.75.75 0 11-1.06-1.06l3.97-3.97h-2.69a.75.75 0 01-.75-.75zm-12 0A.75.75 0 013.75 3h4.5a.75.75 0 010 1.5H5.56l3.97 3.97a.75.75 0 01-1.06 1.06L4.5 5.56v2.69a.75.75 0 01-1.5 0v-4.5zm11.47 15.97a.75.75 0 001.06 0l3.97-3.97v2.69a.75.75 0 001.5 0v-4.5a.75.75 0 00-.75-.75h-4.5a.75.75 0 000 1.5h2.69l-3.97 3.97a.75.75 0 000 1.06zm-4.94-1.06a.75.75 0 001.06 1.06L5.56 15.75h2.69a.75.75 0 000-1.5h-4.5a.75.75 0 00-.75.75v4.5a.75.75 0 001.5 0v-2.69l3.97 3.97z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
    
    {{-- Loading Indicator --}}
    <div id="loadingIndicator" class="absolute inset-0 flex items-center justify-center z-[40] bg-black/30 backdrop-blur-sm">
        <span class="loading loading-spinner loading-lg text-primary"></span>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // DOM elements
        const videoContainer = document.getElementById('videoContainer');
        const videoPoster = document.getElementById('videoPoster');
        const video = document.getElementById('mainVideo');
        const playButton = document.getElementById('playButton');
        const pauseButton = document.getElementById('pauseButton');
        const muteButton = document.getElementById('muteButton');
        const volumeOnIcon = document.getElementById('volumeOnIcon');
        const volumeOffIcon = document.getElementById('volumeOffIcon');
        const fullscreenButton = document.getElementById('fullscreenButton');
        const progressBar = document.getElementById('progressBar');
        const timeDisplay = document.getElementById('timeDisplay');
        const loadingIndicator = document.getElementById('loadingIndicator');
        
        // State
        let isPlaying = {!! $autoplay ? 'true' : 'false' !!};
        let isMuted = {!! $muted ? 'true' : 'false' !!};
        let controlsTimeout;
        
        // Update volume icon based on initial state
        updateVolumeIcon();
        
        // Hide loading indicator when video can play
        video.addEventListener('canplay', () => {
            loadingIndicator.classList.add('hidden');
            videoPoster.classList.add('opacity-0');
        });
        
        // Show loading indicator if video stalls
        video.addEventListener('waiting', () => {
            loadingIndicator.classList.remove('hidden');
        });
        
        // Update time display and progress bar
        video.addEventListener('timeupdate', () => {
            // Update progress bar
            const progress = (video.currentTime / video.duration) * 100 || 0;
            progressBar.style.width = `${progress}%`;
            
            // Update time display
            const currentMinutes = Math.floor(video.currentTime / 60);
            const currentSeconds = Math.floor(video.currentTime % 60);
            const totalMinutes = Math.floor(video.duration / 60) || 0;
            const totalSeconds = Math.floor(video.duration % 60) || 0;
            
            timeDisplay.textContent = `${currentMinutes.toString().padStart(2, '0')}:${currentSeconds.toString().padStart(2, '0')} / ${totalMinutes.toString().padStart(2, '0')}:${totalSeconds.toString().padStart(2, '0')}`;
        });
        
        // Function to toggle play/pause
        function togglePlayPause() {
            if (video.paused) {
                playVideo();
            } else {
                pauseVideo();
            }
        }
        
        // Play video function
        function playVideo() {
            if (video.paused) {
                video.play()
                    .then(() => {
                        isPlaying = true;
                        updatePlayPauseButtons();
                        videoPoster.classList.add('opacity-0');
                    })
                    .catch(error => {
                        console.error('Error playing video:', error);
                        // Show error message or fallback
                    });
            }
        }
        
        // Pause video function
        function pauseVideo() {
            if (!video.paused) {
                video.pause();
                isPlaying = false;
                updatePlayPauseButtons();
            }
        }
        
        // Update play/pause buttons visibility
        function updatePlayPauseButtons() {
            if (isPlaying) {
                playButton.style.display = 'none';
                pauseButton.style.display = 'flex';
                pauseButton.classList.remove('opacity-0', 'pointer-events-none');
                
                // Auto-hide pause button after some time
                clearTimeout(controlsTimeout);
                controlsTimeout = setTimeout(() => {
                    pauseButton.classList.add('opacity-0', 'pointer-events-none');
                }, 2000);
            } else {
                playButton.style.display = 'flex';
                pauseButton.style.display = 'none';
                playButton.classList.remove('opacity-0', 'pointer-events-none');
            }
        }
        
        // Toggle mute function
        function toggleMute() {
            video.muted = !video.muted;
            isMuted = video.muted;
            updateVolumeIcon();
        }
        
        // Update volume icon based on mute state
        function updateVolumeIcon() {
            if (isMuted) {
                volumeOnIcon.classList.add('hidden');
                volumeOffIcon.classList.remove('hidden');
            } else {
                volumeOnIcon.classList.remove('hidden');
                volumeOffIcon.classList.add('hidden');
            }
        }
        
        // Toggle fullscreen function
        function toggleFullscreen() {
            if (!document.fullscreenElement) {
                videoContainer.requestFullscreen()
                    .catch(err => {
                        console.log(`Error attempting to enable fullscreen: ${err.message}`);
                    });
            } else {
                document.exitFullscreen();
            }
        }
        
        // Event Listeners
        video.addEventListener('click', togglePlayPause);
        playButton.addEventListener('click', playVideo);
        pauseButton.addEventListener('click', pauseVideo);
        muteButton.addEventListener('click', toggleMute);
        fullscreenButton.addEventListener('click', toggleFullscreen);
        
        video.addEventListener('ended', () => {
            if (!video.loop) {
                isPlaying = false;
                updatePlayPauseButtons();
            }
        });
        
        // Mouse hover effects for controls
        videoContainer.addEventListener('mouseenter', () => {
            if (isPlaying) {
                pauseButton.classList.remove('opacity-0', 'pointer-events-none');
                clearTimeout(controlsTimeout);
            }
        });
        
        videoContainer.addEventListener('mouseleave', () => {
            if (isPlaying) {
                controlsTimeout = setTimeout(() => {
                    pauseButton.classList.add('opacity-0', 'pointer-events-none');
                }, 500);
            }
        });
        
        // Initialize state
        updatePlayPauseButtons();
        
        // Video click to play first time
        video.addEventListener('click', () => {
            // This is for mobile where autoplay might be blocked
            if (video.paused) {
                playVideo();
            } else {
                pauseVideo();
            }
        });
        
        // Progress bar click to seek
        progressBar.parentElement.addEventListener('click', (e) => {
            const rect = progressBar.parentElement.getBoundingClientRect();
            const pos = (e.clientX - rect.left) / rect.width;
            video.currentTime = pos * video.duration;
        });
        
        // Set initial muted state
        video.muted = isMuted;
    });
</script>
