document.addEventListener("DOMContentLoaded", function() {

    // If user complete the form and sign up: send mail, track in segment and show next section: confirm
    jQuery(".sendme").on('click', function(){
        // @todo: validate data
        // @todo: segmenet integration
        // @todo: send email

        // Fadeout form
        jQuery(".access").fadeOut(500);
        // Fadein confirm email
        jQuery(".confirm").delay(500).fadeIn(500);
        // Avoid to send via get/post the form
        return false;
    });

    // If user click on back button
    jQuery(".back").on('click', function(){
        var back = Number(this.className.split("back backto-")[1]);
        // Hide current question
        jQuery("#quiz"+ (back+1) ).fadeOut(500);
        // Show previous question
        jQuery("#quiz"+back).delay(500).fadeIn(500);
    });

    // If user click in any option of the quiz
    jQuery(".options li, .goToNext").on('click', function(){
        // Remove all active class to all .option>li elements
        jQuery(".options li").removeClass("active");
        // Add active class to clicked element
        jQuery(this).addClass("active");


        // Check if next step is a question or the form
        // if var next is a number = is a question
        // if var next is "access" go to the form 
        var next = this.className.replace(' active','').split("goto-")[1];
        if (next == "access") {
            last = jQuery(".quiz_total").val();
            // Fadeout last question
            jQuery("#quiz"+last).fadeOut(500);
            // Show form
            jQuery(".access").delay(500).fadeIn(500);
        } else {
            // Hide current question
            jQuery("#quiz" + (Number(next)-1)).fadeOut(500);
            // Display next question
            jQuery("#quiz" + Number(next)).delay(500).fadeIn(500);
        }
    });

    // If user click on start quiz button: then the quiz start
    jQuery(".start").on('click', function(){
        // Fadeout .startpage
        jQuery(".startpage").fadeOut(500);
        // Display first question
        jQuery("#quiz1").delay(500).fadeIn(500);
    });


});

