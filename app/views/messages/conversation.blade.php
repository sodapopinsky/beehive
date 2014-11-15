

 
      <div class="mails">
      @foreach($messages as $message)

       <div class="item">
       

          <div>
            <span class="date pull-right">{{$message->created_at}}</span>
            <h4 class="from">{{$message->fromUser()->first()->firstName}}</h4>
            <p class="msg">{{$message->message}}</p>
          </div>
        
</div>

      @endforeach
       
          

      </div>