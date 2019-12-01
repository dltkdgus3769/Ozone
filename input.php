<script language='javascript'>
  window.setTimeout('window.location.reload()',10000); //10초마다 리플리쉬 시킨다 1000이 1초가 된다.
 </script>
<?php 
    $json = file_get_contents('https://ozoneinfo.herokuapp.com/api/ozoneInfo');
	//echo("$json");
	header('Content-Type: text/html; charset=utf-8');
	echo '<br>';
	echo '<hr>';
	echo("<table border=0 width=100% align=center><tr align=center><td><font size=10 color=blue>양식장내 O3 수치</font></td></tr></table>");
	echo("<hr>");
    
	$R = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($json, TRUE)),
    RecursiveIteratorIterator::SELF_FIRST);


$json_string = file_get_contents('https://ozoneinfo.herokuapp.com/api/ozoneInfo/one/ozoneinfo');
$R = json_decode($json_string, true);
// json_decode : JSON 문자열을 PHP 배열로 바꾼다
// json_decode 함수의 두번째 인자를 true 로 설정하면 무조건 array로 변환된다.
// $R : array data




echo("<table border=1 style=border-collapse:collapse width=100% align=center><tr align=center bgcolor=#F8F6C3>
											<td width=30% ><font size=5 color=#135CFA>Device ID</font></td>
											<td><font size=5 color=#135CFA>Measured Value</font></td>
											<td><font size=5 color=#135CFA>Measurement time</font></td></tr>");
foreach ($R as $row) {
	$date = $row['createdAt'];
	$date2 = substr($date,0,10);
	$date3 = substr($date,11,11);
	$value = $row['readingValue'];
	$PerVal = ($value/10)*100; 
	echo ("
			<tr align=center><td height=50><font size=10>$row[deviceId]</font></td>
							<td><font size=10>$row[readingValue] ppm</font></td>
							<td><font size=10>$date2 $date3</font></td></tr>"); 
	echo(" <tr align=center><td colspan=3>
								<table border=0 width=100%>
									<tr>
										<td width=33% bgcolor=#9EFA5C align=center><font size=10>양호</font></td>
										<td width=33% bgcolor=#FBF46D align=center><font size=10>보통</font></td>
										<td width=33% bgcolor=#FB4646 align=center><font size=10>나쁨</font></td>
									</tr>
									<tr>
										<td colspan=3><hr width=$PerVal% style= 'border: solid 7px #0602FA' align=left></td>
									</tr>
								</table>
							</td></tr>");
	
	
}
echo("</table>");

?>