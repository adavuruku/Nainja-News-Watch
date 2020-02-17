<?php
//update
$str = "&lt;&copy; W3S&ccedil;h&deg;&deg;&brvbar;&sect;&gt;";
echo html_entity_decode($str).'<br/>';
$str = "<© W3Sçh°°¦§>";
echo htmlentities($str).'<br/>';
$str = "This is some <b>bold</b> text.";
echo htmlspecialchars($str).'<br/>';
$str = "This is some &lt;b&gt;bold&lt;/b&gt; text.";
$str = "&lt;p style=&quot;text-align:justify&quot;&gt;&lt;span style=&quot;font-size:16px&quot;&gt;&lt;span style=&quot;font-family:lucida sans unicode,lucida grande,sans-serif&quot;&gt;A problem may have numerous algorithmic solutions. In order to choose the best algorithm for a particular task, you need to be able to judge how long a particular solution will take to run. Or, more accurately, you need to be able to judge how long two solutions will take to run, and choose the better of the two. You don&amp;#39;t need to know how many minutes and seconds they will take, but you do need some way to compare algorithms against one another.&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;";

echo htmlspecialchars_decode($str).'<br />';
echo strip_tags($str);
?>