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
        
        var userId = '{{ session('users_data')['id_users'] ?? null }}';
        var userName = '{{ session('users_data')['nested']['name'] ?? null }}';

        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });

        var channel = pusher.subscribe('{{ $broadcastOn }}');

        channel.bind('{{ $broadcastAs }}', function(data) {
            displayMessage(data.message);
        });

        $.get('{{ $getMessagesUrl }}' + ('{{ $getMessagesUrl }}' === '{{ url('/messages') }}' ? '/' + recipientId : ''), function(data) {
            data.forEach(function(message) {
                displayMessage(message);
            });
        });

        function displayMessage(message) {
            var backgroundColor = message.from == userId ? '#6BA5C8' : '#FFFFFF';
            var positionChat = message.from == userId ? 'flex-end' : 'flex-start';
            var messageContent = '<p class="box-message ' + '" style="background-color: ' + backgroundColor + '; align-self: ' + positionChat + ';">' + message.content + '</p>';
            var messageContentForum = '<p class="box-message ' + '" style="background-color: ' + backgroundColor + '; align-self: ' + positionChat + '; display: flex; flex-direction: column; font-weight: 400; gap: 5px; align-items: ' + positionChat + ' ">' + '<label style="font-weight: 700;">' + message.name +'</label>' + message.content + '</p>';
            if(('{{ $broadcastOn }}') === 'my-channel-chat') {
                $('#chat').append(messageContent);
            } else {
                $('#chat').append(messageContentForum);
            }
            $('#chat').scrollTop($('#chat')[0].scrollHeight);
        }

        $('#send-message').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_token', $('input[name="_token"]').val());
            formData.append('to', recipientId);
            formData.append('name', userName);
            $.ajax({
                url: '{{ $sendMessageUrl }}',
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