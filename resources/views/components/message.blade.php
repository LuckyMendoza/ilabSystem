@extends('layouts.master')
@section('title', "Services")
@section('services', "active")

@section('main_content')

<section>
    <div class="container py-5">

        <div class="row">
            <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">
                <h5 class="font-weight-bold mb-3 text-center text-lg-start">User List</h5>

                <div class="card">

                    <div class="card-body">
                        <ul class="list-unstyled mb-0" style="max-height: 600px; overflow-y: auto;">
                            @foreach($users as $u)
                                @if($u->id !== Auth::id())
                                    @php
                                        $unreadMessages = $chat->where('user_id_sender', $u->id)->where('user_id_receiver', Auth::id())->where('is_read', false)->count();
                                        $latestMessage = $chat
                                            ->where('user_id_sender', $u->id)
                                            ->where('user_id_receiver', Auth::id())
                                            ->first();
                                        $timeAgo = $latestMessage ? $latestMessage->created_at->diffForHumans() : 'N/A';
                                    @endphp

                                    <li class="p-2 border-bottom" @if($unreadMessages > 0) style="background-color: #eee;" @endif>
                                        <a href="javascript:void(0);" data-user-id="{{ $u->id }}" class="d-flex justify-content-between user-item">
                                            <div class="d-flex flex-row">
                                                <img src="{{ asset('asset/img/avatars/logo.png') }}" alt="avatar" class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="50" height="50">
                                                <div class="pt-1">
                                                    <p class="fw-bold mb-0">{{ $u->name }}</p>
                                                    <p class="small text-muted">{{ $latestMessage ? $latestMessage->message : 'No messages' }}</p>
                                                </div>
                                            </div>
                                            <p class="small text-muted mb-1">{{ $timeAgo }}</p>
                                            @if($unreadMessages > 0)
                                                <div class="pt-1">
                                                    <span class="badge bg-danger float-end"><i class="fas fa-exclamation-circle text-warning ml-2"></i></span>
                                                </div>
                                            @endif
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>

            <div class="col-md-6 col-lg-7 col-xl-8">
                <h5 class="font-weight-bold mb-3 text-center text-lg-start">Messeges List</h5>

                <div id="chat" style="max-height: 600px; overflow-y: auto;">
                    {{-- chats --}}
                </div>

                <div id="startConversationMessage" class="card w-100">
                    <div class="card-body">
                        <p class="mb-0">Select User to Start Conversation.</p>
                    </div>
                </div>

                <form id="chatForm" class="my-3 px-3" style="display: none;">
                    @csrf
                    <input type="hidden" name="receiver_id" id="receiver_id" value="">
                    <div class="bg-white">
                        <div class="form-outline">
                            <textarea class="form-control" name="message" id="message" rows="3" placeholder="Type your message"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info btn-rounded float-end mt-2">Send</button>
                </form>
            </div>

        </div>

    </div>
</section>


@endsection

@section('specific-js')
<script>
$(document).ready(function() {

    // Load user conversations
    $('.user-item').click(function() {
        $('#startConversationMessage').hide();
        $('#chatForm').show();

        var receiverId = $(this).data('user-id');
        $('#receiver_id').val(receiverId);

        // Load chat messages for the selected user
        $.ajax({
            type: 'GET',
            url: '/chat/' + receiverId,
            dataType: 'json', // Specify that the expected response is JSON
            success: function(response) {
                // Display chat messages
                displayChatMessages(response);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching chat messages:", error);
            }
        });

        // Show the chat box modal
        $('#chatBoxModal').modal('show');
    });

    // Ajax form submission
    $('#chatForm').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: '/chat',
            data: $(this).serialize(),
            success: function(response) {
                // Display the new message
                displayChatMessages(response);

                // Clear the input field
                $('#message').val('');
            },
            error: function(xhr, status, error) {
                console.error("Error sending chat message:", error);
            }
        });
    });

    // Function to display chat messages
    function displayChatMessages(messages) {
        console.log(messages);
        var chatHtml = '';
        if (messages && messages.length > 0) {
            messages.forEach(function (message) {
                var timeAgo = moment(message.created_at).fromNow();

                chatHtml += '<ul class="list-unstyled px-3">';

                if (message.user_id_sender == '{{ Auth::id() }}') {
                    chatHtml += '<li class="d-flex justify-content-between">' +
                        '<div class="card w-100">' +
                        '<div class="card-header d-flex justify-content-between p-2">' +
                        '<p class="fw-bold mb-0">You:</p>' +
                        '<p class="text-muted small mb-0"><i class="far fa-clock me-1"></i>' + timeAgo + '</p>' +
                        '</div>' +
                        '<div class="card-body">' +
                        '<p class="mb-0">' + message.message + '</p>' +
                        '</div>' +
                        '</div>' +
                        '<img src="{{ asset('asset/img/avatars/logo.png') }}" alt="avatar" class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="50" height="50">' +
                        '</li>';
                } else {
                    chatHtml += '<li class="d-flex justify-content-between">' +
                        '<img src="{{ asset('asset/img/avatars/logo.png') }}" alt="avatar" class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="50" height="50">' +
                        '<div class="card w-100">' +
                        '<div class="card-header d-flex justify-content-between p-2">' +
                        '<p class="fw-bold mb-0">' + message.sender.name + ':</p>' +
                        '<p class="text-muted small mb-0"><i class="far fa-clock me-1"></i>' + timeAgo + '</p>' +
                        '</div>' +
                        '<div class="card-body">' +
                        '<p class="mb-0">' + message.message + '</p>' +
                        '</div>' +
                        '</div>' +
                        '</li>';
                }

                chatHtml += '</ul>';
            });
        } else {
            chatHtml = '<div class="card w-100 mb-3">' +
                '<div class="card-body">' +
                '<p class="mb-0"> Start Conversation now!</p>' +
                '</div>' +
                '</div>';
        }

        $('#chat').html(chatHtml);
    }

});
</script>

@endsection
