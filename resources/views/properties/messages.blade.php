<br>
<div class="card">   
    <div class="message-wrapper">
        <ul class="messages">
            @foreach ($messages as $message)
                <li class="message clearfix">
                    {{-- if messaged user_id is equal to auth id then it is send by logged user --}}
                    @if ($message->user_id == Auth::id())
                        <div class="sent">
                            <p>{{$message->message}}</p>
                            <p class="date">{{date('d M y, h:i a', strtotime($message->created_at))}}</p>
                        </div>
                    @else 
                        <div class="received">
                            <p>{{$message->message}}</p>
                            <p class="date">{{date('d M y, h:i a', strtotime($message->created_at))}}</p>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div> 
<div class="input-text">
    <input type="text" name="message" class="submit">
</div>
