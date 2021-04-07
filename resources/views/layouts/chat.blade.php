@extends('front-end.layouts.main')

@section('title')
    Chat
@endsection

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
        /* width */
        ::-webkit-scrollbar {
            width: 7px;
        }
        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #a7a7a7;
        }
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #929292;
        }
        ul {
            margin: 0;
            padding: 0;
        }
        li {
            list-style: none;
        }
        .user-wrapper, .message-wrapper {
            border: 1px solid #dddddd;
            overflow-y: auto;
        }
        .user-wrapper {
            height: 600px;
        }
        .user {
            cursor: pointer;
            padding: 5px 0;
            position: relative;
        }
        .user:hover {
            background: #eeeeee;
        }
        .user:last-child {
            margin-bottom: 0;
        }
        .pending {
            position: absolute;
            left: 13px;
            top: 9px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;
        }
        .media-left {
            margin: 0 10px;
        }
        .media-left img {
            width: 64px;
            border-radius: 64px;
        }
        .media-body p {
            margin: 6px 0;
        }
        .message-wrapper {
            padding: 10px;
            height: 536px;
            background: #eeeeee;
        }
        .messages .message {
            margin-bottom: 15px;
        }
        .messages .message:last-child {
            margin-bottom: 0;
        }
        .received, .sent {
            width: 45%;
            padding: 3px 10px;
            border-radius: 10px;
        }
        .received {
            background: #ffffff;
        }
        .sent {
            background: #3bebff;
            float: right;
            text-align: right;
        }
        .message p {
            margin: 5px 0;
        }
        .date {
            color: #777777;
            font-size: 12px;
        }
        .active {
            background: #eeeeee;
        }
        input[type=text].message {
            width: 100%;
            padding: 12px 20px;
            margin: 15px 0 0 0;
            display: inline-block;
            border-radius: 4px;
            box-sizing: border-box;
            outline: none;
            border: 1px solid #cccccc;
        }
        input[type=text]:focus {
            border: 1px solid #aaaaaa;
        }
    </style>
<div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="user-wrapper">
                    <ul class="users">
                            @foreach($users as $user)
                            <li class="user" id="{{ $user->id }}">
                                @if($user->unread)
                                    <span class="pending">{{ $user->unread }}</span>
                                @endif  
                                <div class="media">
                                    <div class="media-left">
                                        <img src="https://via.placeholder.com/150" alt="" class="media-object">
                                    </div>
                                    <div class="media-body">
                                        <p class="name">{{ $user->name }}</p>
                                        <p class="email">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-8" id="messages">
                <!-- render Message -->
            </div>
        </div>
    </div>

<script>

let receiver_id = '';
let my_id = '{{ Auth::id() }}';

$(document).ready((e)=> {
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('9b3e94e62e0ff0812fb4', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
        //   alert(JSON.stringify(data));
            if (my_id == data.from) {
                $('.messages').append(`
                <li class="message clearfix">    
                    <div class="sent">
                        <p>${data.message}</p>
                        <p class="date">${data.date}</p>
                    </div>
                </li>             
                `);
            } else if (my_id == data.to) {
                if (receiver_id == data.from) {
                    // if receiver is selected, reload the selected user ...
                    // $('#' + data.from).click();
                    $('.messages').append(`
                    <li class="message clearfix">    
                        <div class="received">
                            <p>${data.message}</p>
                            <p class="date">${data.date}</p>
                        </div>
                    </li>             
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

        $('.user').on('click', function (e) {
            $('.user').removeClass('active');
            $(this).addClass('active');
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
        })

        $(document).on('keyup','.input-text input', function (e) {
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
            $('.message-wrapper').animate({
                scrollTop: $('.message-wrapper').get(0).scrollHeight
            }, 50);
        }
})
</script>
@endsection