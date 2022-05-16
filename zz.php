<?php 
include 'core/init.php';
include 'includes/overall/overall_header.php';
protect_page();
include 'includes/menu.php';
include 'includes/overall/navigate.php';
include 'includes/widgets/loggedin.php';

?>      

<h1>Assessment</h1>

<form action="save.php" method="post">

<p class="p1">
Question 1</p>
<p class="p4">
Are you tall or short?</p>

<p class="p3"> 
<input type="radio" name="q1" value="1" />
1
<input type="radio" name="q1" value="2" />
2
<input type="radio" name="q1" value="3" />
3
<input type="radio" name="q1" value="4" />
4
<input type="radio" name="q1" value="5" />
5
</p><br><br>
</form>

<?php
}
 include 'includes/overall/overall_footer.php'; 
 ?>  