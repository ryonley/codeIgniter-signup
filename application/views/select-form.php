<!--<p><br />Page rendered in {elapsed_time} seconds</p>-->
<?php // var_dump($price); ?>
<div id="planbox">

<div class="header">Select Your Plan</div>

<!--<form action="index.php/welcome/select_plan" method="post">-->
<form action="index.php/signup/select_plan" method="post">

<div class="column">

<div class="planinputbox"><label for="plan"><input name="plan" type="radio" value="Plus Individual" />$8.95/ Individual</label> <label for="plan"><input name="plan" type="radio" value="Plus Family" />$12.95/ Family</label> <span class="per"> / month</span></div>

<h2>Plus Plan</h2>

<p>The Plus Plan includes unlimited email and telephone informational medical consultations.  Diagnostic medical consultations are billed on a pay per use basis.</p>

<ul>

<li>Email Consult:<span class="bold"> FREE</span></li>

<li>Information Conult: <span class="bold">FREE</span></li>

<li>Diagnostic Consult: <span class="bold">$35.00 per call</span></li>

</ul>

</div>

<div class="column">

<div id="mostpopular">Most Popular</div>

<div class="planinputbox"><label for="plan"><input name="plan" type="radio" value="Enhanced Individual" />$10.95/ Individual</label> <label for="plan"><input name="plan" type="radio" value="Enhanced Family" />$14.95/ Family</label> <span class="per"> / month</span></div>

<h2>Enhanced Plan</h2>

<p>The Enhanced Plan provides you unlimited access to both email and telephone informational medical consultations.  Two diagnostic medical consultations are included each year.  Additional diagnostic medical consultations are billed on a pay per use basis.</p>

<ul>

<li>Email Consult: <span class="bold">FREE</span></li>

<li>Information Consult:<span class="bold"> FREE</span></li>

<li>Two Diagnostic Consults Included:<span class="bold"> FREE</span></li>

<li>Additional Diagnostic Consult:<span class="bold"> $35.00 per call</span></li>

</ul>

</div>

<div class="column">

<div class="planinputbox"><label for="plan"><input name="plan" type="radio" value="Unlimited Individual" />$13.95/ Individual</label> <label for="plan"><input name="plan" type="radio" value="Unlimited Family" />$17.95/ Family</label> <span class="per"> / month</span></div>

<h2>Unlimited Plan</h2>

<p>The Unlimited Plan is our most comprehensive plan and our best value.  The Unlimited Plan includes unlimited email, telephone informational medical consultations, AND unlimited diagnostic medical consultations.</p>

<ul>

<li>Email Consult: <span class="bold">FREE</span></li>

<li>Information Consult:<span class="bold"> FREE</span></li>

<li>Diagnostic Consult:<span class="bold">FREE</span></li>

</ul>

</div>

<div class="bottom">

<div class="bottomleft">One Time Enrollment Fee:</div>

<div class="bottomright">

<p>All accounts will be billed a one-time enrollment fee in the amount of $20 for the setup and activation of your account.  This a one-time fee and is non-recurring.</p>

</div>

</div>

<input id="next" name="next" type="submit" value="Submit" /> </form></div>


