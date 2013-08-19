
<ul id="breadcrumb">
<li class="first">1. Select Your Plan <span class="arrow"></span></li>
<li>2. Member Information <span class="arrow"></span></li>
<li>3. Process Payment <span class="preactivearrow"></span></li>
<li class="active last">4. Confirmation</li>
</ul>

<!--
<ul id="breadcrumb">

<li class="first">1. Member Information <span class="arrow"></span></li>
<li>2. Process Payment <span class="preactivearrow"></span></li>
<li class="active last">3. Confirmation</li>
</ul>
-->
<?php
echo '<div id="thankyouMessage">';
echo'<h1>You are now a member!</h1>  
	   <h2>You will receive a confirmation email shortly.</h2>';
echo '</div>';

echo '<div class="memberInfo">';
echo '<h2>Your Information</h2>';
echo '<p>Your confirmation number is <span class="bold">'.$transaction_id.'</span></p>';

echo '<p>Your Ameridoc username is <span class="bold">'.$username.'</span></p>';
echo '<p>Your Ameridoc password is <span class="bold">'.$password.'</span></p>';
echo '</div>';



echo "<a id='loginbtn' href='https://www.ameridoc.com/member/login.aspx'>Log In</a>";

echo "<div id='login_note'>";
echo "<p>Log in to access your Electronic Health Record or schedule a consultation.</p>";
echo "<p class='or'>OR</p>";
echo "<p>To talk to a doctor now, call 877-263-7409</p>";
echo "</div>";


?>
