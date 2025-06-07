<div class="card-body">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Audio Tersedia</label>
        <div class="col-sm-10">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="audioToggle" name="status_tts" value="1" {{ isset($produkHukumList) && $produkHukumList->status_tts == 1 ? 'checked' : '' }}>
                <label class="custom-control-label" for="audioToggle">Aktifkan jika memiliki file audio</label>
            </div>
        </div>
    </div>

    <div class="form-group row" id="audioUploadField" style="display: {{ isset($produkHukumList) && $produkHukumList->status_tts == 1 ? 'flex' : 'none' }};">
        <label class="col-sm-2 col-form-label">File Audio <span class="text-danger">*</span></label>
        <div class="col-sm-10">
            @if(isset($produkHukumList) && $produkHukumList->mp3_path)
                <div class="mb-2">
                    <audio controls>
                        <source src="{{ asset('storage/places/mp3/' . $produkHukumList->mp3_path) }}" type="audio/mpeg">
                        Browser Anda tidak mendukung pemutaran audio.
                    </audio>
                </div>
            @endif
            <input type="file" class="form-control-file" name="audio_file" id="audioFile" accept=".mp3">
            <small class="form-text text-muted">Format yang diizinkan: MP3. Maksimal ukuran file: 10MB</small>
            @if(isset($produkHukumList) && $produkHukumList->mp3_path)
                <small class="form-text text-info">Upload file baru untuk mengganti file audio yang ada</small>
            @endif
            <div class="invalid-feedback" id="audioError">
                File audio wajib diupload jika Audio Tersedia diaktifkan
            </div>
            <input type="hidden" name="mp3_path" id="mp3Path" value="{{ isset($produkHukumList) ? $produkHukumList->mp3_path : '' }}">
            <input type="hidden" name="conversion_status" id="conversionStatus" value="{{ isset($produkHukumList) ? $produkHukumList->conversion_status : '' }}">
        </div>
    </div>
</div>
<hr>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const audioToggle = document.getElementById('audioToggle');
    const audioUploadField = document.getElementById('audioUploadField');
    const audioFile = document.getElementById('audioFile');
    const audioError = document.getElementById('audioError');
    const form = document.querySelector('form');
    const existingAudio = "{{ isset($produkHukumList) && $produkHukumList->mp3_path ? 'true' : 'false' }}";

    // Function to validate audio file
    function validateAudioFile() {
        if (audioToggle.checked && !audioFile.value && existingAudio === 'false') {
            audioFile.classList.add('is-invalid');
            audioError.style.display = 'block';
            return false;
        }
        audioFile.classList.remove('is-invalid');
        audioError.style.display = 'none';
        return true;
    }

    // Toggle audio field visibility and required state
    audioToggle.addEventListener('change', function() {
        audioUploadField.style.display = this.checked ? 'flex' : 'none';
        if (this.checked) {
            if (existingAudio === 'false') {
                audioFile.setAttribute('required', 'required');
            }
            document.getElementById('conversionStatus').value = 'completed';
        } else {
            audioFile.removeAttribute('required');
            audioFile.value = '';
            document.getElementById('conversionStatus').value = '';
            document.getElementById('mp3Path').value = '';
        }
        validateAudioFile();
    });

    // Validate on file change
    audioFile.addEventListener('change', validateAudioFile);

    // Form submission validation
    form.addEventListener('submit', function(e) {
        if (audioToggle.checked && !validateAudioFile()) {
            e.preventDefault();
            return false;
        }
    });
});
</script> 