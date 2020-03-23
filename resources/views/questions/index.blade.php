@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Questions</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.create')}}" class="btn btn-outline-secondary">
                                Ask Question
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('layouts._messages')
                    
                    @foreach ($questions as $data)
                        <div class="media">
                            <div class="d-flex flex-column counters">
                                <div class="vote">
                                    <strong>{{ $data->votes }}</strong> {{ str_plural('vote', $data->votes )}}
                                </div>
                                <div class="status {{$data->status}}">
                                    <strong>{{ $data->answers }}</strong> {{ str_plural('answer', $data->votes )}}
                                </div>
                                <div class="view">
                                    {{ $data->views .' '. str_plural('view', $data->votes )}}
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="d-flex align-items-center">
                                    <h3 class="mt-0"><a href="{{ $data->url }}">{{ $data->title }}</a></h3>
                                    <div class="ml-auto">
                                        <a href="{{route('questions.edit', $data->id )}}" class="btn btn-sm btn-outline-info">Edit</a>
                                        <form class="form-delete" action="{{ route('questions.destroy', $data->id)}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                
                                <p class="lead">
                                    Asked by 
                                    <a href="{{ $data->user->url}}">
                                        {{ $data->user->name}}
                                    </a>
                                    <small class="text-muted">{{ $data->created_date }}</small>
                                </p>
                                    {{ str_limit($data->body, 250) }}
                            </div>    
                        </div>   
                        <hr>
                    @endforeach
                    
                    <div class="mx-auto">
                        {{$questions->links() }}
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
