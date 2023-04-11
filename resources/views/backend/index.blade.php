@extends('layouts.backend-layout')

@section('CssPart')

@endsection

@section('body')



@endsection






@section('JavaScriptPart')
<script>
    function showAlert(message) {
        alert(message);
    }

    @if(session()->has('notice'))
    showAlert("{{ session('notice') }}");
    @endif
</script>
@endsection
