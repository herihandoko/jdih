{{-- resources/views/partials/share.blade.php --}}
@php
  // URL yang akan di‐share via GET
  $shareUrl = urlencode(url('storage/places/peraturan/'.$produkHukumDetail->file_peraturan));
@endphp
<style>
    .btn-copy-wrapper {
      position: relative;
      display: inline-block;
    }
    .tooltip-custom {
      position: absolute;
      bottom: 100%;           /* di atas tombol */
      left: 50%;
      transform: translateX(-50%);
      margin-bottom: 8px;     /* jarak dari tombol */
      background: rgba(0,0,0,0.8);
      color: #fff;
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 0.75rem;
      white-space: nowrap;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.2s ease;
      z-index: 10;
    }
    .tooltip-custom.show {
      opacity: 1;
    }
  </style>
<div class="d-flex align-items-center">
    {{-- Label --}}
    <span class="me-3 fw-semibold mr-1">{{ translateText('Bagikan') }}</span>

    {{-- Facebook --}}
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank"
        class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle me-2 mr-1"
        style="width: 36px; height: 36px;">
        <i class="fab fa-facebook-f fa-lg"></i>
    </a>

    {{-- X (Twitter) --}}
    <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}" target="_blank"
        class="d-inline-flex align-items-center justify-content-center bg-dark text-white rounded-circle me-2 mr-1"
        style="width: 36px; height: 36px;">
        <i class="fab fa-twitter fa-lg"></i>
    </a>

    {{-- WhatsApp --}}
    <a href="https://wa.me/?text={{ $shareUrl }}" target="_blank"
        class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-circle me-2 mr-1"
        style="width: 36px; height: 36px;">
        <i class="fab fa-whatsapp fa-lg"></i>
    </a>

    {{-- Telegram --}}
    <a href="https://t.me/share/url?url={{ $shareUrl }}" target="_blank"
        class="d-inline-flex align-items-center justify-content-center bg-info text-white rounded-circle me-2 mr-1"
        style="width: 36px; height: 36px;">
        <i class="fab fa-telegram-plane fa-lg"></i>
    </a>

    {{-- tombol copy + tooltip --}}
    <div class="btn-copy-wrapper me-2">
        <button
        onclick="copyLink(this)"
        class="d-inline-flex align-items-center justify-content-center bg-secondary text-white rounded-circle"
        style="width:36px; height:36px; border:none; cursor:pointer;"
        aria-label="Copy link"
        >
        <i class="fas fa-link fa-lg"></i>
        </button>
        <div class="tooltip-custom">Copy link</div>
    </div>
</div>

<script>
    function copyLink(btn) {
      const url = '{{ $shareUrl }}';
      const tooltip = btn.parentElement.querySelector('.tooltip-custom');
      navigator.clipboard.writeText(url)
        .then(() => {
          tooltip.textContent = 'Copied';
          tooltip.classList.add('show');
          setTimeout(() => {
            tooltip.classList.remove('show');
            tooltip.textContent = 'Copy link';
          }, 2000);
        })
        .catch(err => {
          console.error('Gagal menyalin:', err);
        });
    }
</script>