@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/components/components.css') }}">
@endpush

<div class="component_dialog-wrapper">
    <div class="component_dialog-display-message" id="chat"></div>
    <div class="component_dialog-button-wrapper">
        @csrf
        <form id="send-message">
            <input type="text" name="content" id="input-form-message" placeholder="Masukkan Pesan....">
            <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(function () {
        var urlParts = window.location.pathname.split('/');
        var recipientId = urlParts[urlParts.length - 1];
        
        var userId = '{{ session('users_data')['id'] ?? null }}';

        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });

        var channel = pusher.subscribe('my-channel-chat');

        channel.bind('my-event-chat', function(data) {
            displayMessage(data.message);
        });

        $.get('{{ $getMessagesUrl }}/' + recipientId, function(data) {
            data.forEach(function(message) {
                displayMessage(message);
            });
        });

        function displayMessage(message) {
            var backgroundColor = message.from == userId ? '#6BA5C8' : '#FFFFFF';
            var positionChat = message.from == userId ? 'flex-end' : 'flex-start';
            var messageContent = '<p class="box-message ' + '" style="background-color: ' + backgroundColor + '; align-self: ' + positionChat + ';">' + message.content + '</p>';
            $('#chat').append(messageContent);
            $('#chat').scrollTop($('#chat')[0].scrollHeight);
        }

        $('#send-message').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_token', $('input[name="_token"]').val());
            formData.append('to', recipientId);
            $.ajax({
                url: '/send',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#input-form-message').val('');
                }
            });
        });

    });
</script>
@endpush