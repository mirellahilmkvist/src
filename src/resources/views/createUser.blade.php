@extends('master')


@section('content')



<h1 class="header center green-text text-lighten-1-2">Registrera nytt företag</h1>



  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="center-align">
        <div class="col s12 m4">


      <div class="row">
       <form method="POST" action="{{ route('register') }}"  class="col s12">
         @csrf

         <div class="row">
           <div class="input-field col s12">
            <input placeholder="Name" id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

           </div>

         </div>
         <div class="row">
           <div class="input-field col s12">
             <input placeholder="Company Name" id="company_name" type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ old('company_name') }}" required autofocus>
             @if ($errors->has('name'))
                 <span class="invalid-feedback">
                     <strong>{{ $errors->first('name') }}</strong>
                 </span>
             @endif

           </div>

         </div>
         <div class="row">
           <div class="input-field col s12">
          <input placeholder="Org Nr" id="org_nr" type="text" class="form-control{{ $errors->has('org_nr') ? ' is-invalid' : '' }}" name="org_nr" value="{{ old('org_nr') }}" required autofocus>

          @if ($errors->has('org_nr'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('org_nr') }}</strong>
              </span>
          @endif
           </div>
         </div>

         <div class="row">
           <div class="input-field col s12">
              <input placeholder="Email" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

              @if ($errors->has('email'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif

           </div>
         </div>
         <div class="row">
           <div class="input-field col s12">
               <input placeholder="Password" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
               @if ($errors->has('password'))
                   <span class="invalid-feedback">
                       <strong>{{ $errors->first('password') }}</strong>
                   </span>
               @endif
           </div>
         </div>
         <div class="row">
           <div class="input-field col s12">
               <input placeholder="Confirm password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

           </div>
         </div>

         <div class="row">
           <div class="col s12">
             <button type="submit" class="btn-large waves-effect waves-light green lighten-1">
                  {{ __('Register') }}


           </div>
         </div>
       </form>
     </div>


          </div>
        </div>
      </div>

    </div>

  @endsection
