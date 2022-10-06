<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Link Shortener</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <div class="container mx-auto mt-5 px-4">
    <h1 class="text-3xl">
      Link Shortener of smasa.id
    </h1>
    @if (session()->has('success'))
      <p class="text-green-500">{{ session()->get('success') }}</p>
    @endif
    <form class="w-full max-w-lg mt-5" action="/" method="post" role="form" autocomplete="off">
      @csrf
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
            Link name
          </label>
          <input class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('name')border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="name" name="name" type="text" placeholder="Name of Link" required value="{{ old('name') }}">
          @error('name')
          <p class="text-red-500 text-xs italic">{{ $message }}</p>
          @enderror
        </div>
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="link">
            Very long Link
          </label>
          <input class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('link')border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="link" name="link" type="url" placeholder="Input Your Link" required value="{{ old('link') }}">
          @error('link')
          <p class="text-red-500 text-xs italic">{{ $message }}</p>
          @enderror
        </div>
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="shortlink">
            Shortened Link
          </label>
          <input class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('shortlink')border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="shortlink" name="shortlink" type="text" placeholder="Short Your Link" required value="{{ old('shortlink') }}">
          <span id="errorshort"></span>
          @error('shortlink')
          <p class="text-red-500 text-xs italic">{{ $message }}</p>
          @enderror
        </div>
      </div>
      <button id="genrand" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" type="button">
        Generate Random Link
      </button>
      <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" type="submit" id="send">
        SHORT YOUR LINK
      </button>
    </form>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
  const characters ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_';
    function generateString(length) {
    let result = '';
    const charactersLength = characters.length;
    for ( let i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}
$(document).ready(function (){
$('#genrand').click(function (e) { 
  e.preventDefault();
  $("#shortlink").val(generateString(7));
})
$('#shortlink').on('input',function(){
  var not_valid ='';
  var shortlink=$('#shortlink').val();
  var _token=$('input[name="_token"]').val();
  var filter = /^([a-zA-Z0-9_-])/
      if(!filter.test(shortlink))
      {
        $('#errorshort').html('<p class="text-red-500 text-xs italic">Shortlink tidak sesuai kriteria</p>');
        $('#shortlink').addClass('border-red-500');
        $('#send').attr('disabled', 'disabled');
      }else{
        $.ajax({
          url:"{{ route('cekLink') }}",
          method:"POST",
          data:{shortlink:shortlink, _token:_token},
      success:function(response)
      {
        if(response.status=='success')
        {
          $('#errorshort').html('<p class="text-green-500 text-xs italic">'+response.msg+'</p>');
          $('#shortlink').removeClass('border-red-500');
          $('#shortlink').addClass('border-green-500');
          $('#send').attr('disabled', false);
        }
        else
        {
          $('#errorshort').html('<p class="text-red-500 text-xs italic">'+response.msg.shortlink+'</p>');
          $('#shortlink').addClass('border-red-500');
          $('#send').attr('disabled', 'disabled');
        }
      }
    })
  }
})
// $('#send').click(function () { 
//   $.ajax({
//     url:"{{ route('store') }}",
//     method:"POST",
//     data:
//   })
//  })
});
</script>
</html>