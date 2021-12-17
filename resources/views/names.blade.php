@extends('layouts.default')
@section('content')

    <div class="bg-secondary text-white p-2 mb-3">
      <h4 class="m-0">{{ ucfirst(@$cat) }} Baby Names</h4>
    </div>

    @if(@count($childern) > 0)
      <div class="p-0 mb-3 child-cat-outer">
      <h5 class="m-0"> {{ ucfirst(@$cat) }} All Categories  </h5>
      @php
       
      $categories =  (@$childern->count()) ? @$childern->pluck('name','slug') : [];

      @endphp
      </br>
      @foreach ( $categories as $ck => $category )
         
         <a href='{{ route("baby-names","$ck")}}' class="btn btn-success btn-sm child-cat">{{ $category }} 
         </a>

      @endforeach
     </div>
    @endif

    <p>Currently we have <span class="boy"> {{ $boys }} Boys </span> Names and <span class="girl">{{ $girls }} Girls </span> Names with Meanings in our {{ ucfirst(@$cat) }} collection <br> Please Choose a Letter</p>
    <div class="topcolor btn">Boys</div>
    @php
     $alphas = range('A', 'Z');
    @endphp
    <hr class="mt-0">
        <div class="mb-3 fr">
            @foreach($alphas as $alpha)
                 <li>
                    <a href='{{route("baby-names.letter",[$cat,"boy", $alpha])}}'> {{ $alpha }}</a>
                  </li>
            @endforeach

        </div>

    <div class="topcolorG btn">Girls</div>
    <hr class="mt-0">
        <div class="mb-3 fr">
           @foreach($alphas as $alpha)
                 <li>
                    <a href='{{route("baby-names.letter",[$cat,"girl",$alpha] ) }}'> {{ $alpha }}</a>
                  </li>
            @endforeach
        </div>  

@stop