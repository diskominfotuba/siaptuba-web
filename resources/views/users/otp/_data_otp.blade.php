<div class="alert alert-warning mb-1">OTP terbaru: {{ Carbon\Carbon::parse($data['created_at'])->format('d-m-Y H:i') }}</div>
<div class="card mb-1">
    <div class="card-body">
        <div>tulangbawangkab.go.id</div>
        <h3>{{ $data['otp'] }}</h3>
    </div>
</div>