 @extends('layouts.app')  

 @section('content') 
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            
            <!-- Current Tasks -->
            @if (count($films) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Films
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Film</th>
                                <th>Price</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($films as $film)
                                    <tr>
                                        <td class="table-text"><div>{{ $film->name }}</div></td>
                                        <td class="table-text"><div>{{ $film->price }}</div></td>

                                        <!-- Task Delete Button -->
                                        @if (!Auth::guest())
                                        <td class="col-sm-3">
                                            <form action="{{ route('film.destroy', ['id' => $film->id]) }}" method="POST">
                                                
                                                 {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                        @endif
                                        <td>
                                           
                                                <a href="{{route('film.show', ['id' => $film->id]) }}" class="btn btn-primary">
                                                    <i class="fa fa-btn fa-search"></i>Details
                                                </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                         {{ $films->links() }} 
                    </div>
                </div>
            @endif
            @if(count($films) == 0)
                <h2>There are no films at the moment...</h2>
            @endif
        </div>
    </div>
 @endsection 
