@extends('layouts.pegawai.auth')
@section('content')
<style>
    .otp-container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px; /* Gunakan gap untuk jarak antar elemen */
    flex-wrap: wrap; /* Agar elemen bisa turun ke bawah jika tidak cukup */
}

.otp-input {
    width: 50px;
    height: 50px;
    text-align: center;
    font-size: 24px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin: 0;
    transition: all 0.2s ease-in-out; /* Animasi saat hover */
}

.otp-input:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Responsif untuk layar kecil */
@media (max-width: 768px) {
    .otp-input {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
    .otp-container {
        gap: 8px;
    }
}

/* Responsif untuk layar sangat kecil */
@media (max-width: 480px) {
    .otp-input {
        width: 40px;
        height: 40px;
        font-size: 18px;
    }
    .otp-container {
        gap: 6px;
    }
}

</style>
<section class="section">
  <div class="mt-3">
    <div class="row">
      <div class="col-12">
        <div class="login-brand text-center my-3">
          <img src="{{ asset('assets') }}/icon/otp-pegawai.png" lazy="loading" alt="logo" width="50%">
        </div>

        @if (session('error'))
        <div class="alert alert-danger mb-2">{{ session('error') }}</div>
        @endif
        <form action="/kepegawaian/otp/verifikasi" method="POST">
        @csrf
        <div class="card card-primary mb-3">
          <div class="card-header text-center"><h4>{{ __('Silakan Masukan OTP yang dikirim ke email SIAP TUBA Anda') }}</h4></div>
            <div class="card-body">
                <div class="otp-container">
                    <input type="text" name="otp[]" class="form-control otp-input" maxlength="1" pattern="\d*" required>
                    <input type="text" name="otp[]" class="form-control otp-input" maxlength="1" pattern="\d*" required>
                    <input type="text" name="otp[]" class="form-control otp-input" maxlength="1" pattern="\d*" required>
                    <input type="text" name="otp[]" class="form-control otp-input" maxlength="1" pattern="\d*" required>
                    <input type="text" name="otp[]" class="form-control otp-input" maxlength="1" pattern="\d*" required>
                    <input type="text" name="otp[]" class="form-control otp-input" maxlength="1" pattern="\d*" required>
                </div>
            </div>
        </div>
        @include('layouts.pegawai._loading_submit')
        <button type="submit" id="btn_login" class="btn btn-primary btn-block btn-lg">Verifikasi</button>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
@push('js')
    <script type="text/javascript">
    //digunakan untuk menampilkan animasi loading ketika tombol login ditekan
    

    // Focus otomatis ke kolom berikutnya
    const inputs = document.querySelectorAll('.otp-input');
    inputs.forEach((input, index) => {
        input.addEventListener('input', (e) => {
            if (e.target.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
                if(e.target.value.length === 5) {
                        $('#btn_login').click(function() {
                        $('#btn_login').hide();
                        $('#loadingSubmit').removeClass('d-none');
                    });
                }
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && index > 0 && e.target.value === '') {
                inputs[index - 1].focus();
                if(e.target.value.length === 5) {
                        $('#btn_login').click(function() {
                        $('#btn_login').hide();
                        $('#loadingSubmit').removeClass('d-none');
                    });
                }
            }
        });
    });
    </script>
@endpush

   
