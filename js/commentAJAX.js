$(document).ready(function() {
  $(".submitBtn").on('click', function(events) {
    events.preventDefault();

    // Modifiy the serialized form with the store id retrieved from the icon called selectable
    // The selectable class will only be added if there is a current user and the form is only accessible by people who logged in
    // Therefore there is no reason for double checking
    data = $(".commentForm").serialize() + '&storeId=' + $(".selectable").attr("id");

    $.ajax({
        url: 'newComment.php',
        type: 'POST',
        data: data,
      })
      .done(function(data) {
        $(".commentSection").prepend(data); // Prepend the new comment (received from data) to the comment section

        let newRating = $(".updatedRatings")[0].innerHTML; // The updated ratings came back in the data
        $(".updatedRatings").remove(); // Remove the updatedRatings tag

        $(".score")[0].childNodes[0].nodeValue = newRating + " Satisfaction Score "; // Updating the score, the score is text within a span tag so I had to access the childNode

        $(".commentForm").trigger("reset"); // Reset the form
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
  })
});