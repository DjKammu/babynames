@extends('layouts.default')
@section('content')
    <div class="row">
    <div class="col-md-8">    
    <div class="bg-secondary text-white p-2 mb-3">
      <h4 class="m-0">{{ ucfirst(@$cat)}} {{ucfirst(@$gender)}} Names » {{ ucfirst(@$letter) }}</h4>
    </div>
    <p>Currently we have <span class="{{ $gender }}"> {{ ${Str::plural($gender)} }} {{ Str::plural( ucfirst(@$gender)) }} </span> Beginning with letter A in our {{ ucfirst(@$cat)}} collection Names </p>
    <div class="topcolor btn">Boys</div>
    @php
     $alphas = range('A', 'Z');
    @endphp
    <hr class="mt-0">
        <div class="mb-3 fr">
            @foreach($alphas as $alpha)
                 <li {{ (strtolower($alpha) == strtolower($letter)) && 
                 (strtolower($gender) == 'boy') ? 'class=alpha-active' : ''}} > 
                    <a href='{{ URL::to("names/$cat/boy/$alpha")}}'> {{ $alpha }}</a>
                  </li>
            @endforeach

        </div>

    <div class="topcolorG btn">Girls</div>
    <hr class="mt-0">
    <div class="mb-3 fr">
       @foreach($alphas as $alpha)
             <li {{ (strtolower($alpha) == strtolower($letter)) && 
             (strtolower($gender) == 'girl') ? 'class=alpha-active' : ''}} >
                <a href='{{ URL::to("names/$cat/girl/$alpha")}}'> {{ $alpha }}</a>
              </li>
        @endforeach
    </div>  
    
    <div class="table-responsive">
      <table class="table table-hover cursor">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Meanings</th>
            </tr>
          </thead>
          <tbody>
            @foreach($names as $key => $name)
                 @php @$bname = @strtolower($name->name); @endphp
                 <tr  onclick="window.location='{{ url("/name/$gender/$bname")}}';">
                      <th scope="row"> {{ $names->firstItem() + $key }}</th>
                      <td> {{ $name->name }} </td>
                      <td>{{ (@$name->meanings->count()) ? @$name->meanings->pluck('name')->join(', ') : 'Add Meaning' }}</td>
                 </tr>
            @endforeach

          </tbody>
        </table>

        {!! $names->render() !!}

    </div>
    </div>
    <div class="col-md-4">
        
    </div>
  </div>
@stop