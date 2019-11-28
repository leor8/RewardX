$(document).ready(function() {


  // If filter radio button form clicked
  $('.startFilter').on('click', (events) => {
    events.preventDefault(); // Prevent page from reloading due to the form button being pressed

    let data = $(".filterRadios").serialize();

    $.ajax({
          url: 'searchFilterProcessing.php',
          type: 'POST',
          data: data,
        })
        .done(function(data) {
          $(".partnerFlex").empty();
          let result = $.parseJSON(data);

          result.forEach(function(item, key) {
            $(".partnerFlex").append(item);
          })
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });

  });

  // If name search is clicked
  $('.searchBtn').on('click', (events) => {
    events.preventDefault(); // Prevent page from reloading due to the form button being pressed

    let data = $(".filterHeader").serialize();

    $.ajax({
          url: 'searchFilterProcessing.php',
          type: 'POST',
          data: data,
        })
        .done(function(data) {
          $(".partnerFlex").empty();
          let result = $.parseJSON(data);

          result.forEach(function(item, key) {
            $(".partnerFlex").append(item);
          })
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
    });

  $('.partnerFlex').on('click', ".selectable", function(events) { // the on function to prevent dynamically added tag not being binded to the click event
    events.preventDefault(); // Prevent page from refreshing
    let storeId = $(events.target).parent()[0].id;
    let fav = 0;

    if($(events.target).attr("style")) {
      fav = 1
    }

    let data = {
      favId: storeId,
      liked: fav
    };

    $.ajax({
          url: 'editFav.php',
          type: 'POST',
          data: data,
        })
        .done(function(data) {
          if(data == "0") { // if the query failed
            if(fav == 0) { // send alert
              alert("There is a problem adding this store as your favorite. Please try again later.");
            } else {
              alert("There is a problem removing this store from your favorite. Please try again later.");

            }

          } else { // modify the frontend only
            if($(events.target).attr("style")) {
              $(events.target).replaceWith("<i class=\"far fa-star favSelect selectable\"></i>");
            } else {
              $(events.target).replaceWith('<i class="fas fa-star favSelect selectable" style="color: yellow"></i>');
            }
          }

        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
  });


  $('.score').on('click', ".selectable", function(events) { // the on function to prevent dynamically added tag not being binded to the click event
    events.preventDefault(); // Prevent page from refreshing
    let storeId = $(events.target).attr('id');
    let fav = 0;

    if($(events.target).attr("style")) {
      fav = 1
    }

    let data = {
      favId: storeId,
      liked: fav
    };


    $.ajax({
          url: 'editFav.php',
          type: 'POST',
          data: data,
        })
        .done(function(data) {
          console.log(data);
          if(data == "0") { // if the query failed
            if(fav == 0) { // send alert
              alert("There is a problem adding this store as your favorite. Please try again later.");
            } else {
              alert("There is a problem removing this store from your favorite. Please try again later.");

            }

          } else { // modify the frontend only
            if($(events.target).attr("style")) {
              $(events.target).replaceWith("<i class=\"far fa-star favSelect selectable\" id=\" " +storeId+ "\"></i>");
            } else {
              $(events.target).replaceWith('<i class="fas fa-star favSelect selectable" style="color: yellow; text-shadow: 0 0 1px #000;" id="' +storeId+ '"></i>');
            }
          }

        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
  });


})