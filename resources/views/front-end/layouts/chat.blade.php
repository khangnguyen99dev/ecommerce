
<!-- <link href="assets/front-end/css/chat/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
<link href="assets/front-end/css/chat/css/main.css" rel="stylesheet" type="text/css" />
<link href="assets/front-end/css/chat/css/chatBot.css" rel="stylesheet" type="text/css"/>
<div class="chat-screen">
    <div class="chat-header">
        <div class="chat-header-title">
        <svg xmlns="http://www.w3.org/2000/svg" class="message" height="25px" viewBox="0 0 128 128" width="25px"><g id="Circle_Grid" data-name="Circle Grid"><circle cx="64" cy="64" fill="#69b0ee" r="64"/></g><g id="icon"><path d="m89.611 50.407c0 13.831-14.909 25.038-33.306 25.038a42.2 42.2 0 0 1 -14.644-2.553c-10.475 7.6-17.909 4.81-17.909 4.81a21.479 21.479 0 0 0 8-10.373c-5.437-4.454-8.752-10.393-8.752-16.922 0-13.841 14.909-25.048 33.306-25.048s33.305 11.207 33.305 25.048z" fill="#eeefee"/><g fill="#575b6d"><path d="m43.407 50.4a3.8 3.8 0 1 1 -3.8-3.8 3.807 3.807 0 0 1 3.8 3.8z"/><path d="m60.109 50.4a3.8 3.8 0 1 1 -3.8-3.8 3.807 3.807 0 0 1 3.8 3.8z"/><path d="m76.811 50.4a3.8 3.8 0 1 1 -3.8-3.8 3.807 3.807 0 0 1 3.8 3.8z"/></g><path d="m49.929 79.662c0 11.435 12.326 20.7 27.535 20.7a34.887 34.887 0 0 0 12.107-2.11c8.66 6.281 14.806 3.977 14.806 3.977a17.757 17.757 0 0 1 -6.617-8.576c4.5-3.683 7.239-8.593 7.239-13.99 0-11.443-12.326-20.708-27.535-20.708s-27.535 9.264-27.535 20.707z" fill="#f6c863"/><circle cx="91.332" cy="79.658" fill="#575b6d" r="3.158"/><circle cx="77.465" cy="79.658" fill="#575b6d" r="3.158"/><circle cx="63.597" cy="79.658" fill="#575b6d" r="3.158"/></g></svg>
            Chat với chúng tôi
        </div>
        <!-- <div class="chat-header-option hide">
            <span class="dropdown custom-dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink1" style="will-change: transform;">
                    <a class="dropdown-item" href="javascript:void(0);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#bc32ef" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        Send Transcriptions
                    </a>
                    <a class="dropdown-item end-chat" href="javascript:void(0);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#bc32ef" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-power"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg>
                        End Chat
                    </a>
                </div>
            </span>
        </div> -->
    </div>
    <div class="chat-mail">
        <div class="row">
            <div class="m-12 mb-2" style="text-align: center;">
                <p>👋 Chọn một nhân viên để bắt đầu cuộc trò chuyện! </p>
            </div>
        </div>
        <div class="row">
            <div class="m-12">
              <ul class="list-group list-group-flush employes">
              @foreach($users as $user)
                <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action employee" id="{{ $user->id }}">
                  {{ $user->name }}
                  @if($user->unread)
                  <span class="badge badge-primary badge-pill pending">{{ $user->unread }}</span>
                  @endif
                </li>
                @endforeach
              </ul>
            </div>
        </div>
    </div>
    <div class="chat-body hide" id="messages">
        <div class="scollmessage">
            <!-- render message -->
        </div>     
    </div>
</div>
<div class="chat-bot-icon">
    <img src="assets/front-end/css/chat/img/we-are-here.svg"/>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square animate"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x "><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
</div>
<script>
    let receiver_id = '';
    let my_id = '{{ Auth::id() }}';
    $(document).ready(function () {
        //Toggle fullscreen
        $(".chat-bot-icon").click(function (e) {
            $(this).children('img').toggleClass('hide');
            $(this).children('svg').toggleClass('animate');
            $('.chat-screen').toggleClass('show-chat');
        });
        $('.employee').click(function () {
            $('.chat-mail').addClass('hide');
            $('.chat-body').removeClass('hide');
            $('.chat-input').removeClass('hide');
            $('.chat-header-option').removeClass('hide');

            $(this).find('.pending').remove();
            receiver_id = $(this).attr('id');
            $.ajax({
                type: 'GET',
                url: 'message/'+ receiver_id,
                data: '',
                cache: false,
                success: (data)=> {
                    $('#messages').html(data);
                    scrollToBottomFunc();
                },
                error: (error) => {

                }
            })
        });
        $('.end-chat').click(function () {
            $('.chat-body').addClass('hide');
            $('.chat-input').addClass('hide');
            $('.chat-session-end').removeClass('hide');
            $('.chat-header-option').addClass('hide');
        });
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = false;

        var pusher = new Pusher('9b3e94e62e0ff0812fb4', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
        //   alert(JSON.stringify(data));
            if (my_id == data.from) {
                $('.scollmessage').append(`
                <div class="chat-bubble me">
                    ${data.message}
                    <p class="date">${data.date}</p>
                </div>
                `);
            } else if (my_id == data.to) {
                if (receiver_id == data.from) {
                    // if receiver is selected, reload the selected user ...
                    // $('#' + data.from).click();
                    $('.scollmessage').append(`
                    <div class="chat-bubble you">
                        ${data.message}
                        <p class="date">${data.date}</p>
                    </div>
                    `);
                } else {
                    // if receiver is not seleted, add notification for that user
                    var pending = parseInt($('#' + data.from).find('.pending').html());
                    if (pending) {
                        $('#' + data.from).find('.pending').html(pending + 1);
                    } else {
                        $('#' + data.from).append('<span class="pending">1</span>');
                    }
                }
            }
            scrollToBottomFunc();
        });

        // $('.user').on('click', function (e) {
        //     $('.user').removeClass('active');
        //     $(this).addClass('active');

        // })

        $(document).on('keyup','.chat-input input', function (e) {
            let message = $(this).val();
            if(e.keyCode == 13 && message != '' && receiver_id != '') {
                $(this).val('');

                let datastr = 'receiver_id='+receiver_id+'&message='+message;
                $.ajax({
                    type: 'POST',
                    url: 'message',
                    data: datastr,
                    cache: false,
                    success: (data)=> {
                        scrollToBottomFunc();
                    },
                    error: (error) => {

                    }
                }) 
            }
        })

        function scrollToBottomFunc() {
            $('.scollmessage').animate({
                scrollTop: $('.scollmessage').get(0).scrollHeight
            }, 50);
        }

    });

</script>