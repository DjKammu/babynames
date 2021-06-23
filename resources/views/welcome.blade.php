@extends('layouts.default')
@section('content')
  <div class="p-4 p-md-5 mb-4 text-white rounded banner">
    <div class="col-md-6 px-0">
      <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
      <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
      <p class="lead mb-0"><a href="#" class="text-white fw-bold">Continue reading...</a></p>
    </div>
  </div>

 <div>
      <p>BabyNamesWizards.com has been a trusted source of names for 25 years. Whether you're choosing a name for your baby or just love names, you've come to the right place! Here you can research the meaning of names, history, origin, etymology, and fun name facts of over 20,000 first and last names.</p>
    </div>
  
  @foreach($categories as $category)
        <div class="bg-secondary text-white p-2 mb-3">
          <h4 class="m-0"> {{ $category->name }} Baby Names</h4>
        </div>
        <p>Currently we have {{ @$category->names->where('gender',\App\Name::MALE)->count()}} Boys Names and {{ @$category->names->where('gender',\App\Name::FEMALE)->count()}} Girls Names with Meanings in our American collection <br> Please Choose a Letter</p>

        <div class="topcolor btn">Boys</div>
        @php
         $alphas = range('A', 'Z');
        @endphp
        <hr class="mt-0">
            <div class="mb-3 fr">
              @foreach($alphas as $alpha)
                 <li > 
                    <a href='{{ route("baby-names.letter",[$category->slug,"boy", $alpha])}}'> {{ $alpha }}</a>
                  </li>
            @endforeach
            </div>

        <div class="topcolorG btn">Girls</div>
        <hr class="mt-0">
            <div class="mb-3 fr">
             @foreach($alphas as $alpha)
                 <li  >
                    <a href='{{ route("baby-names.letter",[$category->slug,"girl",$alpha] )}}'> {{ $alpha }}</a>
                  </li>
            @endforeach
            </div>
      @endforeach


@stop