<form action="{{ route('admin.post.names.import') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-header">
          {{-- <strong>Select Excel Sheet</strong> --}}
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="name">Select Excel Sheet</label>
                <input class="form-control" id="name" name="import" type="file" required>
              </div>

              <div class="form-inline">
                <label for="name">Gender</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Male" required="">
                  <label class="form-check-label" for="inlineRadio1">Male</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Female" required="">
                  <label class="form-check-label" for="inlineRadio2">Female</label>
                </div>
              </div>

              <div class="form-group">
                <label for="name">Origin/Country</label>
                <select class="form-control" name="origins[]" multiple="" required="">
                   <option value=""> Select Country</option>
                   @php
                     $countries = \App\Country::pluck('title','id');
                   @endphp

                   @foreach($countries as $ck =>  $country)
                    <option value="{{ $ck}}"> {{ $country }}</option>
                   @endforeach


                </select>
              </div>

              <div class="form-group">
                <label for="name">Categories</label>
                <select class="form-control" name="categories[]" multiple="" required="">
                   <option value=""> Select Category</option>
                   @php
                     $categories = \App\Category::pluck('name','id');
                   @endphp

                   @foreach($categories as $ctk =>  $category)
                    <option value="{{ $ctk}}"> {{ $category }}</option>
                   @endforeach


                </select>
              </div>

              <div class="form-group">
                <label for="name">Tags</label>
                <select class="form-control" name="tags[]" multiple="" required="">
                   <option value=""> Select Tag</option>
                   @php
                     $tags = \App\Tag::pluck('name','id');
                   @endphp

                   @foreach($tags as $tk =>  $tag)
                    <option value="{{ $tk}}"> {{ $tag }}</option>
                   @endforeach


                </select>
              </div>

               <div class="form-inline">
                <label for="name">Publish</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="publish" id="inlineRadio1" value="1" required="">
                  <label class="form-check-label" for="inlineRadio1">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="publish" id="inlineRadio2" value="0" required="">
                  <label class="form-check-label" for="inlineRadio2">No</label>
                </div>
              </div>

                

                <button style="background-color: indigo;border: none;color: #ffff;padding: 12px 14px;border-radius: 10px;margin: 10px;">Import</button>
            </div>
          </div>
          <!-- /.row-->
        </div>
      </div>
    </div>
  </div>
</form>
