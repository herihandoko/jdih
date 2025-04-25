<script src="{{ asset('storage/backend/js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('storage/backend/js/custom.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#toggle-password').on('click', function() {
            var passwordField = $('#password');
            var passwordIcon = $('#password-icon');
            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                passwordIcon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                passwordIcon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
        
        $('#file-upload').change(function() {
            var fileInput = $(this);
            var file = fileInput.get(0).files[0];
            var fileName = file ? file.name : 'Tidak ada file yang dipilih';
            $('#file-name').text(fileName);

            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').attr('src', e.target.result);
                    $('#image-preview').show();
                };
                reader.readAsDataURL(file);
            } else {
                $('#image-preview').hide();
            }
        });
        
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        
        $('#inlineDiubah').change(function() {
            if($(this).is(':checked')) {
                $('.diubah-section').slideDown();
            } else {
                $('.diubah-section').slideUp();
            }
        });
        
        if ($('#inlineDiubah').is(':checked')) {
            console.log('checked');
        } else {
            $('.diubah-section').css('display','none');
        }
        
        $('#inlineMengubah').change(function() {
            if($(this).is(':checked')) {
                $('.mengubah-section').slideDown();
            } else {
                $('.mengubah-section').slideUp();
            }
        });
        
        if ($('#inlineMengubah').is(':checked')) {
            console.log('checked');
        } else {
            $('.mengubah-section').css('display','none');
        }
        
        $('#inlineDicabut').change(function() {
            if($(this).is(':checked')) {
                $('.dicabut-section').slideDown();
            } else {
                $('.dicabut-section').slideUp();
            }
        });
        
        if ($('#inlineDicabut').is(':checked')) {
            console.log('checked');
        } else {
            $('.dicabut-section').css('display','none');
        }
        
        $('#inlineMencabut').change(function() {
            if($(this).is(':checked')) {
                $('.mencabut-section').slideDown();
            } else {
                $('.mencabut-section').slideUp();
            }
        });
        
        if ($('#inlineMencabut').is(':checked')) {
            console.log('checked');
        } else {
            $('.mencabut-section').css('display','none');
        }
    });
    
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    
     $(".select2").select2();
     
     tinymce.init({
        selector: 'textarea#editorContent',
        menubar: false,
        icons: 'thin',
        plugins: 'a11ychecker advcode advlist advtable anchor autocorrect autosave editimage image code link linkchecker lists media mediaembed pageembed powerpaste searchreplace table template tinymcespellchecker typography visualblocks wordcount',
        toolbar: 'undo redo | styles | bold italic underline strikethrough | align | table link media pageembed | bullist numlist outdent indent | spellcheckdialog a11ycheck typography code',
        height: 400
    });
</script>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{ $error }}');
        </script>
    @endforeach
@endif

@if(session()->get('error'))
    <script>
        toastr.error('{{ session()->get('error') }}');
    </script>
@endif

@if(session()->get('success'))
    <script>
        toastr.success('{{ session()->get('success') }}');
    </script>
@endif