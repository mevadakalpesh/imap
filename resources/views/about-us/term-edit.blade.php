@extends('layouts.app')

@section('content')
<div class="row page-titles mx-0">
  <div class="col-sm-6 p-md-0">
    <div class="welcome-text">
      <h4>Terms & Condition</h4>
    </div>
  </div>
  <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    </ol>
  </div>
</div>
<!-- row -->
<div class="row">

  <div class="col-12">
    <div class="card">
      <div class="card-body">

        <form action="{{ route('aboutUsUpdate') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" value="{{ $theAboutUs->id }}">
          <input type="hidden" name="type" value="{{ $theAboutUs->type }}">
         
          <div class="form-group">
            <label class="form-label">Name (EN)</label>
            <input type="text" value="{{ old('nameEn',$theAboutUs->nameEn)  }}" name="nameEn" class="form-control">
          </div>
          
          <div class="form-group">
            <label class="form-label">Name (AR)</label>
            <input type="text" value="{{ old('nameAr',$theAboutUs->nameAr)  }}" name="nameAr" class="form-control">
          </div>
          
          
          <div class="form-group">
            <label class="form-label">Description (EN)</label>
            <textarea name="descriptionEn" class="form-control" cols="30" rows="10">{{ old('descriptionEn',$theAboutUs->descriptionEn)  }}</textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Description (AR)</label>
            <textarea name="descriptionAr" class="form-control" cols="30" rows="10">{{ old('descriptionAr',$theAboutUs->descriptionAr)  }}</textarea>
          </div>
      
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection


@push('js')

@endpush