/*
$("#btn-submit").click( function() {
 $.post( $("#register").attr("action"), 
         $("#register :input").serializeArray(), 
         function(info){ $("#result").html(info); 
  });
});
*/

// Variable to hold request
var request;

// Bind to the submit event of our form
$("#register").submit(function(event) {
  // Prevent default posting of form - put here to work in case of errors
  event.preventDefault();

  var valid = true;
  if (valid === false) {
  } else {
    // Abort any pending request
    if (request) {
      request.abort();
    }
    // setup some local variables
    var $form = $(this);

    // Let's select and cache all the fields
    var $inputs = $form.find("input, select, button, textarea");

    // Serialize the data in the form
    var serializedData = $form.serialize();

    d_saveNewUser(serializedData).then(
      user => {
        window.location = "/developerDashboard.php";
      },
      () => {}
    );
  }
});
