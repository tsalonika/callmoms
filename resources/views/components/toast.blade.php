@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/components/components.css') }}">
@endpush

<div id="toast" class="toast-wrapper">{{ $message }}</div>

@push('scripts')
    <script>
        function showToast(message, type) {
            var toast = document.getElementById("toast");
            toast.textContent = message;
            toast.className = "toast-wrapper show";
            if(type === 'success') {
                toast.style.backgroundColor = 'rgb(57, 170, 57)';
            } else {
                toast.style.backgroundColor = 'rgb(255, 51, 51)';
            }
            setTimeout(function() {
                toast.className = toast.className.replace("show", "");
            }, 3000);
        }

        @if (session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('success') }}', 'success');
            });
        @elseif(session('error'))
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('error') }}', 'error');
            });
        @endif
    </script>
@endpush