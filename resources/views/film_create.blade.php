@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Film
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form action="{{ route('film.store')}}" method="POST" class="form-horizontal" 
                        enctype="multipart/form-data">
                        
                        {{ csrf_field() }}

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" required id="film-name" class="form-control" value="{{ old('name') }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-3">
                            @foreach ($genres as $genre)
                              
                              <label class="checkbox-inline"><input type="checkbox" name="genre[]" onclick='handleClick(this);' value="{{$genre->genre}}" required>{{$genre->genre}}</label>
                             @endforeach
                             </div>
                        </div>
                        <div class="form-group">
                            <label for="film-description" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-6">
                                <textarea name="description" required id="film-description" class="form-control" value="{{ old('description') }}"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="film-price" class="col-sm-3 control-label">Price</label>

                            <div class="col-sm-6">
                                <input type="text" name="price" required id="film-price" class="form-control" value="{{ old('price') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="film-rating" class="col-sm-3 control-label">Rating</label>

                            <div class="col-sm-6">
                                <!--input type="text" name="rating" id="film-rating" class="form-control" value="{{ old('film') }}" >
                                 <label for="sel1">Select list:</label-->
                                  <select name="rating" class="form-control" id="sel1" value="{{ old('rating') }}">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>

                                  </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="film-country" class="col-sm-3 control-label">Country</label>

                            <div class="col-sm-6">
                                <input type="text" name="country" required id="film-country" class="form-control" value="{{ old('country') }}">
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="image" class="col-sm-3 control-label" >Film image:</label>
                                <div class="col-sm-6">
                                    <input type="file" id="image" name="image" 
                                        accept="image/png, image/jpeg" />
                                </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Film
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
<script type="text/javascript">
    

   
    
    function handleClick(cb){
       var requiredCheckboxes = $(':checkbox');
       var inputs = document.querySelectorAll('input[type=checkbox]')
       var selected = false;
       for(var i= 0; i < inputs.length; i++){
            if(inputs[i].checked){
              selected = true;
              break;  
            }
        }
        if(!selected){
            for(var i= 0; i < inputs.length; i++){
                inputs[i].required = true;
            }
        }
        else{
            for(var i= 0; i < inputs.length; i++){
                inputs[i].required = false;
            }
        }
    }

</script>
