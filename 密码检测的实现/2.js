<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function mailsome1(){
who=prompt("Enter recipient's email address: ","antispammer@earthling.net");
what=prompt("Enter the subject: ","none");
if (confirm("Are you sure you want to mail "+who+" with the subject of "+what+"?")==true){
parent.location.href='mailto:'+who+'?subject='+what+'';
}
}
// End -->
</SCRIPT>
<a href='javascript:mailsome1()'>E-Mail Someone!</a>
<FORM>
<input type=button value="E-Mail Someone!" onClick="mailsome1()">
</FORM>