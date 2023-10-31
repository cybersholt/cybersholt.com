<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sean W.</title>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<link href='css/main.css' rel='stylesheet' type='text/css'>
</head>
<body>
<div id="wrapper">
	<div id="contact">
		<h1>Send Me a Message</h1>
		<div id="contact-additional">
			<div id="form-instructions">
				<p style="text-align: center">
					<a href="https://www.upwork.com/freelancers/~0187ff090807338046" target="_blank" rel="nofollow"><img src="/img/tr-upwork-logo.png" alt="Top Rated on Upwork with 100% success!"
					                                                                                                     title="Top Rated on Upwork with 100% success!" width="500"></a>
				</p>
				<h2>All form fields are required.</h2>
				<p>
					Don't hesitate to contact me with any questions or comments. Please note that I am not currently taking on any web development projects.
				</p>
				<p>
					Thank you.
				</p>
			</div>
			<div id="form-wait" style="display: none;">
				<h2>Submitting...</h2>
				Your message is being processed.
			</div>
			<div id="form-failure" style="display: none;">
				<h2>An unknown error occurred.</h2>
				Please try submitting your message again.
			</div>
			<div id="form-errors" style="display: none;">
				<h2>Please correct the following errors:</h2>
				<div id="form-errors-inner">
				</div>
			</div>
			<div id="form-success" style="display: none;">
				<h2>Your message has been sent.</h2>
				<p>
					I do my best to respond to all inquiries within two business days.
				</p>
				<p>
					Thank you.
				</p>
			</div>
		</div>
		<div>
			<form id="message-form" name="message-form" method="post" action="extras/send.php">
				<label for="name">Your Name:</label>
				<input type="text" size="20" id="name" name="name">
				<br>
				<label for="email">Your Email Address:</label>
				<input type="text" size="20" id="email" name="email">
				<br>
				<label for="subject">Subject:</label>
				<input type="text" size="20" id="subject" name="subject">
				<br>
				<label for="message">Message:</label>
				<textarea name="message" id="message" rows="4" cols="50"></textarea>
				<br>
				<script type="text/javascript">
                    var RecaptchaOptions = {
                        theme: 'clean'
                    };
				</script>
				<label>Spam Prevention:</label>
				<script src="https://www.google.com/recaptcha/api.js" async defer></script>
				<div class="g-recaptcha" data-sitekey="6LfEQxITAAAAALulMFYk-CLaTG8gP-acjt2cH4RL"></div>
				<input type="submit" value="Send Message" name="submit" id="submit">
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#contact-additional').children().hide();
        $('#form-instructions').show();
    });

    $('#message-form').submit(function () {
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        var easingType = "easeOutQuint";
        var formDuration = 750;

        $('#contact-additional').children().stop().hide();
        $('#form-wait').fadeIn({duration: formDuration, easing: easingType});

        $.ajax({
            type: "POST",
            url: formURL,
            data: postData,
            timeout: 5000,
            success: function (data) {
                if (data === true) {
                    $('#contact-additional').children().stop().hide();
                    $('#form-success').fadeIn({duration: formDuration, easing: easingType});
                    $('#message-form').find("input[type=text], textarea").val("");
                    Recaptcha.reload();
                } else {
                    $('#contact-additional').children().stop().hide();
                    $('#form-errors-inner').html(data);
                    $('#form-errors').fadeIn({duration: formDuration, easing: easingType});
                    grecaptcha.reset();
                }
            },
            error: function () {
                $('#contact-additional').children().stop().hide();
                $('#form-failure').fadeIn({duration: formDuration, easing: easingType});
            }
        });

        return false;
    });
</script>
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-70987009-1', 'auto');
    ga('send', 'pageview');
</script>
</body>
</html>