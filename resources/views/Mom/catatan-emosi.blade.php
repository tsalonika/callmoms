@extends('layout.index')

@section('title', 'Calmoms - Mari lakukan Penilaian Terhadap Emosi yang Anda Miliki Sekarang')

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/mom/mom.css') }}">
@endpush

@section('content')
    {{-- Catatan Emosi Mom View --}}
    <div class="catatan_emosi-page-wrapper">
        <h2>Apa yang sedang ibu rasakan?</h2>
        <form action="{{ route('mom.emotionalSubmit') }}" method="POST">
            @csrf
            @foreach ($questions as $index => $question)
            <div>
                <label>{{ $question }}</label><br>
                <div class="catatan_emosi-options-wrapper">
                    <label class="question-label">
                        <input type="radio" name="scores[{{ $index }}]" value="0" required> Sangat tidak setuju
                    </label><br>
                    <label class="question-label">
                        <input type="radio" name="scores[{{ $index }}]" value="1" required> Tidak setuju
                    </label><br>
                    <label class="question-label">
                        <input type="radio" name="scores[{{ $index }}]" value="2" required> Netral
                    </label><br>
                    <label class="question-label">
                        <input type="radio" name="scores[{{ $index }}]" value="3" required> Setuju
                    </label><br>
                    <label class="question-label">
                        <input type="radio" name="scores[{{ $index }}]" value="4" required> Sangat setuju
                    </label>
                </div>
            </div>
            @endforeach
            <div class="catatan_emosi-button-wrapper">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>

    @if (Session::has('success'))
        <script>
            Swal.fire({
                text: "{{ Session::get('success') }}",
                imageUrl: "{{ Session::get('imageUrl') }}",
                imageWidth: 200,
                imageHeight: 80,
                imageAlt: "Custom image",
                confirmButtonText: "{{ Session::get('buttonText') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ Session::get('url') }}";
                }
            });
        </script>
    @endif
@endsection