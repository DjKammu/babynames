@php

$categories = App\Category::with('childern')->get();

@endphp

<div class="bg-secondary text-white p-2 mb-3">
      <h4 class="m-0">Search</h4>
</div>

<form>
  <div class="row">
    <div class="col">
      <select class="form-select"  name="category" required="required">
            <option value="" disabled="disabled">Category</option>

            @foreach($categories as $cat)
             
             <option value="{{ $cat->slug }}">{{ $cat->name }}</option>

             @if($cat->childern)
                 @foreach($cat->childern as $childCat)
                    <option value="{{ $childCat->slug }}">◦ {{ $childCat->name }}</option>
                 @endforeach
             @endif

            @endforeach

         </select>
    </div>

    <div class="col">
      <div class="custom-control custom-radio custom-control-inline">
        <input class="custom-control-input" type="radio" name="gender" value="girl" id="girl" required="">
        <label class="custom-control-label" for="girl">
         Girl
        </label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input class="custom-control-input" type="radio" name="gender" id="boy" value="boy" checked required="">
        <label class="custom-control-label" for="boy">
          Boy
        </label>
      </div>
    </div>
  </div> 
  <div class="row ml-1">
    <div class="col">
      <select class="form-select" name="term">
            <option value="begins">Starting from</option>
            <option value="contains">Contains</option>
            <option value="ends" selected="selected">Ends with</option>
            <option value="meaning">Meaning</option>
       </select>
    </div>
    <div class="col">
      <input type="text" class="form-control" name="word" style="text-transform:capitalize" pattern="[A-Za-z ]{1,}" placeholder="Search" value="" size="5" required="required">
    </div>
  </div>
  </br>
  <div class="row ml-1">
    <div class="col text-center">
      <button type="submit" class="topcolor btn">Submit</button>
    </div>
  </div>
</form>

 @section('pagescript')
    
<script type="text/javascript">
  
  $("form").submit(function(e) {
    e.preventDefault();
    
    let category = $('select[name="category"]').val();

    let gender = $('input[name="gender"]:checked').val(); 

    let term = $('select[name="term"]').val();
    
    let word = $('input[name="word"]').val();

    window.location.href = '{{ url("baby-names") }}/'+category+'/'+gender+'/'+term+'/'+word;
     
});
</script>

  @endsection