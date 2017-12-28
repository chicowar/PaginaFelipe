$(document).ready(function() {
/*
  $('#tarjetaForm').on('submit',function(e){
  e.preventDefault();

  alert('aquiestoy');
NuevaTarjetax();
  });
*/
  $('#tarjetaForm').bootstrapValidator({
 // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later

 feedbackIcons: {
     valid: 'glyphicon glyphicon-ok',
     invalid: 'glyphicon glyphicon-remove',
     validating: 'glyphicon glyphicon-refresh'
 },
 submitHandler: function(validator, form, submitButton) {

event.preventDefault();

NuevaTarjetax();

    $('#tarjetaForm').data('bootstrapValidator').resetForm();




/*
    var bv = form.data('bootstrapValidator');
    // Use Ajax to submit form data
    $.post(form.attr('action'), form.serialize(), function(result) {
        console.log(result);
    }, 'json');

*/



},
 fields: {
     first_name: {
         validators: {
                 stringLength: {
                 min: 2,
                 message: 'Es necesario ingresar el nombre'
             },
                 notEmpty: {
                 message: 'Es necesario ingresar el nombre'
             }
         }
     },

     email: {
         validators: {
             notEmpty: {
                 message: 'Es necesario ingresar el correo electronico'
             },
             emailAddress: {
                 message: 'Por favor ingresa una direccion de correo valida'
             }
         }
     },
     phone: {
         validators: {
             notEmpty: {
                 message: 'Por favor ingresa un numero de telefono a 10 digitos'
             },
             stringLength: {
                       min: 10,
                       max: 10,
                       message: 'El telefono debe ser a 10 digitos (lada + numero)'
                   },


         }
     },
     whatsapp: {
         validators: {

             stringLength: {
                       min: 10,
                       max: 10,
                       message: 'El numero debe ser a 10 digitos o dejar vacio si no se desea utilizar whatsapp'
                   },


         }
     },

     puesto: {
         validators: {
              stringLength: {
                 min: 2,
                 message: 'Es necesario ingresar el puesto'
             },
             notEmpty: {
                 message: 'Es necesario ingresar el puesto'
             }
         }
     },



     }
 })
        .on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

/*
            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function(result) {
                // ... Process the result ...
            }, 'json');*/
        });
});
