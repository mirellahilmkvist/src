@extends('master')

@section('content')


<div class="container" id="applyDiv">
    <h4 class="header center green-text">APPLY FOR MEMBERSHIP</h4>
    <div class="row center">
        <p class="light">
            By submitting your company details you can get access to StoryTourist and create your own 
            customized stories for your audience to enjoy around the world!
        </p>
        <div class="input-field col s12">
            <i class="material-icons prefix green-text">business</i>
            <input placeholder="Company Name" type="text" class="validate">
        </div>
        <div class="input-field col s12">
            <i class="material-icons prefix green-text">mail outline</i>
            <input placeholder="Company e-mail" type="text" class="validate">
        </div> 
        <div class="input-field col s12">
            <i class="material-icons prefix green-text">phone</i>
            <input placeholder="Company phone-number" type="text" class="validate">
        </div> 
        <div class="input-field col s12">
          <i class="material-icons prefix green-text">mode_edit</i>
          <input placeholder="Message us..." textarea id="textArea1" class="materialize-textarea"></textarea>
        </div>
</div>        
    <div class="row center padding-bottom-1">
        <a class="btn-small green" id="sendButton">Submit details</a>
    </div>
</div>



@endsection 