@extends('layout')
@section('content')
<form enctype="multipart/form-data" method="POST" id="imageUploadForm" action="thread/upload-image">
    @csrf
    {{-- <input type="file" name="imageUpload" id="newImageFile"> --}}
    <input type="text" name="question_id">
    <button type="submit"> fefefw</button>
</form>
@endsection
