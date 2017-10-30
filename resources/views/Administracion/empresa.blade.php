@extends('layouts.app')

@section('content')
    <link href="css/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif

<div class="container">

    <form class="well form-horizontal" action=" " method="post"  id="contact_form">
<fieldset>

<!-- Form Name -->
<legend>Mi Empresa</legend>

<div class="row">

  <!-- Text input-->
  <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="form-group">
      <a  id="archivobtn" type="button" value="Seleccionearchivo" ><output id="list"><img src="/img/companyDefault.png" alt="Compañia" height="142" width="142" class="img-rounded"></output></a>
    </div>
  </div>

  <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="form-group">
      <label class="control-label" ><FONT SIZE=22 color="cian">Compañia</FONT></label>
    </div>
  </div>

  <input type="file" id="files" name="files" style="display:none;" />
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
    <button type="submit" class="btn btn-warning" >Send <span class="glyphicon glyphicon-send"></span></button>
  </div>
</div>

</fieldset>
</form>
    </div><!-- /.container -->

    <script type="text/javascript">
    $(document).ready(function() {
 $('#contact_form').bootstrapValidator({
     // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
     feedbackIcons: {
         valid: 'glyphicon glyphicon-ok',
         invalid: 'glyphicon glyphicon-remove',
         validating: 'glyphicon glyphicon-refresh'
     },
     fields: {
         first_name: {
             validators: {
                     stringLength: {
                     min: 2,
                 },
                     notEmpty: {
                     message: 'Please supply your first name'
                 }
             }
         },
          last_name: {
             validators: {
                  stringLength: {
                     min: 2,
                 },
                 notEmpty: {
                     message: 'Please supply your last name'
                 }
             }
         },
         email: {
             validators: {
                 notEmpty: {
                     message: 'Please supply your email address'
                 },
                 emailAddress: {
                     message: 'Please supply a valid email address'
                 }
             }
         },
         phone: {
             validators: {
                 notEmpty: {
                     message: 'Please supply your phone number'
                 },
                 phone: {
                     country: 'US',
                     message: 'Please supply a vaild phone number with area code'
                 }
             }
         },
         address: {
             validators: {
                  stringLength: {
                     min: 8,
                 },
                 notEmpty: {
                     message: 'Please supply your street address'
                 }
             }
         },
         city: {
             validators: {
                  stringLength: {
                     min: 4,
                 },
                 notEmpty: {
                     message: 'Please supply your city'
                 }
             }
         },
         state: {
             validators: {
                 notEmpty: {
                     message: 'Please select your state'
                 }
             }
         },
         zip: {
             validators: {
                 notEmpty: {
                     message: 'Please supply your zip code'
                 },
                 zipCode: {
                     country: 'US',
                     message: 'Please supply a vaild zip code'
                 }
             }
         },
         comment: {
             validators: {
                   stringLength: {
                     min: 10,
                     max: 200,
                     message:'Please enter at least 10 characters and no more than 200'
                 },
                 notEmpty: {
                     message: 'Please supply a description of your project'
                 }
                 }
             }
         }
     })
     .on('success.form.bv', function(e) {
         $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
             $('#contact_form').data('bootstrapValidator').resetForm();

         // Prevent form submission
         e.preventDefault();

         // Get the form instance
         var $form = $(e.target);

         // Get the BootstrapValidator instance
         var bv = $form.data('bootstrapValidator');

         // Use Ajax to submit form data
         $.post($form.attr('action'), $form.serialize(), function(result) {
             console.log(result);
         }, 'json');
     });
});

        function archivo(evt) {
              var files = evt.target.files; // FileList object

                //Obtenemos la imagen del campo "file".
              for (var i = 0, f; f = files[i]; i++) {
                   //Solo admitimos imágenes.
                   if (!f.type.match('image.*')) {
                        continue;
                   }

                   var reader = new FileReader();

                   reader.onload = (function(theFile) {
                       return function(e) {
                       // Creamos la imagen.
                              document.getElementById("list").innerHTML = ['<img height="142" width="142" class="img-rounded" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                       };
                   })(f);

                   reader.readAsDataURL(f);
               }
        }

      document.getElementById('files').addEventListener('change', archivo, false);


      $('#archivobtn').click(function () {
          $("#files").click();
      });
    </script>
@endsection
