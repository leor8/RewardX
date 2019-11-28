$(document).ready(function() {
  $(".removeFavBtn").on("click", function(events) { // Detect

    var storeId = $(events.target).attr('id'); // Get button's attached id

    var data = {
      removeId: storeId
    }

    $.ajax({
        url: 'removeFavFromDash.php',
        type: 'POST',
        data: data,
      })
      .done(function(data) {
        if(data == 1) {
          $(events.target).parent().remove();
        } else if(data == 0) {
          alert("There is a problem removing your favorite. Please try again later.");
        }

      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });

  })
})