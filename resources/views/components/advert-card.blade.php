<div id="advert-container" class="relative w-full h-[400px] max-w-md mx-auto bg-gray-100 rounded-md shadow-md overflow-hidden">
    @foreach($adverts as $advert)
        <div class="advert-item absolute inset-0 w-full h-full transition-opacity duration-1000 opacity-0"
             data-index="{{ $loop->index }}"
             data-has-video="{{ $advert->video_path ? 'true' : 'false' }}"
             data-has-image="{{ $advert->image_path ? 'true' : 'false' }}">

            @if($advert->video_path)
                <video class="absolute inset-0 w-full h-full object-cover hidden" muted playsinline>
                    <source src="{{ asset('storage/' . $advert->video_path) }}" type="video/mp4">
                </video>
            @endif

            @if($advert->image_path)
                <img src="{{ asset('storage/' . $advert->image_path) }}" 
                     alt="{{ $advert->title }}" 
                     class="absolute inset-0 w-full h-full object-cover hidden">
            @endif
        </div>
    @endforeach
    
    @if($adverts->isEmpty())
        <div class="flex items-center justify-center h-full text-gray-500">
            No adverts available
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const adverts = Array.from(document.querySelectorAll('.advert-item'));
    let currentIndex = 0;
    let currentState = 'video'; // 'video' or 'image'

    function showAdvert() {
        if (adverts.length === 0) return;

        const advert = adverts[currentIndex];
        const hasVideo = advert.dataset.hasVideo === 'true';
        const hasImage = advert.dataset.hasImage === 'true';

        // Fade out all adverts smoothly
        adverts.forEach(a => {
            a.style.opacity = '0';
            a.style.zIndex = '-1';
        });

        // Show current advert
        advert.style.zIndex = '1';
        advert.style.display = 'block';
        setTimeout(() => advert.style.opacity = '1', 600); // Smooth fade-in delay

        if (hasVideo && currentState === 'video') {
            const video = advert.querySelector('video');
            video.currentTime = 0;
            video.style.display = 'block';
            if (hasImage) advert.querySelector('img').style.display = 'none';

            video.play().catch(e => console.error('Video error:', e));

            video.onended = function() {
                if (hasImage) {
                    currentState = 'image';
                    video.style.display = 'none';
                    advert.querySelector('img').style.display = 'block';
                    setTimeout(showAdvert, 6000); // Longer image display
                } else {
                    currentState = 'video';
                    currentIndex = (currentIndex + 1) % adverts.length;
                    setTimeout(showAdvert, 1500); // Slower transition
                }
            };
        } else if (hasImage && currentState === 'image') {
            if (hasVideo) advert.querySelector('video').style.display = 'none';
            advert.querySelector('img').style.display = 'block';
            currentState = 'video';
            currentIndex = (currentIndex + 1) % adverts.length;
            setTimeout(showAdvert, 6000); // Longer image display
        } else {
            currentState = 'video';
            currentIndex = (currentIndex + 1) % adverts.length;
            setTimeout(showAdvert, 1500); // Slower transition
        }
    }

    if (adverts.length > 0) {
        adverts.forEach(a => a.style.display = 'none');
        showAdvert();
    }
});
</script>
