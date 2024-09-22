{{-- video_call_test_field field --}}
@include('crud::fields.inc.wrapper_start')
<div class="video-call">
    <h3>Video Call Test</h3>
    <p>Click the button below to test your camera before the consultation.</p>
    <button id="startTest" type="button">Test my video now</button>
    <div id="video-test" style="display: none;">
        <video id="video" autoplay></video>
    </div>
    <p id="note" style="display:none;">If you can see yourself, your video is working correctly!</p>
</div>

@push('crud_fields_styles')

    @basset('css/video-call.css')
@endpush

@push('crud_fields_scripts')
<script>
    document.getElementById('startTest').addEventListener('click', function () {
        const video = document.getElementById('video');
        const videoTestDiv = document.getElementById('video-test');
        const note = document.getElementById('note');

        // Show the video element and start video testing
        videoTestDiv.style.display = 'block';

        // Request access to the user's camera
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
                video.play();
                note.style.display = 'block';
            })
            .catch(err => {
                console.error("Error accessing camera: ", err);
                alert('Unable to access your camera. Please ensure you have granted permission.');
            });
    });
</script>
@endpush
@include('crud::fields.inc.wrapper_end')
