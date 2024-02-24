<!DOCTYPE html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
			  integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8="
			  crossorigin="anonymous"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>




<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">   
   <body>  
   <div class="container">

   <div class="alert alert-success" style="display:none; width:800px; margin-top:20px;">
            <p id="message"></p>
    </div>

    <a href="{{route('add_post')}}"  style="margin-top:20px;"   class="btn btn-primary">Add New Post</a>
   <table class="table table-bordered" >
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Post Title</th>
      <th scope="col">Details</th>
      <th scope="col">Submitted By</th>
      <th scope="col">Comments</th>
    </tr>
  </thead>
  <tbody>
    <p style="margin-top:50px;">Post Details</p>
    @if(!empty($posts))
    @foreach($posts as $key=>$post)
    <tr>
      <th scope="row">{{$key+1}}</th>
      <td>{{$post->title}}</td>
      <td>{{$post->details}}</td>
      <td>{{$post->user->name}}</td>
      <td>@if(!empty($post->comments))
        @foreach($post->comments as $comment)
        <p>{{$comment->comment}}</p>
        @endforeach
        @endif
      </td>
    </tr>
    @endforeach
    @endif
   
  </tbody>
</table>


    

</div>
  
   </body>    

   @vite('resources/js/app.js')
   <script>    
        setTimeout(() => {
            window.Echo.channel('soumitra')
            .listen('.App\\Events\\SendBlogNotification', (e)=>{
                    console.log(e);
                    var div = document.getElementById('message');   
                    if(e.data!=''){
                        $('.alert-success').show();
                        div.innerHTML = e.data
                    }     else{
                        $('.alert-success').hide();
                        div.innerHTML='';
                    }            
                    
            });
        }, 5000);
    </script>
  
</html>
